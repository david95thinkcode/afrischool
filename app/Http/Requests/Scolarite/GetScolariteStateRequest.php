<?php

namespace App\Http\Requests\Scolarite;

use Illuminate\Foundation\Http\FormRequest;

class GetScolariteStateRequest extends FormRequest
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
            'type' => 'required|string',
            'key' => 'required|integer', // ID de la classe ou matricule de l'élève selon le param key ci-dessus
            'year' => 'nullable|integer' // Id de l'année scolaire
        ];
    }
}
