<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


/**
 * Class Admin
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property int $role_id
 * @property string $password
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Role $role
 *
 * @package App\Models
 */
class Admin extends Authenticatable
{
	use HasRoles, Notifiable;

	protected $table = 'admins';

	public static string $permission = 'Admin';
	public static string $dashboardpermission = 'Dashboard';
	public static int $admin = 1;
	public static int $agencechief = 5;
	public static string $guard = 'admin';

	protected $casts = [
		'role_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'email',
		'role_id',
		'department_id',
		'password',
		'status'
	];

	public static array $rules = [
        'name' => 'required|unique:admins',
        'email' => 'required|unique:admins',
        'role_id' => 'required',
        'password' => 'required',
    ];

	public static array $updaterules = [
		'name' => 'required',
        'email' => 'required',
        'role_id' => 'required',
        // 'password' => 'required',
    ];

	public function sendPasswordResetNotification($token)
    {
      $this->notify(new ResetPasswordNotification($token));
    }

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function department()
	{
		return $this->belongsTo(Departement::class);
	}

	public function leave()
    {
        return $this->hasOne(Leave::class, 'signatory_id');
    }

	public function flow()
    {
        return $this->hasOne(Flow::class, 'signatory_id');
    }
}
