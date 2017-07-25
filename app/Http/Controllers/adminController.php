<?php

namespace ead\Http\Controllers;

use Illuminate\Http\Request;
use ead\Pre_reserva;
use ead\Pre_reserva_datas;


class adminController extends Controller
{
    //
    
     public function __construct()
    {
        $this->middleware('auth');
    }    
    
    public function index(){
        $dados = Pre_reserva_datas::paginate(20);        
        //return $dados;
        
        return view('admin.index')->with(['dados'=> $dados]);
    }
    
    public function show($id){
        //$dados = Pre_reserva::find($id);
        //$dados = Pre_reserva::find($id)->pre_reserva_datas;
        $dados = Pre_reserva::where('id',$id)->with('pre_reserva_datas')->get();
        return view('admin.info')->with(['dados'=>$dados]);
        //return $dados;
    }
    
}
