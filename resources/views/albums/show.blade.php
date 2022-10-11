@extends('layouts.app')
@section('content')
    <div class=" row row-cols-1 row-cols-lg-3  row-cols-md-2 justify-content-between">
        @foreach($images as $image)
            <div class=" my-2  col" >
                <div class=" card p-1 " >

                        <img src="{{asset('assets/images/albums/'.$image->image)??asset('assets/dist/img/avatar5.png')}}" width="200" height="200" class="card-img-top " alt="{{$album->images->first()->name}}">

                    <div class="card-body">

                        <h3 class="card-text">{{$image->name}}</h3>



                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="d-flex justify-content-end">
        <div class="">

            {{$images->links()}}
        </div>
    </div>
@endsection
@section('title')
     Album {{$album->name}} Images
@endsection
