@extends('layouts.admin')
@section('admin')
    <?php
        foreach($dados as $dado){
            $id = $dado->id;
            $nome = $dado->nome;
            $evento = $dado->evento;
            $professor = $dado->professor;
            $email = $dado->email;
            $fone = $dado->fone;
            $obs = $dado->obs;
            $criado_em = $dado->created_at;
            
            foreach($dado->pre_reserva_datas as $pd){
                $data_reserva = $pd->data_reserva;        
            }
        }
        $data = explode(" ",$data_reserva);
        $hora = explode(":", $data[1]);
        $hora = $hora[0] . ":" . $hora[1];
        $data = explode("-", $data[0]);
        $data = $data[2]."/".$data[1]."/".$data[0];    
        $data_reserva = $data;
    ?>
    <h1>{{ ucfirst($link)}}</h1>
    <h2>{{ $data_reserva  }} - {{ $hora}} </h2>
    <p>    
        Evento: <b>{{$evento}}</b>
    </p>
    <p>
        Professor: <b>{{ $professor }}</b>
    </p>
    @if($obs != "")
        <p>
            Observações: <b>{{ $obs }}</b>
        </p>
    @endif    
    <hr>
    <p>
        Nome: <b>{{$nome}}</b>    
    </p>
    <p>
        E-mail: <b>{{$email}}</b> 
    </p>
    <p>
        Telefone: <b>{{$fone}}</b>    
    </p>
    <hr>

    @if($link == "pendentes")
    <p>
        
        {{ Form::open(['action'=>'adminController@setAguardandoFormulario','method'=>'PUT']) }}
        {{ Form::hidden('id',$id)}}        
        {{ Form::submit('Aprovar (Mudar status para Aguardando formulário)',['class'=>'btn btn-success center-block'])}}  
        {{ Form::close() }}
        <br />
        {{ Form::open(['action'=>'adminController@setNegadas','method'=>'PUT']) }}
        {{ Form::hidden('id',$id)}}        
        {{ Form::submit('Não Confirmar', ['class'=>'btn btn-danger center-block'])}}
        {{ Form::close() }}
        <br />
        {{ Form::open(['action'=>'adminController@setReservaTecnica','method'=>'PUT']) }}
        {{ Form::hidden('id',$id)}}        
        {{ Form::submit('Reserva Técnica', ['class'=>'btn btn-info center-block'])}}
        {{ Form::close() }}
    </p>

    @endif
    <p>
        <a href="/admin/{{$link}}" class="center-block btn ">Voltar</a>    
    </p>

@endsection