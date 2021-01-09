<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BranchRequest extends FormRequest
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
            'address' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|unique:branches,phone,' . $this->id,
            'telephone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|unique:branches,telephone,' . $this->id,
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
            'name' => trans('branch.name'),
            'address' => trans('branch.address'),
            'phone' => trans('branch.phone'),
            'telephone' => trans('branch.telephone'),
            'user_id' => trans('branch.user'),
        ];
    }
}
