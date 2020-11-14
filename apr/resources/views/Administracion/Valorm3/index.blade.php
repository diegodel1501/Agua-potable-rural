@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado de valores por metro cúbico</h3>
		@include('Administracion.Valorm3.search')
	</div>	
</div>
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" id="tablavalor">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>descripcion</th>
					<th>estado</th>
					<th>precio</th>
					<th>Opciones</th>
				</thead>
				<tbody>
				@foreach($valores as $v)
 					<tr>
 						<td>{{$v->idValorM3}}</td>
 						<td>{{$v->nombre}}</td>
 						<td>{{$v->descripcion}}</td>
 						<td>{{$v->estado}}</td>
 						<td>{{$v->precio}}</td>
 					<td>
 						<a href="{{route('valor.edit',$v->idValorM3)}}"><button class="btn btn-info">editar</button></a>
 				
 							<a href="" data-target="#modal-delete-{{$v->idValorM3}}" data-toggle="modal"><button class="btn btn-danger">eliminar</button></a>
 							@include('administracion.valorm3.modal')
 						</td>
 					</tr>

 					@endforeach
				</tbody>
 			</table>
 		</div>	
 	</div>
 </div>
 @endsection
 @push('estilos')
  <link rel="stylesheet" href="{{url('adminlte/plugins/datatables/jquery.datatables.min.css')}}">
@endpush
  @push('scripts')
   <script src="{{url('adminlte/plugins/datatables/jquery.datatables.min.js')}}"></script>
<script >
$( document ).ready(function() {
	//quitamo lo active anteriores y reponemos los neesarios
	$(".nav-link").removeClass("active");
	$(".administradorpositivoidentificador").addClass("active");
//agregamos el active de la seccion
  $("#menuvalor").addClass("active");
   $('#tablavalor').DataTable({
    			  searching: false,
    			  paging:true,
                language: {
                    processing: "Tratamiento en curso...",
                    search: "Buscar&nbsp;:",
                    lengthMenu: "Agrupar de _MENU_ items",
                    info: "Mostrando del item _START_ al _END_ de un total de _TOTAL_ items",
                    infoEmpty: "No existen datos.",
                    infoFiltered: "(filtrado de _MAX_ elementos en total)",
                    infoPostFix: "",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron datos con tu busqueda",
                    emptyTable: "No hay datos disponibles en la tabla.",
                    paginate: {
                        first: " Primero ",
                        previous: " Anterior ",
                        next: " Siguiente ",
                        last: " Ultimo "
                    },
                    aria: {
                        sortAscending: ": active para ordenar la columna en orden ascendente",
                        sortDescending: ": active para ordenar la columna en orden descendente"
                    }
                },
                scrollY: 200,
                lengthMenu: [ [3,7,-1], [3,7,"todos"] ],
            });
});
</script>
});
</script>
@endpush