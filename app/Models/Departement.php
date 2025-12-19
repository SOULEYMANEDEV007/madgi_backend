<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    public $table = 'departements';

	public static string $permission = 'Département';

    public $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
	];

    public static array $rules = [
        'name' => 'required',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class, 'department_id');
    }

    public function leave()
    {
        return $this->hasOne(Leave::class);
    }

    public function info()
    {
        return $this->hasOne(Infos::class);
    }

    public function signatories()
    {
        return $this->hasMany(Signatory::class, 'department_id');
    }

    public function formassessment()
    {
        return $this->hasOne(FormAssessment::class);
    }
}
