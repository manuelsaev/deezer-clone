<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SongController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/search",
    *     summary="Realizar una búsqueda",
    *     tags={"Songs"},
    *     security={{"bearerAuth":{}}},
    * @OA\Parameter(
    *   name="q",
    *   in="query",
    *   description="Palabras clave para la búsqueda",
    *   required=true,
    *   @OA\Schema(type="string")
    * ),
    *     @OA\Response(
    *         response=200,
    *         description="Obtener resultados de búsqueda exitoso."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function search(Request $request)
    {

        $data = [];
        $code = "";

        if($request->has('q')){
            $data = Song::with(['album','album.artist'])
                        ->where('songs.title', 'LIKE', '%'.$request->get('q').'%')
                        ->get();
            $message = 'Búsqueda exitosa';
        }

        $code = Response::HTTP_OK;


        return response()->json([
            [
               'data' => $data,
               'message' => $message
             ],
            ], $code);

    }
}
