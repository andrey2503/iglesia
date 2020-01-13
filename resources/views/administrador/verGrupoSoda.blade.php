@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Ver Grupo Soda</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <div class="box-body">
            <div class="form-group">
                <label for="nombreGrupo">Nombre Grupo</label>
                <input type="text" class="form-control" name="nombreGrupo" value="{{ $gruposSoda->nombreGrupo }}" disabled="true">
              </div>

              <div class="form-group">
                <label for="fechaInicio">Fecha Inicio</label>
                <input type="text" class="form-control" name="fechaInicio" value="{{ $gruposSoda->fechaInicio }}" disabled="true">

              </div>

               <div class="form-group">
                <label for="fechaFin">Fecha Fin</label>
                <input type="text" class="form-control" name="fechaFin" value="{{ $gruposSoda->fechaFin }}" disabled="true">
              </div>




              <a   class="btn btn-success" href="{{ url('/listaGruposSoda') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
        </div>
        <!-- <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar usuario</button> -->
      </div><!-- /.box -->
</div>
@endsection
