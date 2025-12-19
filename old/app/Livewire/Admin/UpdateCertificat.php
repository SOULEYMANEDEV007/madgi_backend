<?php

namespace App\Livewire\Admin;

use App\Models\Departement;
use App\Models\Site;
use App\Models\User;
use Livewire\Component;

class UpdateCertificat extends Component
{
    public $userId;
    public $fullname = "Nom et prénoms";
    public $matricule;
    public $department;
    public $function;
    public $department_id;
    public $type;
    public $certificate;

    public function mount($certificate)
    {
        $this->certificate = $certificate;
    }

    public function render()
    {
        return view('livewire.admin.update-certificat', [
            'departments' => $this->departments,
            'sites' => $this->sites,
        ]);
    }

    public function search()
    {
        $user = User::where('mat_without_space', 'like', $this->matricule)->first();
        $this->userId = $user->id ?? '';
        $this->department = $user->depart->name ?? '';
        $this->function = $user->fonction ?? '';
        $this->department_id = $user->departement ?? '';
        return $this->fullname = $user->nom ?? '';
    }

    public function getDepartmentsProperty()
    {
        return Departement::all();
    }

    public function getSitesProperty()
    {
        return Site::all();
    }
}
