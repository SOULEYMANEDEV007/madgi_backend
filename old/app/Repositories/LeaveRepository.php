<?php

namespace App\Repositories;

use App\Models\Leave;
use App\Repositories\BaseRepository;

class LeaveRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Leave::class;
    }
}
