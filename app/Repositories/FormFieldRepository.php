<?php

namespace App\Repositories;

use App\Models\FormField;
use App\Repositories\BaseRepository;

class FormFieldRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return FormField::class;
    }
}
