<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    public $table = 'form_fields';

    public static string $permission = 'Formulaire';

    public $fillable = [
        'name',
        'type',
        'label',
        'value',
        'options',
        'form_assessment_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
	];

    public static array $rules = [
        'name' => 'required',
        'department_id' => 'required',
        'fields.*.type' => 'required',
        'fields.*.label' => 'required',
    ];

    public static array $departmentrules = [
        'name' => 'required',
        'fields.*.type' => 'required',
        'fields.*.label' => 'required',
    ];

    public function formassessment()
	{
		return $this->belongsTo(FormAssessment::class, 'form_assessment_id');
	}
}
