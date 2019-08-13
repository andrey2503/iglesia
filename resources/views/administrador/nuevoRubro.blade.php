@extends('administrador.escritorio')

@section('content')

<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Nuevo Rubro</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <form  role="form"   method="post"  action="{{ url('nuevoRubro') }}" class="form-horizontal form_entrada" >
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
                <label for="email">Descripcion</label>
                <textarea type="text" class="form-control" name="descripcion" placeholder="Descripcion.." style="max-height: 300px;min-height: 200px;"></textarea>
                @if($errors->has('descripcion'))
                  <span style="color: red;">{{ $errors->first('descripcion') }}</span>
                @endif
              </div>
        </div>
        <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Crear Rubro</button>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaRubros') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
      </form>
      </div><!-- /.box -->
</div>
@endsection
