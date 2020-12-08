@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach($products as $p)
        <div class="col-md-8">
            <a href="{{url('/'.$p->id.'/product')}}">
                <img src="/storage/images/{{$p->image}}" width="400" height="400" alt="">
            </a>
            <a href="{{url('/'.$p->id.'/product')}}">{{$p->name}}</a>
        </div>
        @endforeach
    </div>
</div>
@endsection
