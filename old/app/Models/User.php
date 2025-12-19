<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

  	public static string $agent = 'Agent';
  	public static string $worker = 'Employé';
  	public static string $intern = 'Stagiaire';
  	public static string $temporaryworker = 'Vacataire';
  	public static string $employee = 'Salarié';
  	public static string $official = 'Fonctionnaire';
  	public static string $external = 'Collaborateurs extérieur';
  	public static string $fixed = 'CDD';
  	public static string $available = 'Mise en disponibilité';

  	public static string $import = 'Personnel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'nom',
      'cnps',
      'email',
      'matricule',
      'mat_without_space',
      'fonction',
      'date_fonction',
      'date_entre_mad',
      'date_occupation_p',
      'date_debut_mise_disponibilite',
      'date_fin_mise_disponibilite',
      'grade',
      'site',
      'genre',
      'type',
      'specialite',
      'reconduction',
      'situation_matrim',
      'nombre_enfant',
      'date_naissance',
      'tel',
      'statut_mad',
      'situation_convention',
      'date_validations',
      'date_signature',
      'slug',
      'type_stage',
      'situation_stage',
      'departement',
      'service',
      'photo',
      'diplome',
      'statut',
      'confession_relg',
      'start_date',
      'end_date',
      'lock_nb',
      'lock_date',
      'is_salarie',
      'is_register',
      'is_medical',
      'type_device',
      'unique_web_identifier',
      'activity_id',
      'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'departement',
        'service',
        'grade',
        'categorie',
        'site',
        'type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed'
    ];

    public static array $rules = [
      // 'nom' => 'required',
      // 'email' => 'required|email',
      // 'tel' => 'required',
      // 'cnps' => 'required',
      // 'matricule' => 'required',
      // 'fonction' => 'required',
      // 'date_fonction' => 'required',
      // 'date_entre_mad' => 'required',
      // 'date_occupation_p' => 'required',
      // 'grade' => 'required',
      // 'site' => 'required',
      // 'situation_matrim' => 'required',
      // 'nombre_enfant' => 'required',
      // 'date_naissance' => 'required',
      // // 'statut_mad' => 'required',
      // 'diplome' => 'required',
      // 'confession_relg' => 'required',
  		// 'pictures' => 'image|mimes:jpeg,png,jpg|max:10240',
      'type' => 'required'
    ];

    public static array $workerrules = [
      // 'nom' => 'required',
      // 'email' => 'required|email',
      // 'tel' => 'required',
      // 'cnps' => 'required',
      // 'matricule' => 'required',
      // 'fonction' => 'required',
      // 'date_fonction' => 'required',
      // 'date_entre_mad' => 'required',
      // 'date_occupation_p' => 'required',
      // 'grade' => 'required',
      // 'site' => 'required',
      // 'situation_matrim' => 'required',
      // 'nombre_enfant' => 'required',
      // 'date_naissance' => 'required',
      // // 'statut_mad' => 'required',
      // 'diplome' => 'required',
      // 'confession_relg' => 'required',
      // 'departement' => 'required',
      // 'service' => 'required',
  		// 'pictures' => 'image|mimes:jpeg,png,jpg|max:10240',
    ];

    public static array $internrules = [
      // 'nom' => 'required',
      // 'specialite' => 'required',
      // 'type_stage' => 'required',
      // 'situation_stage' => 'required',
      // 'tel' => 'required',
      // 'date_validations' => 'required',
      // 'reconduction' => 'required',
  		// 'pictures' => 'image|mimes:jpeg,png,jpg|max:10240'
    ];

    public static array $temporaryworkerrules = [
      // 'nom' => 'required',
      // 'specialite' => 'required',
      // 'type_stage' => 'required',
      // 'situation_convention' => 'required',
      // 'date_validations' => 'required',
      // 'reconduction' => 'required',
  		// 'pictures' => 'image|mimes:jpeg,png,jpg|max:10240'
    ];

    public static array $employeerules = [
    ];

    public static array $officialrules = [
    ];

    public static array $filerules = [
      'file' => 'required|file|mimes:xlsx,xls,csv,csv',
    ];

    public function sendPasswordResetNotification($token)
    {
      $this->notify(new ResetPasswordNotification($token));
    }

    public function serv()
    {
      return  $this->belongsTo(Service::class,'service','id');
    }
    public function typ()
    {
      return  $this->belongsTo(Type::class,'type','id');
    }

    public function Sit()
    {
      return  $this->belongsTo(Site::class,'site','id');
    }
    public function grad()
    {
      return  $this->belongsTo(Grade::class,'grade','id');
    }

    public function depart()
    {
      return  $this->belongsTo(Departement::class,'departement','id');
    }

    public function category()
    {
      return  $this->belongsTo(Categorie::class, 'categorie');
    }

    public function leave()
    {
      return  $this->hasOne(Leave::class);
    }

    public function transmission()
    {
      return $this->hasOne(Transmission::class, 'user_id');
    }

    public function assessments()
    {
      return $this->hasMany(Assessment::class, 'user_id');
    }

    public function emargements()
    {
      return $this->hasMany(Emargement::class);
    }

    public function userLeave()
    {
      return $this->hasOne(UserLeave::class);
    }

    public function activity()
    {
      return $this->belongsTo(Activity::class);
    }

    public function files()
    {
      return $this->hasMany(File::class)->latest();
    }
}
