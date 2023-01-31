<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\IFTTTHandler;

class ProductoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//paginacion muestra solo 5 productos
		$productos = Producto::paginate(5);

		//llama a los productos
		return view('productos.index', compact('productos'));  
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('productos.crear');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'nombre' => 'required', 
			'descripcion' => 'required',
			'imagen' => 'required|image',
			'modelo' => 'file'
		]);

		// $infoPath = pathinfo(public_path('/modelo/Arbol.glb'));
		// $extension = $infoPath['extension'];
		// dd($extension);

		$producto = $request->all();

		//obtiene y guarda la imagen en la carpeta ./public/imagen
		if ($imagen = $request->file('imagen')) {
			$rutaGuardarImg = 'imagen/';
			$imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
			$imagen->move($rutaGuardarImg, $imagenProducto);
			$producto['imagen'] = "$imagenProducto";
		}
		
		//obtiene y guarda la imagen en la carpeta ./public/modelo
		if ($modelo = $request->file('modelo')) {
			$rutaGuardarModleo = 'modelo/';
			$nameModelo = date('YmdHis') . "." . $modelo->getClientOriginalExtension();
			$modelo->move($rutaGuardarModleo, $nameModelo);
			$producto['modelo'] = "$nameModelo";
		}

		Producto::create($producto);
		return redirect()->route('productos.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	// public function show($id)
	// {
	// 	//
	// }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Producto $producto)
	{
		return view('productos.editar', compact('producto'));
	}

	/**
	 * Update the specified resource in storage.
	 *    NOTA
	 * No se puede guardar el modelo al editar
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Producto $producto)
	{
		$request->validate([
			'nombre' => 'required', 
			'descripcion' => 'required',
			'imagen' => 'required|image',
			'modelo' => 'file'
		]);

		//obtener todos los productos
		$prod = $request->all();
		
		//obtiene y guarda la imagen en la carpeta ./public/imagen
		if( $imagen = $request->file('imagen') ) {
			$rutaGuardarImg = 'imagen/';
			$imagenProducto	= date('YmdHis').".".$imagen->getClientOriginalExtension();
			$imagen->move($rutaGuardarImg, $imagenProducto);
			$prod['imagen'] = "$imagenProducto";
		}else{
			unset($prod['imagen']);
		}

		//obtiene y guarda la imagen en la carpeta ./public/modelo
		if ($modelo = $request->file('modelo')) {
			$rutaGuardarModleo = 'modelo/';
			$nameModelo = date('YmdHis') . "." . $modelo->getClientOriginalExtension();
			$modelo->move($rutaGuardarModleo, $nameModelo);
			$prod['modelo'] = "$nameModelo";
		}else{
			unset($prod['modelo']);
		}

		$producto->update($prod);
		return redirect()->route('productos.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Producto $producto)
	{
		// $file = $producto->name;
		// Storage::delete("public/imagen/$file");
		$producto->delete();
		return redirect()->route('productos.index');
	}
}
