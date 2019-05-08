<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'email' => 'required|email|unique:users',
            'birthday' => 'required|date_format:Y-m-d|before:today',
            'phone' => 'required| numeric| digits_between:5,20',
            'address' => 'required',
            'gender' => 'required | numeric| min:0 |max: 1',
            'role' => 'numeric| min:0 |max: 2',
            'skill.*' => 'numeric',
            'group.*' => 'numeric',
        ];
    }
}
