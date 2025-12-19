<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\Leave;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveRequest extends FormRequest
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
        if(isset($_REQUEST['signator']) && Admin::$agencechief == $_REQUEST['signator']) $rules = Leave::$updateagrules;
        else $rules = Leave::$updaterules;

        return $rules;
    }
}
