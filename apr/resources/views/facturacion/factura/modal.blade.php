

<div class="modal fade" id="modal-delete-{{$m->idmedicion}}">
 <form action="{{ route('medicion.destroy', $m->idmedicion) }}" method="POST">
  @method('DELETE')
  @csrf
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">
      <span aria-hidden>x</span>
     </button>
     <h4 class="modal-title">cerrar</h4>
    </div>
    <div class="modal-body">
     <p>
      Confirme si desea Eliminar la medicion de la casa: <strong>{{ $m->direccion }}</strong>, efectuada en la fecha:  <strong>{{ $m->fechadeingreso }}</strong>, por:  <strong>{{ $m->inscriptor }}</strong>
     </p>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">
      Cerrar
     </button>
     <button type="submit" class="btn btn-primary">Confirmar</button>
    </div>
   </div>
  </div>
 </form>
</div>

