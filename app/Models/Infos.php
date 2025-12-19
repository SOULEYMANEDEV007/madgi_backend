<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infos extends Model
{
    public $table = 'infos';

  	public static string $permission = 'Information';

    public $fillable = [
        'post_name',
        'post_phone',
        'department_id',
        'content',
        'status',
        'is_read',
    ];

    protected $casts = [
        'department_id',
    ];

    protected $hidden = [
		'department_id',
        'department',
        'created_at',
        'updated_at',
        'medias'
	];

    public static array $rules = [
        'post_name' => 'required',
        // 'post_phone' => 'required',
        // 'department_id' => 'required',
        'content' => 'required',
		// 'file' => 'file|mimes:jpeg,png,jpg,pdf|max:10240'
    ];

    public function department()
    {
        return $this->belongsTo(Departement::class);
    }

    public function media()
    {
        return $this->hasOne(Media::class, 'source_id')->whereSource('info')->latest();
    }

    public function userinfos()
    {
        return $this->hasOne(UserInfo::class, 'info_id')->whereUserId(auth()->user()->id);
    }
}
