@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-12 contenedor-usuario">
<h3>Cuentas por Pagar</h3>
 @if(Auth::user()->idrol==1 || Auth::user()->idrol==2)
  <a href="{{ URL::asset('/nuevaCuentaPP') }}" class="btn btn-success btn-md" style="margin-top: 24px;">
          <span class="glyphicon glyphicon-plus"></span>
          Agregar Cuenta por Pagar
  </a>
  @endif
  <a href="{{ URL::asset('/reportesPP') }}" class="btn btn-danger btn-md" style="margin-top: 24px;">
          <span class="glyphicon glyphicon-file"></span>
          Reportes
  </a>
          <!-- tabla principal de usuarios -->
          <div class="row tabla-usuarios">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <th>Nombre</th>
                  <th>Identificacion</th>
                  <th>Rubro</th>
                  <th>Monto</th>
                  <th>Moneda</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  @if(isset($cuentasPagar))
                    @foreach($cuentasPagar as $cpp)

                      <tr>
                        <td>{{ $cpp->nombre }}</td>
                        <td>0{{ $cpp->id }}PP</td>
                        <td>{{ $cpp->rubro->nombre }}</td>
                        <td>{{ $cpp->monto }}</td>
                          <td>{{ $cpp->moneda }}</td>
                        <td>
                           @if(Auth::user()->idrol==1 || Auth::user()->idrol==2)
                         <a class="btn btn-primary btn-md" href="{{ url('/modificarPP') }}/{{$cpp->id}}"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar</a>
                         @endif
                         <a class="btn btn-success btn-md" href="{{ url('/verPP') }}/{{$cpp->id}}"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a>
                         @if(Auth::user()->idrol==1)
                         <a  type="button" class="btn btn-danger btn-md" href="#"  data-toggle="modal" data-target="#myModal" onclick="preEliminar({{$cpp->id}})"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
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
        <form  action="{{ url('eliminarPP') }}" method="post" id="eliminar">
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
