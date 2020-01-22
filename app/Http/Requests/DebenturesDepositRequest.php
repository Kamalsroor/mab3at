<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DebenturesDepositRequest extends FormRequest
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
            'branch_id' => 'required|exists:branches,id',
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric',
            'note' => 'nullable',
            'date_at' => 'required',
        ];
        // branch_id
        // user_id
        // customer_id
        // note
        // img
        // type
        // amount
        // date_at
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
