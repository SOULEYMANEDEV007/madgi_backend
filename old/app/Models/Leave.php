<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    public $table = 'leaves';

	public static string $permission = 'Congé';

    public $fillable = [
        'fullname',
        'matricule',
        'start_date',
        'end_date',
        'resumption',
        'number_absence',
        'motif',
        'new_start_date',
        'new_end_date',
        'place_enjoyment',
        'call_user_name',
        'call_phone',
        'interim',
        'duration',
        'department_id',
        'service_id',
        'type_id',
        'user_id',
        'signatory_id',
        'w_admin',
        'status',
    ];

    protected $casts = [
        'department_id',
		'service_id',
        'type_id',
        'user_id',
        'signatory_id',
    ];

    protected $hidden = [
		'department_id',
		'service_id',
        'type_id',
        'department',
		'service',
        'type',
        'created_at',
        'updated_at',
        'medias',
        'user_id',
        'signatory_id',
	];

    public static array $rules = [
        // 'fullname' => 'required',
        // 'matricule' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        // 'place_enjoyment' => 'required',
        // 'call_user_name' => 'required',
        // 'call_phone' => 'required',
        // 'interim' => 'required',
        'department_id' => 'required',
        'service_id' => 'required',
        'type_id' => 'required',
		'picture' => 'mimes:jpeg,png,jpg|max:102400',
        'leaveYear.*' => 'required',
    ];

    public static array $updaterules = [
        'picture' => 'required|mimes:jpeg,png,jpg,pdf|max:102400',
        // 'content' => 'required',
        'status' => 'required',
    ];

    public static array $updateagrules = [
        'new_start_date' => 'required',
        'new_end_date' => 'required',
        // 'content' => 'required',
        'status' => 'required',
        'peoples' => 'required',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Departement::class);
    }

    public function type()
    {
        return $this->belongsTo(TypeLeave::class);
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'source_id')->whereSource('leave');
    }

    public function flow()
    {
        return $this->hasOne(Flow::class, 'leave_id');
    }

    public function signatory()
    {
        return $this->belongsTo(Admin::class);
    }

    public function flows()
    {
        return $this->hasMany(Flow::class, 'leave_id');
    }

    public function transmissions()
    {
        return $this->hasMany(Transmission::class, 'leave_id');
    }

    public function leaveYear()
    {
        return $this->belongsTo(LeaveYear::class, 'leave_id');
    }
}
