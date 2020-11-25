@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <img src="../images/{{$data->image}}" width="400" height="400" alt="">
            <p>{{$data->name}}</p>
            <p>{{$data->price}}</p>
            <p>{{$data->description}}</p>
        </div>
    </div>
</div>
@endsection