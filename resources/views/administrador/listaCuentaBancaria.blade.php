@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-12 contenedor-usuario">
  
  <a href="{{ URL::asset('/nuevaCuentaBancaria') }}" class="btn btn-success btn-md" style="margin-top: 24px;">
          <span class="glyphicon glyphicon-plus"></span>
          Agregar Cuenta Bancaria
  </a>
          <!-- tabla principal de usuarios -->
          <div class="row tabla-usuarios">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <th>Nombre</th>
                  <th>Banco</th>
                  <th>Tipo</th>
                  <th>Moneda</th>
                  <th># Cuenta</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <!-- @define $i = 1 -->
                  @php
                     $i=0;
                  @endphp
                  @if(isset($cuentas))
                    @foreach($cuentas as $c)
                    @php
                    $i =   $c->monto  + $i
                    @endphp
                    valor {{
                      $c->monto
                    }}
                    = {{
                      $i
                    }}
                    
                      <tr>
                        <td>{{ $c->nombre }}</td>
                        <!-- <td>{{ $c->user }}</td> -->
                        <td>{{ $c->banco }}</td>
                        <td>{{ $c->tipo }}</td>
                        <td>{{ $c->moneda }}</td>
                        <td>{{ $c->cuenta }}</td>

                        <td>
                         <a class="btn btn-primary btn-md" href="{{ url('/modificarCuenta') }}/{{$c->id}}"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar</a>
                         <a class="btn btn-success btn-md" href="{{ url('/verCuenta') }}/{{$c->id}}"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a>
                         <a  type="button" class="btn btn-danger btn-md" href="#"  data-toggle="modal" data-target="#myModal" onclick="preEliminar({{$c->id}})"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
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
