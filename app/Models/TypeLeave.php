<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeLeave extends Model
{
    public $table = 'type_leaves';

    public $fillable = [
        'name',
    ];

    protected $casts = [
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
