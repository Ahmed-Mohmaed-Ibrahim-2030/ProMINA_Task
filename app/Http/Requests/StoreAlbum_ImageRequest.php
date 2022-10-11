<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAlbum_ImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image_name'=>['required','string','min:5','unique:album__images,name,Null,id,album_id,'.$this->album->id],
            'image'=>'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ];
    }
}
