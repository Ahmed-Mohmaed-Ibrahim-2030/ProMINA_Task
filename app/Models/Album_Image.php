<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album_Image extends Model
{
    use HasFactory;
    protected $fillable=['name','image','album_id'];
    public function album(){
        return $this->belongsTo(Album::class,'album_id','id');
}
}
