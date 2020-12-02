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
        <table border="1" style="text-align:center">
            <tr>
                <th>Flower Image</th>
                <th>Flower Name</th>
                <th>Subtotal</th>
                <th>Quantity</th>
            </tr>
            @foreach($data['historyDetail'] as $h)
            <tr>
                <td><img src="../images/{{$h->image}}" width="300" height="300" alt=""></td>
                <td>{{$h->name}}</td>
                <td>Rp. {{number_format($h->subtotal)}}</td>
                <td>{{$h->quantity}}</td>
            </tr>
            @endforeach
        </table>
        <div class="col-md-8">
            <p>Total Price: Rp. {{number_format($data['totalPrice'])}}</p>
        </div>
    </div>
</div>
@endsection
