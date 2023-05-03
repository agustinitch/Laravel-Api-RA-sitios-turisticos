<x-app-layout>
	<div class="py-12" style="background-image: url('http://escolar.itchetumal.edu.mx/moodle/pluginfile.php/1/theme_moove/loginbgimg/1628214763/banner2.jpg'); background-repeat: no-repeat; background-size: cover;">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-black overflow-hidden shadow-xl sm:rounded-lg" style="background-color: #fff">

				<a type="button" href="{{ route('productos.create') }}" style="display: block; margin: 15px auto; width: 200px;" class="bg-indigo-500 px-12 py-2 rounded text-white text-center text-2xl font-bold hover:bg-indigo-700 transition duration-200 each-in-out">Crear</a>

				<table class=" table-auto w-full">
					<thead>
						<tr class="bg-gray-800 text-white">
							<th style="display: none;">ID</th>
							<th class="border px-4 py-2">NOMBRE</th>
							<th class="border px-4 py-2">DESCRIPCION</th>
							<th class="border px-14 py-1">IMAGEN</th>
							<th style="display: none;">MODELO</th>
							<th class="border px-4 py-2">ACCIONES</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($productos as $producto)
						<tr style="text-align: center;">
							<td style="display: none;">{{$producto->id}}</td>
							<td class="border-b-2 border-sky-200 px-4 py-2">{{$producto->nombre}}</td>
							<td class="border-b-2 border-sky-200 px-4 py-2">{{$producto->descripcion}}</td>
							<td class="border-b-2 border-sky-200 px-14 py-1" style="width: 300px;">
								<img src="/imagen/{{$producto->imagen}}" style="display: block; margin: auto; max-height: 250px;">
							</td>
							<td class="border-b-2 border-sky-200 px-14 py-1" style="display: none;">
								<img src="/modelo/{{$producto->modelo}}" style="display: block; margin: auto; max-height: 250px;">
							</td>
							
							<td class="border-b-2 border-sky-200 px-4 py-2">
								<div class="flex justify-center gap-10 rounded-lg text-lg" role="group">
									<!-- boton editar -->
									<a href="{{ route('productos.edit', $producto->id) }}" class="px-12 py-2 rounded font-semibold" style="margin-right: 30px;">Editar</a>

									<!-- boton borrar -->
									<form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="formEliminar">
										@csrf
										@method('DELETE')
										<button type="submit" class="text-black font-semibold py-2 px-4">Borrar</button>
									</form>
								</div>
							</td>
						</tr>

					</tbody>
					@endforeach
				</table>
				<div>
					{!! $productos->links() !!}
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
<script>
	(function() {
		'use strict'
		// Buscamos todos los formularios que tengan la clase "formEliminar"
		var forms = document.querySelectorAll('.formEliminar')

		// Iteramos sobre cada uno de los formularios encontrados
		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				// Agregamos un evento "submit" a cada formulario
				form.addEventListener('submit', function(event) {
					// Evitamos que el formulario se envíe automáticamente
					event.preventDefault()
					event.stopPropagation()

					// Mostramos un mensaje de confirmación al usuario usando la librería SweetAlert2
					Swal.fire({
						title: '¿Confirma la eliminación?',
						icon: 'info',
						showCancelButton: true,
						confirmButtonColor: '#20c997',
						cancelButtonColor: '#6c757d',
						confirmButtonText: 'Confirmar'
					}).then((result) => {
						// Si el usuario confirma la eliminación, enviamos el formulario
						if (result.isConfirmed) {
							this.submit();
							// Mostramos un mensaje de éxito al usuario usando la librería SweetAlert2
							Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.', 'success');
						}
					})
				}, false)
			})
	})()
</script>
