<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\Album_Image;
use Illuminate\Support\Facades\File;
class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums=Album::with(['images:name,image,album_id'])->orderBy('id','desc')->paginate(6);
        return view('albums.index')->with(compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlbumRequest  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(StoreAlbumRequest $request)

    public function store(StoreAlbumRequest $request)
    {

        $validated = $request->validated();



        $productIamge=str_replace(" ","",$validated['name']).'_'.str_replace(" ","",$validated['image_name']).'.'.$request->file('image')->extension();
        $request->file('image')->move(public_path('/assets/images/albums'),$productIamge);
       $album= new Album;
       $album->name=$validated['name'];
       $album->save();


  $image=new Album_Image;
$image->name = $validated['image_name'];
$image->image = $productIamge;
$image->album_id=$album->id;
$image->save();

       return redirect()->route('albums.index')->with('success','Album Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
$images=$album->images()->select('name','image')->orderBy('id','desc')->paginate(6);
return view('albums.show')->with(compact('images','album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
        return view('albums.edit')->withAlbum($album);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlbumRequest  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
//    public function update(UpdateAlbumRequest $request, Album $album)
    public function update(UpdateAlbumRequest $request,Album  $album)
    {
//        dd($request);
        $image_updated=false;
        $validated = $request->validated();
       if( isset($validated['name']))
       {
           $album->name=$validated['name'];
           $album->update();
       }
       $image=$album->images->first();
        if(isset($validated['name']))
        {
            $image->name = $validated['image_name'];
            $image_updated=true;
        }


if(isset($validated['image'])) {
    $productIamge = str_replace(" ", "", $validated['name']) . '_' . str_replace(" ", "", $validated['image_name']) . '.' . $request->file('image')->extension();
    $request->file('image')->move(public_path('/assets/images/albums'), $productIamge);
    $removedPhotoPath = public_path("/assets/images/albums/{$image->image}");
 File::delete($removedPhotoPath);
     $image->image = $productIamge;
    $image_updated=true;
}
     if($image_updated){
         $image->update();
     }


        return redirect()->route('albums.index')->with('success','Album Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        if(is_null($album)){
            abort(404);
        }
        else{
            $images=$album->images;
            foreach($images as $image)
            {
                $removedPhotoPath = public_path("/assets/images/albums/{$image->image}");
                File::delete($removedPhotoPath);
            }
            $album->images()->delete();

            $album->delete();
        }
        return redirect()->route('albums.index')->with('success','Album deleted successfully');
    }
}
