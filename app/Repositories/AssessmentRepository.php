<?php

namespace App\Repositories;

use App\Models\Assessment;
use App\Repositories\BaseRepository;

class AssessmentRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Assessment::class;
    }
}
