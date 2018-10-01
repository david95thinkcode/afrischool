<?php

namespace App\Http\Requests\Scolarite;

use Illuminate\Foundation\Http\FormRequest;

class StorePaiementScolariteRequest extends FormRequest
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
            'tranche' => 'required|integer',
            'reste' => 'required|integer',
            'montant_verser' => "required|integer|max:reste"
        ];
    }

    public function messages()
    {
        return [
            'montant_verser.required' => 'Veuillez indiquez le mondant versé.',
        ];
    }
}
