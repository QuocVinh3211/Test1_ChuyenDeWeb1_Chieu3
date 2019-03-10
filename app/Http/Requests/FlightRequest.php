<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
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
            'flight_depature'      => 'required',
            'flight_return'  => 'required'
        ];
    }


    public function messages()
    {
        return [
            'flight_return.required' => 'Bạn chưa chọn chuyến bay chiều về',
            'flight_depature.required' => 'Bạn chưa chọn chuyến bay chiều đi',
        ];
    }
}
