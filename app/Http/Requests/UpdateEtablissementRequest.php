<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEtablissementRequest extends FormRequest
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
            'raison_sociale' => 'required|string',
            'sigle' => 'required',
            'directeur' => '',
            'tel' => '',
            'email' => '',
            'site_web' => '',

            'pays' => 'required|string',
            'ville' => 'required|string',
            'quartier' => '',
            
            'categorie_ets' => 'required',
        ];
    }
}
