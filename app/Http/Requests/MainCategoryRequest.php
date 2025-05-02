<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
           'name'=>'required',
            'slug'=>'required|unique:categories,slug,'.$this->id,
           'is_active'=>'boolean',
        ];
    }

    public function messages(){
        return [
            'id.required'=>'Id is required',
            'id.exists'=>'Id is not exists',
            'name.required'=>'Name is required',
            'name.string'=>'Name is not valid',
            'slug.required'=>'Slug is required',
            'slug.unique'=>'Slug is not unique',
            'is_active.required'=>'Status is required',
        ];
    }
}
