

<div class="modal fade" id="modal-delete-{{$v->idValorM3}}">
 <form action="{{ route('valor.destroy', $v->idValorM3) }}" method="POST">
  @method('DELETE')
  @csrf
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
     </button>

    </div>
    <div class="modal-body">
     <p>
      Confirme si desea Eliminar <strong>{{ $v->nombre }}</strong>
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


