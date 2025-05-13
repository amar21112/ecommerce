<?php

namespace App\Http\Requests;

use App\Http\Enumerations\CategoryType;
use Illuminate\Foundation\Http\FormRequest;

class PriceProductRequest extends FormRequest
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
            'id'=>'required|exists:products,id',
            'price' => 'required|numeric|min:0|max:10000000',
            'special_price' => 'nullable|numeric|min:0|max:10000000',
            'special_price_type' => 'nullable|numeric|between:1,2',
            'special_price_start' => 'nullable|date',
            'special_price_end' => 'nullable|date|after:special_price_start',
        ];
    }

}
