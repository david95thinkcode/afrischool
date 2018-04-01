<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEtablissementRequest extends FormRequest
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
            'sigle' => '',
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
