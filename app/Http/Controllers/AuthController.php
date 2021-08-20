<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\HistoryUserLogin;

class AuthController extends Controller
{

    public function login(Request $request){
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required',
            'tipo'=>'required'
        ]);

        if($validator->failed()){
            $Response=APIHelpers::APIResponse(false,400,'Bad request',null);
            return response()->json($Response,400);
        }

        $credentials=request(['email','password']);

        if(!Auth::attempt($credentials)){
            $Response=APIHelpers::APIResponse(false,406,'incorrect credencials',null);
            return response()->json($Response,406);
        }

        $user = User::where('email', $request->email)->first();

        $dataHistoryIp= array(
            "user_id"=>$user->id,
            'hulIp'=>$request->ip(),
            'state_ip_id'=>1,
            'hulComment'=>"Inicio de sesión en la IP: ".$request->ip()
        );

        HistoryUserLogin::create($dataHistoryIp);

        $tokenResult=$user->createToken('authToken')->plainTextToken;

        $data=array(
            'correo'=>$user->email,
            'token'=>$tokenResult
        );

        $Response=APIHelpers::APIResponse(false,200,null,$data);
        return response()->json($Response,200);
    }

    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'',
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if($validator->failed()){
            $message="Bad request";
            $Response=APIHelpers::APIResponse(false,400,$message,null);
            return response()->json($Response,400);
        }



        $user=new User();
        $user->name=ucwords(strtolower($request->name));
        $user->email=strtolower($request->email);
        $user->password=bcrypt($request->password);
        $user->save();
        $message="Usuario fue creado existosamente.";
        $Response=APIHelpers::APIResponse(false,201,$message,null);
        return response()->json($Response,201);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        $message="Token deleted successfully!";
        $Response=APIHelpers::APIResponse(false,200,$message,null);
        return response()->json($Response,200);
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }

}
