@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @guest
                <img src="../images/{{$data->image}}" width="400" height="400" alt="">
                <p>{{$data->name}}</p>
                <p>{{$data->price}}</p>
                <p>{{$data->description}}</p>
                <form action="{{url('/'.$data->id.'/product/update')}}" method="post" enctype="multipart/form-data">
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
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    Quantity: <input type="number" name="quantity" id="" value="1"><br>
                    <input type="submit" value="Add to Cart">
                </form>
                @endif
            @endguest
        </div>
    </div>
</div>
@endsection