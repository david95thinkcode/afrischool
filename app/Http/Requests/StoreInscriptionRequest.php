<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInscriptionRequest extends FormRequest
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
            'nom' => 'required|string',
            'prenoms' => 'required|string',
            'date_naissance' => 'required|date|before:today',
            'sexe' => 'required',
            
            // 'ancien' => 'required',
            'ecole_provenance' => '',
            'classe' => 'required',
            'redoublant' => ''
        ];
    }

    public function messages()
    {
        return [
            'date_naissance.required' => 'Précisez la date de naissance de l\'élève',
            'ancien.required' => "Veuillez indiquez si l'élève est ancien ou pas",
            'redoublant.required' => "Veuillez indiquez si l'élève est redoublant ou pas"
        ];
    }
}
