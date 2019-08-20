@extends('administrador.escritorio')

@section('content')

<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Modificar Entrada</h3>
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
      <form  role="form"   method="POST" action="{{ url('modificarEntrada') }}"  class="form-horizontal form_entrada" >
       {{ csrf_field() }}
       <input type="hidden" value="{{$entradas->id}}" name="id">
        <div class="box-body">

         <div class="form-group">
           <label for="user">Rubro</label>
           <select class="form-control" name="rubro">
             @if(isset($rubros))
               @foreach($rubros as $r)
                @if($r->id ==  $entradas->fk_rubro)
                <option selected value="{{ $r->id }}">{{ $r->nombre }}</option>
                @else
                <option value="{{ $r->id }}">{{ $r->nombre }}</option>
                @endif

               @endforeach
             @endif
           </select>
           @if($errors->has('rubro'))
             <span style="color: red;">{{ $errors->first('rubro') }}</span>
           @endif
         </div>

         <div class="form-group">
           <label for="documento">Documento</label>
           <input type="text" class="form-control" name="documento" value="{{ $entradas->documento }}" >
         </div>

         <div class="form-group">
           <label for="email">Descripcion</label>
           <textarea type="text" class="form-control" name="descripcion" placeholder="Descripcion.." style="max-height: 300px;min-height: 200px;">{{$entradas->descripcion}}</textarea>

         </div>

         <div class="form-group">
           <label for="moneda">Moneda</label>
           <input type="text" class="form-control" name="moneda" value="{{ $entradas->moneda }}" >
         </div>

              <div class="form-group">
               <label for="user">Monto</label>
                <input type="hidden" step="any" class="form-control" name="montoRechazado"  value="{{$entradas->monto}}" >
               <input type="number" step="any" class="form-control" name="monto" placeholder="Monto" value="{{$entradas->monto}}">
              </div>
              <div class="form-group">
               <label for="user">Confirmar Monto</label>
               <input type="number" step="any" class="form-control" name="confMonto" placeholder="Monto" value="{{$entradas->monto}}"/>
               @if($errors->has('confMonto'))
                 <span style="color: red;">{{ $errors->first('confMonto') }}</span>
               @endif
              </div>
              <div class="form-group">

                    <label for="fechaRegistro">Fecha de Registro</label>

                    <input type="date" class="form-control" name="fechaRegistro" value="{{ $entradas->fechaRegistro }}">
{{ $entradas->fechaRegistro }}
                    @if($errors->has('fechaRegistro'))

                      <span style="color: red;">{{ $errors->first('fechaRegistro') }}</span>

                    @endif

                  </div>

                  <div class="form-group">
                   <label for="user">Asignar Cuenta Bancaria</label>
                   <select class="form-control" name="cuentaBancaria" id="cuentaMoneda">
                       <option value="0">Sin Cuenta Bancaria Asignada</option>
                     @if(isset($cuentas))
                       @foreach($cuentas as $c)
                       @if($movEntrada[2]->fk_cuenta == $c->id)
                         <option  selected value="{{ $c->id }}" moneda="{{ $c->moneda }}">{{ $c->cuenta }}  //  {{ $c->moneda }} //  {{ $c->nombre }}</option>
                       @endif
                     <option value="{{ $c->id }}" moneda="{{ $c->moneda }}">{{ $c->cuenta }}  //  {{ $c->moneda }} //  {{ $c->nombre }}</option>
                       @endforeach
                     @endif
                   </select>
                   @if($errors->has('cuentaBancaria'))
                     <span style="color: red;">{{ $errors->first('cuentaBancaria') }}</span>
                   @endif
                 </div>

                  <div class="form-group">
                    <label for="user">Estado</label>
                    <select class="form-control" name="estado">

                      @if($entradas->estado ==1 )
                         <option  value="0">Rechazado</option>
                         <option selected value="1">Aceptado</option>
                         @else
                         <option  selected value="0">Rechazado</option>
                         <option  value="1">Aceptado</option>
                      @endif
                    </select>
                    @if($errors->has('estado'))
                      <span style="color: red;">{{ $errors->first('estado') }}</span>
                    @endif
                  </div>
        </div>
        <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar Entrada</button>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaEntradas') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>

      </form>
      </div><!-- /.box -->
</div>
@endsection
