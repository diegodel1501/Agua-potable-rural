@extends('adminPruebasConcepto.admin')

@section('contenido')
<div class="row align-items-center">
	<div class="col">
		<nav class="navbar navbar-light bg-light ">
  			<a class="navbar-brand">Buscar Socio</a>
	 		 <form class="form-inline">
    			<input class="form-control mr-sm-2" type="search" placeholder="Nombre, rut, vivienda" aria-label="Search">
    			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
  			</form>
  		</nav>
	</div>
	<div class="col d-flex justify-content-center">
		<button class="btn btn-outline-primary my-2 my-sm-0" type="button">nuevo</button>
	</div>
		
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">identificador</th>
      <th scope="col">nombre</th>
      <th scope="col">apellido</th>
      <th scope="col">direccion</th>
      <th scope="col">Control</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>camelias 3</td>
      <td><i class="fas fa-trash-alt"></i>/<i class="fas fa-edit"></i>/<i class="fas fa-eye"></i></td>

    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>camelias s/n</td>
      <td><i class="fas fa-trash-alt"></i>/<i class="fas fa-edit"></i>/<i class="fas fa-eye"></i></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>rio lejos</td>
      <td><i class="fas fa-trash-alt"></i>/<i class="fas fa-edit"></i>/<i class="fas fa-eye"></i></td>
    </tr>
  </tbody>
</table>
@endsection