<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $table = 'activities';

    public $fillable = [
        'name',
    ];

    public static array $rules = [
        'name' => 'required'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
