@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"> Modificar Rubro</h3>
      @if(session()->has('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
      @endif
    </div><!-- /.box-header -->
    <form  role="form"   method="post"  action="{{ url('modificarRubro') }}" class="form-horizontal form_entrada" >
      <input type="hidden" name="id" value="{{ $rubro->id }}">
      {{ csrf_field() }}
      <div class="box-body">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" name="nombre" value="{{ $rubro->nombre }}">
          @if($errors->has('nombre'))
          <span style="color: red;">{{ $errors->first('nombre') }}</span>
          @endif
        </div>

        <div class="form-group">
          <label for="email">Descripcion</label>
          <textarea type="text" class="form-control" name="descripcion" value="{{ $rubro->descripcion }}" style="max-height: 300px;min-height: 200px;">
            {{ $rubro->descripcion }}
          </textarea>
          @if($errors->has('descripcion'))
          <span style="color: red;">{{ $errors->first('descripcion') }}</span>
          @endif
        </div>

      </div>
      <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar Rubro</button>
    </form>
  </div><!-- /.box -->
</div>
@endsection
