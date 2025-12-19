<?php

namespace App\Repositories;

use App\Models\Official;
use App\Models\User;
use App\Repositories\BaseRepository;

class OfficialRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return User::class;
    }
}
