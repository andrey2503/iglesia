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

            <div class="box-heade with-border">
                            @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
            </div><!-- /.box-header -->
            <div class="box-heade with-border" id="box-informatico">

            </div><!-- /.box-header -->
            <div class="box-heade with-border"  id="box-errores">

            </div>

                  <h3 class=""> Nuevo usuario</h3>

      </div><!-- /.box-header -->
      <form  id="formulario-datos" role="form"   method="post"  action="{{ url('nuevoUsuario') }}" class="form-horizontal form_entrada" >
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
        <button id="btn-accion-crear" style="margin-bottom: 15px;color:white;" type="submit" class="btn btn-default btn-info end">Crear usuario</button>

      </form>
      </div><!-- /.box -->
</div>
@endsection


@section('scripts')

<script>

$(document).ready(function() {

          $("#btn-accion-crear").click((event)=>{

          creandoElementoLoading('Proceso','Creando nuevo plan');
          $("#box-errores").empty();
          $("#box-informatico").empty();
          event.preventDefault();
          var form=$("#formulario-datos");
          var url = form.attr("action");
          enviarPeticion(url,form.serialize());

          }) //btn

          function enviarPeticion(url,datos){

            $.ajax({
                    type:"POST",
                    url: url,
                    dataType: 'json',
                    data:datos,
                    beforeSend: function() {
                        //$loader.show();
                    }
                }).done((result)=>{
                    creandoElemento('Exito','Plan creado correctamente','success',3000)
                    $("#box-informatico").append('<div class="alert alert-danger">'+result.mensaje+'</div>')
                    console.log(result.mensaje);
                    if(result.error){

                    }
                }).fail((data)=>{
                        creandoElemento('Oops...','Error en los datos','error',3000)
                        var errors = $.parseJSON(data.responseText);
                        console.log(errors);
                        let lista="";
                        $.each(errors.errors, function (key, value) {
                            console.log(key);
                            lista+='<li>' +value+' </li>';
                            //$("#box-errores").append('<li>'+key+'</li>')
                        });
                        $("#box-errores").append('<h4>Los siguientes campos contienen errores</h4><br/> <ul style="padding:20px" class="alert-danger">'+lista+'</ul>')

                    })
                    .always(()=>{});

          }//enviar peticion
  })

</script>

@endsection
