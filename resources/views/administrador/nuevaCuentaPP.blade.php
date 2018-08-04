@extends('administrador.escritorio')

@section('content')

<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Nueva Cuenta por Pagar</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <form  role="form"   method="post"  action="{{ url('nuevaCuentaPP') }}" class="form-horizontal form_entrada" >
       {{ csrf_field() }}
        <div class="box-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                @if($errors->has('nombre'))
                  <span style="color: red;">{{ $errors->first('nombre') }}</span>
                @endif
              </div>



               <div class="form-group">
                <label for="user">Rubro</label>
                <select class="form-control" name="rubro">
                  @if(isset($rubros))
                    @foreach($rubros as $r)
                  <option value="{{ $r->id }}">{{ $r->nombre }}</option>

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
                 <option value="Colones">₡ Colones</option>
                   <option value="Dolares">$ Dolares</option>
                    <option value="Euros">€ Euros</option>
               </select>
               @if($errors->has('moneda'))
                 <span style="color: red;">{{ $errors->first('moneda') }}</span>
               @endif
              </div>
              <div class="form-group">
               <label for="user">Monto</label>
               <input type="number" step="any" class="form-control" name="monto" placeholder="Monto">
               @if($errors->has('monto'))
                 <span style="color: red;">{{ $errors->first('monto') }}</span>
               @endif
              </div>

        </div>
        <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Crear Cuenta por Pagar</button>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaCuentaPP') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
      </form>
      </div><!-- /.box -->
</div>
@endsection
