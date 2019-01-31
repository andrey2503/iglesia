@extends('administrador.escritorio')

@section('content')

<div class="container-fluid row contenedor-usuario col-md-12">
  <form class=""  action="{{ url('/reporteMovimientos') }}" method="post" id="formreportes">
    {{ csrf_field() }}

    <div style="padding: 15px;" class="col-md-3">
      <label for="user">Tipo de Reporte:</label>
      <select class="form-control" name="tipoReporte" id="tipoReporte">
          <option value="0">Selecione Tipo reporte</option>
          <option value="1">Movimiento Por fechas</option>
          <option value="2">Todos los Movimientos</option>
          <option value="3">Todos los Rubros Por fechas</option>
          <option value="4">Todos los Rubros</option>
          <!-- <option value="5">1 Rubro Por fechas</option>
          <option value="6">Todos los Movimientos de 1 Rubro</option> -->
      </select>
    </div>
    <div style="padding: 15px;" class="col-md-3" id="rubro1" hidden>
      <label for="user">Rubro:</label>
      <select class="form-control" name="rubro" id="rubro">
          <option value="0">Selecione Rubro</option>
      </select>
    </div>
    <div style="padding: 15px;" class="col-md-2" hidden id="fInicio">
      <div class="form-group">
       <label for="user">Fecha Inicio:</label>
       <input type="date" step="any" class="form-control" name="fechaInicio"   placeholder="Fecha Inicial">
      </div>

    </div>
    <div style="padding: 15px;" class="col-md-2" hidden id="fFin">
      <div class="form-group">
       <label for="user">Fecha Fin</label>
       <input type="date" step="any" class="form-control" name="fechaFinal"   placeholder="Fecha Final">
      </div>
    </div>
      <div class="col-md-2">
        <div class="form-group"  style="margin-top: 39px;">

        <button href="#" type="submit" class="btn btn-info" id="idconsultar">Consultar</button>
      </div>
    </div>

  </form>
</div>
<div class="container row col-md-12 contenedor-usuario">


<h3>Movimientos Bancarios</h3>

          <!-- tabla principal de usuarios -->
          @if($tipoReporte>0)
          <form class="" action="{{ url('/reportegenerarMovimiento') }}" method="post" target="_blank">
            {{ csrf_field() }}
            <input type="hidden" name="tipoReporte" value="{{$tipoReporte}}">
            <input type="hidden" name="fechaInicio" value="{{$fechaInicio}}">
            <input type="hidden" name="fechaFinal" value="{{$fechaFinal}}">
            <button href="#" target="_blank" type="submit"  class="btn btn-warning">Generar</button>
          </form>
          @endif
          <div class="row tabla-usuarios">
            <div class="table-responsive">
              @if($tipoReporte == 0 || $tipoReporte == 0 || $tipoReporte == 2)
              <table id="example" class="table table-striped">


          <thead>
            <tr>
                <th scope="col">Tipo</th>
              <th scope="col">Moneda</th>
              <th scope="col">Monto</th>
              <th scope="col">Cuenta</th>
              <th scope="col">Rubro</th>
              <th scope="col">Usuario</th>
              <th scope="col">Fecha Registro</th>
            </tr>
          </thead>
          <tbody>

            @if(isset($movEntrada))
              @foreach($movEntrada as $me)

            <tr>
              <td scope="row">Entrada</td>
              <td>{{ $me->moneda }}</td>
              @if($me->moneda == "Dolares")
              <td>$ {{ number_format($me->monto, 2, ' ', ',') }}</td>
              @endif
              @if($me->moneda == "Colones")
              <td>₡ {{ number_format($me->monto, 2, ' ', ',') }}</td>
              @endif
              @if($me->moneda == "Euros")
              <td>€ {{ number_format($me->monto, 2, ' ', ',') }}</td>
              @endif

              <!-- verificar tipo moneda -->
              <td>{{$me->cuenta->cuenta}}</td>
                <td>{{$me->rubro->nombre}}</td>
                <td>{{$me->usuario->nombre}}</td>
                <td>{{$me->fechaRegistro}}</td>
            </tr>
            @endforeach
          @endif
<!--  segunda tabla-->
          @if(isset($movSalida))
            @foreach($movSalida as $ms)

            <tr>
              <td scope="row">Salida</td>
              <td>{{ $me->moneda }}</td>
              @if($ms->moneda == "Dolares")
              <td>$ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
              @endif
              @if($ms->moneda == "Colones")
              <td>₡ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
              @endif
              @if($ms->moneda == "Euros")
              <td>€ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
              @endif

              <!-- verificar tipo moneda -->
                <td>{{$me->cuenta->cuenta}}</td>
                <td>{{$ms->rubro->nombre}}</td>
                <td>{{$ms->usuario->nombre}}</td>
                <td>{{$ms->fechaRegistro}}</td>
            </tr>
          @endforeach
        @endif

          </tbody>

        </table>
          @endif

        @if($tipoReporte == 3)
        <table id="example" class="table table-striped">


    <thead>
      <tr>
        <th scope="col">Rubro</th>
        <th scope="col">Monto Entrada</th>
        <th scope="col">Monto Salida</th>

      </tr>
    </thead>
    <tbody>

      @if(isset($movRubroEntrada) && isset($movRubroSalida))
      @for ($i = 0; $i < count($movRubroEntrada); $i++)
      <!-- verifica el monto que la suma sea mayor a 0 -->
        @if(($movRubroEntrada[$i]['monto'] )+($movRubroSalida[$i]['monto']) >0  )
      <tr>
      <td scope="row">{{ $movRubroEntrada[$i]['rubro'] }}</td>
      <td scope="row">{{ $movRubroEntrada[$i]['monto'] }}</td>
      <td scope="row">{{ $movRubroSalida[$i]['monto'] }}</td>
      </tr>
        @endif

      @endfor
      @endif
  <!-- fin tr sumatorias -->
  <!-- fin tr todos los rubros -->
    </tbody>

  </table>
        @endif

        @if($tipoReporte == 4)
        <table id="example" class="table table-striped">


    <thead>
      <tr>
        <th scope="col">Tipo</th>
        <th scope="col">Rubro</th>
        <th scope="col">Monto </th>
        <th scope="col">Fecha Registro</th>

      </tr>
    </thead>
    <tbody>

      @if(isset($movEntrada))
        @foreach($movEntrada as $me)
      <tr>
      <td scope="row">Entrada</td>
      <td scope="row">{{ $me->rubro->nombre }}</td>
      <td scope="row">{{ $me->monto }}</td>
        <td scope="row">{{ $me->fechaRegistro }}</td>
      </tr>

      @endforeach
      @endif

      @if(isset($movSalida))
        @foreach($movSalida as $ms)
      <tr>
      <td scope="row">Salida</td>
      <td scope="row">{{ $ms->rubro->nombre }}</td>
      <td scope="row">{{ $ms->monto }}</td>
        <td scope="row">{{ $ms->fechaRegistro }}</td>
      </tr>

      @endforeach
      @endif
  <!-- fin tr sumatorias -->
  <!-- fin tr todos los rubros -->
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
        <h4 class="modal-title">Movimientos Bancarios</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Tipo</th>
      <th scope="col">Moneda</th>
      <th scope="col">Monto</th>
      <th scope="col">Rubro</th>
      <th scope="col">Usuario</th>
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
    $("#tipoReporte").change(function(){
      if ($("#tipoReporte").val()==1 ||$("#tipoReporte").val()==3) {
        $("#fInicio").show();
          $("#fFin").show();
      }else if($("#tipoReporte").val()!=1){
        $("#fInicio").hide();
          $("#fFin").hide();
      }
        if ($("#tipoReporte").val()==5) {
          $("#rubro1").show();
          $("#fInicio").show();
            $("#fFin").show();
        }else if ($("#tipoReporte").val()==6) {
          $("#rubro1").show();
        }else{
          $("#rubro1").hide();
        }
      console.log($("#tipoReporte").val());
    });



});





</script>
@endsection
