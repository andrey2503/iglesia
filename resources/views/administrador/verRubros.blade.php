@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Ver Rubros</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <div class="box-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ $rubro->nombre }}" disabled="true">
              </div>

              <div class="form-group">
                <label for="email">Descripcion</label>
                <textarea type="text" class="form-control" name="descripcion" value="{{ $rubro->descripcion }}" disabled="true" style="max-height: 300px;min-height: 200px;">
                  {{ $rubro->descripcion }}
                </textarea>

              </div>

              <a   class="btn btn-success" href="{{ url('/listaRubros') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
        </div>
        <!-- <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar usuario</button> -->
      </div><!-- /.box -->
</div>
@endsection
