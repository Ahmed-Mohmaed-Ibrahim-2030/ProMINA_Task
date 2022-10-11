@extends('layouts.app')
@section('content')
    <div class=" row row-cols-1 row-cols-lg-3  row-cols-md-2 justify-content-between">
        @foreach($albums as $album)
            <div class=" my-2  col" >
                <div class=" card p-1 " >
                    <div class="card-body">
                        <img src="{{asset('assets/images/albums/'.$album->images->first()->image)??asset('assets/dist/img/avatar5.png')}}" width="200" height="200" class=" card-img-top" alt="{{$album->images->first()->name}}">
                    </div>
                    <div class="card-body">
{{--                        <h5 class="card-title">{{$album->user->name}}</h5>--}}
                        <h3 class="card-text"><a href="{{route('albums.show',$album->id)}}">{{$album->name}}</a></h3>


                        {!! Form::open(['route'=>['albums.destroy',$album->id]])!!}
                        @method('delete')
                        <div class="row justify-content-between">

                                <a href="{{route('albums.edit',$album->id)}}" class="btn btn-sm btn-outline-warning col-3 ">Edit</a>
                                <a href="{{route('albums.addImage',$album->id)}}" class="btn btn-sm btn-outline-info col-3 ">Add Image</a>


                                <button type="submit" class="btn btn-sm btn-outline-danger delete col-3" >Delete</button>

                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end">
        <div class="">

            {{$albums->links()}}
        </div>
    </div>
@endsection
@section('title')
All Albums
@endsection
