<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CheckCategory extends FormRequest
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
            'name' => 'required|max:150',
            'slug' => 'required|max:250|unique:categories',
            'description' => 'max:500',
        ];

        if($request->method() === 'PUT') {
            $rules['slug'] = 'required|max:250|unique:categories,slug,' . $request->id;
        }
        return $rules;
    }
}
