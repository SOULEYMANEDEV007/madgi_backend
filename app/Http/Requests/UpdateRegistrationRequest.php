<?php

namespace App\Http\Requests;

use App\Models\Emargement;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRegistrationRequest extends FormRequest
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
        if(isset($_REQUEST['statut']) && $_REQUEST['statut'] == '0') return ['observation' => 'required'];
        elseif(isset($_REQUEST['statut']) && $_REQUEST['statut'] == '') return ['unregister_observation' => 'required'];
        $rules = Emargement::$updaterules;
        
        return $rules;
    }
}
