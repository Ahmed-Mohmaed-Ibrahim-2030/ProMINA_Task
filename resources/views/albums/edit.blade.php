@extends('layouts.app')
@section('content')
    <form method="post" action="{{route('albums.update',$album)}}"  enctype="multipart/form-data">
        {{  csrf_field()}}
        {{  method_field('patch')}}
        <div class="form-group my-3">
            <label for="" class="form-label">Enter Album Name</label>
            <input type="text" name="name" class="form-control " value="{{old('name',$album->name)}}">


        </div>
        <div class="form-group my-3">
            <label for="" class="form-label">Enter Image Name</label>
            <input type="text" name="image_name" class="form-control " value="{{old('image_name',$album->images->first()->name)}}">



        </div>

        <div class="form-group ml-3">

            <label for="user_image" class="form-label">
                <img src="{{asset('assets/images/albums/'.$album->images->first()->image)??asset('assets/dist/img/avatar5.png')}}" width="200" height="200" alt="{{$album->images->first()->name}}" class="img-thumbnail image-preview">
            </label>
            <input id="user_image" type="file" class="image" name="image" hidden>

        </div>
        <button type="submit" class="btn btn-primary" >Update</button>

    </form>

    @foreach($errors->all() as $error)
        <div class="alert mt-2 alert-danger">
            {{

        $error


         }}
        </div>
    @endforeach

@endsection
@section('title')
    Edit  Album
@endsection
