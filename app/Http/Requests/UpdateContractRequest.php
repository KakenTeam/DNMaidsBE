<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContractRequest extends FormRequest
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
            'helper_id' =>'numeric |helper',
            'address' => 'required',
            'start_date' => 'required | date_format:Y-m-d',
            'end_date' => 'required | date_format:Y-m-d',
        ];
    }
}
