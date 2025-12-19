<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLeave extends Model
{
    public $table = 'user_leaves';

    public $fillable = [
        'year',
        'value',
        'nb_use',
        'user_id',
    ];

    protected $casts = [
        'user_id',
    ];

    protected $hidden = [
        'user_id',
	];

    public static array $rules = [
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
