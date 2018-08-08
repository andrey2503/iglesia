@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-12 contenedor-usuario">

  <a href="{{ URL::asset('/nuevoEmpleado') }}" class="btn btn-success btn-md" style="margin-top: 24px;">
          <span class="glyphicon glyphicon-plus"></span>
          Agregar
  </a>
          <!-- tabla principal de usuarios -->
          <div class="row tabla-usuarios">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <th>Nombre</th>
                  <th>Cedula</th>
                  <th>Telefeno</th>
                  <th>Puesto</th>
                  <th>Estado</th>
                  <th>Monto</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  @if(isset($empleados))
                    @foreach($empleados as $e)
                      <tr>
                        <td>{{ $e->nombre }}</td>
                        <td>{{ $e->cedula }}</td>
                        <td>{{ $e->telefono }}</td>
                        <td>{{ $e->fk_puesto }}</td>
                        @if($e->estado==1)
                        <td>activo</td>
                        @else
                        <td> inactivo</td>
                        @endif
                        <td>{{ $e->monto }}</td>

                        <td>
                         <a class="btn btn-primary btn-md" href="{{ url('/modificarEmpleado') }}/{{$e->id}}"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar</a>
                         <a class="btn btn-success btn-md" href="{{ url('/verEmpleado') }}/{{$e->id}}"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a>
                         <a  type="button" class="btn btn-danger btn-md" href="#"  data-toggle="modal" data-target="#myModal" onclick="preEliminar({{$e->id}})"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
                        </td>
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
        <form  action="{{ url('eliminarEmpleado') }}" method="post">
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
