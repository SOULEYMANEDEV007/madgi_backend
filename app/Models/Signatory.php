<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signatory extends Model
{
    public $table = 'signatories';

    public static string $permission = 'Service signataire';

    public $fillable = [
        'name',
        'department_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'department_id',
	];

    public static array $rules = [
        'name' => 'required',
    ];

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
