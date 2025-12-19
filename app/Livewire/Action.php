<?php

namespace App\Livewire;

use App\Mail\AssessmentMail;
use App\Models\Admin;
use App\Models\Assessment;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Action extends Component
{
    public $factor;
    public $assessment;
    public $formAssessments;
    public $selectedOption = '';

    public function mount($factor, $assessment, $formAssessments)
    {
        $this->factor = $factor;
        $this->assessment = $assessment;
        $this->formAssessments = $formAssessments;
    }

    public function updatedSelectedOption($value)
    {
        foreach($this->assessment as $item) {
            $insert = Assessment::whereId($item->id)->first();
            $insert->update(['status' => $value]);
            if(auth()->user()->role->id == 5) Mail::to($this->factor->email)->send(new AssessmentMail($this->factor, $this->formAssessments));
            if($value == 'refuser') {
                $departmentChief = Admin::whereDepartmentId($this->factor->departement)->whereRoleId(5)->first();
                Mail::to($departmentChief->email)->send(new AssessmentMail($this->factor, $this->formAssessments));
            }
        }
        return redirect()->getGuardedRoute('assessments.recap', $this->factor->id);
    }

    public function render()
    {
        return view('livewire.action');
    }
}
