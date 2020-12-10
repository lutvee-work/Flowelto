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
        <h1>Your Transaction History</h1>
    </div>

    <div class="row justify-content-center">
        @forelse($history as $h)
        <div class="col-md-4">
            <a class="btn btn-outline-dark" href="{{url('/'.$h->id.'/history')}}">Transaction at {{$h->created_at}}</a>
            <a class="btn btn-danger" href="{{url('/'.$h->id.'/history/delete')}}">Delete</a>
        </div>
        @empty
        <div class="row justify-content-center">
            <h1>Empty Transaction!!!</h1>
        </div>
        @endforelse
    </div>
</div>
@endsection
