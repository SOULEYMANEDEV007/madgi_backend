<?php

namespace App\Livewire;

use App\Models\Departement;
use App\Models\Leave;
use App\Models\LeaveYear;
use App\Models\Service;
use App\Models\TypeLeave;
use App\Models\User;
use App\Models\UserLeave;
use Livewire\Component;
use Livewire\WithPagination;

class LeaveUpdate extends Component
{
    use WithPagination;

    public $userId;
    public $fullname = "Nom et prénoms";
    public $matricule;
    public $department;
    public $department_id;
    public $service;
    public $service_id;
    public $startDate;
    public $endDate;
    public $resumption;
    public $placeEnjoyment;
    public $callUserName;
    public $callPhone;
    public $interim;
    public $motif;

    public $path;
    public $collections = [];
    public $leaveYear = [];

    public function mount($leaveId, $userMatricule)
    {
        $user = User::where('mat_without_space', 'like', $userMatricule ?? '')->first();
        $leave = Leave::find($leaveId);
        $total = UserLeave::whereUserId($user?->id)->orderBy('year', 'asc')->get();

        $this->path = $_REQUEST['type'];
        $this->userId = $user?->id ?? '';
        $this->fullname = $user?->nom ?? '';
        $this->matricule = $user?->matricule ?? '';
        $this->department = $user?->depart->name ?? '';
        $this->department_id = $user?->departement ?? '';
        $this->service = $user?->serv->name ?? '';
        $this->service_id = $user?->service ?? '';
        $this->service_id = $user?->service ?? '';
        $this->startDate = $leave->start_date;
        $this->endDate = $leave->end_date;
        $this->resumption = $leave->resumption;
        $this->placeEnjoyment = $leave->place_enjoyment;
        $this->callUserName = $leave->call_user_name;
        $this->callPhone = $leave->call_phone;
        $this->interim = $leave->interim;
        $this->motif = $leave->motif;

        $this->collections = [];
        foreach ($total as $item) {
            $this->leaveYear[$item->year] = LeaveYear::where('leave_id', $leaveId)->where('year', $item->year)->first()->nb;

            $this->collections[] = [
                'year' => $item->year,
                'total' => $item->value,
                'leaves' => $item->nb_use,
                'rest' => $item->value - $item->nb_use,
                'user_leave' => $item
            ];
        }
    }

    public function render()
    {
        return view('livewire.leave-update', [
            'types' => $this->types,
            'departments' => $this->departments,
            'services' => $this->services,
            'users' => $this->users,
        ]);
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
