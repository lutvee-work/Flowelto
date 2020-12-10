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
        <div class="col-md-4">
            <div class="card-deck">
                <div class="card">
                    <img src="/storage/images/{{$c['image']}}" class="card-img-top" width="400" height="400" alt="">
                    <div class="card-body text-center">
                        <p class="card-title">{{$c['name']}}</p>
                        <p class="card-text">Rp. {{ number_format($c['price'] * $c['quantity']) }}</p>

                        <form action="{{url('cart/update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        
                            <div class="form-group row">
                                <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                                <div class="col-md-6">
                                    <input class="form-control @error('quantity') is-invalid @enderror" type="number" name="quantity[]" id="{{$c['id']}}" value="{{$c['quantity']}}">
                                    <input type="hidden" name="id" value="{{ $c['id'] }}" class="form-control">
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Update">
                        </form>
                    </div>
                </div>
            </div> 
        </div>
        @empty
        <div class="row justify-content-center">
            <h1>Empty Cart!!!</h1>
        </div>
        @endforelse
    </div>
    @if(count($carts) > 0)
    <div class="text-center mt-5">
        <form action="cart/checkout" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <input class="btn btn-danger" type="submit" value="Checkout">
            </div>
        </form>
    </div>
    @endif
</div>
@endsection