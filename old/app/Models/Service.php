<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $table = 'services';

    public static string $permission = 'Service';

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

    public function leave()
    {
        return $this->hasOne(Leave::class);
    }
}
