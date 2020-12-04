
<div class="row align-items-center mt-3 mb-3">
	<div class="col">
		<nav class="navbar navbar-light bg-light ">
  			<a class="navbar-brand">Buscar valor</a>
	 		 <form class="form-inline" action="{{route('valor.index')}}" method="GET" autocomplete="off" role="search">
    			<input class="form-control mr-sm-2" type="search" placeholder="id, nombre o estado" aria-label="Search" name="searchText" value="{{$searchText}}">
    			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
			  </form>
			  <button class=" float-right btn btn-outline-primary my-2 my-sm-0" type="button"><a href="{{url('valorm3/create')}}">nuevo</a></button>

		  </nav>
</div>
