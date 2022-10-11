<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasetImagesRequest;
use App\Models\Album;
use App\Models\Album_Image;
use App\Http\Requests\StoreAlbum_ImageRequest;
use App\Http\Requests\UpdateAlbum_ImageRequest;

class AlbumImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Album $album)
    {
        return view('albums.add-image')->withAlbum($album);
        //
    }

    public function move(Album $album)
    {
        $albums=Album::select('id','name')->latest()->get();
        return view('albums.move-images')->with(compact('album','albums'));
    }

    public function paste(PasetImagesRequest $request,Album $album)
    {
        $validated = $request->safe()->only(['album_id']);
        $newAlbum =Album::find($validated['album_id']);
        $images=$album->images;
        foreach ($images as $image)
        {
            $newImage=new Album_Image;
            $newImage->image=$image->image;
            if($newAlbum->images()->where('name',$image->name)->first()){

                $newImage->name=$image->name."1";
            }
            else{
                $newImage->name=$image->name;

            }
            $newImage->album_id=$newAlbum->id;

            $newImage->save();
//            $newAlbum->images()->create($image);

        }

        $album->images()->delete();

        $album->delete();
        return redirect()->route('albums.show',$newAlbum->id)->with('success','Images Attached Successfully');


    }
    // return add image view (method of albums.addImage (get))

    // return add image view (method of albums.storeImage (put))

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlbum_ImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbum_ImageRequest $request,Album $album )
    {
        //

        $validated = $request->safe()->only(['image_name']);


        $productIamge=str_replace(" ","",$album->name).'_'.str_replace(" ","",$validated['image_name']).'.'.$request->file('image')->extension();
        $request->file('image')->move(public_path('/assets/images/albums'),$productIamge);



        $image=new Album_Image;
        $image->name = $validated['image_name'];
        $image->image = $productIamge;
        $image->album_id=$album->id;
        $image->save();

        return redirect()->route('albums.index')->with('success','Image Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album_Image  $album_Image
     * @return \Illuminate\Http\Response
     */
    public function show(Album_Image $album_Image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album_Image  $album_Image
     * @return \Illuminate\Http\Response
     */
    public function edit(Album_Image $album_Image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlbum_ImageRequest  $request
     * @param  \App\Models\Album_Image  $album_Image
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbum_ImageRequest $request, Album_Image $album_Image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album_Image  $album_Image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album_Image $album_Image)
    {
        //
    }
}
