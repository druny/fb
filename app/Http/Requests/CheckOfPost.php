<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CheckOfPost extends FormRequest
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
    public function rules(Request $request)
    {
        $rules = [
            'slug' => 'required|min:5|max:355|unique:posts',
            'title' => 'required|max:255',
            'short' => 'required|max:1000',
            'text' => 'required',
            'img' => 'image'
        ];

        if($request->method() === 'PUT') {
            $rules['slug'] = 'required|min:5|max:355|unique:posts,slug,' . $request->id;
        }
        return $rules;
    }
}
