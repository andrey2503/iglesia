@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Ver usuario</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <div class="box-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ $usuario->nombre }}" disabled="true">
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $usuario->email }}" disabled="true">

              </div>

               <div class="form-group">
                <label for="usuario">usuario</label>
                <input type="text" class="form-control" name="usuario" value="{{ $usuario->usuario }}" disabled="true">
              </div>

              <div class="form-group">
                <label for="usuario">Telefono</label>
                <input type="text" class="form-control" name="usuario" value="{{ $usuario->telefono }}" disabled="true">
              </div>


              <div class="form-group">
                <label for="contrasena">Tipo usuario</label>
                @if($usuario->idrol==3)
                <input type="text" class="form-control" value="Lector" disabled="true">
                @elseif($usuario->idrol==2)
                <input type="text" class="form-control"  value="Digitador" disabled="true">
                @elseif($usuario->idrol==1)
                <input type="text" class="form-control"  value="Admnistrador" disabled="true">
                @endif
              </div>

               <!-- <select name="estado"class="form-control">
               @if($usuario->state==1)
                  <option value="0">Inactivo</option>
                  <option value="1" selected>Activo</option>
                @elseif($usuario->state==0)
                  <option value="0" selected>Inactivo</option>
                  <option value="1" >Activo</option>
               @endif
              </select> -->
              <a   class="btn btn-success" href="{{ url('/administrador') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
        </div>
        <!-- <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar usuario</button> -->
      </div><!-- /.box -->
</div>
@endsection
