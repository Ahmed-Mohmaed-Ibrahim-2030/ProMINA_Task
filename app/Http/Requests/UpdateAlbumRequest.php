<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAlbumRequest extends FormRequest
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
//        dd($this->album->images()->first()->id);
        return [
            'name'=>"string|min:5|unique:albums,name,{$this->album->id}",
            "image_name"=>["string","min:5"],
//            unique:exam_scores,student_id,exam_scores.*.id,id,exam_id,".$this->exam_id]
            'image'=>'image|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ];
    }
}
