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
        $label = "pendentes de aprovação";
        $dados = Pre_reserva_datas::where('status',0)->orderBy('data_reserva')->paginate(20);
        return view('admin.index')->with(['dados'=> $dados, 'label'=> $label]);
        
    }
    
    public function listarAprovadas(){
        //Aprovada / Efetivada => status 1
        $label = "aprovadas";
        $dados = Pre_reserva_datas::where('status',1)->orderBy('data_reserva')->paginate(20);                
        return view('admin.index')->with(['dados'=> $dados, 'label'=> $label]);
    }
    
    public function listarNegadas(){
        //Não confirmadas - Datas liberadas =>status =2
        //Apagar do google calendar???
        $label = "não confirmadas";
        $dados = Pre_reserva_datas::where('status',2)->orderBy('data_reserva')->paginate(20);   
        return view('admin.index')->with(['dados'=> $dados, 'label'=> $label]);
   }
    
    public function listarReservaTecnica(){
        //Reserva Técnica =>status = 3
        $label = "reserva técnica";
        $dados = Pre_reserva_datas::where('status',3)->orderBy('data_reserva')->paginate(20);                
        return view('admin.index')->with(['dados'=> $dados, 'label'=> $label]);        
    }
    
    public function show($id){
        //$dados = Pre_reserva::find($id);
        //$dados = Pre_reserva::find($id)->pre_reserva_datas;
        $dados = Pre_reserva::where('id',$id)->with('pre_reserva_datas')->get();
        return view('admin.info')->with(['dados'=>$dados]);
        //return $dados;
    }
    
}
