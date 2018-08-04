@extends('administrador.escritorio')

@section('content')

<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Nuevo Salario</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <form  role="form"   method="post"  action="{{ url('nuevoSalario') }}" class="form-horizontal form_entrada" >
       {{ csrf_field() }}
        <div class="box-body">
            <div class="form-group">
                <label for="nombre">Puesto</label>
                <select class="form-control" name="puesto">
                  @if(isset($puestos))
                    @foreach($puestos as $p)
                  <option value="{{ $p->id }}">{{ $p->nombre }}</option>

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
                 <option value="Colones">₡ Colones</option>
                   <option value="Dolares">$ Dolares</option>
                    <option value="Euros">€ Euros</option>
               </select>
               @if($errors->has('moneda'))
                 <span style="color: red;">{{ $errors->first('moneda') }}</span>
               @endif
              </div>
              <div class="form-group">
                <label for="email">Salario Nominal</label>
                <input type="number" step="any" class="form-control" name="salarioNominal" placeholder="Salario Nominal">
                @if($errors->has('salarioNominal'))
                  <span style="color: red;">{{ $errors->first('salarioNominal') }}</span>
                @endif
              </div>
              <div class="form-group">
               <label for="user">Obligaciones</label>
               <input type="number" step="any" class="form-control" name="obligaciones" placeholder="Obligaciones">
               @if($errors->has('obligaciones'))
                 <span style="color: red;">{{ $errors->first('obligaciones') }}</span>
               @endif
              </div>


        </div>
        <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Crear Salario</button>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaSalarios') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
      </form>
      </div><!-- /.box -->
</div>
@endsection
