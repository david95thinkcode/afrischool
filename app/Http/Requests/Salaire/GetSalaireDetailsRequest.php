<?php

namespace App\Http\Requests\Salaire;

use Illuminate\Foundation\Http\FormRequest;

class GetSalaireDetailsRequest extends FormRequest
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
            'month' => 'required',
            'year' => 'required',
            'prof' => 'required|integer'
        ];
    }
}
