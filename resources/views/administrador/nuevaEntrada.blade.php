@extends('administrador.escritorio')

@section('content')
<script type="text/javascript">

$( document ).ready(function() {

$("#cuentaPagar").hide();
    $("#cuentaPagar1").change(function(){
      if ($("#cuentaPagar1").val() ==1) {
        $("#cuentaPagar").show();
      }else{
        $("#cuentaPagar").hide();
      }
    });

});


</script>
<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Nueva Entrada</h3>
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
      <form  role="form"   method="post"  action="{{ url('nuevaEntrada') }}" class="form-horizontal form_entrada" >
       {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group">
           <label for="user">Rubro</label>
           <select class="form-control" name="rubro">
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
          <label for="user">Numero Documento</label>
          <input type="text" step="any" class="form-control" name="documento" placeholder="# documento">
          @if($errors->has('documento'))
            <span style="color: red;">{{ $errors->first('documento') }}</span>
          @endif
         </div>
         <div class="form-group">
           <label for="email">Descripcion</label>
           <textarea type="text" class="form-control" name="descripcion" placeholder="Descripcion.." style="max-height: 300px;min-height: 200px;"></textarea>
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
              </div>

              <div class="form-group">
               <label for="user">Monto</label>
               <input type="number" step="any" class="form-control" name="monto" placeholder="Monto">
               @if($errors->has('monto'))
                 <span style="color: red;">{{ $errors->first('monto') }}</span>
               @endif
              </div>

              <div class="form-group">
               <label for="user">Confirmar Monto</label>
               <input type="number" step="any" class="form-control" name="confMonto" placeholder="Monto">
               @if($errors->has('confMonto'))
                 <span style="color: red;">{{ $errors->first('confMonto') }}</span>
               @endif
              </div>
              <div class="form-group">
               <label for="user">Generar cuenta por pagar</label>
               <select class="form-control" name="cuentaPagar1" id="cuentaPagar1">
                 <option value="0" selected> No</option>
                 <option value="1"> Si</option>
               </select>
               @if($errors->has('cuentaPagar1'))
                 <span style="color: red;">{{ $errors->first('cuentaPagar1') }}</span>
               @endif
             </div>

             <div class="form-group" id="cuentaPagar">
              <label for="user">Nombre cuenta por Pagar</label>
              <input type="text" step="any" class="form-control" name="cuentaPagar"  placeholder="Nombre cuenta por Pagar">
              @if($errors->has('cuentaPagar'))
                <span style="color: red;">{{ $errors->first('cuentaPagar') }}</span>
              @endif
             </div>
             <div class="form-group">
              <label for="user">Cuenta por Cobrar a Disminuir</label>
              <select class="form-control" name="cuentaCobrarD">
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

            <div class="form-group">
             <label for="user">Seleccione Cuenta por Pagar a Disminuir</label>
             <select class="form-control" name="cuentaPagarD">
                 <option value="0">Seleccione Cuenta por Cobrar</option>
               @if(isset($cuentasPagar))
                 @foreach($cuentasPagar as $cpp)
                 <option value="{{ $cpp->id }}">{{ $cpp->nombre }}  //  {{ $cpp->id }}PC //   @if($cpp->moneda =="Colones" )₡ @endif
                 @if($cpp->moneda =="Dolares" ) $     @endif
                 @if($cpp->moneda =="Euros" )€ @endif
                 {{$cpp->monto}}</option>
                 @endforeach
               @endif
             </select>
             @if($errors->has('cuentaPagarD'))
               <span style="color: red;">{{ $errors->first('cuentaPagarD') }}</span>
             @endif
           </div>

           <div class="form-group">
            <label for="user">Cuenta por Pagar a Aumentar</label>
            <select class="form-control" name="cuentaPagarA">
                <option value="0">Selecione Cuenta por Cobrar</option>
                @if(isset($cuentasPagar))
                  @foreach($cuentasPagar as $cpp)
                <option value="{{ $cpp->id }}">{{ $cpp->nombre }}  //  {{ $cpp->id }}PC //   @if($cpp->moneda =="Colones" )₡ @endif
                @if($cpp->moneda =="Dolares" ) $     @endif
                @if($cpp->moneda =="Euros" )€ @endif
                {{$cpp->monto}}</option>
                @endforeach
              @endif
            </select>
            @if($errors->has('cuentaPagarA'))
              <span style="color: red;">{{ $errors->first('cuentaPagarA') }}</span>
            @endif
          </div>


             <div class="form-group">
              <label for="user">Asignar Cuenta Bancaria</label>
              <select class="form-control" name="cuentaBancaria">
                  <option value="0">Sin Cuenta Bancaria Asignada</option>
                @if(isset($cuentas))
                  @foreach($cuentas as $c)
                <option value="{{ $c->id }}">{{ $c->cuenta }}  //  {{ $c->moneda }} //  {{ $c->nombre }}</option>
                  @endforeach
                @endif
              </select>
              @if($errors->has('cuentaBancaria'))
                <span style="color: red;">{{ $errors->first('cuentaBancaria') }}</span>
              @endif
            </div>

        </div>
        <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Crear Entrada</button>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaEntradas') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
      </form>
      </div><!-- /.box -->
</div>
@endsection
