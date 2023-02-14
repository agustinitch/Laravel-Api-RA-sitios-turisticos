<x-app-layout>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">

				<a type="button" href="{{ route('productos.create') }}" class="bg-indigo-500 my-8 px-12 py-2 w-full rounded text-white text-center text-2xl font-bold hover:bg-indigo-700 transition duration-200 each-in-out">Crear</a>

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
		//debemos crear la clase formEliminar dentro del form del boton borrar
		//recordar que cada registro a eliminar esta contenido en un form  
		var forms = document.querySelectorAll('.formEliminar')
		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {
					event.preventDefault()
					event.stopPropagation()
					Swal.fire({
						title: '¿Confirma la eliminación del registro?',
						icon: 'info',
						showCancelButton: true,
						confirmButtonColor: '#20c997',
						cancelButtonColor: '#6c757d',
						confirmButtonText: 'Confirmar'
					}).then((result) => {
						if (result.isConfirmed) {
							this.submit();
							Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.', 'success');
						}
					})
				}, false)
			})
	})()
</script>