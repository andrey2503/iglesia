@extends('administrador.escritorio')

@section('content')

<div class="container row col-md-8 col-md-offset-2 ">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class="box-title"> Modificar empleado</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <form  role="form"   method="post"  action="{{ url('actualizarEmpleado') }}/{{$empleado->id}}" class="form-horizontal form_entrada" >
       {{ csrf_field() }}
        <div class="box-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{$empleado->nombre}}">
                @if($errors->has('nombre'))
                  <span style="color: red;">{{ $errors->first('nombre') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label for="cedula">cedula</label>
                <input type="number" class="form-control" name="cedula" value="{{$empleado->cedula}}">
                @if($errors->has('cedula'))
                  <span style="color: red;">{{ $errors->first('cedula') }}</span>
                @endif
              </div>

               <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="number" class="form-control" name="telefono" value="{{$empleado->telefono}}">
                @if($errors->has('telefono'))
                  <span style="color: red;">{{ $errors->first('telefono') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label for="monto">Monto</label>
                <input type="number" class="form-control" name="monto" value="{{$empleado->monto}}" disabled="true">
                @if($errors->has('monto'))
                  <span style="color: red;">{{ $errors->first('monto') }}</span>
                @endif
              </div>


              <div class="form-group">
              <label for="contrasena">Puesto</label>
              @if(isset($puestos))
                <select name="puesto"class="form-control">
                @foreach($puestos as $p)
                  @if($p->id == $empleado->fk_puesto)
                  <option value="{{$p->id}}" selected>{{$p->nombre}}</option>
                  @else
                  <option value="{{$p->id}}" >{{$p->nombre}}</option>
                  @endif
                @endforeach
                </select>
              @if($errors->has('puesto'))
                  <span style="color: red;">{{ $errors->first('puesto') }}</span>
              @endif
              @endif
              </div>

              <div class="form-group">
              <label for="estado">Estado</label>
                <select name="estado"class="form-control">
                @if($empleado->estado == 1)
                  <option value="0">Inactivo</option>
                  <option value="1" selected>Activo</option>
                @else
                  <option value="0" selected>Inactivo</option>
                  <option value="1">Activo</option>
                @endif
                </select>
              @if($errors->has('estado'))
                  <span style="color: red;">{{ $errors->first('estado') }}</span>
              @endif
            </div>

        </div>
        <button style="margin-bottom: 15px;" type="submit" class="btn btn-default btn-info">Actualizar empleado</button>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/empleados') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>

      </form>
      </div><!-- /.box -->
</div>
@endsection
