<?php

namespace App\Repositories;

use App\Models\Emargement;
use App\Repositories\BaseRepository;

class RegistrationRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Emargement::class;
    }
}
