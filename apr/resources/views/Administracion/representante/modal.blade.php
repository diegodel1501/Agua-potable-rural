

<div class="modal fade" id="modal-delete-{{$r->idrepresentante}}">
 <form action="{{ route('representante.destroy', $r->idrepresentante) }}" method="POST">
  @method('DELETE')
  @csrf
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
     </button>
    </div>
    <div class="modal-body text-center">
     <p>
      ¿Desea Eliminar a:<strong>{{ $r->nombre }}</strong>, con Rut: <strong> {{$r->rut}}</strong> ?
     </p>
     <i class="fas fa-exclamation-triangle fa-5x" style="color:orange"></i>

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


