@extends('layouts.app')
@section('content')
<h1>Pré-reserva salas de Videoconferência FE-UNICAMP</h1>


@if($mensagem)
<div class="{{ $css }}">
    {{ $mensagem }}    
</div>
<div class="center-block">     
    <a href="{{env('APP_URL')}}/">Fazer nova pré-reserva</a>
</div>

@else

    @if(count($errors) >0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{ Form::open(['action' => 'pre_reservaController@gravar']) }}    
    <p>
    {{ Form::label('nome','Nome*:') }}
    {{ Form::text('nome','',['class'=>'form-control','required','placeholder'=>'Seu nome aqui']) }}
    </p>
    <p>
    {{ Form::label('email','E-mail*:') }}
    {{ Form::email('email','',['class'=>'form-control','required','placeholder'=>'E-mail para contato']) }}
    </p>
    <p>
    {{ Form::label('fone','Telefone Contato:') }}
    {{ Form::number('fone','',['class'=>'form-control','placeholder'=>'Telefone fixo ou celular com DDD']) }}
    </p>
    <hr />
    <p>
    {{ Form::label('professor','Professor Responsável*:') }}
    {{ Form::text('professor','',['class'=>'form-control','required','placeholder'=>'Professor da UNICAMP responsável pelo evento']) }}
    </p>
    <p>
     {{ Form::label('evento','Evento*:') }}
     {{ Form::select('evento',
             ['Seminario' => 'Seminário',
             'Palestra' => 'Palestra',
             'Debate' => 'Debate',
             'Aula' => 'Aula',
             'Qualificacao Mestrado' => 'Qualificação Mestrado',
             'Qualificacao Doutorado' => 'Qualificação Doutorado',
             'Defesa Mestrado' => 'Defesa Mestrado',
             'Defesa Doutorado' => 'Defesa Doutorado',
             'Outros' => 'Outros (especificar em observações)'         
         ],null,['required','class'=>'form-control','placeholder'=>'Escolha o tipo de evento']) }}
    </p>
    <p>
        {{Form::label('obs','Observações:') }}
        {{Form::textarea('obs','',['class'=>'form-controll', 'rows'=>'5'])}}
    </p>
    <p>
        {{Form::label('data_reserva','Data do Evento*:')}}
        {{Form::date('data_reserva', \Carbon\Carbon::tomorrow()->addWeeks(2),['class'=>''])}}
        {{Form::label('horario','Horário*:')}}
        {{ Form::select('horario', 
             ['09:00'=>'09:00',
             '14:00'=>'14:00'
        ],null,['required','placeholder'=>''])}}

    </p>
    <p class="alert-info">
        A reserva das salas de Videoconferência deverão ser efetuadas com <b>antecedência mínima de 10 (dez) dias úteis</b> a data de realização do evento.
    </p>
    <hr />
    <p>
    {{Form::submit('Enviar pedido de Pré-reserva',['class'=>'center-block btn btn-default']) }}
    </p>
    {{ Form::close()}}
@endif

@endsection
