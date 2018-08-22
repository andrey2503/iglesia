@extends('administrador.escritorio')

@section('content')

<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Nueva Salida </h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <form  role="form"   method="post"  action="{{ url('nuevaSalidaSoda') }}" class="form-horizontal form_entrada" >
       {{ csrf_field() }}
        <div class="box-body">
            <div class="form-group">
                <label for="nombre">Nombre Grupo</label>
                <select name="grupo"class="form-control">
                @foreach($gruposSoda as $gs)
                  <option value="{{$gs->id}}">{{$gs->nombreGrupo}}</option>
                  @endforeach
                </select>
                @if($errors->has('grupo'))
                  <span style="color: red;">{{ $errors->first('grupo') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label for="email">Descripcion</label>
                <textarea type="text" class="form-control" name="descripcion" placeholder="Descripcion.." style="max-height: 300px;min-height: 200px;"></textarea>
                @if($errors->has('descripcion'))
                  <span style="color: red;">{{ $errors->first('descripcion') }}</span>
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
        <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Crear Entrada</button>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaEntradasSoda') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
      </form>
      </div><!-- /.box -->
</div>
@endsection
