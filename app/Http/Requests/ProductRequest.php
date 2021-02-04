<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|unique:products,name,' . $this->id,
            'parcode' => 'sometimes|nullable|string',
            'group_id' => 'required|exists:groups,id',
            'category_id' => 'required|exists:categories,id',
            'min_price' => 'sometimes|nullable|numeric|min:1',
            'max_price' => 'sometimes|nullable|numeric|min:1|required_unless:min_price,0|gte:min_price',
            'status' => 'sometimes|nullable|in:0,1,false,true',
        ];
    }



    /**
     * Translate fields with user friendly name.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => trans('product.name'),
            'parcode' => trans('product.parcode'),
            'group_id' => trans('product.group_id'),
            'category_id' => trans('product.category_id'),
            'min_price' => trans('product.min_price'),
            'max_price' => trans('product.max_price'),
            'status' => trans('product.status'),

       
        ];
    }
}
