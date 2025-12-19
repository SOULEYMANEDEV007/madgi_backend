<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public $table = 'grades';

    public static string $permission = 'Grade';

    public $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
	];

    public static array $rules = [
        'name' => 'required',
    ];
}
