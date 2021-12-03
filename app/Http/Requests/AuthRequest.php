<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => 'required|unique:posts|min:5',
            'password' => 'required|min:5',
            'email' => 'required|unique:posts|min:5',
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'A login is required',
            'email.required' => 'A email is required',
            'password.required' => 'A password is required'
        ];
    }
}
