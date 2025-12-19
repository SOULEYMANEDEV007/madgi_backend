<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    public $table = 'leave_flow';

    public $fillable = [
        'leave_id',
        'signatory_id',
        'content',
        'status',
    ];

    protected $hidden = [
        'leave_id',
        'signatory_id',
        'created_at',
        'updated_at',
	];

    public static array $rules = [
        'leave_id' => 'required',
        'signatory_id' => 'required',
        'content' => 'required',
        'status' => 'required',
    ];

    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }

    public function signatory()
    {
        return $this->belongsTo(Admin::class);
    }

    public function media()
    {
        return $this->hasOne(Media::class, 'source_id')->whereSource('flow')->latest();
    }
}
