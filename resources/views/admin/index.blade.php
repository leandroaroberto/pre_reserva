@extends('layouts.admin')
@section('admin')
    
<h3>Pré-reservas <b>{{ $label }}</b></h3>
@if($mensagem)
<h1>{{$mensagem}}</h1>
@endif
    
    <table class="table-bordered table-hover table-responsive" width="100%" align="center">
        @if(count($dados) <= 0)
        <p>Nenhuma pré-reserva localizada.</p>
        @else
            <tr>
                <th>Data</th>
                <th>Evento</th>
                <th>Professor Responsável</th>
                <th></tH>
            </tr>        
        
            @foreach($dados as $dado)
                <tr>                    
                    <?php
                        $data = ""; $hora = "";
                        $data = explode(" ",$dado->data_reserva);
                        $hora = explode(":", $data[1]);
                        $hora = $hora[0] . ":" . $hora[1];
                        $data = explode("-", $data[0]);
                        $data = $data[2]."/".$data[1]."/".$data[0];    
                    ?>
                    <td>{{ $data }} {{ $hora }}</td>            
                    <td>{{ $dado->pre_reserva->evento }}</td>
                    <td>{{ $dado->pre_reserva->professor }}</td>            
                    <td>
                        <a href="{{env('APP_URL')}}/admin/{{$dado->id}}?tipo={{$tipo}}"><span class="glyphicon glyphicon-search"></span></a>                        
                    </td>
                </tr>
            @endforeach             
        @endif
    </table>
            
        {{ $dados->links() }}
    
@endsection
