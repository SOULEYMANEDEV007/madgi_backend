<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\FormField;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFormFieldRequest extends FormRequest
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
        if(auth()->guard(Admin::$guard)->check()) return FormField::$rules;
        else return FormField::$departmentrules;
    }
}
