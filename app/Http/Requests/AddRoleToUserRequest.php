<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Carbon\Carbon as Carbon;

class AddRoleToUserRequest extends FormRequest
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
            'user'          =>  'required|integer',
            'role'          =>  'required|integer',
            'disableDate'   =>  'required|date|after_or_equal:' . Carbon::today()
        ];
    }

    public function messages()
    {
        return [
            'disableDate.after_or_equal'    =>  "La date de désactivation ne doit pas précéder la date d'aujourd'hui",
        ];
    }
}
