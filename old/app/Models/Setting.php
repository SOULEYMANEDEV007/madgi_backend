<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $table = 'parametres';

    public static string $permission = 'settings';

	protected $fillable = [
		'name',
		'year',
		'value',
		'slug',
	];

	public static array $rules = [
        'year' => 'required',
        'value' => 'required',
    ];

    public static array $updaterules = [
        'value' => 'required',
    ];
}
