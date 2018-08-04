@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Ver Salarios</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <div class="box-body">
            <div class="form-group">
                <label for="nombre">Puesto</label>
                <input type="text" class="form-control" name="puesto" value="{{ $salario->puesto->nombre }}" disabled="true">
              </div>

              <div class="form-group">
                <label for="email">Moneda</label>
                <input type="email" class="form-control" name="moneda" value="{{ $salario->moneda }}" disabled="true">

              </div>

               <div class="form-group">
                <label for="usuario">Salario Nominal</label>
                <input type="text" class="form-control" name="usuario" value="{{ $salario->salarioNominal }}" disabled="true">
              </div>

              <div class="form-group">
                <label for="usuario">Obligaciones</label>
                <input type="text" class="form-control" name="usuario" value="{{ $salario->obligaciones }}" disabled="true">
              </div>
              <div class="form-group">
                <label for="usuario">Salario Neto</label>
                <input type="number" step="any" class="form-control" name="usuario" value="{{ $salario->salarioNeto }}" disabled="true">
              </div>



              <a   class="btn btn-success" href="{{ url('/listaSalarios') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
        </div>
        <!-- <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar usuario</button> -->
      </div><!-- /.box -->
</div>
@endsection
