
<div class="row align-items-center">
	<div class="col">
		<nav class="navbar navbar-light bg-light ">
  			<a class="navbar-brand">Buscar subsidio</a>
	 		 <form class="form-inline" action="{{route('subsidio.index')}}" method="GET" autocomplete="off" role="search">
    			<input class="form-control mr-sm-2" type="search" placeholder="id, tipo de subsidio o descripcion" aria-label="Search" name="searchText" value="{{$searchText}}">
    			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
  			</form>
  		</nav>
	</div>
			<div class="col d-flex justify-content-center">
		<button class="btn btn-outline-primary my-2 my-sm-0" type="button"><a href="{{url('subsidio/create')}}">nuevo</a></button>
	</div>
</div>
