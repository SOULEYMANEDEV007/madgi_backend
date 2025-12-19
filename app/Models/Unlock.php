<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unlock extends Model
{
    public $table = 'unlocks';
    public static string $permission = 'Déblocage';

    public $fillable = [
        
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'unlocks' =>'required'
    ];

    
}
