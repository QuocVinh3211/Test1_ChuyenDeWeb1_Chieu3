<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'firstName'      => 'required',
            'lastName'  => 'required'
        
        ];
    }

    public function messages()
    {
        return [
            'firstName.required' => 'Please input customer first name',
            'lastName.required' => 'Please input customer last name',
        ];
    }


}
