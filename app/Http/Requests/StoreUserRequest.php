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
            'secret_code'   => 'required|integer',
            'tel'           => 'required|string|max:25',
            'name'          => 'nullable|string|max:255',
            // 'email'         => 'nullable|string|email|max:255|unique:users',
            // 'username'      => 'required|string|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
        ];
    }
}
