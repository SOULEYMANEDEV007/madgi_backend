<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Admin[] $admins
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';

	public static string $permission = 'Rôle';

	protected $fillable = [
		'name'
	];

	public static array $rules = [
        'name' => 'required|unique:roles,name',
        'permissions' => 'required',
    ];

	public static array $updaterules = [
        'name' => 'required',
        'permissions' => 'required',
    ];

	public function admin()
    {
        return $this->hasOne(Admin::class);
    }
}
