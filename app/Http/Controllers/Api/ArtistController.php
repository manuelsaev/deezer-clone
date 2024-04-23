<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArtistController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/artists/{id}",
    *     summary="Obtener detalle de Artista",
    *     tags={"Artists"},
    *     security={{"bearerAuth":{}}},
    * @OA\Parameter(
    *   name="id",
    *   in="path",
    *   description="ID de artista",
    *   required=true,
    *   @OA\Schema(type="integer")
    * ),
    *     @OA\Response(
    *         response=200,
    *         description="Obtener detalle de artista exitoso."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function get(Request $request, $id)
    {

        $data = [];
        $code = "";

        if(is_numeric($id)){
            $data = Artist::where('id', $id)->first();
            $message = 'Consulta de detalle de artista exitoso';
            $code = Response::HTTP_OK;
        }else{
            $message = 'Debe especificar un ID de artista';
            $code = Response::HTTP_UNPROCESSABLE_ENTITY;
        }

        return response()->json([
            [
               'data' => $data,
               'message' => $message
             ],
            ], $code);

    }
}
