@extends('administrador.escritorio')

@section('content')

<div class="container row col-md-12">
  <div class=" col-md-12 box box-primary">
    <div class="box-header with-border">

      <div class="box-header with-border">
                      @if(session()->has('error'))
                          <div class="alert alert-danger">
                              {{ session()->get('error') }}
                          </div>
                      @endif
      </div><!-- /.box-header -->
      <div class="box-header with-border" id="box-informatico">

      </div><!-- /.box-header -->
      <div class="box-header with-border"  id="box-errores">

      </div>
                  <h3 class="box-title"> Nueva Cuenta Bancaria</h3>
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif
      </div><!-- /.box-header -->
      <form   id="formulario-datos" role="form"   method="post"  action="{{ url('nuevaCuentaBancaria') }}" class="form-horizontal form_entrada" >
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
                <label for="email">Banco</label>
                <input type="text" class="form-control" name="banco" placeholder="Banco">
                @if($errors->has('banco'))
                  <span style="color: red;">{{ $errors->first('banco') }}</span>
                @endif
              </div>
              <div class="form-group col-md-6">

                <label for="fechaRegistro">Fecha de Registro</label>

                <input type="date" class="form-control fecha" name="fechaRegistro" >

                @if($errors->has('fechaRegistro'))

                  <span style="color: red;">{{ $errors->first('fechaRegistro') }}</span>

                @endif

              </div>


               <div class="form-group col-md-6">
                <label for="user">Tipo de Cuenta</label>
                <select class="form-control" name="tipo">
                  <option value="Corriente">Corriente</option>
                    <option value="Ahorros">Ahorros</option>
                </select>
                @if($errors->has('tipo'))
                  <span style="color: red;">{{ $errors->first('tipo') }}</span>
                @endif
              </div>
              <div class="form-group col-md-6">
               <label for="user">Moneda</label>
               <select class="form-control" name="moneda">
                 <option value="Colones">₡ Colones</option>
                   <option value="Dolares">$ Dolares</option>
                    <option value="Euros">€ Euros</option>
               </select>
               @if($errors->has('moneda'))
                 <span style="color: red;">{{ $errors->first('moneda') }}</span>
               @endif
              </div>

              <div class="form-group col-md-6">
                <label for="telefono">Número de Cuenta</label>
                <input type="text" class="form-control" name="cuenta" placeholder="Número de Cuenta">
                @if($errors->has('cuenta'))
                  <span style="color: red;">{{ $errors->first('cuenta') }}</span>
                @endif
              </div>

        </div>
        <a  style="margin-bottom: 15px;" class="btn btn-success" href="{{ url('/listaCuentaBancaria') }} " > <span class="glyphicon glyphicon-chevron-left"></span> Regresar</a>
        <button id="btn-accion-crear" style="margin-bottom: 15px;color:white;" type="submit" class="btn btn-default btn-info">Crear Cuenta</button>

      </form>
      </div><!-- /.box -->
</div>
@endsection

@section('scripts')

<script>

$(document).ready(function() {
  var hoy = new Date();
  var mes=hoy.getMonth() + 1;
  var dia=hoy.getDate();
  if( mes <= 9 ){
    mes="0"+mes;
  }
  if (dia<=9) {
    dia="0"+dia;
  }


  var fecha =  hoy.getFullYear()+'-'+mes +'-'+dia ;
  $(".fecha").val(fecha);


          $("#btn-accion-crear").click((event)=>{

          creandoElementoLoading('Proceso','Creando nueva cuenta bancaria');
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

                    creandoElemento('Exito','Cuenta Bancaria creada correctamente','success',3000)
                    $("#box-informatico").append('<div class="alert alert-success">'+result.mensaje+'</div>')
                    console.log(result.mensaje);
                    $('#formulario-datos')[0].reset();
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
