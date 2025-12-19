<?php

namespace App\Repositories;

use App\Models\Signatory;
use App\Repositories\BaseRepository;

class SignatoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Signatory::class;
    }
}
