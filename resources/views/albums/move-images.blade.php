@extends('layouts.app')
@section('content')
    <form action="{{route('albums.pasteImages',$album)}}" method="post"  enctype="multipart/form-data">

        @csrf
        <div class="form-group my-3">
            <label for="" class="form-label">Deleted Album Name</label>
            <input type="text" name="name" class="form-control disabled " value="{{$album->name}}">



        </div>
        <div class="form-group my-3">
            <label for="" class="form-label">select Album to attach images </label>
{{--            <input type="text" name="image_name" class="form-control " value="{{old('image_name')}}">--}}

            <select name="album_id" id="" class="form-control">
                <option value="" readonly></option>
                @foreach($albums as $alb)
                    <option value="{{$alb->id}}" >{{$alb->name}}</option>
                @endforeach
            </select>



        </div>


        <button type="submit" class="btn btn-primary" >Attach</button>

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
    Move Images
@endsection
