<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use Carbon\Carbon;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RolesController;


class AuthController extends Controller
{
     /**
     * Registro de usuario
     */
    public static function signUp(Request $request)
    {
        try {
            
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string',
                'id' => 'required|integer|exists:roles'
            ]);
    
            User::create([
                'name'  => $request->name,
                'email' => $request->email,
                'rol'   => $request->id,
                'password' => bcrypt($request->password)
            ]);
    
            return response()->json([
                'message' => 'Successfully created user!'
            ], 200);

        } catch (Exception $e) {

            return returnExceptions($e);

        }
        
    }

    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {
        try {
            
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
                'remember_me' => 'boolean'
            ]);
    
            $credentials = request(['email', 'password']);
    
            if (!Auth::attempt($credentials))
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
    
            $user = $request->user();

            if(!$this->validateAdminRol($user->role))
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);

            $tokenResult = $user->createToken('Personal Access Token');
    
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
    
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
                'user' => $user,
            ]);

        } catch (Exception $e) {

            return returnExceptions($e);

        }
        
    }

    public function validateAdminRol($id)
    {
        try {
            
            $rol = RolesController::show($id);

            $isValid = false;

            if (isset($rol->original['rol'])){

                $rol_name = $rol->original['rol']->name;

                if($rol_name == 'admin_room_911'){

                    $isValid = true;

                }

            }

            return $isValid;
            
        } catch (Exception $e) {

            return returnExceptions($e);

        }
    }

    /**
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {

        try {
            
            $request->user()->token()->revoke();

            return response()->json([
                'message' => 'Successfully logged out'
            ]);

        } catch (Exception $e) {

            return returnExceptions($e);

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getToken()
    {
        try {
                
            $user = User::all()->first();

            $tokenResult = $user->createToken('Personal Access Token');
            
            $token = $tokenResult->token;
            if ($user->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
    
            return response()->json([
                'access_token' => $tokenResult->accessToken
            ]);

        } catch (Exception $e) {

            return returnExceptions($e);

        }
    }
}
