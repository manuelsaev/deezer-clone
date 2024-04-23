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
use Laravel\Sanctum\PersonalAccessToken;

/**
* @OA\Info(title="API Deezer Clone", version="1.1")
*
* @OA\Server(url="http://localhost:8000")
*
* @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
* )
*/
class AuthController extends Controller
{
    /**
    * @OA\Post(
    *     path="/api/auth/register",
    *     summary="Registrar usuario",
    *     tags={"Auth"},
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\MediaType(mediaType="multipart/form-data",
    *              @OA\Schema(
    *           required={"name","email","password","country"},
    *           @OA\Property(
    *               property="name",
    *               type="string",
    *               description="Nombre"
    *           ),
    *           @OA\Property(
    *               property="email",
    *               type="string",
    *               description="Email"
    *           ),
    *           @OA\Property(
    *               property="password",
    *               type="string",
    *               description="Contraseña"
    *           ),
    *           @OA\Property(
    *               property="country",
    *               type="string",
    *               description="País"
    *           ),
    *             )
    *         )
    *      ),
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
                   'country' => $user->country,
                   'name' => $user->name,
                   'email' => $user->email
                ],
               'token' => $user->createToken($user->id)->plainTextToken
             ],
            ], Response::HTTP_OK);
    }

    /**
    * @OA\Post(
    *     path="/api/auth/login",
    *     summary="Autenticar usuario",
    *     tags={"Auth"},
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\MediaType(mediaType="multipart/form-data",
    *              @OA\Schema(
    *           required={"email","password"},
    *           @OA\Property(
    *               property="email",
    *               type="string",
    *               description="Email"
    *           ),
    *           @OA\Property(
    *               property="password",
    *               type="string",
    *               description="Contraseña"
    *           ),
    *             )
    *         )
    *      ),
    *     @OA\Response(
    *         response=200,
    *         description="Autenticar usuario y obtener sus datos."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     ),
    *     @OA\Response(response=401, description="Unauthorized"),
    *     @OA\Response(response=404, description="Not Found"),
    * )
    */
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
                   'country' => $user->country,
                   'name' => $user->name,
                   'email' => $user->email
                ],
               'token' => $user->createToken($user->id)->plainTextToken
             ],
            ], Response::HTTP_OK);
    }

    /**
    * @OA\Post(
    *     path="/api/auth/logout",
    *     summary="Cerrar sesión de usuario",
    *     tags={"Auth"},
    *     security={{"bearerAuth":{}}},
    *     @OA\Response(
    *         response=200,
    *         description="Cerrar sesión de usuario."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     ),
    *     @OA\Response(response=401, description="Unauthorized"),
    * )
    */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Ha cerrado sesión.'
        ]);
    }
}
