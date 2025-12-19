<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
	protected $table = 'medias';

	public const SLIDE = 'slide';
	public static string $permission = 'Bannière';

	protected $casts = [
		'source_id' => 'int',
	];

	protected $fillable = [
		'src',
		'source_id',
		'source'
	];

	public static array $rules = [
		'pictures' => 'required',
		'pictures.*' => 'mimes:jpeg,png,jpg,pdf|max:102400'
    ];

	public function info()
	{
		return $this->belongsTo(Infos::class);
	}

	public function leave()
	{
		return $this->belongsTo(Leave::class);
	}

	public function certificat()
	{
		return $this->belongsTo(Certificate::class);
	}

    public function file()
	{
		return $this->belongsTo(File::class);
	}
}
