@extends('layouts.admin')
@section('admin')
<p>    
    {{$dados}}
</p>
<p>
    Tipo: {{ $link }}
</p>
<p >
    <a href="/admin/{{$link}}" class="center-block btn btn-default ">Voltar</a>    
</p>
@endsection