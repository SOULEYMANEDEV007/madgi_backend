<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    public $table = 'holidays';
    public static string $permission = 'Férié';

    protected $fillable = [
		'name',
		'date'
	];

	public static array $rules = [
        'name' => 'required',
        'date' => 'required|date',
    ];
}
