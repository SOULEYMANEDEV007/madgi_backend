<?php

namespace App\Livewire;

use App\Models\Departement;
use App\Models\Service;
use App\Models\TypeLeave;
use App\Models\User;
use App\Models\UserLeave;
use Livewire\Component;
use Livewire\WithPagination;

class Leave extends Component
{
    use WithPagination;

    public $userId;
    public $matricule;
    public $fullname = "Nom et prénoms";
    public $selectedMatricule;
    public $imageUrl;
    public $department;
    public $department_id;
    public $service;
    public $service_id;
    public $path;
    public $collections = [];
    public $leaveYear = [];

    public function mount()
    {
        $this->path = $_REQUEST['type'];
        $this->imageUrl = asset('/images/user.png');
    }

    public function render()
    {
        return view('livewire.leave', [
            'types' => $this->types,
            'departments' => $this->departments,
            'services' => $this->services,
            'users' => $this->users,
        ]);
    }

    public function updatedSelectedMatricule($matricule)
    {
        $this->collections = [];
        $user = User::where('mat_without_space', 'like', $matricule ?? '')->first();

        $this->userId = $user?->id ?? '';
        $this->fullname = $user?->nom ?? '';
        $this->matricule = $user?->matricule ?? '';
        $this->department = $user?->depart->name ?? '';
        $this->department_id = $user?->departement ?? '';
        $this->service = $user?->serv->name ?? '';
        $this->service_id = $user?->service ?? '';
        $this->imageUrl = $user?->photo != null ? $user?->photo : asset('/images/user.png');
        $total = UserLeave::whereUserId($user?->id)->orderBy('year', 'asc')->get();

        foreach ($total as $item) {
            $this->collections[] = [
                'year' => $item->year,
                'total' => $item->value,
                'leaves' => $item->nb_use,
                'rest' => $item->value - $item->nb_use,
                'user_leave' => $item
            ];
        }
    }

    public function getTypesProperty()
    {
        return TypeLeave::all();
    }

    public function getDepartmentsProperty()
    {
        return Departement::all();
    }

    public function getServicesProperty()
    {
        return Service::all();
    }

    public function getUsersProperty()
    {
        return User::whereStatut(1)->get();
    }
}
