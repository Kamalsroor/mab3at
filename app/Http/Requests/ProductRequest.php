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
            'name' => 'required|products:categories,name,' . $this->id,
            'address' => 'nullable',
            'email' => 'nullable|email',
            'type' => 'required|in:cargo,trade,cargo&trade',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|unique:products,phone,' . $this->id,
            'telephone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|unique:products,telephone,' . $this->id,
            // 'user_id' => 'required|exists:users,id',
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
            'address' => trans('product.address'),
            'phone' => trans('product.phone'),
            'telephone' => trans('product.telephone'),
            // 'user_id' => trans('product.user'),
            'type' => trans('product.type'),
            'email' => trans('product.email'),
        ];
    }
}
