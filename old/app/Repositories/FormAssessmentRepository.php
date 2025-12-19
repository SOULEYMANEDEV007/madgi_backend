<?php

namespace App\Repositories;

use App\Models\FormAssessment;
use App\Models\FormField;
use App\Repositories\BaseRepository;

class FormAssessmentRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return FormAssessment::class;
    }
}
