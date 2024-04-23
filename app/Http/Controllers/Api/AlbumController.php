<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AlbumController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/albums/{id}",
    *     summary="Obtener detalle de Álbum",
    *     tags={"Albums"},
    *     security={{"bearerAuth":{}}},
    * @OA\Parameter(
    *   name="id",
    *   in="path",
    *   description="ID de álbum",
    *   required=true,
    *   @OA\Schema(type="integer")
    * ),
    *     @OA\Response(
    *         response=200,
    *         description="Obtener detalle de álbum exitoso."
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
            $data = Album::where('id', $id)->with(['artist','songs'])->first();
            $message = 'Consulta de detalle de album exitoso';
            $code = Response::HTTP_OK;
        }else{
            $message = 'Debe especificar un ID de álbum';
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
