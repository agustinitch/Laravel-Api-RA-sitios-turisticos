<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Models\Producto;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function downloadimage($id)
    {
        // $arch = $request->all();
        // $filepath = public_path("imagen/$arch");
        // return Response::download(public_path("imagen/20230122190333.jpeg"));
        
        
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
        // return response()->json($image);
    }
}
