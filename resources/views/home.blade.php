@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($products as $p)
        <div class="col-md-8">
            <a href="{{url('/'.$p->id.'/product')}}">
                <img src="images/{{$p->image}}" width="400" height="400" alt="">
            </a>
            <a href="{{url('/'.$p->id.'/product')}}">{{$p->name}}</a>
        </div>
        @endforeach
    </div>
</div>
@endsection
