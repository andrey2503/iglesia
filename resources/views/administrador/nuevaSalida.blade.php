@extends('administrador.escritorio')

@section('content')
<script type="text/javascript">

$( document ).ready(function() {

$("#cuentaMoneda").change(()=>{
  let moneda=$("#cuentaMoneda").find(':selected').attr('moneda')
  $("#validarMoneda").attr("value",moneda);
  // alert(moneda);
});

$("#cuentaPagar").hide();
    $("#cuentaPagar1").change(function(){
      if ($("#cuentaPagar1").val() ==1) {
        $("#cuentaPagar").show();
        $("#cuentaPagarD").hide();
      }else{
        $("#cuentaPagar").hide();
        $("#cuentaPagarD").show();
      }
    });
    $("#cuentaPagarD-1").change(function(){
      if ($("#cuentaPagarD-1").val() !=0) {
        $("#cuentaPagarN").hide();
      }else{
        $("#cuentaPagar").hide();
        $("#cuentaPagarN").show();
      }
    });

});


</script>
<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Nueva Salida</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
                  @if(session()->has('error'))
                      <div class="alert alert-danger">
                          {{ session()->get('error') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <form  role="form"   method="post"  action="{{ url('nuevaSalida') }}" class="form-horizontal form_entrada" >
       {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group">
           <label for="user">Rubro</label>
           <select class="form-control" name="rubro" id="rubro">
              <option value="" selected>Seleccione un rubro</option>
             @if(isset($rubros))
               @foreach($rubros as $r)
             <option value="{{ $r->id }}">{{ $r->nombre }}</option>

               @endforeach
             @endif
           </select>
           @if($errors->has('rubro'))
             <span style="color: red;">{{ $errors->first('rubro') }}</span>
           @endif
         </div>

          <div class="form-group">
               <label for="nombre">Nombre</label>
               <input type="text" step="any" class="form-control" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}"/>
               @if($errors->has('nombre'))
                 <span style="color: red;">{{ $errors->first('nombre') }}</span>
               @endif
          </div>

         <div class="form-group">
          <label for="user">Numero Documento</label>
          <input type="text" step="any" class="form-control" name="documento" placeholder="# documento" value="{{ old('documento') }}"/>
          @if($errors->has('documento'))
            <span style="color: red;">{{ $errors->first('documento') }}</span>
          @endif
         </div>
         <div class="form-group">

           <label for="fechaRegistro">Fecha de Registro</label>

           <input type="date" class="form-control" name="fechaRegistro" value="{{ old('fechaRegistro') }}" />

           @if($errors->has('fechaRegistro'))

             <span style="color: red;">{{ $errors->first('fechaRegistro') }}</span>

           @endif

         </div>
         <div class="form-group">
           <label for="email">Descripcion</label>
           <textarea type="text" class="form-control" name="descripcion" placeholder="Descripcion.." style="max-height: 300px;min-height: 200px;">{{ old('descripcion') }}</textarea>
           @if($errors->has('descripcion'))
             <span style="color: red;">{{ $errors->first('descripcion') }}</span>
           @endif
         </div>

              <div class="form-group">
               <label for="user">Moneda</label>
               <select class="form-control" name="moneda">
                 <option value="Colones">₡ Colones</option>
                   <option value="Dolares">$ Dolares</option>
                    <option value="Euros">€ Euros</option>
               </select>
               @if($errors->has('moneda'))
                 <span style="color: red;">{{ $errors->first('moneda') }}</span>
               @endif
               @if($errors->has('validarMoneda'))
                <span style="color: red;">La moneda debe coincidir con el tipo de cuenta bancaria</span>
              @endif
              </div>

              <div class="form-group">
               <label for="user">Monto</label>
               <input type="number" step="any" class="form-control" name="monto" placeholder="Monto" value="{{ old('monto') }}">
               @if($errors->has('monto'))
                 <span style="color: red;">{{ $errors->first('monto') }}</span>
               @endif
              </div>

              <div class="form-group">
               <label for="user">Confirmar Monto</label>
               <input type="number" step="any" class="form-control" name="confMonto" placeholder="Monto" value="{{ old('confMonto') }}" />
               @if($errors->has('confMonto'))
                 <span style="color: red;">{{ $errors->first('confMonto') }}</span>
               @endif
              </div>

              <div class="form-group" id="cuentaPagarN">
               <label for="user">Generar cuenta por cobrar</label>
               <select class="form-control" name="cuentaCobrar" id="cuentaPagar1">
                 <option value="0" selected> No</option>
                 <option value="1"> Si</option>
               </select>
               @if($errors->has('cuentaCobrar'))
                 <span style="color: red;">{{ $errors->first('cuentaCobrar') }}</span>
               @endif
             </div>

             <div class="form-group" id="cuentaPagar">
              <label for="user">Nombre cuenta por Cobrar</label>
              <input type="text" step="any" class="form-control" name="cuentaCobrarName" placeholder="Nombre cuenta por Cobrar" value="{{ old('cuentaCobrarName') }}" />
              @if($errors->has('cuentaPagar'))
                <span style="color: red;">{{ $errors->first('cuentaPagar') }}</span>
              @endif
             </div>

             <div class="form-group" id="cuentaPagarD">
              <label for="user">Aplicar a cuenta por pagar</label>
              <select class="form-control" name="cuentaPagarDis" id="cuentaPagarD-1">
                  <option value="0">No</option>

                @if(isset($cuentasPagar))
                  @foreach($cuentasPagar as $cp)
                <option value="{{ $cp->id }}">{{ $cp->nombre }} // {{ $cp->monto }}  </option>
                  @endforeach
                @endif
              </select>
              @if($errors->has('cuentaPagar'))
                <span style="color: red;">{{ $errors->first('cuentaPagar') }}</span>
              @endif
            </div>


             <div class="form-group" >
              <label for="user">Asignar Cuenta Bancaria</label>
              <select class="form-control" name="cuentaBancaria" id="cuentaMoneda">
                  <option value="">Sin Cuenta Bancaria Asignada</option>
                @if(isset($cuentas))
                  @foreach($cuentas as $c)
                <option value="{{ $c->id }}" moneda="{{ $c->moneda }}">{{ $c->cuenta }}  // {{ $c->nombre }} // {{ $c->moneda }}</option>
                  @endforeach
                @endif
              </select>
              @if($errors->has('cuentaBancaria'))
                <span style="color: red;">{{ $errors->first('cuentaBancaria') }}</span>
              @endif
            </div>
            <input name="validarMoneda" type="hidden" id="validarMoneda" value="0"/>

        </div>
        <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Crear Salida</button>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaSalidas') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
      </form>
      </div><!-- /.box -->
</div>
@endsection
