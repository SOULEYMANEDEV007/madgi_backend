<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormAssessment extends Model
{
    public $table = 'form_assessments';

    public $fillable = [
        'name',
        'department_id'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'name' => 'required',
        'department_id' => 'required'
    ];

    public function formfields()
	{
		return $this->hasMany(FormField::class);
	}

    public function department()
	{
		return $this->belongsTo(Departement::class);
	}

    public function assessments()
    {
      return $this->hasMany(Assessment::class);
    }
}
