@extends('layouts.admin')
@section('admin')
    
<h3>Pré-reservas <b>{{ $label }}</b></h3>
    
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
                    <td>{{ $dado->data_reserva }}</td>            
                    <td>{{ $dado->pre_reserva->evento }}</td>
                    <td>{{ $dado->pre_reserva->professor }}</td>            
                    <td>
                        <a href="/admin/{{$dado->id}}"><span class="glyphicon glyphicon-search"></span></a>                        
                    </td>
                </tr>
            @endforeach             
        @endif
    </table>
            
        {{ $dados->links() }}
    
@endsection
