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
            <!-- Pendentes -->
            {{ Form::open(['action'=>'adminController@showConfirm','method'=>'POST']) }}
            {{ Form::hidden('id',$id)}} 
            {{ Form::hidden('novoStatus',4) }}
            {{ Form::hidden('statusA','PENDENTE')}}
            {{ Form::hidden('statusB','AGUARDANDO FORMULÁRIO')}}
            {{ Form::hidden('metodo','adminController@setStatus')}}
            {{ Form::hidden('retorno','adminController@listarPendentes')}}
            {{ Form::submit('Aprovar (Mudar status para Aguardando formulário)',['class'=>'btn btn-success center-block'])}}  
            {{ Form::close()}}
            <br />
            {{ Form::open(['action'=>'adminController@showConfirm','method'=>'POST']) }}
            {{ Form::hidden('id',$id)}}
            {{ Form::hidden('novoStatus',2) }}
            {{ Form::hidden('statusA','PENDENTE')}}
            {{ Form::hidden('statusB','NÃO CONFIRMADO')}}
            {{ Form::hidden('metodo','adminController@setStatus')}}
            {{ Form::hidden('retorno','adminController@listarPendentes')}}
            {{ Form::submit('Não Confirmar', ['class'=>'btn btn-danger center-block'])}}
            {{ Form::close() }}
            <br />
            {{ Form::open(['action'=>'adminController@showConfirm','method'=>'POST']) }}
            {{ Form::hidden('id',$id)}} 
            {{ Form::hidden('novoStatus',3) }}
            {{ Form::hidden('statusA','PENDENTE')}}
            {{ Form::hidden('statusB','RESERVA TÉCNICA')}}
            {{ Form::hidden('metodo','adminController@setStatus')}}
            {{ Form::hidden('retorno','adminController@listarPendentes')}}
            {{ Form::submit('Reserva Técnica', ['class'=>'btn btn-info center-block'])}}
            {{ Form::close() }}
        </p>
    @endif

    @if($link == "aguardando-formulario")
        <p>
            <!-- Aguardando formulario -->
            {{ Form::open(['action' => 'adminController@showConfirm','method'=>'POST']) }}
            {{ Form::hidden('id',$id)}} 
            {{ Form::hidden('novoStatus',1) }}
            {{ Form::hidden('statusA','AGUARDANDO FORMULÁRIO')}}
            {{ Form::hidden('statusB','APROVADA')}}
            {{ Form::hidden('metodo','adminController@setStatus')}}
            {{ Form::hidden('retorno','adminController@listarPreReservadas')}}
            {{ Form::submit('Aprovar pré-reserva',['class'=>'btn btn-success center-block'])}}  
            {{ Form::close() }}
        <br />
            {{ Form::open(['action'=>'adminController@showConfirm','method'=>'POST']) }}
            {{ Form::hidden('id',$id)}}
            {{ Form::hidden('statusA','AGUARDANDO FORMULÁRIO')}}
            {{ Form::hidden('statusB','NÃO CONFIRMADA')}}
            {{ Form::hidden('novoStatus',2) }}
            {{ Form::hidden('metodo','adminController@setStatus')}}
            {{ Form::hidden('retorno','adminController@listarPreReservadas')}}
            {{ Form::submit('Não Confirmar', ['class'=>'btn btn-danger center-block'])}}
            {{ Form::close() }}
        <br />
            {{ Form::open(['action'=>'adminController@showConfirm','method'=>'POST']) }}
            {{ Form::hidden('id',$id)}}
            {{ Form::hidden('statusA','AGUARDANDO FORMULÁRIO')}}
            {{ Form::hidden('statusB','CANCELADA')}}
            {{ Form::hidden('novoStatus',5) }}
            {{ Form::hidden('metodo','adminController@setStatus')}}
            {{ Form::hidden('retorno','adminController@listarPreReservadas')}}
            {{ Form::submit('Cancelar', ['class'=>'btn btn-info center-block'])}}
            {{ Form::close() }}

    @endif
        </p>
        
    @if($link == "aprovadas")
        <p>
            <!-- aprovadas -->        
            {{ Form::open(['action'=>'adminController@showConfirm','method'=>'POST']) }}
            {{ Form::hidden('id',$id)}}
            {{ Form::hidden('statusA','APROVADA')}}
            {{ Form::hidden('statusB','CANCELADA')}}
            {{ Form::hidden('novoStatus',5) }}
            {{ Form::hidden('metodo','adminController@setStatus')}}
            {{ Form::hidden('retorno','adminController@listarAprovadas')}}
            {{ Form::submit('Cancelar Pré-reserva', ['class'=>'btn btn-info center-block'])}}
            {{ Form::close() }}

    @endif
        </p>
        
        
    @if($link == "negadas")
        <p>
            <!-- negadas -->        
            {{ Form::open(['action'=>'adminController@showConfirm','method'=>'POST']) }}
            {{ Form::hidden('id',$id)}}
            {{ Form::hidden('statusA','NÃO CONFIRMADA')}}
            {{ Form::hidden('statusB','AGUARDANDO FORMULÁRIO')}}
            {{ Form::hidden('novoStatus',4) }}
            {{ Form::hidden('metodo','adminController@setStatus')}}
            {{ Form::hidden('retorno','adminController@listarNegadas')}}
            {{ Form::submit('Mudar status para Aguardando formulário', ['class'=>'btn btn-success center-block'])}}
            {{ Form::close() }}

    @endif
        </p>  
        

    @if($link == "reserva-tecnica")
    <p>
        <!-- reserva técnica -->
        {{ Form::open(['action'=>'adminController@showConfirm','method'=>'POST']) }}
        {{ Form::hidden('id',$id)}}
        {{ Form::hidden('statusA','RESERVA TÉCNICA')}}
        {{ Form::hidden('statusB','CANCELADA')}}
        {{ Form::hidden('novoStatus',5) }}
        {{ Form::hidden('metodo','adminController@setStatus')}}
        {{ Form::hidden('retorno','adminController@listarReservaTecnica')}}
        {{ Form::submit('Cancelar Pré-reserva', ['class'=>'btn btn-danger center-block'])}}
        {{ Form::close() }}

    @endif
    </p>
        
    <p>
        <a href="{{env('APP_URL')}}/admin/{{$link}}" class="center-block btn">Voltar</a>    
    </p>

@endsection