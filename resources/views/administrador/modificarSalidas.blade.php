@extends('administrador.escritorio')

@section('content')

<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Modificar Salidas</h3>
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
      <form  role="form"   method="POST" action="{{ url('modificarSalida') }}"  class="form-horizontal form_entrada" >
       {{ csrf_field() }}
       <input type="hidden" value="{{$salida->id}}" name="id">
        <div class="box-body">

         <div class="form-group">
           <label for="user">Rubro</label>
           <select class="form-control" name="rubro">
             @if(isset($rubros))
               @foreach($rubros as $r)
                @if($r->id ==  $salida->fk_rubro)
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
           <input type="text" class="form-control" name="documento" value="{{ $salida->documento }}" >
         </div>

         <div class="form-group">
           <label for="email">Descripcion</label>
           <textarea type="text" class="form-control" name="descripcion" placeholder="Descripcion.." style="max-height: 300px;min-height: 200px;">{{$salida->descripcion}}</textarea>

         </div>

         <div class="form-group">
           <label for="moneda">Moneda</label>
           <input type="text" class="form-control" name="moneda" value="{{ $salida->moneda }}" >
         </div>

              <div class="form-group">
               <label for="user">Monto</label>
               <input type="hidden" step="any" class="form-control" name="montoRechazado"  value="{{$salida->monto}}" >
               <input type="number" step="any" class="form-control" name="monto" placeholder="Monto" value="{{$salida->monto}}" >
              </div>
              <div class="form-group">
               <label for="user">Confirmar Monto</label>
               <input type="number" step="any" class="form-control" name="confMonto" placeholder="Monto" value="{{ $salida->monto }}"/>
               @if($errors->has('confMonto'))
                 <span style="color: red;">{{ $errors->first('confMonto') }}</span>
               @endif
              </div>
              <div class="form-group">

                  <label for="fechaRegistro">Fecha de Registro</label>

                  <input type="date" class="form-control" name="fechaRegistro" value="{{ $salida->fechaRegistro }}">

                  @if($errors->has('fechaRegistro'))

                    <span style="color: red;">{{ $errors->first('fechaRegistro') }}</span>

                  @endif

                </div>

                <div class="form-group">
                  <label for="user">Estado</label>
                  <select class="form-control" name="estado">

                    @if($salida->estado == 1 )
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
        <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar Salida</button>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaSalidas') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>

      </form>
      </div><!-- /.box -->
</div>
@endsection
