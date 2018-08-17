<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsenceFirstStepRequest extends FormRequest
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
            'anneeScolaire' =>  'required|integer',
            'classe'        =>  'required|integer',
            'date'          =>  'required|date|before_or_equal:' . date('Y-m-d')
        ];
    }
}