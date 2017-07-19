<?php

namespace ead\Http\Controllers;

use Illuminate\Http\Request;
use ead\Pre_reserva;
use ead\Pre_reserva_datas;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;


class pre_reservaController extends Controller
{
    //
    
    public function __construct() {
        
    }
    
    public function index(){
        return view('form')->withMensagem('');
    }
    
    public function gravar(Request $request){    
        $this->validate($request, [
        'nome' => 'required|max:50',
        'email' => 'required|max:100|e-mail',
        'professor'=> 'required|max:50',
        'evento' => 'required',
        'fone' => 'max:20',
        'data_reserva' => 'required|date',
        'horario' => 'required'
    ]);
        
        //$dados = $request->all();
        
        $pre_reserva = new Pre_reserva();
        //$pre_reserva->fill($request->all());
        $pre_reserva->nome = $request->input('nome');
        $pre_reserva->email = $request->input('email');
        $pre_reserva->fone = $request->input('fone');
        $pre_reserva->professor = $request->input('professor');
        $pre_reserva->evento = $request->input('evento');
        $pre_reserva->obs = $request->input('obs');
        
        $pre_reserva->save();
        
        $pre_reserva_id = $pre_reserva->getKey();
        
        //grava na tabela pre_reserva_datas
        $pre_reserva_datas = new Pre_reserva_datas();
        //gera a data no formato yyyy-mm-dd hh:mm:ss
        $data_reserva = $request->input('data_reserva');
        $data_reserva .= " ". $request->input('horario');
        
        $pre_reserva_datas->data_reserva = $data_reserva;
        $pre_reserva_datas->status = 0;
        $pre_reserva_datas->pre_reserva_id = $pre_reserva_id;
        
        if ($pre_reserva_datas->save()){            
            if ($this->sendMail($request->all())){
                if (! $this->calendar($request->all()))
                    return view('form')->with(['mensagem' =>'Erro ao acessar o Google Calendar. A operação foi cancelada. Tente novamente mais tarde.','css'=>'alert alert-danger']);
                    
                return view('form')->with(['mensagem'=> 'Obrigado! Sua pré-reserva será analisada e entraremos em contato em breve.','css'=>'alert alert-info']);            
            }
            else
                return view('form')->with(['mensagem' =>'Erro ao enviar o e-mail. A operação foi cancelada. Tente novamente mais tarde.','css'=>'alert alert-danger']);
        }
        else
        {
            return view('form')->with(['mensagem' =>'Um erro inesperado ocorreu. A operação foi cancelada. Tente novamente mais tarde.','css'=>'alert alert-danger']);
        }            
    }
    
    private function sendMail($dados){
        //enviar e-mail com os dados da pré reserva
        
        
        $to = "leroberto@gmail.com";
        
        $headers = "From: leroberto@gmail.com \r\n";
        $headers .= "Reply-To: leroberto@gmail.com\r\n";
        $headers .= "CC: rleandro@g.unicamp.br,leandro@leandroroberto.com.br\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                
        
        $subject = "[EAD Pre-Reserva] Nova solicitação de pré-reserva";
        
        $message = "<html><body>";
        $message .= "<p>Um novo pedido de pré-reserva de sala de Videoconferência foi efetuado por <b>". $dados['nome']. "</b>.</p>";
        $message .= "<h4>Detalhes do pedido</h4>";
        
        
        $data = explode("-",$dados['data_reserva']);
        $data = $data[2]."/".$data[1]."/".$data[0];
        //checar disponibilidade no calendário google $disponivel
        $disponivel = "Disponível"; //api google calendar
        
        $message .= "<p>Data: <b>$data</b> Horário: <b>".$dados['horario']."</b></p>";
        $message .= "<p>Disponibilidade na Agenda: <b><a href'#'>$disponivel</a></b></p>";
        $message .= "<p>Professor Responsável: <b>".$dados['professor']."</b></p>";
        $message .= "<p>Nome do Solicitante: <b>". $dados['nome']."</b></p>";
        $message .= "<p>E-mail: <b>". $dados['email']."</b></p>";
        $message .= "<p>Telefone: <b>". $dados['fone'] . "</b></p>";
        $message .= "<p>Tipo de Evento: <b>". $dados['evento'] ."</b></p>";
        $message .= "<p>Observações: <br /><br />". $dados['obs'] ."</p>";
        
        $message .= "</body></html>";
        
        $transport = new \Swift_SendmailTransport('/usr/sbin/sendmail -bs');
        $mailer = new \Swift_Mailer($transport);
        $message = (new \Swift_Message($subject))
                ->setFrom('leandro@leandroroberto.com.br')
		->setTo($to)
		->setContentType('text/html')
                ->setBody($message);
        /*if ($result = $mailer->send($message))
            return 1;
        else
            return 0;*/
        return 1; //test mode
    }
    
    public function listarPedidos(){
        //tela de admin para gerencia de pedidos
    }
    
   //Método para pré-reserva no Google Calendar
    
    public function calendar($dados){
        $event = new Event;
        $evento = $this->getEvento($dados['evento']);
        $event->name = "Pré-reserva ".$evento . " - " . $dados['professor'];
        $data_reserva = explode("-",$dados['data_reserva']);
        $ano = $data_reserva[0];
        $mes = $data_reserva[1];
        $dia = $data_reserva[2];
        
        $horario = explode(":",$dados['horario']);
        $horario = $horario[0];
        
        //$event->startDateTime = \Carbon\Carbon::create('2017','07','18','09','00','00','America/Sao_Paulo');                         
        $event->startDateTime = \Carbon\Carbon::create($ano,$mes,$dia,$horario,"00","00","America/Sao_Paulo");                         
        //Carbon::create($year, $month, $day, $hour, $minute, $second, $tz);
        //$event->startDateTime = \Carbon\Carbon::now();                          
        //$event->endDateTime = \Carbon\Carbon::now()->addHour();
        $event->endDateTime = \Carbon\Carbon::create($ano,$mes,$dia,$horario + 3,"00","00","America/Sao_Paulo");                         
        //$event->endDateTime = \Carbon\Carbon::create('2017','07','18','12','00','00','America/Sao_Paulo');
        //$event->addAttendee(['email'=> $dados['email']]);    
        $event->description = "Solicitante: ".$dados['nome']."\n";
        $event->description .= "Evento: ". $evento. "\n";
        $event->description .= "E-mail: ". $dados['email'];
        //$event->addAttendee(['email'=> 'leroberto@gmail.com']);
        
        if ($event->save())
            return 1;
        else
            return 0;
        
    }
    
    public function getEvento($evento){
        switch ($evento):
            case  "Qualificacao Doutorado" :
                return "Qualificação de Doutorado";
            case "Qualificacao Mestrado" :
                return "Qualificação Mestrado";
            case "Seminario":
                return "Seminário";
            default:
                return $evento;            
        endswitch;        
    }
    
}
