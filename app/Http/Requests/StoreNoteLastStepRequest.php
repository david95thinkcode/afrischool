<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteLastStepRequest extends FormRequest
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
            'classe' => 'integer|required',
            'trimestre' => 'integer|required',
            'type_evaluation' => 'integer|required',
            'matiere' => 'integer|required',
            'eleve' => 'integer|required',
            'note' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'type_evaluation.required' => "Renseignez le type d'évaluation SVP",
            'matiere.required' => "Renseignez la matière SVP", 
        ];
    }
}
