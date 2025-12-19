<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $table = 'files';

    public $fillable = [
        'name',
        'date',
        'user_id',
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
	];

    public static array $rules = [
        'name' => 'required',
        // 'date' => 'required',
		'file' => 'file|mimes:jpeg,png,jpg,pdf|max:10240'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doc()
    {
        return $this->hasOne(Media::class, 'source_id')->whereSource('file');
    }
}
