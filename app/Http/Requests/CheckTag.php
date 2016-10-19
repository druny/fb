<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CheckTag extends FormRequest
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
            'name' => 'required|max:150|unique:tags',
            'description' => 'max:500',
        ];

        if($request->method() === 'PUT') {
            $rules['name'] = 'required|max:250|unique:tags,name,' . $request->id;
        }
        return $rules;
    }
}
