@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <img src="/images/{{$data->image}}" width="400" height="400" alt="">
            <form action="{{url('/'.$data->id.'/product/update')}}" method="post" enctype="multipart/form-data">
                @csrf
                Category: <select name="product_id" id="">
                @foreach($category as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
                </select> <br>
                Name: <input type="text" name="name" id="" value="{{$data->name}}"><br>
                Price: <input type="number" name="price" id="" value="{{$data->price}}"><br>
                Description: <input type="text" name="description" id="" value="{{$data->description}}"><br>
                Flower Image: <input type="file" name="image" ><br>
                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</div>
@endsection