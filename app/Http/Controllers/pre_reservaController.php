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
        return view('form');
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
        
        $pre_reserva_datas->save();
        
        
        return redirect()->action('pre_reservaController@index');
        
    }
    
    
    
}
