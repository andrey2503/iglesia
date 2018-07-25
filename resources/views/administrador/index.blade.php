@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-12 contenedor-usuario">

  <a href="{{ URL::asset('/nuevoUsuario') }}" class="btn btn-success btn-md" style="margin-top: 24px;">
          <span class="glyphicon glyphicon-plus"></span>
          Agregar
  </a>
          <!-- tabla principal de usuarios -->
          <div class="row tabla-usuarios">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <th>Nombre</th>
                  <!-- <th>Usuario</th> -->
                  <th>Email</th>
                  <th>Rol</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  @if(isset($users))
                    @foreach($users as $u)
                    @if(Auth::user()->id!= $u->id)
                      <tr>
                        <td>{{ $u->nombre }}</td>
                        <!-- <td>{{ $u->user }}</td> -->
                        <td>{{ $u->email }}</td>

                         @if($u->idrol==1)
                        <td>Administrador</td>
                        @elseif($u->idrol==2)
                        <td>Digitador</td>
                        @elseif($u->idrol==3)
                        <td>Lector</td>
                        @endif


                        <td>
                         <a class="btn btn-primary btn-md" href="{{ url('/modificarUsuario') }}/{{$u->id}}"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar</a>
                         <a class="btn btn-success btn-md" href="{{ url('/verUsuario') }}/{{$u->id}}"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a>
                         <a  type="button" class="btn btn-danger btn-md" href="#"  data-toggle="modal" data-target="#myModal" onclick="preEliminar({{$u->id}})"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
                        </td>
                      </tr>
                    @endif
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
        <form  action="{{ url('eliminarUsuario') }}" method="post">
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
