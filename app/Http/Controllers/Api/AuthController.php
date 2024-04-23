<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

/**
* @OA\Info(title="API Deezer Clone", version="1.0")
*
* @OA\Server(url="http://localhost:8000")
*/
class AuthController extends Controller
{
    /**
    * @OA\Post(
    *     path="/api/auth/register",
    *     summary="Registrar usuario",
    *     tags={"Auth"},
    * @OA\Parameter(
    *   name="name",
    *   in="query",
    *   description="Nombre del usuario",
    *   required=true,
    *   @OA\Schema(type="string")
    * ),
    * @OA\Parameter(
    *   name="email",
    *   in="query",
    *   description="Correo del usuario",
    *   required=true,
    * @OA\Schema(type="string")
    * ),
    * @OA\Parameter(
    *   name="password",
    *   in="query",
    *   description="Contraseña del usuario",
    *   required=true,
    *   @OA\Schema(type="string")
    * ),
    * @OA\Parameter(
    *   name="country",
    *   in="query",
    *   description="País del usuario",
    *   required=true,
    *   @OA\Schema(type="string")
    * ),
    *     @OA\Response(
    *         response=200,
    *         description="Registrar usuario y obtener sus datos."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function register(RegisterAuthRequest $request): JsonResponse
    {
        $user = User::create($request->all());

        return response()->json([
               'data' => [
               'attributes'=> [
                   'id' => $user->id,
                   'name' => $user->name,
                   'email' => $user->email
                ],
               'token' => $user->createToken($user->id)->plainTextToken
             ],
            ], Response::HTTP_OK);
    }

    public function login(LoginAuthRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
           return response()->json([
             'message' => 'Las credenciales son incorrectas.'
           ], Response::HTTP_UNPROCESSABLE_ENTITY);

        }

        return response()->json([
               'data' => [
               'attributes'=> [
                   'id' => $user->id,
                   'name' => $user->name,
                   'email' => $user->email
                ],
               'token' => $user->createToken()->plainTextToken
             ],
            ], Response::HTTP_OK);
    }


    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Ha cerrado sesión.'
        ]);
    }
}
