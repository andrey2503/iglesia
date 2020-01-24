@extends('administrador.escritorio')

@section('content')
<style>
  .form-group{
    margin: 6px 0px !important;
  }

  .chosen-default{
    height: 34px !important;
    padding: 4px 10px !important;
    background: white !important;
  }

  .form-control{
    border-radius: 4px;
  }

  .box.box-primary {
    border-top-color: #ffffff !important;;
  }

</style>
<script type="text/javascript">

$( document ).ready(function() {
$("#cuentaMoneda").change(()=>{
  let moneda=$("#cuentaMoneda").find(':selected').attr('moneda')
  $("#validarMoneda").attr("value",moneda);
});
$("#cuentaPagar").hide();
    $("#cuentaPagar1").change(function(){
      if ($("#cuentaPagar1").val() ==1) {
        $("#cuentaPagar").show();
        $("#cuentaCobrarD").hide();
        $("#cuentaPagarD").hide();
      }else{
        $("#cuentaPagar").hide();
        $("#cuentaCobrarD").show();
        $("#cuentaPagarD").show();
      }
    });

    $("#cuentaCobrarD-1").change(function(){
      if ($("#cuentaCobrarD-1").val() !=0) {
        $("#cuantaPagar-1").hide();
         $("#cuentaPagarD").hide();
         $("#cuentaCobrarD-1").show();
      }else{
        $("#cuantaPagar-1").show();
         $("#cuentaPagarD").show();
      }
    });

    $("#cuentaPagarD-1").change(function(){
      if ($("#cuentaPagarD-1").val() !=0) {
        $("#cuantaPagar-1").hide();
         $("#cuentaCobrarD").hide();
         $("#cuentaPagarD-1").show();
      }else{
        $("#cuantaPagar-1").show();
         $("#cuentaCobrarD").show();
      }
    });

});


</script>
<div class="container row col-md-12">
  <div class="col-md-12 box box-primary">
    <div class="box-header with-border">


                <div class="box-header with-border">
                                        @if(session()->has('error'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('error') }}
                                            </div>
                                        @endif
                        </div><!-- /.box-header -->
                <div class="box-heade with-border" id="box-informatico">

                </div><!-- /.box-header -->
                <div class="box-heade with-border"  id="box-errores">
                
                </div>

                  <h3 class=""> Nueva Entrada</h3>
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
      <form   id="formulario-datos"   role="form"   method="post"  action="{{ url('nuevaEntrada') }}" class="form-horizontal form_entrada" >
       {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group col-md-6">
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

              <div class="form-group col-md-6">
               <label for="nombre">Nombre</label>
               <input type="text" step="any" class="form-control" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}"/>
               @if($errors->has('nombre'))
                 <span style="color: red;">{{ $errors->first('nombre') }}</span>
               @endif
              </div>


         <div class="form-group col-md-6">
          <label for="user">Número Documento</label>
          <input type="text" step="any" class="form-control" name="documento" placeholder="Número documento" value="{{ old('documento') }}"/>
          @if($errors->has('documento'))
            <span style="color: red;">{{ $errors->first('documento') }}</span>
          @endif
         </div>
         <div class="form-group col-md-6">

           <label for="fechaRegistro">Fecha de Registro</label>

           <input type="date" class="form-control" name="fechaRegistro" value="{{ old('fechaRegistro') }}" />

           @if($errors->has('fechaRegistro'))

             <span style="color: red;">{{ $errors->first('fechaRegistro') }}</span>

           @endif

         </div>
         <div class="form-group col-md-6">
           <label for="email">Descripcion</label>
           <textarea type="text" class="form-control" name="descripcion" placeholder="Descripcion.." style="max-height: 300px;min-height: 200px;">{{ old('descripcion') }}</textarea>
           @if($errors->has('descripcion'))
             <span style="color: red;">{{ $errors->first('descripcion') }}</span>
           @endif
         </div>

              <div class="form-group col-md-6">
               <label for="user">Moneda</label>
               <select class="form-control" name="moneda" value="{{ old('moneda') }}">

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

              <div class="form-group col-md-6">
               <label for="user">Monto</label>
               <input type="number" step="any" class="form-control" name="monto" placeholder="Monto" value="{{ old('monto') }}"/>
               @if($errors->has('monto'))
                 <span style="color: red;">{{ $errors->first('monto') }}</span>
               @endif
              </div>

              <div class="form-group col-md-6">
               <label for="user">Confirmar Monto</label>
               <input type="number" step="any" class="form-control" name="confMonto" placeholder="Monto" value="{{ old('confMonto') }}"/>
               @if($errors->has('confMonto'))
                 <span style="color: red;">{{ $errors->first('confMonto') }}</span>
               @endif
              </div>
              <div class="form-group col-md-6" id="cuantaPagar-1">
               <label for="user">Generar cuenta por pagar</label>
               <select class="form-control" name="cuentaPagar1" id="cuentaPagar1">
                 <option value="0" selected> No</option>
                 <option value="1"> Si</option>
               </select>
               @if($errors->has('cuentaPagar1'))
                 <span style="color: red;">{{ $errors->first('cuentaPagar1') }}</span>
               @endif
             </div>

             <div class="form-group col-md-6" id="cuentaPagar">
              <label for="user">Nombre cuenta por Pagar</label>
              <input type="text" step="any" class="form-control" name="cuentaPagar"  placeholder="Nombre cuenta por Pagar" value="{{ old('cuentaPagar') }}">
              @if($errors->has('cuentaPagar'))
                <span style="color: red;">{{ $errors->first('cuentaPagar') }}</span>
              @endif
              @if($errors->has('cuentaBancaria'))
                <span style="color: red;">{{ $errors->first('cuentaBancaria') }}</span>
              @endif
             </div>
             <div class="form-group col-md-6" id="cuentaCobrarD">
              <label for="user">Cuenta por Cobrar a Disminuir</label>
              <select class="form-control" name="cuentaCobrarD"  id="cuentaCobrarD-1">
                  <option value="0">Seleccione Cuenta por Cobrar</option>
                @if(isset($cuentasCobrar))
                  @foreach($cuentasCobrar as $cpc)
                <option value="{{ $cpc->id }}">{{ $cpc->nombre }}  //  {{ $cpc->id }}PC //   @if($cpc->moneda =="Colones" )₡ @endif
                @if($cpc->moneda =="Dolares" ) $     @endif
                @if($cpc->moneda =="Euros" )€ @endif
                {{$cpc->monto}}</option>
                  @endforeach
                @endif
              </select>
              @if($errors->has('cuentaCobrarD'))
                <span style="color: red;">{{ $errors->first('cuentaCobrarD') }}</span>
              @endif
            </div>


             <div class="form-group col-md-6">
              <label for="user">Asignar Cuenta Bancaria</label>
              <select class="form-control" name="cuentaBancaria" id="cuentaMoneda">
                  <option value="0">Sin Cuenta Bancaria Asignada</option>
                @if(isset($cuentas))
                  @foreach($cuentas as $c)
                <option value="{{ $c->id }}" moneda="{{ $c->moneda }}">{{ $c->cuenta }}  //  {{ $c->moneda }} //  {{ $c->nombre }}</option>
                  @endforeach
                @endif
              </select>
              @if($errors->has('cuentaBancaria'))
                <span style="color: red;">{{ $errors->first('cuentaBancaria') }}</span>
              @endif
            </div>
              <input name="validarMoneda" type="hidden" id="validarMoneda" value="0"/>

          

        </div>
          <a  style="margin-bottom: 15px; color:#fff;" class="btn btn-success" href="{{ url('/listaEntradas') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
          <button  id="btn-accion-crear"  style="margin-bottom: 15px; color:#fff;" type="submit" class="btn btn-default btn-info">Crear Entrada</button>
      </form>
      </div><!-- /.box -->
</div>
@endsection

@section('scripts')

<script>

$(document).ready(function() {

          $("#btn-accion-crear").click((event)=>{

          creandoElementoLoading('Proceso','Creando nuevo usuario');
          $("#box-errores").empty();
          $("#box-informatico").empty();
          event.preventDefault();
          var form=$("#formulario-datos");
          var url = form.attr("action");
          enviarPeticion(url,form.serialize(),"Creando usuario");

          }) //btn

         
  })

</script>

@endsection
