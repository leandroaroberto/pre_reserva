<?php

namespace ead\Http\Controllers;

use Illuminate\Http\Request;
use ead\Pre_reserva;
use ead\Pre_reserva_datas;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class adminController extends Controller
{
    
    //const STATUS = array([0 => '[PENDENTE]',1 => '',2 => '[NÃO APROVADA]',3 => '[RESERVA TÉCNICA]', 4 => '', 5 => '[CANCELADA]']);
    
     public function __construct()
    {
        $this->middleware('auth');
    }    
    
    public function index(){        
        return $this->listarPendentes('');        
    }
    
    public function listarPendentes(){
        //status => 0
        $label = "pendentes de aprovação";        
        $dados = Pre_reserva_datas::where('status',0)->orderBy('data_reserva')->paginate(20);
        
        return view('admin.index')->with(['dados'=> $dados, 'label'=> $label,'tipo' => 'pendentes','mensagem'=> '']);        
    }
    
    
    public function listarAprovadas(){
        //Aprovada / Efetivada => status 1
        $label = "aprovadas";
        $dados = Pre_reserva_datas::where('status',1)->orderBy('data_reserva')->paginate(20);                
        return view('admin.index')->with(['dados'=> $dados, 'label'=> $label, 'tipo' => 'aprovadas','mensagem'=>'']);
    }
    
    public function listarNegadas(){
        //Não confirmadas - Datas liberadas =>status = 2
        //Apagar do google calendar??? NEVER
        $label = "não confirmadas";
        $dados = Pre_reserva_datas::where('status',2)->orderBy('data_reserva')->paginate(20);   
        return view('admin.index')->with(['dados'=> $dados, 'label'=> $label, 'tipo' => 'negadas','mensagem'=>'']);
   }
    
    public function listarReservaTecnica(){
        //Reserva Técnica =>status = 3
        $label = "reserva técnica";
        $dados = Pre_reserva_datas::where('status',3)->orderBy('data_reserva')->paginate(20);                
        return view('admin.index')->with(['dados'=> $dados, 'label'=> $label, 'tipo' => 'reserva-tecnica','mensagem'=>'']);        
    }
    
     public function listarPreReservadas(){
        //pré-reservas aguardando formulário => status = 4
        $label = "aguardando formulário";
        $dados = Pre_reserva_datas::where('status',4)->orderBy('data_reserva')->paginate(20);   
        return view('admin.index')->with(['dados'=> $dados, 'label'=> $label, 'tipo' => 'aguardando-formulario','mensagem'=>'']);
   }  
    
    public function listarCanceladas(){
        //pré-reservas canceladas => status = 5
        $label = "canceladas";
        $dados = Pre_reserva_datas::where('status',5)->orderBy('data_reserva')->paginate(20);   
        return view('admin.index')->with(['dados'=> $dados, 'label'=> $label, 'tipo' => 'canceladas','mensagem'=>'']);
   }     
   
    public function show($id, Request $request){        
        $link = $request->get('tipo');
        $dados = Pre_reserva::where('id',$id)->with('pre_reserva_datas')->get();
        return view('admin.info')->with(['dados'=>$dados, 'link'=>$link]);
    }
    
    public function setStatus(Request $form){
        //$status => id do novo status
        /*
         * 0 - PENDENTE
         * 1 - APROVADA
         * 2 - NEGADA
         * 3 - RESERVA TÉCNICA
         * 4 - AGUARDANDO FORMULÁRIO
         * 5 - CANCELADA
         */
        
        $id = $form->input('id');
        $retorno = $form->input('retorno');
        $novoStatus = $form->input('novoStatus');
        
        $dados = Pre_reserva_datas::find($id);            
        $dados->status = $novoStatus;                        
        $gid = $dados->gid;                        
        
        $result = $this->updateGCalendar($gid,$dados->status); 
        //$result = trim($result);
        //teste
        return $result;
        
        
        if ($result){
            if ($dados->save()){
                /*Exemplo com parâmetro - TESTAR
                return redirect()->action(
                $retorno, ['id' => 1]);*/
                return redirect()->action($retorno);                
            }
            else
            {
                //erro ao gravar
                return 0;
            }                
        }
        else
        {
            //erro google calendar
            return 0;
        }
    }    
    
    
    public function showConfirm(Request $dados){        
        $a = $dados->input('statusA');
        $b = $dados->input('statusB');
        $novoStatus = $dados->input('novoStatus');
        $metodo = $dados->input('metodo');
        $id = $dados->input('id');
        $retorno = $dados->input('retorno');
        
        return view('admin.confirm')->with(['statusA'=>$a, 'statusB'=> $b, 'metodo'=> $metodo, 'id'=> $id, 'retorno'=>$retorno, 'novoStatus'=> $novoStatus]);        
    }
    
    
    private function updateGCalendar($gid,$novoStatus){
        //UPDATE Google Agenda
        $event = Event::find($gid);
        $titulo = $event->name;
        $status = array(0 => '[PENDENTE] ', 1 => '[APROVADA]', 2 => '[NÃO APROVADA] ',3 => '[RESERVA TÉCNICA] ', 4 => ' ', 5 => '[CANCELADA] ');
        //return $status;
        
        $flags = explode(" ", $titulo);
        
        
        if($novoStatus != 1)
        {            
            for ($i =0; $i < count($flags); $i++)
            {
                if ($i == 0){                    
                    $novoTitulo = $status[$novoStatus] . " ";
                }
                else
                {
                    $novoTitulo .= $flags[$i] . " ";
                }    


            }
            $novoTitulo = trim($novoTitulo);
        }
        else
        {
            //Pré-reserva aprovada - remover o "pré-reserva do título
            $novoTitulo = explode("Pré-reserva", $titulo);
            $novoTitulo = $novoTitulo[1];
        }    

        return "Google: " .$titulo. " Novo: " .$novoTitulo;

        $event->name = $novoTitulo;
        if ($event->save())
            return 1;
        else
            return 0;       
    }
        
    
}
