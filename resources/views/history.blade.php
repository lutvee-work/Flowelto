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
        @foreach($history as $h)
        <div class="col-md-8">
            <a href="">Transaction at {{$h->created_at}}</a>
        </div>
        @endforeach
    </div>
</div>
@endsection
