<?php

namespace App\Repositories;

use App\Models\Holiday;
use App\Repositories\BaseRepository;

class HolidayRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Holiday::class;
    }
}
