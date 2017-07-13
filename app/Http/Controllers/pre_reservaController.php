<?php

namespace ead\Http\Controllers;

use Illuminate\Http\Request;
use ead\Pre_reserva;

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
        'nome' => 'required|max:10',
        'email' => 'required|max:100|e-mail',
        'professor'=> 'required|max:50',
        'evento' => 'required',
        'fone' => 'max:10',
        'data_reserva' => 'required|date',
        'horario' => 'required'
    ]);
        
        $dados = $request->all();
        
        print_r($dados);
    }
    
    
    
}
