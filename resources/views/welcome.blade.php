@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1 class="display-3">Welcome to Flowelto Shop</h1>
        <h3>The Best Flower Shop in Binus University</h3>
    </div>
    <div class="row justify-content-center">
        @foreach($products as $p)
        <div class="col-md-4">
            <div class="card-group">
                <div class="card">
                    <a href="{{url('/'.$p->id.'/product')}}">
                        <img class="card-img-top" src="images/{{$p->image}}" width="400" height="400" alt="">
                    </a>
                    <div class="card-body">
                        <a class="card-title" href="{{url('/'.$p->id.'/product')}}">{{$p->name}}</a> 
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection