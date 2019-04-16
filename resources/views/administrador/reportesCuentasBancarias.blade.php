@extends('administrador.escritorio')

@section('content')

<div class="container-fluid row contenedor-usuario col-md-12">
  <form class=""  action="{{ url('/reportesCuentasBancarias') }}" method="post" id="formreportes">
    {{ csrf_field() }}

    <div style="padding: 15px;" class="col-md-3">
      <label for="user">Cuentas</label>
      <select class="form-control chosen-select"  data-placeholder="Seleccione la Cuenta" name="tipoReporte" id="tipoReporte">
        @if(isset($cuentas))
        <option value="0">Todo</option>

          @foreach($cuentas as $c)
          <option value="{{ $c->id }}">{{ $c->nombre }}</option>
          @endforeach
        @endif
      </select>
    </div>


    <div style="padding: 15px;" class="col-md-3" hidden id="fInicio">
      <div class="form-group">
       <label for="user">Fecha Inicio:</label>
       <input type="date" step="any" class="form-control" name="fechaInicio"   placeholder="Fecha Inicial">
    </div>

    </div>
    <div style="padding: 15px;" class="col-md-3" hidden id="fFin">
      <div class="form-group">
       <label for="user">Fecha Fin</label>
       <input type="date" step="any" class="form-control" name="fechaFinal"   placeholder="Fecha Final">
      </div>
    </div>
      <div class="col-md-3">
        <div class="form-group"  style="margin-top: 39px;">
        <input type="hidden" id="titulo" name="titulo">
        <button href="#" type="submit" class="btn btn-info" id="idconsultar">Consultar</button>
      </div>
    </div>

  </form>
</div>
<div class="container row col-md-12 contenedor-usuario">

@if(isset($titulo))
<h3>{{ $titulo }}</h3>
@endif

          <!-- tabla principal de usuarios -->
          @if(isset($tipoReporte))
          <form class="" action="{{ url('/reportegenerar') }}" method="post" target="_blank">
            {{ csrf_field() }}
            <input type="hidden" name="tipoReporte" value="{{$tipoReporte}}">
            <input type="hidden" name="fechaInicio" value="{{$fechaInicio}}">
            <input type="hidden" name="fechaFinal" value="{{$fechaFinal}}">
            <button href="#" target="_blank" type="submit"  class="btn btn-warning">Generar</button>
          </form>
          @endif
          <div class="row tabla-usuarios">
            <div class="table-responsive">
            @if(isset($mov_entrada) || isset($mov_salida))
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th scope="col">Movimiento</th>
                    <th scope="col">Rubro</th>

                    <th scope="col">Monto</th>
                    <th scope="col">Fecha registro</th>
                  </tr>
                </thead>
                  <tbody>
                  @if(isset($mov_entrada))
                    @foreach($mov_entrada as $me)
                    <tr>
                      <!-- <th scope="row">{{ $me->cuenta }}</th> -->
                      <th scope="row">Entrada</th>
                      <td>{{ $me->rubro->nombre }}</td>

                      @if($me->moneda == "Dolares")
                      <td class="text-left">$ {{ number_format($me->monto, 2, ' ', ',') }}</td>
                      @endif
                      @if($me->moneda == "Colones")
                      <td class="text-left">₡ {{ number_format($me->monto, 2, ' ', ',') }}</td>
                      @endif
                      @if($me->moneda == "Euros")
                      <td class="text-left">€ {{ number_format($me->monto, 2, ' ', ',') }}</td>
                      @endif
                      <!-- verificar tipo moneda -->
                        <td>{{$me->fechaRegistro}}</td>
                    </tr>
                    @endforeach
                  @endif

                   @if(isset($mov_salida))
                    @foreach($mov_salida as $ms)
                    <tr>
                      <!-- <th scope="row">{{ $ms->cuenta }}</th> -->
                      <th scope="row">Salida</th>
                      <td>{{ $ms->rubro->nombre }}</td>
                      <td>{{ $ms->moneda }}</td>
                      @if($ms->moneda == "Dolares")
                      <td class="text-left">$ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
                      @endif
                      @if($ms->moneda == "Colones")
                      <td class="text-left">₡ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
                      @endif
                      @if($ms->moneda == "Euros")
                      <td class="text-left">€ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
                      @endif
                      <!-- verificar tipo moneda -->
                        <td>{{$ms->fechaRegistro}}</td>
                    </tr>
                    @endforeach
                  @endif

                  </tbody>
              </table>
            @endif

            @if(!isset($mov_entrada))
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                      <th scope="col">Nombres</th>
                    <th scope="col"># Cuenta</th>
                    <th scope="col">Banco</th>
                    <th scope="col">Tipo</th>

                    <th scope="col">Monto</th>
                    <th scope="col">Fecha Registro</th>
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
                      <td scope="row">{{ $c->nombre }}</td>
                      <th scope="row">{{ $c->cuenta }}</th>
                      <td>{{$c->banco}}</td>
                      <td>{{ $c->tipo }}</td>

                      @if($c->moneda == "Dolares")
                      <td class="text-right">$ {{ number_format($c->monto, 2, ' ', ',') }}</td>
                      @endif
                      @if($c->moneda == "Colones")
                      <td class="text-right">₡ {{ number_format($c->monto, 2, ' ', ',') }}</td>
                      @endif
                      @if($c->moneda == "Euros")
                      <td class="text-right">€ {{ number_format($c->monto, 2, ' ', ',') }}</td>
                      @endif
                      <!-- verificar tipo moneda -->
                        <td>{{$c->fechaRegistro}}</td>
                        <td>{{$c->updated_at}}</td>
                    </tr>
                    @endforeach
                  @endif
                  </tbody>
              </table>
            @endif

            </div>
          </div>
</div>

<!-- Modal total -->
<div id="totalCuentas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Total Cuentas Bancarias</h4>
      </div>
      <div class="modal-body">
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th scope="col"># Cuenta</th>
        <th scope="col">Banco</th>
        <th scope="col">Tipo</th>

        <th scope="col">Monto</th>
        <th scope="col">Fecha Registro</th>
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
        <th scope="row">{{ $c->cuenta }}</th>
        <td>{{$c->banco}}</td>
        <td>{{ $c->tipo }}</td>

        @if($c->moneda == "Dolares")
        <td class="text-right">$ {{ number_format($c->monto, 2, ' ', ',') }}</td>
        @endif
        @if($c->moneda == "Colones")
        <td class="text-right">₡ {{ number_format($c->monto, 2, ' ', ',') }}</td>
        @endif
        @if($c->moneda == "Euros")
        <td class="text-right">€ {{ number_format($c->monto, 2, ' ', ',') }}</td>
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

@section('scripts')
<script>
$( document ).ready(function() {
  $( document ).ready(function() {
    $('#example').dataTable({
    'iDisplayLength': 100
  });
  $("#fInicio").show();
    $("#fFin").show();
    $("#tipoReporte").change(function(){
      var elt = document.getElementById("tipoReporte");
      $("#titulo").attr("value",elt.options[elt.selectedIndex].text);
      if ($("#tipoReporte").val() > 0) {
        $("#fInicio").show();
          $("#fFin").show();
      }else if($("#tipoReporte").val()==0){
        $("#fInicio").hide();
          $("#fFin").hide();
      }
      console.log($("#tipoReporte").val());
    });




//datapicker
    $( "#datepicker" ).datepicker({format: 'yyyy-mm-dd'});
    $( "#datepicker2" ).datepicker({format: 'yyyy-mm-dd'});



});





</script>
@endsection
