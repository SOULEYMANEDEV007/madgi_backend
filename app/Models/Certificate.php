<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public $table = 'certificates';

	public static string $permission = 'Certificat';

    public $fillable = [
        'fullname',
        'matricule',
        'start_date',
        'end_date',
        'department_id',
        'user_id',
        'status',
        'type',
        'content',
        'duration',
        'resumption',
        'work_date',
        'motif',
        'site_id',
    ];

    protected $casts = [
        'department_id',
        'site_id',
        'user_id',
    ];

    protected $hidden = [
		'department_id',
		'site_id',
        'department',
        'created_at',
        'updated_at',
        'medias',
        'user_id',
	];

    public static array $rules = [
        'type' => 'required',
    ];

    public static array $updateruleswithfiles = [
        'file' => 'required|file|mimes:pdf|max:10240',
        'content' => 'required',
        'status' => 'required',
        'peoples' => 'required',
    ];

    public static array $updaterules = [
        'content' => 'required',
        'status' => 'required',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Departement::class);
    }

    public function media()
    {
        return $this->hasOne(Media::class, 'source_id')->whereSource('certificat')->latest();
    }

    public function transmissions()
    {
        return $this->hasMany(Transmission::class, 'certificat_id');
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
