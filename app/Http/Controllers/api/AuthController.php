<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\expert;
use App\Http\Resources\reguser;
use App\Models\Expert as ModelsExpert;
use App\Models\Reguser as ModelsReguser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->only('email','password'),[

            'email' => 'required|string|email',
             'password' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 404,
                'message' => 'Unauthorized',
            ], 400);
        }
         $see = DB::table('users')->where('email',$request->only('email'))->value('type');
         $see2 =DB::table('regusers')->where('email',$request->only('email'))->value('email');





        // $seeex = DB::table('experts')->where('email',$request->only('email'))->get('email');
        if($see == 0 && $see2 !=null){

            return response()->json([



                    'token' => $token,
                      'message'=> 'user',
                      'status'=>200,

                ]);
        }
        if($see == 1){

            return response()->json([



                      'token' => $token,
                      'message'=> 'expert',
                      'status'=>200,

                    ]);

        }
            else{
            return response()->json([
                'status' => 200,
                'token' => $token,
                'message' => 'save',
            ]);
        }


    }
    public function register(Request $request){

        $validator = Validator::make($request->only('name','email','password'),[
             'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:5',


        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type'=> 0,
        ]);

        $token = Auth::login($data);

        return response()->json([
            'status' => 200,
            'message' => 'User created successfully ',
            'data' => $data,

                'token' => $token,


        ]);
    }
////////////////////////////////////////////////////////////
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 200,
            'message' => 'Successfully logged out',
        ]);
    }
    public function me()
    {
        return response()->json([
            'status' => 200,
            'data' => Auth::user(),
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 200,
            'data' => Auth::user(),

                'token' => Auth::refresh(),


        ]);
    }


   }




