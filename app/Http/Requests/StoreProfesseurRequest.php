<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfesseurRequest extends FormRequest
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
            'prof_nom' => 'required|string',
            'prof_prenoms' => 'required|string',
            'prof_tel' => 'required|string',
            'prof_email' => '',
            'prof_sexe' => 'required',
            'prof_date_naissance' => '',
            'prof_nationalite' => '',
            'prof_enfant' => '',
            'prof_est_marie' => 'required',
            'prof_est_permanent' => 'required',
        ];
    }
}
