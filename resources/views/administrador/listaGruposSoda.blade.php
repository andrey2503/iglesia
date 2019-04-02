@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-12 contenedor-usuario">
  <h3>Grupos para la Soda</h3>
  @if(session()->has('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
@endif
@if(session()->has('messageError'))
      <div class="alert alert-danger">
        {{ session()->get('messageError') }}
      </div>
@endif
@if(Auth::user()->idrol==1 || Auth::user()->idrol==2)
  <a href="{{ URL::asset('/nuevoGrupoSoda') }}" class="btn btn-success btn-md" style="margin-top: 24px;">
          <span class="glyphicon glyphicon-plus"></span>
          Agregar Grupo
  </a>
@endif

          <!-- tabla principal de usuarios -->
          <div class="row tabla-usuarios">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <th>Grupo</th>
                  <th>Fecha de Inicio</th>
                  <th>Fecha Final</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <!-- @define $i = 1 -->

                  @if(isset($gruposSoda))
                    @foreach($gruposSoda as $gs)


                      <tr>
                        <td>{{ $gs->nombreGrupo }}</td>
                        <!-- <td>{{ $gs->user }}</td> -->
                        <td>{{ $gs->fechaInicio }}</td>
                        <td>{{ $gs->fechaFin }}</td>

                        <td>
                          @if(Auth::user()->idrol==1 || Auth::user()->idrol==2)
                         <a class="btn btn-primary btn-md" href="{{ url('/modificarGrupoSoda') }}/{{$gs->id}}"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar</a>
                           @endif
                         <a class="btn btn-success btn-md" href="{{ url('/verGrupoSoda') }}/{{$gs->id}}"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a>
                         @if(Auth::user()->idrol==1 || Auth::user()->idrol==2)
                         <a  type="button" class="btn btn-danger btn-md" href="#"  data-toggle="modal" data-target="#myModal" onclick="preEliminar({{$gs->id}})"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
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
        <form  action="{{ url('eliminarGrupoSoda') }}" method="post" id="eliminar">
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
