<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emargement extends Model
{
    use HasFactory;

    protected $table = 'emargements';

    protected $fillable = [
        'matricule',
        'day',
        'date',
        'heure_arrive',
        'heure_depart',
        'justificatif_arrive',
        'justificatif_depart',
        'avec_justificatif',
        'photo',
        'photo_depart',
        'type_device',
        'device_depart',
        'unique_web_identifier',
        'type',
        'statut',
        'unregister_observation',
        'user_id',
        'est_en_retard',
        'est_depart_anticipe',
    ];

    protected $casts = [
        'date' => 'date',
        'avec_justificatif' => 'boolean',
        'est_en_retard' => 'boolean',
        'est_depart_anticipe' => 'boolean',
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
