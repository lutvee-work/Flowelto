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
        <table class="table table-bordered text-center">
            <tr>
                <th>Flower Image</th>
                <th>Flower Name</th>
                <th>Subtotal</th>
                <th>Quantity</th>
            </tr>
            @foreach($data['historyDetail'] as $h)
            <tr>
                <td><img src="/storage/images/{{$h->image}}" width="300" height="300" alt=""></td>
                <td class="align-middle">{{$h->name}}</td>
                <td class="align-middle">Rp. {{number_format($h->subtotal)}}</td>
                <td class="align-middle">{{$h->quantity}}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="row justify-content-center">
        <h2>Total Price: Rp. {{number_format($data['totalPrice'])}}</h2>
    </div>
</div>
@endsection
