<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $table = 'permissions';

    public $fillable = [

    ];

    protected $casts = [

    ];

    public static array $rules = [

    ];

    const WORKER = [
        'READ' => 'READ Employé',
        'UPDATE' => 'UPDATE Employé',
        'DISABLE' => 'DISABLE Employé',
        'DELETE' => 'DELETE Employé',
        'EXPORT' => 'EXPORT Employé',
    ];
    const INTERN = [
        'READ' => 'READ Stagiaire',
        'UPDATE' => 'UPDATE Stagiaire',
        'DISABLE' => 'DISABLE Stagiaire',
        'DELETE' => 'DELETE Stagiaire',
        'EXPORT' => 'EXPORT Stagiaire',
    ];
    const TEMPORARYWORKER = [
        'READ' => 'READ Vacataire',
        'UPDATE' => 'UPDATE Vacataire',
        'DISABLE' => 'DISABLE Vacataire',
        'DELETE' => 'DELETE Vacataire',
        'EXPORT' => 'EXPORT Vacataire',
    ];
    const EMPLOYEE = [
        'READ' => 'READ Salarié',
        'UPDATE' => 'UPDATE Salarié',
        'DISABLE' => 'DISABLE Salarié',
        'DELETE' => 'DELETE Salarié',
        'EXPORT' => 'EXPORT Salarié',
    ];
    const OFFICIAL = [
        'READ' => 'READ Fonctionnaire',
        'UPDATE' => 'UPDATE Fonctionnaire',
        'DISABLE' => 'DISABLE Fonctionnaire',
        'DELETE' => 'DELETE Fonctionnaire',
        'EXPORT' => 'EXPORT Fonctionnaire',
    ];
    const EXTERNAL = [
        'READ' => 'READ Collaborateurs extérieur',
        'UPDATE' => 'UPDATE Collaborateurs extérieur',
        'DISABLE' => 'DISABLE Collaborateurs extérieur',
        'DELETE' => 'DELETE Collaborateurs extérieur',
        'EXPORT' => 'EXPORT Collaborateurs extérieur',
    ];
    const FIXED = [
        'READ' => 'READ CDD',
        'UPDATE' => 'UPDATE CDD',
        'DISABLE' => 'DISABLE CDD',
        'DELETE' => 'DELETE CDD',
        'EXPORT' => 'EXPORT CDD',
    ];
    const AVAILABLE = [
        'READ' => 'READ Mise en disponibilité',
        'UPDATE' => 'UPDATE Mise en disponibilité',
        'DISABLE' => 'DISABLE Mise en disponibilité',
        'DELETE' => 'DELETE Mise en disponibilité',
        'EXPORT' => 'EXPORT Mise en disponibilité',
    ];

    const ROLE = [
        'CREATE' => 'CREATE Rôle',
        'READ' => 'READ Rôle',
        'UPDATE' => 'UPDATE Rôle',
        'DELETE' => 'DELETE Rôle',
    ];
    const ADMIN = [
        'CREATE' => 'CREATE Admin',
        'READ' => 'READ Admin',
        'UPDATE' => 'UPDATE Admin',
        'DELETE' => 'DELETE Admin',
    ];
    const INFO = [
        'CREATE' => 'CREATE Information',
        'READ' => 'READ Information',
        'UPDATE' => 'UPDATE Information',
        'DELETE' => 'DELETE Information',
    ];
    const BANNER = [
        'CREATE' => 'CREATE Bannière',
        'READ' => 'READ Bannière',
        'UPDATE' => 'UPDATE Bannière',
        'DELETE' => 'DELETE Bannière',
    ];
    const FACTOR = [
        'CREATE' => 'CREATE Agent',
        'READ' => 'READ Agent',
        'UPDATE' => 'UPDATE Agent',
        'DELETE' => 'DELETE Agent',
    ];
    const DEPARTMENT = [
        'CREATE' => 'CREATE Département',
        'READ' => 'READ Département',
        'UPDATE' => 'UPDATE Département',
        'DELETE' => 'DELETE Département',
    ];
    const GRADE = [
        'CREATE' => 'CREATE Grade',
        'READ' => 'READ Grade',
        'UPDATE' => 'UPDATE Grade',
        'DELETE' => 'DELETE Grade',
    ];
    const SERVICE = [
        'CREATE' => 'CREATE Service',
        'READ' => 'READ Service',
        'UPDATE' => 'UPDATE Service',
        'DELETE' => 'DELETE Service',
    ];
    const SITE = [
        'CREATE' => 'CREATE Site',
        'READ' => 'READ Site',
        'UPDATE' => 'UPDATE Site',
        'DELETE' => 'DELETE Site',
    ];
    const LEAVE = [
        'CREATE' => 'CREATE Congé',
        'READ' => 'READ Congé',
        'UPDATE' => 'UPDATE Congé',
        'DELETE' => 'DELETE Congé',
        'SIGNER' => 'SIGNER Congé',
    ];

    const REGISTER = [
        'CREATE' => 'CREATE Emargement',
        'READ' => 'READ Emargement',
        'UPDATE' => 'UPDATE Emargement',
        'DISABLE' => 'DISABLE Emargement',
        'EXPORT' => 'EXPORT Emargement',
    ];

    const SETTING = [
        'CREATE' => 'CREATE settings',
        'READ' => 'READ settings',
        'UPDATE' => 'UPDATE settings',
        'DELETE' => 'DELETE settings',
    ];

    const PERSONAL = [
        'IMPORT' => 'IMPORT Personnel',
    ];

    const ASSESSMENT = [
        'CREATE' => 'CREATE Evaluation',
        'READ' => 'READ Evaluation',
        'UPDATE' => 'UPDATE Evaluation',
        'DELETE' => 'DELETE Evaluation',
        'ACCESS' => 'ACCESS Historique',
    ];

    const FORMFIELD = [
        'CREATE' => 'CREATE Formulaire',
        'READ' => 'READ Formulaire',
        'UPDATE' => 'UPDATE Formulaire',
        'DELETE' => 'DELETE Formulaire',
    ];
    const CERTIFICAT = [
        'CREATE' => 'CREATE Certificat',
        'READ' => 'READ Certificat',
        'UPDATE' => 'UPDATE Certificat',
        'DELETE' => 'DELETE Certificat',
    ];
    const HOLIDAY = [
        'CREATE' => 'CREATE Emargement',
        'READ' => 'READ Férié',
        'UPDATE' => 'UPDATE Férié',
        'DELETE' => 'DELETE Férié',
    ];

    const UNLOCK = [
        'READ' => 'READ Déblocage',
        'UPDATE' => 'UPDATE Déblocage',
    ];
}
