<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Emargement;
use App\Models\Parametre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmargementController extends Controller
{
    // -----------------------------------------------------------
    // 🔹 Récupère les heures de paramètre (arrive / depart)
    // -----------------------------------------------------------
    private function getHoraireParams()
    {
        $heureArrive = Parametre::where('slug', 'heure_arrive')->first()?->value ?? '08:00';
        $heureDepart = Parametre::where('slug', 'heure_depart')->first()?->value ?? '17:00';
        $tolerance = Parametre::where('slug', 'tolerance_de_retard')->first()?->value ?? 30;

        return [
            'heureArrive' => Carbon::createFromFormat('H:i', $heureArrive),
            'heureDepart' => Carbon::createFromFormat('H:i', $heureDepart),
            'heureAvecTolerance' => Carbon::createFromFormat('H:i', $heureArrive)->copy()->addMinutes(intval($tolerance))
        ];
    }

    // -----------------------------------------------------------
    // 🔹 POINTAGE MANUEL (CORRIGÉ POUR FORM-DATA)
    // -----------------------------------------------------------
    public function emarger(Request $request)
    {
        // DEBUG: Voir EXACTEMENT ce qui arrive
        Log::info('📸 POINTAGE MANUEL - Données reçues (RAW):', $request->all());
        Log::info('📸 Méthode: ' . $request->method());
        Log::info('📸 Content-Type: ' . $request->header('Content-Type'));
        Log::info('📸 Tous les champs: ' . json_encode($request->all()));
        
        // Vérifier chaque champ individuellement
        $debugFields = [
            'matricule' => $request->input('matricule'),
            'justificatif_arrive' => $request->input('justificatif_arrive'),
            'justificatif_depart' => $request->input('justificatif_depart'),
            'justificatif' => $request->input('justificatif'),
            'has_image' => $request->hasFile('image')
        ];
        Log::info('📸 Champs détectés:', $debugFields);

        $validator = Validator::make($request->all(), [
            'matricule' => 'required',
            'image'     => 'required',
        ]);

        if ($validator->fails()) {
            Log::error('❌ Validation failed:', $validator->errors()->toArray());
            return response()->json(['code' => 0, 'message' => $validator->errors()->first()]);
        }

        $user = User::where('matricule', $request->matricule)->first();
        if (!$user) {
            Log::error('❌ Matricule inconnu:', ['matricule' => $request->matricule]);
            return response()->json(['code' => 404, 'message' => 'Matricule inconnu. Veuillez vérifier.']);
        }

        $params = $this->getHoraireParams();
        $now = Carbon::now();
        $dateToday = $now->format('Y-m-d');

        $emargement = Emargement::where('matricule', $user->matricule)->where('date', $dateToday)->first();

        // Sauvegarde de l'image
        $imageResult = $this->_saveImage($request->file('image'), $request->matricule);
        if ($imageResult['code'] != 200) {
            return response()->json(['code' => 400, 'message' => 'Format d\'image invalide']);
        }
        $imagePath = $imageResult['data'];

        // ---------------- ARRIVÉE ----------------
        if (!$emargement) 
        {
            $estEnRetard = $now->greaterThan($params['heureAvecTolerance']);

            // 🚨 CORRECTION CRITIQUE: Bien récupérer le justificatif depuis form-data
            // Essayer dans cet ordre:
            $justificatifArrive = null;
            if ($request->has('justificatif_arrive') && !empty($request->input('justificatif_arrive'))) {
                $justificatifArrive = $request->input('justificatif_arrive');
            } elseif ($request->has('justificatif') && !empty($request->input('justificatif'))) {
                $justificatifArrive = $request->input('justificatif');
            } elseif ($request->has('observation') && !empty($request->input('observation'))) {
                $justificatifArrive = $request->input('observation');
            }
            
            $avecJustificatif = !empty($justificatifArrive);

            Log::info('🚶‍♂️ Pointage manuel - Arrivée DÉTAILS:', [
                'matricule' => $request->matricule,
                'justificatif_arrive_trouve' => $justificatifArrive,
                'estEnRetard' => $estEnRetard,
                'avecJustificatif' => $avecJustificatif,
                'heure_actuelle' => $now->format('H:i:s'),
                'heure_limite' => $params['heureAvecTolerance']->format('H:i:s')
            ]);

            // Si retard ET pas de justificatif fourni
            if ($estEnRetard && !$avecJustificatif) {
                Log::warning('⚠️ Retard sans justificatif');
                return response()->json([
                    'code' => 403,
                    'message' => "Retard détecté. Veuillez fournir un justificatif.",
                    'justification_required' => true
                ]);
            }

            // 🚨 CORRECTION: Créer l'emargement avec TOUS les champs
            $data = [
                'matricule' => $user->matricule,
                'nom'       => $user->nom,
                'prenom'    => $user->prenom,
                'date'      => $dateToday,
                'heure_arrive' => $now->format('H:i:s'),
                'photo' => $imagePath,
                'justificatif_arrive' => $justificatifArrive,
                'avec_justificatif' => $avecJustificatif,
                'est_en_retard' => $estEnRetard,
                'user_id' => $user->id ?? 0,
            ];
            
            Log::info('📝 Données à enregistrer:', $data);
            
            $record = Emargement::create($data);

            // Recharger pour vérifier
            $recordFresh = Emargement::find($record->id);
            Log::info('✅ Emargement créé - Vérification BD:', [
                'id' => $recordFresh->id,
                'justificatif_arrive_bd' => $recordFresh->justificatif_arrive,
                'avec_justificatif_bd' => $recordFresh->avec_justificatif,
                'est_en_retard_bd' => $recordFresh->est_en_retard
            ]);

            return response()->json([
                'code' => 200,
                'message' => $estEnRetard 
                    ? "Arrivée enregistrée avec justificatif."
                    : "Bienvenue {$user->prenom} 👋",
                'data' => $recordFresh,
                'avec_justificatif' => $avecJustificatif,
                'justificatif_enregistre' => $justificatifArrive,
                'debug' => [
                    'est_en_retard_calcule' => $estEnRetard,
                    'justificatif_reçu' => $justificatifArrive
                ]
            ]);
        }

        // ---------------- DEPART ----------------
        $estDepartAnticipe = $now->lessThan($params['heureDepart']);

        // 🚨 CORRECTION: Bien récupérer le justificatif de départ
        $justificatifDepart = null;
        if ($request->has('justificatif_depart') && !empty($request->input('justificatif_depart'))) {
            $justificatifDepart = $request->input('justificatif_depart');
        } elseif ($request->has('justificatif') && !empty($request->input('justificatif'))) {
            $justificatifDepart = $request->input('justificatif');
        } elseif ($request->has('observation_depart') && !empty($request->input('observation_depart'))) {
            $justificatifDepart = $request->input('observation_depart');
        }
        
        $avecJustificatifDepart = !empty($justificatifDepart);

        Log::info('🏃‍♂️ Pointage manuel - Départ DÉTAILS:', [
            'matricule' => $request->matricule,
            'justificatif_depart_trouve' => $justificatifDepart,
            'estDepartAnticipe' => $estDepartAnticipe,
            'avecJustificatif' => $avecJustificatifDepart
        ]);

        // Si départ anticipé ET pas de justificatif fourni
        if ($estDepartAnticipe && !$avecJustificatifDepart) {
            Log::warning('⚠️ Départ anticipé sans justificatif');
            return response()->json([
                'code' => 403,
                'message' => "Départ anticipé détecté. Merci de fournir un justificatif.",
                'justification_required' => true
            ]);
        }

        // 🚨 CORRECTION: Mettre à jour avec TOUS les champs
        $updateData = [
            'heure_depart' => $now->format('H:i:s'),
            'photo_depart' => $imagePath,
            'justificatif_depart' => $justificatifDepart,
            'avec_justificatif' => $avecJustificatifDepart ? true : $emargement->avec_justificatif,
            'est_depart_anticipe' => $estDepartAnticipe,
            'user_id' => $user->id ?? $emargement->user_id,
        ];
        
        Log::info('📝 Données à mettre à jour:', $updateData);
        
        $emargement->update($updateData);

        // Recharger pour vérifier
        $emargementFresh = Emargement::find($emargement->id);
        Log::info('✅ Emargement mis à jour - Vérification BD:', [
            'id' => $emargementFresh->id,
            'justificatif_depart_bd' => $emargementFresh->justificatif_depart,
            'avec_justificatif_bd' => $emargementFresh->avec_justificatif,
            'est_depart_anticipe_bd' => $emargementFresh->est_depart_anticipe
        ]);

        return response()->json([
            'code' => 200,
            'message' => $estDepartAnticipe
                ? "Départ anticipé enregistré avec justificatif."
                : "Au revoir {$user->prenom}, bonne soirée 👋",
            'data' => $emargementFresh,
            'avec_justificatif' => $avecJustificatifDepart,
            'justificatif_enregistre' => $justificatifDepart,
            'debug' => [
                'est_depart_anticipe_calcule' => $estDepartAnticipe,
                'justificatif_reçu' => $justificatifDepart
            ]
        ]);
    }

    // -----------------------------------------------------------
    // 🔹 POINTAGE AUTOMATIQUE QR (CORRIGÉ POUR FORM-DATA/JSON)
    // -----------------------------------------------------------
    public function scanEmargement(Request $request)
    {
        // DEBUG FORCÉ
        Log::info('📱 SCAN QR - DEBUG COMPLET ===========');
        Log::info('📱 Méthode: ' . $request->method());
        Log::info('📱 Content-Type: ' . $request->header('Content-Type'));
        Log::info('📱 Toutes les données (all):', $request->all());
        Log::info('📱 Contenu brut (getContent): ' . $request->getContent());
        Log::info('📱 ===================================');

        // Si JSON, décoder manuellement
        $jsonData = [];
        if ($request->header('Content-Type') === 'application/json') {
            $jsonData = json_decode($request->getContent(), true) ?? [];
            Log::info('📱 Données JSON décodées:', $jsonData);
        }

        $validator = Validator::make($request->all(), [
            'matricule' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'message' => 'Matricule requis']);
        }

        $user = User::where('matricule', $request->matricule)->first();
        if (!$user) {
            return response()->json(['code' => 404, 'message' => 'Matricule inconnu.']);
        }

        $params = $this->getHoraireParams();
        $now = Carbon::now();
        $dateToday = $now->format('Y-m-d');

        $emargement = Emargement::where('matricule', $user->matricule)->where('date', $dateToday)->first();

        // 🚨 CORRECTION: Récupérer le justificatif de TOUTES les façons
        $justificatifArrive = null;
        $justificatifDepart = null;
        $justificatifSimple = null;
        
        // Essayer depuis request
        if ($request->has('justificatif_arrive')) {
            $justificatifArrive = $request->input('justificatif_arrive');
        }
        if ($request->has('justificatif_depart')) {
            $justificatifDepart = $request->input('justificatif_depart');
        }
        if ($request->has('justificatif')) {
            $justificatifSimple = $request->input('justificatif');
        }
        
        // Si JSON, essayer depuis jsonData
        if (empty($justificatifArrive) && !empty($jsonData['justificatif_arrive'])) {
            $justificatifArrive = $jsonData['justificatif_arrive'];
        }
        if (empty($justificatifDepart) && !empty($jsonData['justificatif_depart'])) {
            $justificatifDepart = $jsonData['justificatif_depart'];
        }
        if (empty($justificatifSimple) && !empty($jsonData['justificatif'])) {
            $justificatifSimple = $jsonData['justificatif'];
        }
        
        Log::info('🔍 Justificatifs FINAUX:', [
            'justificatif_arrive' => $justificatifArrive,
            'justificatif_depart' => $justificatifDepart,
            'justificatif_simple' => $justificatifSimple
        ]);

        // ------------ ARRIVÉE ------------
        if (!$emargement) 
        {
            $estEnRetard = $now->greaterThan($params['heureAvecTolerance']);
            
            // Déterminer le justificatif pour l'arrivée
            $justificatif = $justificatifArrive ?? $justificatifSimple;
            $avecJustificatif = !empty($justificatif);

            Log::info('🚶‍♂️ Scan QR - Arrivée FINALE:', [
                'estEnRetard' => $estEnRetard,
                'justificatif' => $justificatif,
                'avecJustificatif' => $avecJustificatif,
                'heure_actuelle' => $now->format('H:i:s'),
                'heure_limite' => $params['heureAvecTolerance']->format('H:i:s')
            ]);

            // CAS 1: Arrivée avec justificatif (qu'il y ait retard ou non)
            if ($avecJustificatif) {
                Log::info('✅ ARRIVÉE AVEC JUSTIFICATIF - ENREGISTREMENT');
                
                $data = [
                    'matricule' => $user->matricule,
                    'nom' => $user->nom,
                    'prenom' => $user->prenom,
                    'date' => $dateToday,
                    'heure_arrive' => $now->format('H:i:s'),
                    'justificatif_arrive' => $justificatif,
                    'avec_justificatif' => true,
                    'est_en_retard' => $estEnRetard,
                    'user_id' => $user->id ?? 0,
                ];
                
                Log::info('📝 Données création QR:', $data);
                
                $record = Emargement::create($data);
                
                // Recharger et vérifier
                $recordFresh = Emargement::find($record->id);
                Log::info('✅ QR créé - Vérification BD:', [
                    'id' => $recordFresh->id,
                    'justificatif_arrive_bd' => $recordFresh->justificatif_arrive,
                    'avec_justificatif_bd' => $recordFresh->avec_justificatif,
                    'est_en_retard_bd' => $recordFresh->est_en_retard
                ]);

                return response()->json([
                    'code' => 200,
                    'message' => "Bienvenue {$user->prenom} 👋",
                    'data' => $recordFresh,
                    'avec_justificatif' => true,
                    'justificatif_enregistre' => $justificatif,
                    'debug' => [
                        'justificatif_stocke' => $recordFresh->justificatif_arrive,
                        'est_en_retard' => $estEnRetard
                    ]
                ]);
            }

            // CAS 2: Arrivée SANS justificatif mais AVEC retard
            if ($estEnRetard) {
                return response()->json([
                    'code' => 403,
                    'message' => "Retard détecté. Veuillez fournir un justificatif.",
                    'justification_required' => true
                ]);
            }

            // CAS 3: Arrivée SANS justificatif et SANS retard (arrivée normale)
            $record = Emargement::create([
                'matricule' => $user->matricule,
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'date' => $dateToday,
                'heure_arrive' => $now->format('H:i:s'),
                'est_en_retard' => false,
                'user_id' => $user->id ?? 0,
            ]);

            return response()->json([
                'code' => 200,
                'message' => "Bienvenue {$user->prenom} 👋",
                'data' => $record
            ]);
        }

        // ------------ DEPART ------------
        $estDepartAnticipe = $now->lessThan($params['heureDepart']);
        
        // Déterminer le justificatif pour le départ
        $justificatif = $justificatifDepart ?? $justificatifSimple;
        $avecJustificatif = !empty($justificatif);

        // CAS 1: Départ avec justificatif (qu'il y ait anticipation ou non)
        if ($avecJustificatif) {
            $data = [
                'heure_depart' => $now->format('H:i:s'),
                'justificatif_depart' => $justificatif,
                'avec_justificatif' => true,
                'est_depart_anticipe' => $estDepartAnticipe,
                'user_id' => $user->id ?? $emargement->user_id,
            ];
            
            Log::info('📝 Données mise à jour QR:', $data);
            
            $emargement->update($data);
            
            // Recharger et vérifier
            $emargementFresh = Emargement::find($emargement->id);
            Log::info('✅ QR mis à jour - Vérification BD:', [
                'id' => $emargementFresh->id,
                'justificatif_depart_bd' => $emargementFresh->justificatif_depart,
                'avec_justificatif_bd' => $emargementFresh->avec_justificatif,
                'est_depart_anticipe_bd' => $emargementFresh->est_depart_anticipe
            ]);

            return response()->json([
                'code' => 200,
                'message' => "Au revoir {$user->prenom} 👋",
                'data' => $emargementFresh,
                'avec_justificatif' => true,
                'justificatif_enregistre' => $justificatif,
                'debug' => [
                    'justificatif_stocke' => $emargementFresh->justificatif_depart,
                    'est_depart_anticipe' => $estDepartAnticipe
                ]
            ]);
        }

        // CAS 2: Départ SANS justificatif mais AVEC anticipation
        if ($estDepartAnticipe) {
            return response()->json([
                'code' => 403,
                'message' => "Départ anticipé détecté. Veuillez fournir un justificatif.",
                'justification_required' => true
            ]);
        }

        // CAS 3: Départ SANS justificatif et SANS anticipation (départ normal)
        $emargement->update([
            'heure_depart' => $now->format('H:i:s'),
            'est_depart_anticipe' => false,
            'user_id' => $user->id ?? $emargement->user_id,
        ]);

        return response()->json([
            'code' => 200,
            'message' => "Au revoir {$user->prenom} 👋",
            'data' => $emargement
        ]);
    }

    // -----------------------------------------------------------
    // 🔹 GENERATION QR CODE
    // -----------------------------------------------------------
    public function generateQr()
    {
        $users = User::select('matricule', 'nom')->get();

        $qrData = [
            'session_id' => uniqid('session_', true),
            'timestamp' => now()->toISOString(),
            'matricules' => $users->pluck('matricule')->toArray(),
            'expires_at' => now()->addSeconds(10)->toISOString()
        ];

        return response()->json([
            "code" => 200,
            "data" => $qrData,
            "message" => "QR code généré"
        ]);
    }

    // -----------------------------------------------------------
    // 🔹 Fonction de sauvegarde image
    // -----------------------------------------------------------
    private function _saveImage($image, $name)
    {
        $extension = $image->getClientOriginalExtension();
        $allowed = ['png','jpg','jpeg','webp'];

        if (!in_array($extension, $allowed)) {
            return ['code' => 400, 'data' => null];
        }

        $fileName = time() . '_' . $name . '.' . $extension;
        $destinationPath = public_path('/images/');
        $image->move($destinationPath, $fileName);

        return ['code' => 200, 'data' => '/images/' . $fileName];
    }
}