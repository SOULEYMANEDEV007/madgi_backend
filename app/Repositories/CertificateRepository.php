<?php

namespace App\Repositories;

use App\Models\Certificate;
use App\Repositories\BaseRepository;

class CertificateRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Certificate::class;
    }
}
