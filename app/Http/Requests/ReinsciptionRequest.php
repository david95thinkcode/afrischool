<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReinsciptionRequest extends FormRequest
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
            'montant_scolarite' => 'required|numeric|min:1',
            'montant_verser' => 'required|numeric|min:1',
            'date_inscription' => 'required|date',
            'annee_scolaire' => 'required',
            'classe' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'date_inscription.required' => 'Précisez la date d\'insciption de l\'élève',
            'montant_verser.required' => "Veuillez indiquez le montant payé par l'élève",
            'montant_scolarite.required' => "Veuillez indiquez le montant de ma scolarité",
            'annee_scolaire.required' => "Veuillez indiquez l'année scolaire",
            'classe.equired' => "Veuillez indiquez la classe d'inscription"
        ];
    }
}
