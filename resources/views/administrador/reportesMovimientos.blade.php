@extends('administrador.escritorio')

@section('content')

<div class="container-fluid row contenedor-usuario col-md-12">
  <form class=""  action="{{ url('/reporteMovimientos') }}" method="post" id="formreportes">
    {{ csrf_field() }}

    <div style="padding: 15px;" class="col-md-2">
      <label for="user">Tipo de Reporte:</label>
      <select class="form-control" name="tipoReporte" id="tipoReporte">
          <!-- <option value="0">Selecione Tipo reporte</option>
          <option value="1">Movimiento Por fechas</option>
          <option value="2">Todos los Movimientos</option>
          <option value="3">Todos los Rubros Por fechas detallado</option>
          <option value="4">Todos los Rubros detallado</option>
          <option value="5">Reporte consolidado</option>
          <option value="6">Reporte consolidado por fechas</option> -->

          <option value="0">Selecione Tipo reporte</option>
          <option value="1">Reporte consolidado</option>
          <option value="2">Reporte consolidado por fechas</option>
          <option value="3">Reporte detallado</option>
          <option value="4">Reporte detallado por fecha</option>
      </select>
    </div>
    <div style="padding: 15px;" class="col-md-2" id="frubro" hidden>
      <label for="user">Rubro:</label>
      <select class="form-control" name="rubro" id="filtrorubro">
      <option value="0">Todos</option>
      @foreach($rubros as $r)
          <option value="{{$r->id}}">{{$r->nombre}}</option>
      @endforeach
      </select>
    </div>

    <div style="padding: 15px;" class="col-md-2" hidden id="fMoneda">
      <div class="form-group">
       <label for="user">Moneda</label>
      <select name="filtroMoneda" class="form-control">
        <option value="Colones">Colones</option>
        <option value="Dolares">Dolares</option>
        <option value="Euros">Euros</option>
      </select>
      </div>
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
        <input type="hidden" id="titulo" name="titulo">
        <button href="#" type="submit" class="btn btn-info" id="idconsultar">Consultar</button>
      </div>
    </div>

  </form>
</div>
<div class="container row col-md-12 contenedor-usuario">

@if(isset($titulo))
<h3>{{ $titulo }} en moneda {{ $moneda }} </h3>
@endif

@if(isset($fechaInicio) && isset($fechaFinal) )
<p>Desde : {{$fechaInicio}} hasta : {{ $fechaFinal }}</p>
@endif
          <!-- tabla principal de usuarios -->
          @if($tipoReporte>0)
          <form class="" action="{{ url('/reportegenerarMovimiento') }}" method="post" target="_blank">
            {{ csrf_field() }}
            <input type="hidden" name="tipoReporte" value="{{$tipoReporte}}">
            <input type="hidden" name="fechaInicio" value="{{$fechaInicio}}">
            <input type="hidden" name="fechaFinal" value="{{$fechaFinal}}">
            <input type="hidden" name="filtroMoneda" value="{{$moneda}}">
              <input type="hidden" name="titulo" value="{{$titulo}}">
            <button href="#" target="_blank" type="submit"  class="btn btn-warning">Generar</button>
          </form>
          @endif
          <div class="row tabla-usuarios">
            <div class="table-responsive">
              @if($tipoReporte == 0  || $tipoReporte == 4 || $tipoReporte == 3)
              <table id="example" class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Fecha Registro</th>
                      <th scope="col">Tipo</th>
                      <th scope="col">Moneda</th>
                      <th scope="col">Monto</th>
                      <th scope="col">Cuenta</th>
                      <th scope="col">Rubro</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">#Documento</th>
                    </tr>
                  </thead>
                  <tbody>

                  @if(isset($movEntrada))
                    @foreach($movEntrada as $me)

                  <tr>
                      <td>{{$me->fechaRegistro}}</td>
                    <td scope="row">Entrada</td>
                    <td>{{ $me->moneda }}</td>
                    @if($me->moneda == "Dolares")
                    <td class="text-right">$ {{ number_format($me->monto, 2, ' ', ',') }}</td>
                    @endif
                    @if($me->moneda == "Colones")
                    <td class="text-right">₡ {{ number_format($me->monto, 2, ' ', ',') }}</td>
                    @endif
                    @if($me->moneda == "Euros")
                    <td class="text-right">€ {{ number_format($me->monto, 2, ' ', ',') }}</td>
                    @endif

              <!-- verificar tipo moneda -->

                    <td>{{$me->cuenta->cuenta}}</td>
                      <td>{{$me->rubro->nombre}}</td>
                      <td>{{$me->entrada->descripcion}}</td>
                      <td>{{$me->entrada->documento}}</td>

                    </tr>
            @endforeach
          @endif
<!--  segunda tabla-->
          @if(isset($movSalida))
            @foreach($movSalida as $ms)

            <tr>
              <td>{{$ms->fechaRegistro}}</td>
              <td scope="row">Salida</td>
              <td>{{ $ms->moneda }}</td>
              @if($ms->moneda == "Dolares")
              <td class="text-right">$ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
              @endif
              @if($ms->moneda == "Colones")
              <td class="text-right">₡ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
              @endif
              @if($ms->moneda == "Euros")
              <td class="text-right">€ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
              @endif

              <!-- verificar tipo moneda -->

                <td>{{$ms->cuenta->cuenta}}</td>
                <td>{{$ms->rubro->nombre}}</td>
                <td>{{$ms->salida->descripcion}}</td>
                <td>{{$ms->salida->documento}}</td>

            </tr>
            @endforeach
          @endif

          </tbody>

        </table>
        <!-- Datos de los reportes generales -->

        <!-- Suma de todos los valores -->
          @endif



          @if($tipoReporte==1 || $tipoReporte==2)
              <table id="example" class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Rubro</th>
                    <th scope="col">Monto Entrada</th>
                    <th scope="col">Monto Salida</th>
                    <th scope="col">Moneda</th>

                  </tr>
                </thead>
              <tbody>

                @if(isset($movRubroEntrada) && isset($movRubroSalida))
                @for ($i = 0; $i < count($movRubroEntrada); $i++)
                <!-- verifica el monto que la suma sea mayor a 0 -->
                  @if(($movRubroEntrada[$i]['monto'] )+($movRubroSalida[$i]['monto']) >0  )
                <tr>
                <td scope="row">{{ $movRubroEntrada[$i]['rubro'] }}</td>
                <td scope="row" class="text-right">{{ $movRubroEntrada[$i]['monto'] }}</td>
                <td scope="row" class="text-right">{{ $movRubroSalida[$i]['monto'] }}</td>
                <td scope="row" >{{ $movRubroSalida[$i]['moneda'] }}</td>
                </tr>
                  @endif

                @endfor
                @endif
            <!-- fin tr todos los rubros -->
              </tbody>
            </table>
            <br/>
            <br/>
            <br/>

            <table class="table">
              <th></th>
              <th>Entrada </th>
              <!-- <th>Salida Dolares</th>
              <th>Salida Euros</th> -->
              <th>Salida </th>
              <!-- <th>Entrada Dolares</th>
              <th>Entrada Euros</th>    -->
              <tr>
                <td>Todo general</td>
                <!-- <td>{{ $sumaDolaresS }}</td>
                <td>{{ $sumaEurosS }}</td> -->
                <td>₡ {{ number_format($sumaColonesE, 2, ' ', ',') }}</td>
                <td>₡ {{ number_format($sumaColonesS, 2, ' ', ',') }}</td>

                <!-- <td>{{ $sumaDolaresE }}</td>
                <td>{{ $sumaEurosE }}</td> -->
              </tr>
              <tr>
                <td>Neto</td>
                <td style="color:green;font-weight: bold;"> @if( $sumaColonesS < $sumaColonesE)₡ {{ number_format($sumaColonesE-$sumaColonesS, 2, ' ', ',') }}@endif</td>
                <td style="color:red;font-weight: bold;"> @if( $sumaColonesS > $sumaColonesE)₡ {{ number_format($sumaColonesS-$sumaColonesE, 2, ' ', ',') }}@endif</td>

              </tr>
              </table>

            @endif


      <!-- Reporte numero 6 por cuentas -->

        </div>
    </div>
</div>

<!--
<div id="totalCuentas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
   <!-- <div class="modal-content">
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
            <th scope="col">Fecha Registros</th>
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
                <td>{{$cp->fechaRegistro}}</td>
            </tr>
            @endforeach
          @endif
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
-->


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
      var elt = document.getElementById("tipoReporte");
      $("#titulo").attr("value",elt.options[elt.selectedIndex].text);

      if($("#tipoReporte").val()>0){
        $("#fMoneda").show();
        $("#frubro").show();
      }else{
        $("#frubro").hide();
      }

      if ($("#tipoReporte").val()==2 ||$("#tipoReporte").val()==4) {
        $("#fInicio").show();
          $("#fFin").show();
      }else if($("#tipoReporte").val()==1 || $("#tipoReporte").val()==3){
        $("#fInicio").hide();
          $("#fFin").hide();
      }
        else{
          $("#rubro1").hide();
        }
      console.log($("#tipoReporte").val());
    });



});





</script>
@endsection
