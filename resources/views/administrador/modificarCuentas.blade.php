@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"> Modificar Cuenta Bancaria</h3>
      @if(session()->has('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
      @endif
    </div><!-- /.box-header -->
    <form  role="form"   method="post"  action="{{ url('modificarCuenta') }}" class="form-horizontal form_entrada" >
      <input type="hidden" name="id" value="{{ $cuentas->id }}">
      {{ csrf_field() }}
      <div class="box-body">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" name="nombre" value="{{ $cuentas->nombre }}">
          @if($errors->has('nombre'))
          <span style="color: red;">{{ $errors->first('nombre') }}</span>
          @endif
        </div>

        <div class="form-group">
          <label for="email">Banco</label>
          <input type="text" class="form-control" name="banco" value="{{ $cuentas->banco }}">
          @if($errors->has('banco'))
          <span style="color: red;">{{ $errors->first('banco') }}</span>
          @endif
        </div>

        <div class="form-group">
          <label for="user">Tipo de Cuenta</label>
          <select class="form-control" name="tipo">
            @if($cuentas->tipo =="Corriente" )
            <option value="Corriente" selected >Corriente</option>
            <option value="Ahorros">Ahorros</option>
            @endif
            @if($cuentas->tipo =="Ahorros" )
            <option value="Ahorros" selected>Ahorros</option>
            <option value="Corriente"  >Corriente</option>
            @endif
          </select>
          @if($errors->has('tipo'))
          <span style="color: red;">{{ $errors->first('tipo') }}</span>
          @endif
        </div>
        <div class="form-group">
          <label for="user">Moneda</label>
          <select class="form-control" name="moneda">
            @if($cuentas->moneda =="Colones" )
            <option value="Colones" selected>₡ Colones</option>
            <option value="Dolares">$ Dolares</option>
            <option value="Euros">€ Euros</option>
            @endif
            @if($cuentas->moneda =="Dolares" )
            <option value="Dolares" selected>$ Dolares</option>
            <option value="Colones" >₡ Colones</option>
            <option value="Euros">€ Euros</option>
            @endif
            @if($cuentas->moneda =="Euros" )
            <option value="Euros" selected>€ Euros</option>
            <option value="Dolares" >$ Dolares</option>
            <option value="Colones" >₡ Colones</option>
            @endif
          </select>
          @if($errors->has('moneda'))
          <span style="color: red;">{{ $errors->first('moneda') }}</span>
          @endif
        </div>
        <div class="form-group">
          <label for="user">Monto</label>
          <input type="number" step="any" class="form-control" name="monto"  value="{{ $cuentas->monto }}">
          @if($errors->has('cuenta'))
          <span style="color: red;">{{ $errors->first('cuenta') }}</span>
          @endif
        </div>


      </div>
      <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar Cuenta Bancaria</button>
    </form>
  </div><!-- /.box -->
</div>
@endsection
