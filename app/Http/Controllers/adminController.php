<?php

namespace ead\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    //
    
     public function __construct()
    {
        $this->middleware('auth');
    }    
    
    public function index(){
        return view('admin.index');
    }
    
    public function show($id){
        return $id;
    }
    
}
