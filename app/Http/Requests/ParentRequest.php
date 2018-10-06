<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParentRequest extends FormRequest
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
            'nom_parent' => 'required|string',
            'prenoms_parent' => 'required|string',
            'tel_parent' => 'required|string',
            'mail_parent' => '',
            'sexe_parent' => '',

            // 'person_a_contacter_nom' => 'required|string',
            // 'person_a_contacter_tel' => 'required|string',
            // 'person_a_contacter_lien' => 'required|string'
        ];
    }
}
