<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CustomerRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'nullable',
            'email' => 'nullable|email',
            'type' => 'required|in:cargo,trade,cargo&trade',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|unique:customers,phone,' . $this->id,
            'telephone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|unique:customers,telephone,' . $this->id,
            'user_id' => 'required|exists:users,id',
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
            'name' => trans('todo.title'),
        ];
    }
}
