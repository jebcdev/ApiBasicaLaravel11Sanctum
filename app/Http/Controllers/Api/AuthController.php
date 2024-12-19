<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private static $APP_TOKEN_NAME;

    public function __construct()
    {
        self::$APP_TOKEN_NAME = env("APP_TOKEN_NAME", "laravel-api-sanctum-example");
    }


    public function register(Request $request)
    {
        try {
            /* validar los datos */
            $newUser = $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);


            /* encriptar el password ya validado */
            $newUser['password'] = Hash::make($newUser['password']);

            /* crear usuario */
            $user = User::create($newUser);

            /* comprobar si NO se creo exitosamente */

            if (!$user) {
                return ApiResponses::Error('Registration Failed');
            }

            /* generar el token */

            $token = $user->createToken(self::$APP_TOKEN_NAME)->plainTextToken;

            /* devolver los datos */

            $data = [
                'user' => $user,
                'token' => $token,
            ];

            return ApiResponses::Success('Registration Successfully', $data, 201);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function login(Request $request)
    {
        try {

            /* validar los datos */
            $loginData = $request->validate([
                'email' => ['required', 'email', 'exists:users,email'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            $user = User::where('email', $loginData['email'])->first();

            /* comprobar el login */

            if (!$user || !Hash::check($loginData['password'], $user->password)) {
                return ApiResponses::Error('Login Failed', null, 401);
            }

            /* generar el token */

            $token = $user->createToken(self::$APP_TOKEN_NAME)->plainTextToken;

            /* devolver los datos */

            $data = [
                'user' => $user,
                'token' => $token,
            ];

            return ApiResponses::Success('Login Successfully', $data, 201);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function profile(Request $request)
    {
        try {
            /* Obtener el token */
            $token = $request->bearerToken();

            $data = [
                'user' => $request->user(),
                'token' => $token,
                'isAdmin' => $request->user()->isAdmin,
            ];

            return ApiResponses::Success('User Profile', $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logout(Request $request)
    {
        try {
            /* revocar los tokens del usuario autenticado */
            $request->user()->tokens()->delete();

            return ApiResponses::Success('Logout Successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
