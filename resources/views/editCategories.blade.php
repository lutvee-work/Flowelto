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
                <div class="card-header">
                    <img class="mx-auto d-block" src="/images/{{$data->image}}" width="400" height="400" alt="">
                </div>

                <div class="card-body">
                    <form action="{{url('/'.$data->id.'/categories/update')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}</label>

                            <div class="col-md-6">

                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="" value="{{$data->name}}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Category Image') }}</label>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="image" id="image" required autocomplete="image">
                                        <label class="custom-file-label" for="image">Category Image</label>
                                    </div>
                                </div>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input class="btn btn-primary" type="submit" value="Update">
                            </div>
                        </div>  
                        
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection