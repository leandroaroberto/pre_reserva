<?php

namespace ead\Http\Controllers;

use Illuminate\Http\Request;


use Mail;

class ContatoController extends Controller
{
    //
    
    public function index(){
        $data['titulo'] = "Fale conosco";
        return view('contato',$data);
    }
    
    public function enviar(Request $request){
        
        $data = array(
            'assunto'=> $request->input('assunto'),
            'mensagem'=> $request->input('mensagem'),            
        );
        
       Mail::send('mensagem',$data, function($message){
            $message->from('leandro@leandroroberto.com.br','Leandro');
            $message->subject('Mensagem encaminhada por meio do formulário de contato');
            $message->to('leroberto@gmail.com')
                    ->cc('leandro@leandroroberto.com.br');
            
        });
        
        return redirect('contato');
    }
    
    
}
