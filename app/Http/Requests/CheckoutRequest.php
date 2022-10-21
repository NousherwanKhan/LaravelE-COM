<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'required',
        'phone_number' => 'required',
        'address' => 'required',
        'city' => 'required',
        'province' => 'required',
        'pin_code' => 'required',
        
        ];
    }

    public function messages()
    {
        return [
            
        'fname' => 'first name field is required',
        'lname' => 'last name field is required',
        'email' => 'email field is required',
        'phone_number' => 'phone number field is required',
        'address' => 'address field is required',
        'city' => 'city field is required',
        'province' => 'province field is required',
        'pin_code' => 'pin code field is required',
        
        ];
    }
}
