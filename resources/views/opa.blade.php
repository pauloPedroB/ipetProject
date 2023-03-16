@extends('layouts.main')
@section('title','opa')
@section('content')
    Ola
    <a href="/">Voltar</a>
    @if($busca != '')
    <p>{{$busca}}</p>
    @endif
@endsection
