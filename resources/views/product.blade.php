@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$data['products']->name}}</h1>
    <div class="row justify-content-center">
        @foreach($data['flowers'] as $f)
        <div class="col-md-8">
            @guest
                <a href="{{url('/'.$f->id.'/detail')}}">
                    <img src="../images/{{$f->image}}" width="400" height="400" alt="">
                </a>
                <a href="{{url('/'.$f->id.'/detail')}}">{{$f->name}}</a>
                <p>{{$f->price}}</p>
            @else
                <a href="{{url('/'.$f->id.'/detail')}}">
                    <img src="../images/{{$f->image}}" width="400" height="400" alt="">
                </a>
                <a href="{{url('/'.$f->id.'/detail')}}">{{$f->name}}</a>
                <p>{{$f->price}}</p>
                @if (Auth::user()->roles->contains(1))
                <a href="{{url('/'.$f->id.'/product/delete')}}">Delete Flower</a>
                <a href="{{url('/'.$f->id.'/product/edit')}}">Update Flower</a>
                @endif
            @endguest
        </div>
        @endforeach
    </div>
</div>
@endsection