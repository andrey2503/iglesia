@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-12 contenedor-usuario">

<h3>Logs</h3>
          <!-- tabla principal de usuarios -->
          <div class="row tabla-usuarios">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <th>Usuario</th>
                  <th>Tabla</th>
                  <th>Elemento</th>
                  <th>Accion</th>
                  <th>Fecha</th>
                </thead>
                <tbody>
                  @if(isset($logs))
                    @foreach($logs as $l)

                      <tr>
                      <td>{{ $l->usuario->nombre }}</td>
                        <!-- <td>{{ $l->id }}</td> -->
                        <td>{{ $l->nombre_tabla }}</td>
                        <td>{{ $l->nombre_elemento }}</td>
                        <td>{{ $l->accion }}</td>
                        <td>{{ $l->created_at }}</td>
                      </tr>

                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog"  id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmacion</h4>
      </div>
      <div class="modal-body">
        <h4>Desea eliminar este elemento?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
        <form  action="{{ url('eliminarCuenta') }}" method="post">
        {{ csrf_field() }}
        <input id="rutaEliminar" type="hidden"  name="id">
        <button type="submit" href="#" class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>   Eliminar</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
  function preEliminar(id){
    // alert(id);
    let ruta= document.getElementById('rutaEliminar');
    ruta.value=id;
    console.log(ruta.value);
  }
</script>
@endsection
