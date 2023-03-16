@extends('layouts.main')
@section('title','PRODUTOS')
@section('content')


    <h1>Algum Título</h1>
    @if(10 >5)
        <p>A condição é true</p>
    @endif
        <p>{{$nome}}</p>
    @if($nome=="Pedro")
        <p>Certo</p>
    @else
        <p>Errado</p>
    @endif
    
    @for($i=0;$i<count($arr);$i++)
    {
        <p>{{ $arr[$i] }} - {{$i}}</p>
        @if($i % 2 !=0)
         <p>impar</p>
        @endif
    }
    @endfor
    @php
        $name = 'joão';
        echo $name;
    @endphp
    @foreach ($nomes as $nome)
        <p>{{$loop->index}}</p>
        <p>{{$nome}}</p> 
    @endforeach

@endsection

  
