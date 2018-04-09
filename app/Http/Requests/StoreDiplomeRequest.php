<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiplomeRequest extends FormRequest
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
            'dip_intitule' =>  'required|string',
            'dip_ecole' => 'required|string',
            'dip_specialite' => 'required|string',
            'dip_niveau' =>  '',
            'dip_date_obtention' =>  '',
            'professeur' => 'required|integer',
        ];
    }
}
