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
        <div class="col-md-8">
            @guest
                <img src="../images/{{$data->image}}" width="400" height="400" alt="">
                <p>{{$data->name}}</p>
                <p>{{$data->price}}</p>
                <p>{{$data->description}}</p>
                <form action="{{url('/cart')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    Quantity: <input type="number" name="quantity" id="" value="1"><br>
                    <input type="submit" value="Add to Cart">
                </form>
            @else
                <img src="../images/{{$data->image}}" width="400" height="400" alt="">
                <p>{{$data->name}}</p>
                <p>{{$data->price}}</p>
                <p>{{$data->description}}</p>
                @if (!Auth::user()->roles->contains(1))
                <form action="{{url('/cart')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    Quantity: <input type="number" name="quantity" id="" value="1"><br>
                    <input type="hidden" name="id" value="{{ $data->id }}" class="form-control">
                    <input type="submit" value="Add to Cart">
                </form>
                @endif
            @endguest
        </div>
    </div>
</div>
@endsection