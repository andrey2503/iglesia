@extends('administrador.escritorio')

@section('content')

<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Nuevo Grupo de Administracion de la Soda</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <form  role="form"   method="post"  action="{{ url('nuevoGruposSoda') }}" class="form-horizontal form_entrada" >
       {{ csrf_field() }}
        <div class="box-body">
            <div class="form-group">
                <label for="nombre">Nombre Grupo</label>
                <input type="text" class="form-control" name="nombreGrupo" placeholder="Nombre Grupo">
                @if($errors->has('nombreGrupo'))
                  <span style="color: red;">{{ $errors->first('nombreGrupo') }}</span>
                @endif
              </div>


              <div class="form-group">
                <label for="fecha">Fecha Inicio</label>
                <input type="date" class="form-control"  name="fechaInicio" placeholder="YYYY-MM-DD" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter a date in this formart YYYY-MM-DD"/>
                <!-- <input type="date" class="form-control" name="fecha" format="yyyy-mm-dd" value="2017-06-01" placeholder="fecha"> -->
                @if($errors->has('fechaInicio'))
                  <span style="color: red;">{{ $errors->first('fechaInicio') }}</span>
                @endif
              </div>
              <div class="form-group">
                <label for="fecha">Fecha Final</label>
                <input type="date" class="form-control"  name="fechaFin" placeholder="YYYY-MM-DD" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter a date in this formart YYYY-MM-DD"/>
                <!-- <input type="date" class="form-control" name="fecha" format="yyyy-mm-dd" value="2017-06-01" placeholder="fecha"> -->
                @if($errors->has('fechaFin'))
                  <span style="color: red;">{{ $errors->first('fechaFin') }}</span>
                @endif
              </div>



        </div>
        <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Crear Grupo</button>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaGruposSoda') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
      </form>
      </div><!-- /.box -->
</div>
@endsection
