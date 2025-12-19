<?php

namespace App\Http\Requests;

use App\Models\Infos;
use Illuminate\Foundation\Http\FormRequest;

class CreateInfosRequest extends FormRequest
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
        return Infos::$rules;
    }
}
