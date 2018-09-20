@extends('administrador.escritorio')

@section('content')
<script type="text/javascript">

$( document ).ready(function() {

$("#cuentaPagar").hide();
    $("#cuentaCobrar").change(function(){
      if ($("#cuentaCobrar").val() ==1) {
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
               <label for="user">Generar cuenta por cobrar</label>
               <select class="form-control" name="cuentaCobrar" id="cuentaCobrar">
                 <option value="0" selected> No</option>
                 <option value="1"> Si</option>
               </select>
               @if($errors->has('cuentaCobrar'))
                 <span style="color: red;">{{ $errors->first('cuentaCobrar') }}</span>
               @endif
             </div>

             <div class="form-group" id="cuentaPagar">
              <label for="user">Nombre cuenta por Cobrar</label>
              <input type="text" step="any" class="form-control" name="cuentaPagar"  placeholder="Nombre cuenta por Cobrar">
              @if($errors->has('cuentaPagar'))
                <span style="color: red;">{{ $errors->first('cuentaPagar') }}</span>
              @endif
             </div>

             <div class="form-group">
              <label for="user">Asignar Cuenta Bancaria</label>
              <select class="form-control" name="cuentaBancaria">
                  <option value="0">Sin Cuenta Bancaria Asignada</option>
                @if(isset($cuentas))
                  @foreach($cuentas as $c)
                <option value="{{ $c->id }}">{{ $c->cuenta }}  //  {{ $c->moneda }}</option>
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
