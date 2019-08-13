@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"> Modificar Salario</h3>
      @if(session()->has('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
      @endif
    </div><!-- /.box-header -->
    <form  role="form"   method="post"  action="{{ url('modificarSalario') }}" class="form-horizontal form_entrada" >
      <input type="hidden" name="id" value="{{ $salarios->id }}">
      {{ csrf_field() }}
      <div class="box-body">
        <div class="form-group">
          <label for="email">Puesto</label>
          <select class="form-control" name="puesto">
            @if(isset($puestos))
              @foreach($puestos as $p)

            @if($salarios->fk_puesto == $p->id )
            <option value="{{ $p->id }}" selected>{{$p->nombre}}</option>
            @else
            <option value="{{ $p->id }}">{{$p->nombre}}</option>
            @endif
            @endforeach
          @endif
          </select>
          @if($errors->has('puesto'))
          <span style="color: red;">{{ $errors->first('puesto') }}</span>
          @endif
        </div>
        <div class="form-group">
          <label for="user">Moneda</label>
          <select class="form-control" name="moneda">
            @if($salarios->moneda =="Colones" )
            <option value="Colones" selected>₡ Colones</option>
            <option value="Dolares">$ Dolares</option>
            <option value="Euros">€ Euros</option>
            @endif
            @if($salarios->moneda =="Dolares" )
            <option value="Dolares" selected>$ Dolares</option>
            <option value="Colones" >₡ Colones</option>
            <option value="Euros">€ Euros</option>
            @endif
            @if($salarios->moneda =="Euros" )
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
          <label for="salarioNominal">Salario Nominal</label>
          <input  type="number" step="any" class="form-control" name="salarioNominal" value="{{ $salarios->salarioNominal }}">
          @if($errors->has('banco'))
          <span style="color: red;">{{ $errors->first('banco') }}</span>
          @endif
        </div>

        <div class="form-group">
          <label for="user">Obligaciones</label>
        <input  type="number" step="any" class="form-control" name="obligaciones" value="{{ $salarios->obligaciones }}">
          @if($errors->has('tipo'))
          <span style="color: red;">{{ $errors->first('tipo') }}</span>
          @endif
        </div>


      </div>
      <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar Cuenta Bancaria</button>
      <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaSalarios') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
    </form>
  </div><!-- /.box -->
</div>
@endsection
