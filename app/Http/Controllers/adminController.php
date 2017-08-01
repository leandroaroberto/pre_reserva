<?php

namespace ead\Http\Controllers;

use Illuminate\Http\Request;
use ead\Pre_reserva;
use ead\Pre_reserva_datas;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class adminController extends Controller
{
    //
    
     public function __construct()
    {
        $this->middleware('auth');
    }    
    
    public function index(){        
        return $this->listarPendentes('');        
    }
    
    public function listarPendentes(){
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
        //Não confirmadas - Datas liberadas =>status =2
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
    
    public function setNegadas(Request $form){
        //Status = 2
        $id = $form->input('id');
        $retorno = $form->input('retorno');
        
        $dados = Pre_reserva_datas::find($id);            
        $dados->status = 2;                        
        $gid = $dados->gid;                        
        
        $result = $this->updateGCalendar($gid,$dados->status); 
        //return $result;
        
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
    
     public function setAguardandoFormulario(Request $form){
            $id = $form->input('id');
            $retorno = $form->input('retorno');        
            $dados = Pre_reserva_datas::find($id);            
            $dados->status = 4;                        
            $gid = $dados->gid;                        
            $result = $this->updateGCalendar($gid,$dados->status);            
            
            if ($result){
                if ($dados->save()){
                    //return redirect('admin/pendentes')->withMensagem('Pré-reserva atualizada com sucesso.');
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
    
    public function setReservaTecnica(Request $form){
        //return $form->input('id'); 
        return "Status: Reserva Técnica";
    }
    
    public function setAprovadas(Request $form){
        //return $form->input('id');
        return "Status: Aprovadas";
    }
    
    public function setCanceladas(Request $form){
        //return $form->input('id');
        return "Status: Canceladas";
    }
    
    
    public function showConfirm(Request $dados){        
        $a = $dados->input('statusA');
        $b = $dados->input('statusB');
        $metodo = $dados->input('metodo');
        $id = $dados->input('id');
        $retorno = $dados->input('retorno');
        
        return view('admin.confirm')->with(['statusA'=>$a, 'statusB'=> $b, 'metodo'=> $metodo, 'id'=> $id, 'retorno'=>$retorno]);        
    }
    
    
    private function updateGCalendar($gid,$status){
        //UPDATE Google Agenda
        $event = Event::find($gid);
        $titulo = $event->name;
        switch ($status):
            case 2 : 
                $novoTitulo = explode("[PENDENTE]", $titulo);
                //return count($novoTitulo);
                if (count($novoTitulo) > 1)
                    $novoTitulo = "[NÃO CONFIRMADO] ".$novoTitulo[1];
                else
                    $novoTitulo = "[NÃO CONFIRMADO] ".$titulo;
                break;
            case 4 : 
                $novoTitulo = explode("[PENDENTE]", $titulo);
                if (count($novoTitulo) > 1)
                    $novoTitulo = $novoTitulo[1];
                else
                    $novoTitulo = $titulo;
                break;
        endswitch;        
        
        $event->name = $novoTitulo;
        if ($event->save())
            return 1;
        else
            return 0;       
    }
    
    
}
