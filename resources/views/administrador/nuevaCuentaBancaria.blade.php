@extends('administrador.escritorio')

@section('content')

<div class="container row col-md-12">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Nueva Cuenta Bancaria</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <form  role="form"   method="post"  action="{{ url('nuevaCuentaBancaria') }}" class="form-horizontal form_entrada" >
       {{ csrf_field() }}
        <div class="box-body">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                @if($errors->has('nombre'))
                  <span style="color: red;">{{ $errors->first('nombre') }}</span>
                @endif
              </div>

              <div class="form-group col-md-6">
                <label for="email">Banco</label>
                <input type="text" class="form-control" name="banco" placeholder="Banco">
                @if($errors->has('banco'))
                  <span style="color: red;">{{ $errors->first('banco') }}</span>
                @endif
              </div>
              <div class="form-group col-md-6">

                <label for="fechaRegistro">Fecha de Registro</label>

                <input type="date" class="form-control" name="fechaRegistro" >

                @if($errors->has('fechaRegistro'))

                  <span style="color: red;">{{ $errors->first('fechaRegistro') }}</span>

                @endif

              </div>


               <div class="form-group col-md-6">
                <label for="user">Tipo de Cuenta</label>
                <select class="form-control" name="tipo">
                  <option value="Corriente">Corriente</option>
                    <option value="Ahorros">Ahorros</option>
                </select>
                @if($errors->has('tipo'))
                  <span style="color: red;">{{ $errors->first('tipo') }}</span>
                @endif
              </div>
              <div class="form-group col-md-6">
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

              <div class="form-group col-md-6">
                <label for="telefono">Número de Cuenta</label>
                <input type="text" class="form-control" name="cuenta" placeholder="Número de Cuenta">
                @if($errors->has('cuenta'))
                  <span style="color: red;">{{ $errors->first('cuenta') }}</span>
                @endif
              </div>

        </div>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaCuentaBancaria') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
        <button style="margin-bottom: 15px;color:white;" type="submit" class="btn btn-default btn-info">Crear Cuenta</button>

      </form>
      </div><!-- /.box -->
</div>
@endsection
