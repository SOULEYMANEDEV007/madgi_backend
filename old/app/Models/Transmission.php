<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transmission extends Model
{
    public $table = 'transmissions';

    public $fillable = [
        'leave_id',
        'certificat_id',
        'user_id',
    ];

    protected $hidden = [
        'leave_id',
        'certificat_id',
        'user_id',
        'created_at',
        'updated_at',
	];

    public static array $rules = [
    ];

    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }

    public function certificat()
    {
        return $this->belongsTo(Certificate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
