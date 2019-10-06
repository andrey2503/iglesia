@extends('administrador.escritorio')

@section('content')
<div class="container row col-md-12 contenedor-usuario">
  <h3>Entradas </h3>
  @if(session()->has('message'))
      <br><div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
  @endif
    @if(Auth::user()->idrol==1 || Auth::user()->idrol==2)
  <a href="{{ URL::asset('/nuevaEntrada') }}" class="btn btn-success btn-md" style="margin-top: 24px;">
          <span class="glyphicon glyphicon-plus"></span>
          Agregar Entrada
  </a>
    @endif
  <a href="{{ URL::asset('/reportesEntradas') }}" class="btn btn-danger btn-md" style="margin-top: 24px;">
          <span class="glyphicon glyphicon-file"></span>
          Reportes
  </a>
          <!-- tabla principal de usuarios -->
          <div class="row tabla-usuarios">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <th>Rubro</th>
                  <th>Descripcion</th>
                  <th>Monto</th>
                  <th>Fecha</th>
                  <th hidden>Monto</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <!-- @define $i = 1 -->

                  @if(isset($entradas))
                    @foreach($entradas as $e)


                      <tr>
                        <td>{{ $e->rubro->nombre }}</td>
                        <!-- <td>{{ $e->user }}</td> -->
                        <td>{{ $e->descripcion }}</td>

                        @if($e->moneda == "Dolares")
                        <td class="text-left" style=" width: 22%;">$ {{ number_format($e->monto, 2, ' ', ',') }}</td>

                        @endif
                        @if($e->moneda == "Colones")
                        <td class="text-left" style=" width: 22%;">₡ {{ number_format($e->monto, 2, ' ', ',') }}</td>
                        @endif
                        @if($e->moneda == "Euros")
                        <td class="text-left" style=" width: 22%;">&#8364; {{ number_format($e->monto, 2, ' ', ',') }}</td>
                        @endif
                          <td style=" width: 10%;">{{\Carbon\Carbon::parse($e->created_at)->format('d-m-Y')}}</td>
                        <td class="text-left" hidden>{{ $e->monto }}</td>

                        <td class="col-md-4">
                          @if(Auth::user()->idrol==1 || Auth::user()->idrol==2)
                         <a class="btn btn-primary btn-md" href="{{ url('/modificarEntrada') }}/{{$e->id}}"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar</a>
                         @endif
                         <a class="btn btn-success btn-md" href="{{ url('/verEntradas') }}/{{$e->id}}"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a>
                         @if(Auth::user()->idrol==1)
                         <a  type="button" class="btn btn-danger btn-md" href="#"  data-toggle="modal" data-target="#myModal" onclick="preEliminar({{$e->id}})"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
                         @endif
                        </td>
                      </tr>

                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
</div>



<div class="modal fade" tabindex="-1" role="dialog"  id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmacion</h4>
      </div>
      <div class="modal-body">
        <h4>Desea eliminar este elemento?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
        <form  action="{{ url('eliminarEntrada') }}" method="post" id="eliminar">
        {{ csrf_field() }}
        <input id="rutaEliminar" type="hidden"  name="id">
        <button type="submit" href="#" class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>   Eliminar</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
  function preEliminar(id){
    // alert(id);
    let ruta= document.getElementById('rutaEliminar');
    ruta.value=id;
    console.log(ruta.value);
  }
</script>
@endsection
