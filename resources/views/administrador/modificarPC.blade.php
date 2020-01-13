@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"> Modificar Cuenta por Cobrar</h3>
      @if(session()->has('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
      @endif
    </div><!-- /.box-header -->
    <form  role="form"   method="post"  action="{{ url('modificarPC') }}" class="form-horizontal form_entrada" >
      <input type="hidden" name="id" value="{{ $cuentasCobrar->id }}">
      {{ csrf_field() }}
      <div class="box-body">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" name="nombre" value="{{ $cuentasCobrar->nombre }}">
          @if($errors->has('nombre'))
          <span style="color: red;">{{ $errors->first('nombre') }}</span>
          @endif
        </div>
        <div class="form-group">
          <label for="email">Rubro</label>
          <select class="form-control" name="rubro">
            @if(isset($rubros))
              @foreach($rubros as $r)

            @if($cuentasCobrar->fk_rubro == $r->id )
            <option value="{{ $r->id }}" selected>{{$r->nombre}}</option>
            @else
            <option value="{{ $r->id }}">{{$r->nombre}}</option>
            @endif
            @endforeach
          @endif
          </select>
          @if($errors->has('rubro'))
          <span style="color: red;">{{ $errors->first('rubro') }}</span>
          @endif
        </div>
        <div class="form-group">
          <label for="user">Moneda</label>
          <select class="form-control" name="moneda">
            @if($cuentasCobrar->moneda =="Colones" )
            <option value="Colones" selected>₡ Colones</option>
            <option value="Dolares">$ Dolares</option>
            <option value="Euros">€ Euros</option>
            @endif
            @if($cuentasCobrar->moneda =="Dolares" )
            <option value="Dolares" selected>$ Dolares</option>
            <option value="Colones" >₡ Colones</option>
            <option value="Euros">€ Euros</option>
            @endif
            @if($cuentasCobrar->moneda =="Euros" )
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
          <input type="number" step="any" class="form-control" name="monto"  value="{{ $cuentasCobrar->monto }}">
          @if($errors->has('monto'))
          <span style="color: red;">{{ $errors->first('monto') }}</span>
          @endif
        </div>
        <div class="form-group">

              <label for="fechaRegistro">Fecha de Registro</label>

              <input type="date" class="form-control" name="fechaRegistro" value="{{ $cuentasCobrar->fechaRegistro }}">

              @if($errors->has('fechaRegistro'))

                <span style="color: red;">{{ $errors->first('fechaRegistro') }}</span>

              @endif

            </div>

      </div>
      <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar Cuenta por Cobrar</button>
      <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaCuentaPC') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
    </form>
  </div><!-- /.box -->
</div>
@endsection
