<?php

namespace App\Models;

use App\Livewire\Certificat;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public $table = 'sites';

    public static string $permission = 'Site';

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

    public function certificat()
    {
        return $this->hasOne(Certificat::class);
    }
}
