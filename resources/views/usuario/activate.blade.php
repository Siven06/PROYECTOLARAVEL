<div class="modal" id="modal-toggle-{{$reg->id}}" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content badge {{ $reg->activo ? 'bg-success' : 'bg-warning'}}"
        {{ $reg->activo ? 'desactivar' : 'activar'}}>
            <form action="{{route('usuarios.toggle', $reg->id)}}" method="post">
                @csrf
                @method('PATCH')

                <div class="modal-header">
                    <h4>{{ $reg->activo ? 'Desactivar' : 'Activar'}} Registro</h4>
                </div>

                <div class="modal-body">
                    ¿Usted desea {{ $reg->activo ? 'Desactivar' : 'Activar'}} el estado de {{$reg->name}}?
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-light">{{ $reg->activo ? 'desactivar' : 'activar'}}</button>
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </form>
        </div>
    </div>
</div>
