<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    public function downloadimage($id)
    {
        // Obtener el recurso correspondiente al ID especificado
        $product = Producto::find($id);

        // Comprobar si el recurso existe
        if (!$product) {
            return response()->json([
                'error' => 'Product not found'
            ], 404);
        }

        // Devolver la respuesta con el recurso
        $image = $product->imagen;

        return Response::download(public_path("imagen/$image"));
        
    }

    public function downloadmodelo($id)
    {
        // Obtener el recurso correspondiente al ID especificado
        $product = Producto::find($id);

        // Comprobar si el recurso existe
        if (!$product) {
            return response()->json([
                'error' => 'Product not found'
            ], 404);
        }

        // Devolver la respuesta con el recurso
        $model = $product->modelo;

        return Response::download(public_path("modelo/$model"));
        
    }
}
