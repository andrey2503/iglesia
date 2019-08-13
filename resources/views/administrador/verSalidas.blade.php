@extends('administrador.escritorio')

@section('content')

<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Ver Salida</h3>
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
      <form  role="form"   method="*"  class="form-horizontal form_entrada" >
       {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group">
           <label for="usuario">Rubro</label>
           <input type="text" class="form-control" name="usuario" value="{{ $salida->rubro->nombre }}" disabled="true">
         </div>
         <div class="form-group">
           <label for="email">Descripcion</label>
           <textarea type="text" class="form-control" name="descripcion" placeholder="Descripcion.." style="max-height: 300px;min-height: 200px;">{{$salida->descripcion}}</textarea>
         </div>

          <div class="form-group">
           <label for="documento">Documento</label>
           <input type="text" class="form-control" name="documento" value="{{ $salida->documento }}" disabled="true">
         </div>

         <div class="form-group">
           <label for="usuario">Moneda</label>
           <input type="text" class="form-control" name="usuario" value="{{ $salida->moneda }}" disabled="true">
         </div>

              <div class="form-group">
               <label for="user">Monto</label>
               <input type="number" step="any" class="form-control" name="monto" placeholder="Monto" value="{{$salida->monto}}" disabled="true">
              </div>
              <div class="form-group">

                    <label for="fechaRegistro">Fecha de Registro</label>

                    <input type="date" class="form-control" name="fechaRegistro" value="{{ $salida->fechaRegistro }}" disabled="true">

                  </div>

        </div>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaSalidas') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
      </form>
      </div><!-- /.box -->
</div>
@endsection
