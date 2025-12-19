<?php

namespace App\Http\Controllers\API;


    use Illuminate\Support\Facades\Log;
    use App\Models\User;
    // use JWTAuth;
    use Illuminate\Support\Facades\Auth;
    // use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Validator;




use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    //connexion mobile
    public function connexion(Request $request)
    {
        Log::info($request->all());
            // $datas=$request->request->all();
            $messages = [
                'email.required' => 'Le mail ou mot de passe incorrecte',
                'password.required' => 'Le mail ou mot de passe incorrecte',
                'email.email' => 'Le mail ou mot de passe incorrecte',
                'email.max' => 'Le mail ou mot de passe incorrecte',
                
            ];

            $validator =  Validator::make($request->all(), [
                'email' => 'required|email|max:255',
                'password' => 'required'
            ],$messages);
            $credential = $request->only('email','password');
            if ($validator->fails()) {
                return response()->json([
                    "code"=>0,
                    "data"=>null,
                    "message"=>'Email or password incorrect',
                ], 200);
            }
            $data = $request->only(['email','password']);

            // if (Auth::attempt($data)) {
                $user = User::where('email', $request->email)->first();
                if (!$user) {
                    $response['message'] ='Email or password incorrect';
                    return response()->json([
                        "code"=>0,
                        "data"=>null,
                        "message"=>"Email or password inscorrec"
                    ]);
                }
                // $user->userPlayerId=$request->userPlayerId;
                // $user->save();
                // $token = $user->createToken($request->email.now(), [$user->type]);
                if(Hash::check($data['password'], $user->password)) {
                    $token = $user->createToken('auth_token')->plainTextToken;
                    $email = trim($request->email);
                    $user=User::where('email',$email)->first();
                    $data["token"] = $token;
                    $data["user"] = $user;
                    return response()->json([
                        "code"=>200,
                        "data"=>$data,
                        "message"=>"Vous etes bien connecté"
                    ]);
                }
                else {
                    $response['message'] ='Email or password incorrect';
                    return response()->json([
                        "code"=>0,
                        "data"=>null,
                        "message"=>"Email or password incorrect"
                    ]);
                }

            // }else{
            //     return response()->json([
            //         "code"=>0,
            //         "data"=>null,
            //         "message"=>'Email or password incorrect',
            //     ], 200);
            //       // return $this->__response(0,'Email or password incorrect',null);
                
            // }

    
    
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            "code"=>200,
            "message"=>"Vous etes bien déconnecté"
        ]);
    }
}
