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
            <div class="card">
                @guest
                    <div class="card-header">
                        <img class="mx-auto d-block" src="../images/{{$data->image}}" width="400" height="400" alt="">
                    </div>
                    <div class="card-body">
                        <p class="card-title">{{$data->name}}</p>
                        <p class="card-text">{{$data->price}}</p>
                        <p class="card-text">{{$data->description}}</p>
                        <form action="{{url('/cart')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            Quantity: <input type="number" name="quantity" id="" value="1"><br>
                            <input type="submit" value="Add to Cart">
                        </form>
                    </div>
                @else
                    <div class="card-header">
                        <img class="mx-auto d-block" src="../images/{{$data->image}}" width="400" height="400" alt="">
                    </div>
                    <div class="card-body text-center">
                        <h2 class="card-title">{{$data->name}}</h2>
                        <p class="card-text">Rp. {{number_format($data->price)}}</p>
                        <p class="card-text">{{$data->description}}</p>
                        @if (!Auth::user()->roles->contains(1))
                        <form action="{{url('/cart')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>
    
                                <div class="col-md-6">
                                    <input class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" value="{{ old('quantity') }}" required autocomplete="quantity" autofocus type="number" name="quantity" id="" value="1">
                                    <input type="hidden" name="id" value="{{ $data->id }}" class="form-control">
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <input class="btn btn-primary" type="submit" value="Add to Cart">

                        </form>
                    </div>
                    @endif
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection