@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"> Modificar Cuenta por Pagar</h3>
      @if(session()->has('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
      @endif
    </div><!-- /.box-header -->
    <form  role="form"   method="post"  action="{{ url('modificarPP') }}" class="form-horizontal form_entrada" >
      <input type="hidden" name="id" value="{{ $cuentasPagar->id }}">
      {{ csrf_field() }}
      <div class="box-body">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" name="nombre" value="{{ $cuentasPagar->nombre }}">
          @if($errors->has('nombre'))
          <span style="color: red;">{{ $errors->first('nombre') }}</span>
          @endif
        </div>
        <div class="form-group">
          <label for="email">Rubro</label>
          <select class="form-control" name="rubro">
            @if(isset($rubros))
              @foreach($rubros as $r)

            @if($cuentasPagar->fk_rubro == $r->id )
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
            @if($cuentasPagar->moneda =="Colones" )
            <option value="Colones" selected>₡ Colones</option>
            <option value="Dolares">$ Dolares</option>
            <option value="Euros">€ Euros</option>
            @endif
            @if($cuentasPagar->moneda =="Dolares" )
            <option value="Dolares" selected>$ Dolares</option>
            <option value="Colones" >₡ Colones</option>
            <option value="Euros">€ Euros</option>
            @endif
            @if($cuentasPagar->moneda =="Euros" )
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
          <input type="number" step="any" class="form-control" name="monto"  value="{{ $cuentasPagar->monto }}">
          @if($errors->has('monto'))
          <span style="color: red;">{{ $errors->first('monto') }}</span>
          @endif
        </div>


      </div>
      <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar Cuenta por Pagar</button>
      <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaCuentaPP') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
    </form>
  </div><!-- /.box -->
</div>
@endsection
