<?php

namespace App\Repositories;

use App\Models\Departement;
use App\Repositories\BaseRepository;

class DepartementRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Departement::class;
    }
}
