<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveYear extends Model
{
    public $table = 'user_leave_year';


    public $fillable = [
        'year',
        'nb',
        'leave_id',
    ];

    protected $casts = [
        'leave_id',
    ];

    protected $hidden = [
		'leave_id',
	];

    public static array $rules = [
        'year.*' => 'required',
        'nb.*' => 'required',
        'leave_id.*' => 'required',
    ];

    public function leave()
    {
        return $this->hasMany(Leave::class);
    }
}
