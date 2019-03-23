<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'password' => 'min:6',
            'birthday' => 'required|date_format:Y-m-d|before:today',
            'phone' => 'required| numeric| digits_between:5,20',
            'address' => 'required',
            'gender' => 'required',
        ];
    }
}
