<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnseignerRequest extends FormRequest
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
            'classe' => 'required|integer',
            'matiere' => 'required|integer',
            'coefficient' => '',
            'professeur' => 'required|integer',
            'anneescolaire' => 'required|integer',
        ];
    }
}
