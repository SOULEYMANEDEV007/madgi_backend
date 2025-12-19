<?php

namespace App\Livewire;

use App\Models\Assessment;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Automate extends Component
{
    public $formAssessments;
    public $factor;
    public $fields = [];
    public $coefficient = 0;
    public $total = 0;
    public $average = 0;

    public function mount($formAssessments, $factor)
    {
        $this->formAssessments = $formAssessments;
        $this->factor = $factor;
        $this->initializeFields();
    }

    public function recalculateTotal($key)
    {
        $note = (int) $this->fields["note{$key}"] ?? 0;
        $coefficient = (int) $this->fields["coefficient{$key}"] ?? 0;

        $total = $note * $coefficient;

        $this->fields["total{$key}"] = $total;

        $this->coefficient = $this->calculateCoefficientSum($this->fields);
        $this->total = $this->calculateTotalSum($this->fields);
        $this->average = $this->calculateAverageSum($this->fields);
    }

    public function initializeFields()
    {
        foreach ($this->formAssessments as $key => $item) {
            foreach ($item['formfields'] as $field) {
                if(Request::routeIs('assessments.recap')) $data = Assessment::where('user_id', $this->factor->id)->get();
                else $data = null;
                if($data) {
                    foreach ($data as $key => $value) {
                        $decode = json_decode($value['data']);
                        $name = $field['name'];
                        $this->fields[$field['name'].$key] = $decode->$name;
                    }
                }
                else $this->fields[$field['name'].$key] = $field['value'];
            }
        }

        $this->coefficient = $this->calculateCoefficientSum($this->fields);
        $this->total = $this->calculateTotalSum($this->fields);
        $this->average = $this->calculateAverageSum($this->fields);
    }

    function calculateCoefficientSum($data)
    {
        $totalSum = 0;

        foreach ($data as $key => $value) {
            if (strpos($key, 'coefficient') === 0)
                if (is_numeric($value)) $totalSum += $value;
        }

        return $totalSum;
    }

    function calculateTotalSum($data)
    {
        $totalSum = 0;

        foreach ($data as $key => $value) {
            if (strpos($key, 'total') === 0)
                if (is_numeric($value)) $totalSum += $value;
        }

        return $totalSum;
    }

    function calculateAverageSum($data)
    {
        $totalSum = 0;

        foreach ($data as $key => $value) {
            if (strpos($key, 'total') === 0)
                if (is_numeric($value)) $totalSum += $value;
        }

        return $totalSum;
    }

    public function render()
    {
        return view('livewire.automate');
    }
}
