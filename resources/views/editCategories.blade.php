@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <img src="/images/{{$data->image}}" width="400" height="400" alt="">
            <form action="{{url('/'.$data->id.'/categories/update')}}" method="post" enctype="multipart/form-data">
                @csrf
                Category Name: <input type="text" name="name" id="" value="{{$data->name}}"><br>
                @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
                Category Image: <input type="file" name="image" ><br>
                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</div>
@endsection