<?php

namespace ead\Http\Controllers;

use Illuminate\Http\Request;
use ead\Pre_reserva;
use ead\Pre_reserva_datas;

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
            $this->sendmail($request->all());            
            return view('form')->with(['mensagem'=> 'Obrigado! Sua pré-reserva será analisada e entraremos em contato em breve.','css'=>'alert alert-info']);            
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
        
        
        
        /*echo $subject . "<br>";
        echo $message;*/
        
        //mail($to, $subject, $message, $headers);
    }
    
    public function listarPedidos(){
        //tela de admin para gerencia de pedidos
    }
    
   //Método para pré-reserva no Google Calendar
    
    
}
