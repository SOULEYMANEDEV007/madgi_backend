<?php

namespace App\Repositories;

use App\Models\Infos;
use App\Repositories\BaseRepository;

class InfosRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Infos::class;
    }
}
