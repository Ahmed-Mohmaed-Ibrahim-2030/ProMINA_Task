@extends('layouts.app')
@section('content')
    <form action="{{route('albums.storeImage',$album)}}" method="post"  enctype="multipart/form-data">

        @csrf
        <div class="form-group my-3">
            <label for="" class="form-label">Enter Album Name</label>
            <input type="text" name="name" class="form-control disabled " disabled value="{{$album->name}}">



        </div>
        <div class="form-group my-3">
            <label for="" class="form-label">Enter Image Name</label>
            <input type="text" name="image_name" class="form-control " value="{{old('image_name')}}">





        </div>

        <div class="form-group ml-3">

            <label for="user_image" class="form-label">
                <img style="width:200px;height:200px;" src="{{asset('assets/dist/img/avatar5.png')}}" width="200" height="200" class="img-thumbnail image-preview">
            </label>
            <input id="user_image" type="file" class="image" name="image" hidden>
        </div>
        <button type="submit" class="btn btn-primary" >Add Image</button>

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
    Add Image
@endsection
