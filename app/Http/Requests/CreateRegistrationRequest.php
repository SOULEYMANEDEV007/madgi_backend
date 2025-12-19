<?php

namespace App\Http\Requests;

use App\Models\Emargement;
use App\Models\Registration;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateRegistrationRequest extends FormRequest
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
        $setting = Setting::find(1)->value;
        if(Carbon::now()->greaterThan($setting)) return Emargement::$allrules;
        else return Emargement::$rules;
    }
}
