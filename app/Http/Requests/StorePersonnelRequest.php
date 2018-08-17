<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonnelRequest extends FormRequest
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
            'name'              =>  'required|string|max:255|unique:users,name',
            'email'             =>  'required|email|max:255|unique:users,email',
            'pwd'               =>  'required|min:8|confirmed',
            'role'              =>  'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'pwd.min'          =>  'Le mot de passe doit contenir au moins 8 caractères !',
            'pwd.confirmed'    =>  'Les mots de passes ne sont pas identiques ! '
        ];
    }
}
