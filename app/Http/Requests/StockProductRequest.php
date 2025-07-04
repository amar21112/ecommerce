<?php

namespace App\Http\Requests;

use App\Http\Enumerations\CategoryType;
use App\Rules\ProductQty;
use Illuminate\Foundation\Http\FormRequest;

class StockProductRequest extends FormRequest
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
            'sku'=>'nullable|max:100',
            'manage_stock' => 'boolean',
            'in_stock' => 'boolean',
//            'qty' => 'required_if:manage_stock,1|numeric|min:1',
            'qty' => [new ProductQty()]
        ];
    }

}
