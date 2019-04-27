<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpContractRequest extends FormRequest
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
            'valid_date' => 'required|date_format:Y-m-d',
            'expired_date' => 'required|date_format:Y-m-d|after:valid_date',
            'duration' => 'required | numeric',
            'salary' => 'required | numeric',
        ];
    }
}
