@extends('layouts.admin')
@section('admin')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Tem certeza?</div>
            <div class="panel-body">
                <p>
                    Confirma a alteração de status de <b>{{$statusA}}</b> para <b>{{$statusB}}</b>?
                </p>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        {{ Form::open(['action'=> $metodo,'method'=>'PUT']) }}
                        {{Form::submit('Sim',['class'=>'btn btn-success'])}}                        
                        {{Form::hidden('id',$id)}} 
                        {{Form::hidden('retorno',$retorno)}}
                        {{Form::hidden('novoStatus',$novoStatus)}}
                        {{Form::close()}}
                        <br>
                        {{Form::open(['action'=>  $retorno,'method'=>'GET']) }}
                        {{Form::submit('Não',['class'=>'btn btn-danger'])}}  
                        {{Form::close()}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection