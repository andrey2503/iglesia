@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Ver Cuenta por Pagar</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <div class="box-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ $cuentasPagar->nombre }}" disabled="true">
              </div>

              <div class="form-group">
                <label for="email">Identificacion</label>
                <input type="email" class="form-control" name="email" value="0{{ $cuentasPagar->id }}PP" disabled="true">

              </div>

               <div class="form-group">
                <label for="usuario">Rubro</label>
                <input type="text" class="form-control" name="usuario" value="{{ $cuentasPagar->rubro->nombre }}" disabled="true">
              </div>

              <div class="form-group">
                <label for="usuario">Moneda</label>
                <input type="text" class="form-control" name="usuario" value="{{ $cuentasPagar->moneda }}" disabled="true">
              </div>
              <div class="form-group">
                <label for="usuario">Monto</label>
                <input type="number" step="any" class="form-control" name="usuario" value="{{ $cuentasPagar->monto }}" disabled="true">
              </div>
              <div class="form-group">

                    <label for="fechaRegistro">Fecha de Registro</label>

                    <input type="date" class="form-control" name="fechaRegistro" value="{{ $cuentasPagar->fechaRegistro }}" disabled="true">

                  </div>

              <a   class="btn btn-success" href="{{ url('/listaCuentaPP') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
        </div>
        <!-- <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar usuario</button> -->
      </div><!-- /.box -->
</div>
@endsection
