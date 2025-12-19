<?php

namespace App\Http\Requests;

use App\Models\Certificate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificateRequest extends FormRequest
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
        if(isset($_REQUEST['status']) && $_REQUEST['status'] == "SUCCESS") $rules = Certificate::$updateruleswithfiles;
        else $rules = Certificate::$updaterules;
        
        return $rules;
    }
}
