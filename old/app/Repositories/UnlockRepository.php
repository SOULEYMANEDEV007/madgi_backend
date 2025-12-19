<?php

namespace App\Repositories;

use App\Models\Unlock;
use App\Models\User;
use App\Repositories\BaseRepository;

class UnlockRepository extends BaseRepository
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
