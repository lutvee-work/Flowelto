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
        @forelse($carts as $c)
        <div class="col-md-8">
            <img src="/storage/images/{{$c['image']}}" width="400" height="400" alt="">
            <p>{{$c['name']}}</p>
            <p>Rp. {{ number_format($c['price'] * $c['quantity']) }}</p>

            <form action="{{url('cart/update')}}" method="post" enctype="multipart/form-data">
                @csrf
                Quantity: <input type="number" name="quantity[]" id="{{$c['id']}}" value="{{$c['quantity']}}"><br>
                <input type="hidden" name="id" value="{{ $c['id'] }}" class="form-control">
                <input type="submit" value="Update">
            </form>
        </div>
        @empty
        <h1>Empty Cart!!!</h1>
        @endforelse
        {{-- blom dibenerin tampilan nya --}}
        @if(count($carts) > 0)
        <div class="col-md-8">
            <form action="cart/checkout" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="submit" value="Checkout">
            </form>
        </div>
        @endif
    </div>
</div>
@endsection