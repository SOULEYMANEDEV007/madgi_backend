<?php

namespace App\Livewire\User;

use App\Models\Departement;
use App\Models\Site;
use App\Models\User;
use Livewire\Component;

class Certificat extends Component
{
    public $userId;
    public $fullname = "Nom et prénoms";
    public $matricule;
    public $department;
    public $function;
    public $department_id;
    public $type;

    public function render()
    {
        return view('livewire.user.certificat', [
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
