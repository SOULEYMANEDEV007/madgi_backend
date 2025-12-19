<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    public $table = 'user_info';

    public $fillable = [
        'user_id',
        'info_id',
    ];

    protected $casts = [
    ];

    protected $hidden = [
	];

    public static array $rules = [
        'user_id' => 'required',
        'info_id' => 'required',
    ];

    public function department()
    {
        return $this->belongsTo(Departement::class);
    }

    public function media()
    {
        return $this->hasOne(Media::class, 'source_id')->whereSource('info')->latest();
    }

    public function info()
    {
        return $this->belongsTo(Infos::class);
    }
}
