<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    public $table = 'assessments';

	  public static string $permission = 'Evaluation';

    public $fillable = [
        'user_id',
        'form_assessment_id',
        'data',
        'save',
        'status',
    ];

    protected $casts = [
        'user_id' => 'int',
        'form_assessment_id' => 'int',
    ];

    public static array $rules = [
      
    ];

    public function user()
    {
      return  $this->belongsTo(User::class);
    }

    public function formassessment()
    {
      return  $this->belongsTo(FormAssessment::class, 'form_assessment_id');
    }
}
