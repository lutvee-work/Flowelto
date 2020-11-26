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
            <img src="images/{{$p->image}}" width="400" height="400" alt="">
            <a href="{{url('/'.$p->id.'/product')}}">{{$p->name}}</a>
            <a href="{{url('/'.$p->id.'/categories/delete')}}">Delete Category</a>
            <a href="{{url('/'.$p->id.'/categories/edit')}}">Update Category</a>
        </div>
        @endforeach
    </div>
</div>
@endsection
