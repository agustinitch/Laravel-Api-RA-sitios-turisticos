<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Models\Producto;
use Illuminate\Http\Request;

class ApiProductoController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos = Producto::all();

        return response()->json([
            'status'=>true,
            'modelos'=> $modelos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación
        $request->validate([
			'nombre' => 'required',
			'descripcion' => 'required',
			'imagen' => 'required|image|mimes:jpeg,png,jpg'
		]);

        // Obtiene toda la valicación
        $producto = $request->all();

        // Si se mando una imagen la guarda
        if ( $imagen = $request->file('imagen') ) {
			$rutaGuardarImg = 'imagen/';
			$imagenProducto = date('YmdHis').".".$imagen->getClientOriginalExtension();
			$imagen->move($rutaGuardarImg, $imagenProducto);
			$producto['imagen'] = "$imagenProducto";
		}

        // Crea el nuevo producto
        Producto::create($producto);

        // Devuelte en respuesta el producto creado
        return response()->json([
            'status'=>true,
            'modelos'=> $producto
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // public function show(Post $post)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // public function edit(Post $post)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductoRequest $request, Producto $modelos)
    {
        $modelos->update($request->all());

        return response()->json([
            "status" => true,
            "message" => "Put Update done successfully",
            "post" => $modelos
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return response()->json([
            "status" => true,
            "message" => "Delete Destroy done successfully",
        ]);
    }
}
