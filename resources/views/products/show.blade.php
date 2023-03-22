@extends('layouts.main')
@section('title','{{$product->name}}')
@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/products/{{$product->image}}" class="img-fluid" alt="{{$product->name}}">
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{$product->name}}</h1>
                <p class="event-city"><ion-ion name="location-outline"></ion-ion>teste</p>
            </div>
        </div>
    </div>
@endsection