@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Ver Cuenta Bancarias</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <div class="box-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ $cuentas->nombre }}" disabled="true">
              </div>

              <div class="form-group">
                <label for="email">Banco</label>
                <input type="email" class="form-control" name="email" value="{{ $cuentas->banco }}" disabled="true">

              </div>

               <div class="form-group">
                <label for="usuario">Tipo de Cuenta</label>
                <input type="text" class="form-control" name="usuario" value="{{ $cuentas->tipo }}" disabled="true">
              </div>

              <div class="form-group">
                <label for="usuario">Moneda</label>
                <input type="text" class="form-control" name="usuario" value="{{ $cuentas->moneda }}" disabled="true">
              </div>
              <div class="form-group">
                <label for="usuario">Monto</label>
                <input type="number" step="any" class="form-control" name="usuario" value="{{ $cuentas->monto }}" disabled="true">
              </div>
              <div class="form-group">
                <label for="usuario">Número de CuentaNúmero de Cuenta</label>
                <input type="text" class="form-control" name="usuario" value="{{ $cuentas->cuenta }}" disabled="true">
              </div>
              <div class="form-group">

                    <label for="fechaRegistro">Fecha de Registro</label>

                    <input type="date" class="form-control" name="fechaRegistro" value="{{ $cuentas->fechaRegistro }}" disabled="true">

                  </div>

              <a   class="btn btn-success" href="{{ url('/listaCuentaBancaria') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
        </div>
        <!-- <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar usuario</button> -->
      </div><!-- /.box -->
</div>
@endsection
