<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\API\DepartmentResource;
use App\Http\Resources\API\InfoResource;
use App\Http\Resources\API\RegisterResource;
use App\Http\Resources\API\ServiceResource;
use App\Http\Resources\API\TypeLeaveResource;
use App\Http\Resources\API\UserResource;
use App\Models\Departement;
use App\Models\Emargement;
use App\Models\Holiday;
use App\Models\Infos;
use App\Models\Media;
use App\Models\Parametre;
use App\Models\Retard;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TypeLeave;
use App\Models\User;
use App\Models\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class HomeAPIController
 */
class HomeAPIController extends AppBaseController
{
    public function user()
    {
        return $this->sendResponse(new UserResource(auth()->user()), 'User retrieved successfully');
    }

    public function banners(): JsonResponse
    {
        $slides = Media::where('source', 'like', 'slide%')->latest()->get();

        return $this->sendResponse($slides, 'Slide retrieved successfully');
    }

    public function setting(): JsonResponse
    {
        $setting = Setting::find(1);

        return $this->sendResponse($setting, 'Setting retrieved successfully');
    }

    public function infos()
    {
        $infos = Infos::with('userinfos')
                    ->where('department_id', auth()->user()->depart->id)
                    ->orWhere('department_id', null)
                    ->whereStatus(1)
                    ->latest()
                    ->get();

        return $this->sendResponse(new InfoResource($infos), 'Info retrieved successfully');
    }

    public function read($id)
    {
        $info = Infos::find($id);
        UserInfo::updateOrCreate([
            'user_id' => auth()->user()->id,
            'info_id' => $id
        ]);

        return $this->sendResponse($info, 'Info retrieved successfully');
    }

    public function departments()
    {
        $departments = Departement::latest()->get();

        return $this->sendResponse(new DepartmentResource($departments), 'Department retrieved successfully');
    }

    public function services()
    {
        $services = Service::latest()->get();

        return $this->sendResponse(new ServiceResource($services), 'Service retrieved successfully');
    }

    public function typeLeaves()
    {
        $types = TypeLeave::all();

        return $this->sendResponse(new TypeLeaveResource($types), 'Type Leave retrieved successfully');
    }

    public function registers()
    {
        $registers = Emargement::where('user_id', auth()->user()->id)->latest()->paginate(10);

        return $this->sendResponse(new RegisterResource($registers), 'Registers retrieved successfully');
    }

    public function register(Request $request)
    {
        $user = User::where('mat_without_space', 'like', "%$request->matricule%")
                ->orWhere('matricule', 'like', "%$request->matricule%")
                ->first();
        // $user = User::where('matricule', $request->matricule)->first();

        if(!empty($user)) {
            if($user->is_register == 0) {
                if($user->statut == 1) {
                    if(empty($user->type_device) || $user->type_device == $request->type_device) {
                        $dateActuelle = Carbon::now();
                        $emargement=Emargement::where('matricule',$request->matricule)->where('date',$dateActuelle->format('Y/m/d'))->first();
                        $day = $dateActuelle->locale('fr_FR')->isoFormat('dddd');
                        $settings = Holiday::where('date', Carbon::parse($request->date)->format('Y/m/d'))->first();
                        $user->update(['type_device' => $request->type_device]);
                        if(empty($settings)) {
                            if ($emargement) {
                                $heureActuelle = Carbon::now();
                                if ($heureActuelle->format('H:i')<"12:00") {
                                    return response()->json([
                                        "code"=>200,
                                        "data"=>null,
                                        "message"=>$user->nom.', Vous avez dejà Émargé',
                                    ], 200);
                                }
                                if (!is_null($emargement->heure_depart)) {

                                    return response()->json([
                                        "code"=>200,
                                        "data"=>null,
                                        "message"=>$user->nom.' Passé une agréable soiré avec votre Famille',
                                    ], 200);
                                }
                                $reponse=$this->depart($emargement->id, $day, $request->type_device);
                              if ($reponse['code']==200) {
                                return response()->json([
                                    "code"=>200,
                                    "data"=>null,
                                    "message"=>$user->nom.' Passé une agréable soiré avec votre Famille',
                                ], 200);
                              }else {
                                return response()->json([
                                    "code"=>0,
                                    "data"=>null,
                                    "message"=>$reponse['message'],
                                ], 200);
                              }
                            } else {
                              $reponse=$this->arrive($user->id, $request->matricule, $request->type_device, $request->date, $request->time, $day);
                              if ($reponse['code']==200) {
                                return response()->json([
                                    "code"=>200,
                                    "data"=>null,
                                    "message"=>$user->nom.' Bienvenu au Bureau',
                                ], 200);
                              }else {
                                return response()->json([
                                    "code"=>0,
                                    "data"=>null,
                                    "message"=>$reponse['message'],
                                ], 200);
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
                        return response()->json([
                            "code"=>0,
                            "data"=>null,
                            "message"=> "Votre compte vient d'être bloqué ! Veuillez contactez votre administrateur",
                        ], 200);
                    };
                }
                else return response()->json([
                    "code"=>0,
                    "data"=>null,
                    "message"=>'Votre compte est bloqué ! Veuillez contactez votre administrateur',
                ], 200);
            }
            else {
                return response()->json([
                    "code"=>0,
                    "data"=>null,
                    "message"=> "Emargement pas néccessaire pour votre compte",
                ], 200);
            }
        }
        else {
            return response()->json([
                "code"=>0,
                "data"=>null,
                "message"=> "Utilisateur introuvable",
            ], 200);
        }
    }

    public static function arrive($userId, $matricule,$type_device=null, $date, $time, $day)
    {
        $dateActuelle = Carbon::now();

        $emargement=new Emargement();
        $emargement->matricule=$matricule;
        $emargement->date=$date;
        $emargement->heure_arrive=$time;
        $emargement->type_device=$type_device;
        $emargement->user_id= $userId;
        $emargement->day = $day;
        $emargement->save();

        $parametre_t=Parametre::where('slug','tolerance_de_retard')->first();
        $parametre_h=Parametre::where('slug','heure_arrive')->first();

        $heure=Carbon::parse($parametre_h->value);
        //    dd($heure);
            $heure_tol=$heure->addMinutes(intval($parametre_t->value));
        //    dd($dateActuelle->format('H:i'));
        if ($heure_tol<$dateActuelle->format('H:i')) {
            self::retard($dateActuelle,$matricule);
        }

        return [
            'code'=>200,
            'data'=>$emargement
        ];
    }

    public static function depart($id, $day, $type_device=null,$observation=null)
    {
        $dateActuelle = Carbon::now()->format('H:i:s');

        $emargement=Emargement::find($id);
        //    $emargement->matricule=$matricule;
        //    $emargement->photo=$image;
        //    $emargement->date=$dateActuelle->format('d/m/Y');
        $emargement->heure_depart=$dateActuelle;
        $emargement->device_depart=$type_device;
        $emargement->observation_depart=$observation;
        $emargement->day = $day;
        $emargement->statut = 1;
        $emargement->user_id = $emargement->user_id;
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
           $retard->mois=$date->format('Y/m/d');
           $retard->anne=$date->format('y');
           $retard->quantit=1;
           $retard->save();

        }

    }
}
