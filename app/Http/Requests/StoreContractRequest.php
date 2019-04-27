<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractRequest extends FormRequest
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
            'address' => 'required',
            'start_date' => 'required | date_format:Y-m-d',
            'end_date' => 'required | date_format:Y-m-d',
            'schedule.*.shift' => 'required |numeric|min:0|max:2 ' ,
            'schedule.*.end_time' => 'required |date_format:H:i:s',
            'schedule.*.start_time' => 'required | date_format:H:i:s',
            'schedule.*.day_of_week' => 'required |numeric|min:0|max:6',
        ];
    }
}
