@extends('administrador.escritorio')

@section('content')

<div class="container-fluid row contenedor-usuario col-md-12">
  <form class=""  action="{{ url('/reportesconsultaCobrar') }}" method="post" id="formreportes">
    {{ csrf_field() }}

    <div style="padding: 15px;" class="col-md-3">
      <label for="user">Tipo de Reporte:</label>
      <select class="form-control" name="tipoReporte" id="tipoReporte">
          <option value="0">Selecione Tipo reporte</option>
          <option value="1">Por fechas</option>
          <option value="2">Todo</option>
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

        <button href="#" type="submit" class="btn btn-info" id="idconsultar">Consultar</button>
      </div>
    </div>

  </form>
</div>
<div class="container row col-md-12 contenedor-usuario">


<h3>Cuentas por Cobrar</h3>

          <!-- tabla principal de usuarios -->
          @if(isset($tipoReporte))
          <form class="" action="{{ url('/reportegenerarCP') }}" method="post" target="_blank">
            {{ csrf_field() }}
            <input type="hidden" name="tipoReporte" value="{{$tipoReporte}}">
            <input type="hidden" name="fechaInicio" value="{{$fechaInicio}}">
            <input type="hidden" name="fechaFinal" value="{{$fechaFinal}}">
            <button href="#" target="_blank" type="submit"  class="btn btn-warning">Generar</button>
          </form>
          @endif
          <div class="row tabla-usuarios">
            <div class="table-responsive">
              <table class="table table-striped"  id="example">
          <thead>
            <tr>
                <th scope="col">Nombre</th>
              <th scope="col"># ID</th>
              <th scope="col">Rubro</th>
              <th scope="col">Moneda</th>
              <th scope="col">Monto</th>
              <th scope="col">Fecha Registro</th>
            </tr>
          </thead>
          <tbody>
            @php $i=0;
            @endphp
            @if(isset($cuentasCobrar))
              @foreach($cuentasCobrar as $cp)
              @php
              $i =   $cp->monto  + $i
              @endphp
            <tr>
              <td scope="row">{{ $cp->nombre }}</td>
              <th scope="row">0{{ $cp->id }}PC</th>
              <td>{{$cp->rubro->nombre}}</td>
              <td>{{ $cp->moneda }}</td>
              @if($cp->moneda == "Dolares")
              <td>$ {{ number_format($cp->monto, 2, ' ', ',') }}</td>
              @endif
              @if($cp->moneda == "Colones")
              <td>₡ {{ number_format($cp->monto, 2, ' ', ',') }}</td>
              @endif
              @if($cp->moneda == "Euros")
              <td>€ {{ number_format($cp->monto, 2, ' ', ',') }}</td>
              @endif
              <!-- verificar tipo moneda -->
                <!-- <td>{{$cp->updated_at}}</td> -->
                <td>{{$cp->fechaRegistro}}</td>
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
  <div class="modal-dialog">

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
      <th scope="col"># ID</th>
      <th scope="col">Rubro</th>
      <th scope="col">Moneda</th>
      <th scope="col">Monto</th>
      <th scope="col">Fecha Registro</th>
      </tr>
    </thead>
    <tbody>
      @php $i=0;
      @endphp
      @if(isset($cuentasCobrar))
        @foreach($cuentasCobrar as $cp)
        @php
        $i =   $cp->monto  + $i
        @endphp
      <tr>
        <td scope="row">{{ $cp->nombre }}</td>
        <th scope="row">0{{ $cp->id }}PC</th>
        <td>{{$cp->rubro->nombre}}</td>
        <td>{{ $cp->moneda }}</td>
        @if($cp->moneda == "Dolares")
        <td>$ {{ number_format($cp->monto, 2, ' ', ',') }}</td>
        @endif
        @if($cp->moneda == "Colones")
        <td>₡ {{ number_format($cp->monto, 2, ' ', ',') }}</td>
        @endif
        @if($cp->moneda == "Euros")
        <td>€ {{ number_format($cp->monto, 2, ' ', ',') }}</td>
        @endif
        <!-- verificar tipo moneda -->
          <!-- <td>{{$cp->updated_at}}</td> -->
          <td>{{$cp->fechaRegistro}}</td>
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
    $('#example').dataTable({
    'iDisplayLength': 100
  });
    $("#tipoReporte").change(function(){
      if ($("#tipoReporte").val()==1) {
        $("#fInicio").show();
          $("#fFin").show();
      }else if($("#tipoReporte").val()!=1){
        $("#fInicio").hide();
          $("#fFin").hide();
      }
      console.log($("#tipoReporte").val());
    });



});





</script>
@endsection
