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
        @forelse($history as $h)
        <div class="col-md-8">
            <a href="{{url('/'.$h->id.'/history')}}">Transaction at {{$h->created_at}}</a>
            <a href="{{url('/'.$h->id.'/history/delete')}}">Delete</a>
        </div>
        @empty
        <h1>Empty Transaction!!!</h1>
        @endforelse
    </div>
</div>
@endsection
