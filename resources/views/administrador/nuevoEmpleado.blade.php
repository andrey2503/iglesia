@extends('administrador.escritorio')

@section('content')

<div class="container row col-md-12">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">
                  <h3 class=""> Nuevo empleado </h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <form  role="form"   method="post"  action="{{ url('nuevoEmpleado') }}" class="form-horizontal form_entrada" >
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
                <label for="cedula">cedula</label>
                <input type="number" class="form-control" name="cedula" placeholder="cedula">
                @if($errors->has('cedula'))
                  <span style="color: red;">{{ $errors->first('cedula') }}</span>
                @endif
              </div>

               <div class="form-group col-md-6">
                <label for="telefono">Telefono</label>
                <input type="number" class="form-control" name="telefono" placeholder="telefono">
                @if($errors->has('telefono'))
                  <span style="color: red;">{{ $errors->first('telefono') }}</span>
                @endif
              </div>


              <div class="form-group col-md-6">
                <label for="fecha">Fecha ingreso</label>
                <input type="date" class="form-control"  name="fecha" placeholder="YYYY-MM-DD" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter a date in this formart YYYY-MM-DD"/>
                <!-- <input type="date" class="form-control" name="fecha" format="yyyy-mm-dd" value="2017-06-01" placeholder="fecha"> -->
                @if($errors->has('fecha'))
                  <span style="color: red;">{{ $errors->first('fecha') }}</span>
                @endif
              </div>

              <div class="form-group col-md-6">
              <label for="contrasena">Puesto</label>
              @if(isset($puestos))
                <select name="puesto"class="form-control">
                @foreach($puestos as $p)
                  <option value="{{$p->id}}">{{$p->nombre}}</option>
                  @endforeach
                </select>
              @if($errors->has('puesto'))
                  <span style="color: red;">{{ $errors->first('puesto') }}</span>
              @endif
              @endif
              </div>

              <div class="form-group col-md-6">
              <label for="estado">Estado</label>
                <select name="estado"class="form-control">
                  <option value="0">Inactivo</option>
                  <option value="1">Activo</option>
                </select>
              @if($errors->has('estado'))
                  <span style="color: red;">{{ $errors->first('estado') }}</span>
              @endif
            </div>

        </div>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/empleados') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
        <button style="margin-bottom: 15px;color:white;" type="submit" class="btn btn-default btn-info">Crear empleado</button>

      </form>
      </div><!-- /.box -->
</div>
@endsection
