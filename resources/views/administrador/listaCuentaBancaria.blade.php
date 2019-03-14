@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-12 contenedor-usuario">
  <h3>Cuentas Bancarias</h3>
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
  <a href="{{ URL::asset('/nuevaCuentaBancaria') }}" class="btn btn-success btn-md" style="margin-top: 24px;">
          <span class="glyphicon glyphicon-plus"></span>
          Agregar Cuenta Bancaria
  </a>
  <!-- Trigger the modal with a button -->
<a type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#totalCuentas" style="margin-top: 24px;"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> Total Cuentas Bancarias</a>
<a href="{{ URL::asset('/reportesCuentasBancarias') }}" class="btn btn-danger btn-md" style="margin-top: 24px;">
        <span class="glyphicon glyphicon-file"></span>
        Reportes
</a>
<h3>Cuentas Bancarias</h3>

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
                  <th>Monto Total</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <!-- @define $i = 1 -->

                  @if(isset($cuentas))
                    @foreach($cuentas as $c)


                      <tr>
                        <td>{{ $c->nombre }}</td>
                        <!-- <td>{{ $c->user }}</td> -->
                        <td>{{ $c->banco }}</td>
                        <td>{{ $c->tipo }}</td>
                        <td>{{ $c->moneda }}</td>
                        <td>{{ $c->cuenta }}</td>
                        @if($c->moneda == "Dolares")
                        <td>$ {{ number_format($c->monto, 2, ' ', ',') }}</td>
                        @endif
                        @if($c->moneda == "Colones")
                        <td>₡ {{ number_format($c->monto, 2, ' ', ',') }}</td>
                        @endif
                        @if($c->moneda == "Euros")
                        <td>€ {{ number_format($c->monto, 2, ' ', ',') }}</td>
                        @endif

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

<!-- Modal total -->
<div id="totalCuentas" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Total Cuentas Bancarias</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
    <thead>
      <tr>
          <th scope="col">Nombre</th>
        <th scope="col"># Cuenta</th>
        <th scope="col">Banco</th>
        <th scope="col">Tipo</th>
        <th scope="col">Moneda</th>
        <th scope="col">Monto</th>
        <th scope="col">Fecha de Registro</th>
        <th scope="col">Datos Actualizacion</th>
      </tr>
    </thead>
    <tbody>
      @php $i=0;
      @endphp
      @if(isset($cuentas))
        @foreach($cuentas as $c)
        @php
        $i =   $c->monto  + $i
        @endphp
      <tr>
          <td>{{ $c->nombre }}</td>
        <th scope="row">{{ $c->cuenta }}</th>
        <td>{{$c->banco}}</td>
        <td>{{ $c->tipo }}</td>
        <td>{{ $c->moneda }}</td>
        @if($c->moneda == "Dolares")
        <td>$ {{ number_format($c->monto, 2, ' ', ',') }}</td>
        @endif
        @if($c->moneda == "Colones")
        <td>₡ {{ number_format($c->monto, 2, ' ', ',') }}</td>
        @endif
        @if($c->moneda == "Euros")
        <td>€ {{ number_format($c->monto, 2, ' ', ',') }}</td>
        @endif
        <!-- verificar tipo moneda -->
          <td>{{$c->fechaRegistro}}</td>
          <td>{{$c->updated_at}}</td>

      </tr>
      @endforeach
    @endif
    </tbody>
  </table>
  <!-- <table class="table table-striped">
<tr>
  <td ><strong>Total Cuentas Bancarias: </strong> </td>
  <td>{{ $i  }}.00</td>
</tr>
  </table> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
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
        <form  action="{{ url('eliminarCuenta') }}" method="post" id="eliminar">
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
