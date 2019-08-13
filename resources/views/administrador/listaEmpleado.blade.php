@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-12 contenedor-usuario">
<h3>Lista Empleados</h3>
@if(Auth::user()->idrol==1 || Auth::user()->idrol==2)
  <a href="{{ URL::asset('/nuevoEmpleado') }}" class="btn btn-success btn-md" style="margin-top: 24px;">
          <span class="glyphicon glyphicon-plus"></span>
          Agregar Empleado
  </a>
    @endif
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
                  <th>Salario</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  @if(isset($empleados))
                    @foreach($empleados as $e)
                      <tr>
                        <td>{{ $e->nombre }}</td>
                        <td>{{ $e->cedula }}</td>
                        <td>{{ $e->telefono }}</td>
                        <td>{{ $e->puesto->nombre }}</td>
                        @if($e->estado==1)
                        <td>activo</td>
                        @else
                        <td> inactivo</td>
                        @endif
                        @foreach($salarios as $s)
                        @if($e->fk_puesto == $s->fk_puesto)
                        <td>{{ $s->salarioNeto }}</td>
                          @endif
                        @endforeach
                        <td>
                           @if(Auth::user()->idrol==1 || Auth::user()->idrol==2)
                         <a class="btn btn-primary btn-md" href="{{ url('/modificarEmpleado') }}/{{$e->id}}"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar</a>
                         @endif
                         <a class="btn btn-success btn-md" href="{{ url('/verEmpleado') }}/{{$e->id}}"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a>
                         @if(Auth::user()->idrol==1)
                         <a  type="button" class="btn btn-danger btn-md" href="#"  data-toggle="modal" data-target="#myModal" onclick="preEliminar({{$e->id}})"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
                         @endif
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
        <form  action="{{ url('eliminarEmpleado') }}" method="post" id="eliminar">
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
