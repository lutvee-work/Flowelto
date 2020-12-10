@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-4">
            @if (session('failed'))
                <div class="alert alert-danger">
                    {{ session('failed') }}
                </div>
            @endif
        </div>
    </div>
    
    <div class="row justify-content-center">
            <h1>{{$data['products']->name}}</h1>
    </div>
        
    <div class="col-md-8">
        <form class="form-inline" action="{{url('/'.$data['products']->id.'/product/search')}}" method="GET">
            <select name="filter" class="custom-select mr-2">
                <option value="name">Name</option>
                <option value="price">Price</option>
            </select>
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" value="{{ old('search') }}">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    
    <br>

    <div class="row justify-content-center">
        <h1>Search result of <b>{{$data['search']}}</b></h1>
    </div>
    
    <br>

    <div class="row justify-content-center">
    @forelse($data['flowers'] as $f)
        <div class="col-md-4 mt-5">
            @guest
                <div class="card-deck">
                    <div class="card">
                        <a href="{{url('/'.$f->id.'/detail')}}">
                            <img src="/storage/images/{{$f->image}}" class="card-img-top" width="400" height="400" alt="">
                        </a>
                        <div class="card-body">
                            <a class="card-title" href="{{url('/'.$f->id.'/detail')}}">{{$f->name}}</a>
                            <p class="card-text">Rp. {{number_format($f->price)}}</p>
                        </div>
                    </div>
                </div>
            @else
            <div class="card-deck">
                <div class="card">
                    <a href="{{url('/'.$f->id.'/detail')}}">
                        <img src="/storage/images/{{$f->image}}" class="card-img-top" width="400" height="400" alt="">
                    </a>
                    <div class="card-body text-center">
                        <a class="card-title" href="{{url('/'.$f->id.'/detail')}}"> <h4><b>{{$f->name}}</b></h4> </a>
                        <p class="card-text">Rp. {{number_format($f->price)}}</p>
                        @if (Auth::user()->roles->contains(1))
                        <a class="btn btn-danger" href="{{url('/'.$f->id.'/product/delete')}}">Delete Flower</a>
                        <a class="btn btn-primary" href="{{url('/'.$f->id.'/product/edit')}}">Update Flower</a>
                        @endif
                    </div>
                </div>
            </div>
            @endguest
        </div>
        @empty
        <div class="row justify-content-center">
            <h1>No Result!!!</h1>
        </div>
        @endforelse
    </div>
    {{ $data['flowers']->links() }}
</div>
@endsection