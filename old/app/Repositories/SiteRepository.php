<?php

namespace App\Repositories;

use App\Models\Site;
use App\Repositories\BaseRepository;

class SiteRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Site::class;
    }
}
