@extends('administrador.escritorio')

@section('content')
<style>
  .form-group{
    margin: 6px 0px !important;
  }

  .chosen-default{
    height: 34px !important;
    padding: 4px 10px !important;
    background: white !important;
  }

  .form-control{
    border-radius: 4px;
  }

  .box.box-primary {
    border-top-color: #ffffff !important;;
  }

</style>
<div class="container row col-md-12">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class=""> Nuevo usuario</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <form  role="form"   method="post"  action="{{ url('nuevoUsuario') }}" class="form-horizontal form_entrada" >
       {{ csrf_field() }}
        <div class="box-body">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                @if($errors->has('nombre'))
                  <span style="color: red;">{{ $errors->first('nombre') }}</span>
                @endif
              </div>

              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email">
                @if($errors->has('email'))
                  <span style="color: red;">{{ $errors->first('email') }}</span>
                @endif
              </div>

               <div class="form-group col-md-6">
                <label for="user">usuario</label>
                <input type="text" class="form-control" name="usuario" placeholder="usuario">
                @if($errors->has('usuario'))
                  <span style="color: red;">{{ $errors->first('usuario') }}</span>
                @endif
              </div>


              <div class="form-group col-md-6">
                <label for="telefono">Telefono</label>
                <input type="text" class="form-control" name="telefono" placeholder="Telefono">
                @if($errors->has('telefono'))
                  <span style="color: red;">{{ $errors->first('telefono') }}</span>
                @endif
              </div>

              <div class="form-group col-md-6">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control" name="contrasena" placeholder="Password">
                @if($errors->has('contrasena'))
                  <span style="color: red;">{{ $errors->first('contrasena') }}</span>
                @endif
              </div>

              <div class="form-group col-md-6">
              <label for="Rol">Rol</label>
              <select name="idrol"class="form-control">
                  <option value="3">Lector</option>
                  <option value="2">Digitador</option>
                  <option value="1">Administrador</option>
              </select>
              @if($errors->has('idrol'))
                  <span style="color: red;">{{ $errors->first('idrol') }}</span>
                @endif
  </div>
              <div class="form-group col-md-6">
              <label for="Rol">Estado</label>

                <select name="estado"class="form-control">
                  <option value="0">Inactivo</option>
                  <option value="1">Activo</option>
              </select>
               @if($errors->has('estado'))
                  <span style="color: red;">{{ $errors->first('estado') }}</span>
                @endif
  </div>

        </div>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/administrador') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
        <button style="margin-bottom: 15px;color:white;" type="submit" class="btn btn-default btn-info end">Crear usuario</button>

      </form>
      </div><!-- /.box -->
</div>
@endsection
