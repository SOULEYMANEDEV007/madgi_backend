<?php

namespace App\Http\Controllers;

use App\Exports\RegistrationExport;
use App\Exports\StatsExport;
use App\Exports\UserStatsExport;
use App\Http\Requests\CreateRegistrationRequest;
use App\Http\Requests\UpdateRegistrationRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin;
use App\Models\Emargement;
use App\Models\Holiday;
use App\Models\Parametre;
use App\Models\Retard;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\RegistrationRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class RegistrationController extends AppBaseController
{
    /** @var RegistrationRepository $registrationRepository*/
    private $registrationRepository;

    private $user;

    public function __construct(RegistrationRepository $registrationRepo)
    {
        $this->registrationRepository = $registrationRepo;
        $this->user = auth()->guard(Admin::$guard);
    }

    /**
     * Display a listing of the Registration.
     */
    public function index(Request $request)
    {
        if($request->has('date')) $date = Carbon::parse($request->date);
        else $date = Carbon::now();

        $type = $request->type ?? null;

        if($this->user->check()) {
            if($request->has('type') && $request->type == 'absent') {
                if($request->has('last_type') && $request->last_type == 'personal') {
                    $query = User::where('site', 1)
                    ->whereDoesntHave('emargements', function ($query) use ($date) {
                        $query->where('date', $date->format('Y-m-d'));
                    })->where('is_register', 0);
                    $registrations = $query->latest()->get();
                    $total = $absents = $query->count();
                }
                else if($request->has('last_type') && $request->last_type == 'hmi') {
                    $query = User::where('site', 6)
                    ->whereDoesntHave('emargements', function ($query) use ($date) {
                        $query->where('date', $date->format('Y-m-d'));
                    })->where('is_register', 0);
                    $registrations = $query->latest()->get();
                    $total = $absents = $query->count();
                }
                else {
                    $query = User::whereDoesntHave('emargements', function ($query) use ($date) {
                        $query->where('date', $date->format('Y-m-d'));
                    })->where('is_register', 0);
                    $registrations = $query->latest()->get();
                    $total = $absents = $query->count();
                }
            }
            else if($request->has('type') && $request->type == 'personal') {
                $registrations = Emargement::whereHas('agent', function ($query) {
                                    $query->where('site', 1);
                                })
                                ->where('date', $date->format('Y-m-d'))
                                ->latest()
                                ->get();
                $total = Emargement::whereHas('agent', function ($query) {
                                $query->where('site', 1);
                            })
                            ->where('date', $date->format('Y-m-d'))
                            ->count();
                $absents = User::where('site', 1)
                            ->where('is_register', 0)->count() - $total;
            }
            else if($request->has('type') && $request->type == 'hmi') {
                $registrations = Emargement::whereHas('agent', function ($query) {
                                    $query->where('site', 6);
                                })
                                ->where('date', $date->format('Y-m-d'))
                                ->latest()
                                ->get();
                $total = Emargement::whereHas('agent', function ($query) {
                                    $query->where('site', 6);
                                })
                                ->where('date', $date->format('Y-m-d'))
                                ->count();
                $absents = User::where('site', 6)
                            ->where('is_register', 0)->count() - $total;
            }
            else {
                $registrations = $this->registrationRepository->where('date', $date->format('Y-m-d'))->latest()->get();
                $total = Emargement::where('date', $date->format('Y-m-d'))->count();
                $absents = User::where('is_register', 0)->count() - $total;
            }
        }
        else {
            if($request->has('type')) {
                $query = $this->registrationRepository->where('heure_depart', null)
                                            ->where('user_id', auth()->user()->id)
                                            ->where('date', '<=', Carbon::now()->format('Y-m-d'))
                                            ->latest();
                $registrations = $query->get();
                $total = $query->count();
                $absents = User::where('is_register', 0)->count() - $total;
            }
            else {
                $query = $this->registrationRepository->where('date', $date->format('Y-m-d'))
                                            ->where('user_id', auth()->user()->id)
                                            ->latest();
                $registrations = $query->get();
                $total = $query->count();
                $absents = User::where('is_register', 0)->count() - $total;
            }
        }

        $page = request()->get('page', 1);
        $perPage = 10;
        $paginatedItems = $registrations->slice(($page - 1) * $perPage, $perPage)->values();
        $registrations = new LengthAwarePaginator(
            $paginatedItems,
            $registrations->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $parametre = Parametre::whereSlug('heure_arrive')->first();
        $emargements = Emargement::where('date', $date->format('Y-m-d'))->get();

        if($request->has('type') && $request->type == 'personal') {
            $presents = Emargement::whereHas('agent', function ($query) {
                $query->where('site', 1);
            })
            ->where('date', $date->format('Y-m-d'))->count();
        }
        else if($request->has('type') && $request->type == 'hmi') {
            $presents = Emargement::whereHas('agent', function ($query) {
                $query->where('site', 6);
            })
            ->where('date', $date->format('Y-m-d'))->count();
        }
        else $presents = Emargement::where('date', $date->format('Y-m-d'))->count();

        $day = $date->locale('fr_FR')->isoFormat('dddd');
        if($day == 'samedi' || $day == 'dimanche') $absents = 0;

        return view('registrations.index', compact('registrations', 'parametre', 'emargements', 'date', 'total', 'presents', 'absents', 'type'));
    }

    /**
     * Show the form for creating a new Registration.
     */
    public function create(Request $request)
    {
        $setting = Setting::find(1)->value;
        $cookie = $request->cookie('user_id');
        return view('registrations.create', compact('setting', 'cookie'));
    }

    /**
     * Store a newly created Registration in storage.
     */
    public function store(CreateRegistrationRequest $request)
    {
        $user = User::where('matricule', $request->matricule)->first();

        if($user->is_register == 0) {
            if($user->statut == 1) {
                if(auth()->user()->matricule == $request->matricule && /*(empty($user->type_device) || $user->type_device == $request->type_device) &&*/ (empty($user->unique_web_identifier) || $user->unique_web_identifier == $request->unique_web_identifier)) {
                    $dateActuelle = Carbon::now();
                    $emargement=Emargement::where('matricule',$request->matricule)->where('date',$dateActuelle->format('Y-m-d'))->first();
                    $day = $dateActuelle->locale('fr_FR')->isoFormat('dddd');
                    $settings = Holiday::where('date', Carbon::parse($request->date)->format('Y-m-d'))->first();
                    $user->update(['unique_web_identifier' => $request->unique_web_identifier]);
                    if(empty($settings)) {
                        if ($emargement) {
                            $heureActuelle = Carbon::now();
                            $user=User::where('matricule',$request->matricule)->first();
                            if ($heureActuelle->format('H:i')<"12:00") {
                                Flash::success($user->nom.', Vous avez dejà Émargé');
                            }
                            if (!is_null($emargement->heure_depart)) {
                                Flash::success($user->nom.' Passé une agréable soiré avec votre Famille');
                            }
                            $reponse=$this->depart($emargement->id, $day, $request->unique_web_identifier, $request->observation);
                          if ($reponse['code']==200) {
                              $user=User::where('matricule',$request->matricule)->first();
                              Flash::success($user->nom.' Passé une agréable soiré avec votre Famille');
                          }else {
                            Flash::error($reponse['message']);
                          }
                        } else {
                          $reponse=$this->arrive($user->id, $request->matricule, $request->unique_web_identifier, $request->date, $request->time, $day, $request->observation);
                          if ($reponse['code']==200) {
                            $user=User::where('matricule',$request->matricule)->first();
                            Flash::success($user->nom.' Bienvenu au Bureau');
                          }else {
                            Flash::error($reponse['message']);
                          }
                        }
                    }
                    else {
                        return response()->json([
                            "code"=>0,
                            "data"=>null,
                            "message"=> 'Vous ne pouvez pas émargé un jours férié',
                        ], 200);
                    }
                }
                else {
                    $user->update([
                        'statut' => 0,
                        'lock_nb' => $user->lock_nb + 1,
                        'lock_date' => Carbon::now()->format('d/m/Y à H:m:s'),
                    ]);
                    Flash::error($user->nom . " Votre compte vient d'être bloqué ! Veuillez contactez votre administrateur");

                };
            }
            else Flash::error('Votre compte est bloqué ! Veuillez contactez votre administrateur');
        }
        else Flash::error("Emargement pas néccessaire pour votre compte");

        return redirect(getGuardedRoute('registrations.index'));
    }

    /**
     * Display the specified Registration.
     */
    public function show($id)
    {
        $registration = $this->registrationRepository->find($id);

        if (empty($registration)) {
            Flash::error('Registration not found');

            return redirect(getGuardedRoute('registrations.index'));
        }

        return view('registrations.show')->with('registration', $registration);
    }

    /**
     * Show the form for editing the specified Registration.
     */
    public function edit($id)
    {
        $registration = $this->registrationRepository->find($id);

        if (empty($registration)) {
            Flash::error('Registration not found');

            return redirect(getGuardedRoute('registrations.index'));
        }

        return view('registrations.edit')->with('registration', $registration);
    }

    /**
     * Update the specified Registration in storage.
     */
    public function update($id, UpdateRegistrationRequest $request)
    {
        $registration = $this->registrationRepository->find($id);

        if (empty($registration)) {
            Flash::error('Registration not found');

            return redirect(getGuardedRoute('registrations.index'));
        }

        $input = $request->all();

        $registration = $this->registrationRepository->update($input, $id);

        Flash::success('Registration updated successfully.');

        return redirect(getGuardedRoute('registrations.index'));
    }

    /**
     * Remove the specified Registration from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $registration = $this->registrationRepository->find($id);

        if (empty($registration)) {
            Flash::error('Registration not found');

            return redirect(getGuardedRoute('registrations.index'));
        }

        $this->registrationRepository->delete($id);

        Flash::success('Registration deleted successfully.');

        return redirect(getGuardedRoute('registrations.index'));
    }

    public function search(Request $request)
    {
        $bool = strpos($request->search, 'ac') !== false ? 1 : 0;

        if($request->has('date')) $date = Carbon::parse($request->date);
        else $date = Carbon::now();

        $type = $request->type ?? null;

        if($request->has('type') && $request->type == 'personal') {
            $registrations = Emargement::whereHas('agent', function ($query) {
                        $query->where('site', 1);
                    })
                    ->where('date', $date->format('Y-m-d'))
                    ->where(function($q) use ($request, $bool) {
                        $q->orWhere('matricule', 'like', '%'.$request->search.'%')
                            ->orWhere('observation', 'like', '%'.$request->search.'%');
                    })
                    ->orWhereRelation('agent', 'nom', 'like', '%'.$request->search.'%')
                    ->latest()
                    ->get();
        }
        else if($request->has('type') && $request->type == 'hmi') {
            $registrations = Emargement::whereHas('agent', function ($query) {
                        $query->where('site', 6);
                    })
                    ->where('date', $date->format('Y-m-d'))
                    ->where(function($q) use ($request, $bool) {
                        $q->orWhere('matricule', 'like', '%'.$request->search.'%')
                            ->orWhere('observation', 'like', '%'.$request->search.'%');
                    })
                    ->orWhereRelation('agent', 'nom', 'like', '%'.$request->search.'%')
                    ->latest()
                    ->get();
        }
        else {
            $registrations = Emargement::where('date', $date->format('Y-m-d'))
                    ->where(function($q) use ($request, $bool) {
                        $q->orWhere('matricule', 'like', '%'.$request->search.'%')
                            ->orWhere('observation', 'like', '%'.$request->search.'%');
                    })
                    ->orWhereRelation('agent', 'nom', 'like', '%'.$request->search.'%')
                    ->latest()
                    ->get();
        }


        $page = request()->get('page', 1);
        $perPage = 10;
        $paginatedItems = $registrations->slice(($page - 1) * $perPage, $perPage)->values();
        $registrations = new LengthAwarePaginator(
            $paginatedItems,
            $registrations->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $parametre = Parametre::whereSlug('heure_arrive')->first();
        $emargements = Emargement::where('date', $date->format('Y-m-d'))->get();

        if($request->has('type') && $request->type == 'personal') {
            $presents = $total = Emargement::whereHas('agent', function ($query) {
                                $query->where('site', 1);
                            })
                            ->where('date', $date->format('Y-m-d'))->count();
            $absents = User::where('site', 1)
                        ->where('is_register', 0)->count() - $total;
        }
        else if($request->has('type') && $request->type == 'hmi') {
            $presents = $total = Emargement::whereHas('agent', function ($query) {
                $query->where('site', 6);
            })
            ->where('date', $date->format('Y-m-d'))->count();
            $absents = User::where('site', 6)
                    ->where('is_register', 0)->count() - $total;
        }
        else {
            $presents = $total = Emargement::where('date', $date->format('Y-m-d'))->count();
            $absents = User::where('is_register', 0)->count() - $total;
        }

        $day = $date->locale('fr_FR')->isoFormat('dddd');
        if($day == 'samedi' || $day == 'dimanche') $absents = 0;

        return view('registrations.index', compact('registrations', 'parametre', 'emargements', 'date', 'total', 'presents', 'absents', 'type'));
    }

    public function stats(Request $request)
    {
        $collections = new Collection([]);
        if($this->user->check()) {
            foreach (User::all() as $key => $value) {
                if ($request->start_date && $request->end_date) {
                    $startOfWeek = $start_date = Carbon::parse($request->start_date);
                    $endOfWeek = $end_date = Carbon::parse($request->end_date);
                }
                else {
                    $start_date = $end_date = Carbon::now();
                    $startOfWeek = $start_date->copy()->startOfWeek(Carbon::MONDAY);
                    $endOfWeek = $end_date->copy()->endOfWeek(Carbon::SUNDAY);
                }
                $clause = [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')];
                $register = 0;
                $emargements = Emargement::whereUserId($value->id)->whereBetween('date', $clause)->get();
                foreach ($emargements as $emargement) {
                    if($emargement->heure_arrive && $emargement->heure_depart) {
                        $heure_arrive = Carbon::parse($emargement->heure_arrive);
                        $heure_depart = Carbon::parse($emargement->heure_depart);
                        $register += $heure_depart->diffInHours($heure_arrive);
                    }
                }
                $parametre = Parametre::whereSlug('heure_arrive')->first();
                $later = Emargement::whereUserId($value->id)->whereBetween('date', $clause)->where('heure_arrive', '>', $parametre->value)->count();
                $absences = 0;
                for ($day = $startOfWeek->copy(); $day->lte($endOfWeek); $day->addDay()) {
                    $check = Emargement::whereDate('date', $day->format('Y-m-d'))->exists();
                    $registration = Emargement::whereUserId($value->id)->whereDate('date', $day->format('Y-m-d'))->exists();
                    if ($check && !$registration) $absences++;
                }

                $data = [
                    'user' => $value,
                    'register' => $register,
                    'later' => $later,
                    'absences' => $absences,
                ];
                $collections->push($data);
            }
        }
        else {
            if ($request->start_date && $request->end_date) {
                $startOfWeek = $start_date = Carbon::parse($request->start_date);
                $endOfWeek = $end_date = Carbon::parse($request->end_date);
            }
            else {
                $start_date = $end_date = Carbon::now();
                $startOfWeek = $start_date->copy()->startOfWeek(Carbon::MONDAY);
                $endOfWeek = $end_date->copy()->endOfWeek(Carbon::SUNDAY);
            }
            $clause = [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')];
            $register = 0;
            $emargements = Emargement::whereUserId(auth()->user()->id)->whereBetween('date', $clause)->get();
            foreach ($emargements as $emargement) {
                if($emargement->heure_arrive && $emargement->heure_depart) {
                    $heure_arrive = Carbon::parse($emargement->heure_arrive);
                    $heure_depart = Carbon::parse($emargement->heure_depart);
                    $register += $heure_depart->diffInHours($heure_arrive);
                }
            }
            $parametre = Parametre::whereSlug('heure_arrive')->first();
            $later = Emargement::whereUserId(auth()->user()->id)->whereBetween('date', $clause)->where('heure_arrive', '>', $parametre->value)->count();
            $absences = 0;
            for ($day = $startOfWeek->copy(); $day->lte($endOfWeek); $day->addDay()) {
                $check = Emargement::whereDate('date', $day->format('Y-m-d'))->exists();
                $registration = Emargement::whereUserId(auth()->user()->id)->whereDate('date', $day->format('Y-m-d'))->exists();
                if ($check && !$registration) $absences++;
            }

            $data = [
                'user' => auth()->user(),
                'register' => $register,
                'later' => $later,
                'absences' => $absences,
            ];
            $collections->push($data);
        }

        $page = request()->get('page', 1);
        $perPage = 10;
        $paginatedItems = $collections->slice(($page - 1) * $perPage, $perPage)->values();
        $collections = new LengthAwarePaginator(
            $paginatedItems,
            $collections->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        $total = Emargement::whereBetween('date', $clause)->count();

        return view('registrations.stats', compact('collections', 'start_date', 'end_date', 'startOfWeek', 'endOfWeek', 'total'));
    }

    public function searchStats(Request $request)
    {
        $users = User::where('nom', 'like', '%' . $request->search . '%')->paginate(10);
        $collections = new Collection([]);
        foreach ($users as $key => $value) {
            if ($request->start_date && $request->end_date) {
                $startOfWeek = $start_date = Carbon::parse($request->start_date);
                $endOfWeek = $end_date = Carbon::parse($request->end_date);
            }
            else {
                $start_date = $end_date = Carbon::now();
                $startOfWeek = $start_date->copy()->startOfWeek(Carbon::MONDAY);
                $endOfWeek = $end_date->copy()->endOfWeek(Carbon::SUNDAY);
            }
            $clause = [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')];
            $register = 0;
            $emargements = Emargement::whereUserId($value->id)->whereBetween('date', $clause)->get();
            foreach ($emargements as $emargement) {
                if($emargement->heure_arrive && $emargement->heure_depart) {
                    $heure_arrive = Carbon::parse($emargement->heure_arrive);
                    $heure_depart = Carbon::parse($emargement->heure_depart);
                    $register += $heure_depart->diffInHours($heure_arrive);
                }
            }
            $parametre = Parametre::whereSlug('heure_arrive')->first();
            $later = Emargement::whereUserId($value->id)->whereBetween('date', $clause)->where('heure_arrive', '>', $parametre->value)->count();
            $absences = 0;
            for ($day = $startOfWeek->copy(); $day->lte($endOfWeek); $day->addDay()) {
                $check = Emargement::whereDate('date', $day->format('Y-m-d'))->exists();
                $registration = Emargement::whereUserId($value->id)->whereDate('date', $day->format('Y-m-d'))->exists();
                if ($check && !$registration) $absences++;
            }

            $data = [
                'user' => $value,
                'register' => $register,
                'later' => $later,
                'absences' => $absences,
            ];
            $collections->push($data);
        }

        $page = request()->get('page', 1);
        $perPage = 10;
        $paginatedItems = $collections->slice(($page - 1) * $perPage, $perPage)->values();
        $collections = new LengthAwarePaginator(
            $paginatedItems,
            $collections->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        $total = Emargement::whereBetween('date', $clause)->count();

        return view('registrations.stats', compact('collections', 'start_date', 'end_date', 'startOfWeek', 'endOfWeek', 'total'));
    }

    public function toogle($id)
    {
        $registration = $this->registrationRepository->find($id);

        if (empty($registration)) {
            Flash::error('Registration not found');

            return redirect(getGuardedRoute('registrations.index'));
        }

        $registration = $this->registrationRepository->update(['statut' => !$registration->statut], $id);

        Flash::success('Registration modifié avec succès.');

        return redirect(getGuardedRoute('registrations.index'));
    }

    public function export($date)
    {
        return Excel::download(new RegistrationExport($date), 'emargements.xlsx');
    }

    public function exportStats($start, $end)
    {
        return Excel::download(new StatsExport($start, $end), 'statistiques-emargement.xlsx');
    }

    public static function arrive($userId, $matricule,$type_device=null, $date, $time, $day, $observation)
    {
        $dateActuelle = Carbon::now();

        $emargement=new Emargement();
        $emargement->matricule=$matricule;
        $emargement->date=$date;
        // $emargement->heure_arrive=$time;
        $emargement->heure_arrive=Carbon::now()->format('H:i:s');
        $emargement->type_device=$type_device;
        $emargement->user_id= $userId;
        $emargement->day = $day;
        $emargement->observation = $observation;
        $emargement->save();

        $parametre_t=Parametre::where('slug','tolerance_de_retard')->first();
        $parametre_h=Parametre::where('slug','heure_arrive')->first();

        $heure=Carbon::parse($parametre_h->value);
            $heure_tol=$heure->addMinutes(intval($parametre_t->value));
        if ($heure_tol<$dateActuelle->format('H:i')) {
            self::retard($dateActuelle,$matricule);
        }
        return [
            'code'=>200,
            'data'=>$emargement
        ];
    }

    public static function depart($id, $day, $type_device=null, $observation1, $observation=null)
    {
        $dateActuelle = Carbon::now()->format('H:i:s');

        $emargement=Emargement::find($id);
        $emargement->heure_depart=$dateActuelle;
        $emargement->device_depart=$type_device;
        $emargement->observation_depart=$observation;
        $emargement->observation = $observation1;
        $emargement->day = $day;
        // $emargement->statut = 1;
        $emargement->save();
        return [
            'code'=>200,
            'data'=>$emargement,
            'message'=>'good'
        ];
    }


    public static function retard($date,$matricule)
    {
        $retard=Retard::where('matricule',$matricule)->whereMonth('mois',$date->format('m'))->whereYear('anne',$date->format('y'))->first();
        if ($retard) {
            $retard->quantit=$retard->quantit+1;
            $retard->save();
        } else {
           $retard= new Retard();
           $retard->matricule=$matricule;
           $retard->mois=$date->format('Y-m-d');
           $retard->anne=$date->format('y');
           $retard->quantit=1;
           $retard->save();
        }
    }
}
