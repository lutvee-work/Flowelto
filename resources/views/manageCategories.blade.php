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
        <h1>Manage Categories</h1>
    </div>

    <div class="row justify-content-center">
        @foreach($products as $p)
        <div class="col-md-4">
            <div class="card-deck">
                <div class="card">
                    <img class="card-img-top" src="/storage/images/{{$p->image}}" width="400" height="400" alt="">
                    <div class="card-body">
                        <a class="card-title" href="{{url('/'.$p->id.'/product')}}"> <h2><b>{{$p->name}}</b></h2> </a>
                        <a class="btn btn-danger" href="{{url('/'.$p->id.'/categories/delete')}}">Delete Category</a>
                        <a class="btn btn-primary" href="{{url('/'.$p->id.'/categories/edit')}}">Update Category</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
