<?php

namespace App\Http\Requests;

use App\Http\Enumerations\CategoryType;
use App\Rules\ProductQty;
use Illuminate\Foundation\Http\FormRequest;

class GeneralProductRequest extends FormRequest
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
            'name' => 'required|max:100',
            'slug' => 'required|unique:products,slug,'.$this->id,
            'description' => 'required|max:1000',
            'short_description' => 'nullable|max:200',
            'categories' => 'required|array|min:1', //[]
            'categories.*' => 'numeric|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'numeric|exists:tags,id',
            'brand_id' => 'required|exists:brands,id',
            'is_active' => 'boolean',

            'price' => 'required|numeric|min:0|max:10000000',
            'special_price_type' => 'nullable|numeric|between:1,2',
            'special_price' => [
                function ($attribute, $value, $fail) {
                    if (in_array(request('special_price_type'), [1, 2]) && is_null($value)) {
                        $fail('The special price is required when special price type is 1 or 2.');
                    }
                    if(request('special_price_type') == 2 && $value >= 100){
                        $fail('The special price percentage must be smaller than 100.');
                    }
                },
                'numeric',
                'min:0',
                'max:10000000'
            ],
            'special_price_start' => 'nullable|date',
            'special_price_end' => 'nullable|date|after:special_price_start',

            'sku'=>'nullable|max:100',
            'manage_stock' => 'boolean',
            'in_stock' => 'boolean',
//            'qty' => 'required_if:manage_stock,1|numeric|min:1',
            'qty' => [new ProductQty()]
        ];
    }

}
