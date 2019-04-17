<!DOCTYPE html>
<html lang="es"><head>
	<title>Reporte Cuenta bancaria</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head><body>
	<style type="text/css">
	.table-encabezado{
		width: 100%;
		text-align: center;
	}
		body { font-family: DejaVu Sans; }
	.tabla-datos{
		width: 100%;
		text-align: center;
	}
	.center{
		text-align:center;
	}
	.left{
		border-right:1px black solid;
	}
	tr{
		border-radius: 2px;
	}
	.thead-dark{
		background-color: #454545;
		color: white;
	}
	.col{
		padding: 10px;
	}
	.titulo{
		text-align: center;
	}
	.right{
	}
	.escudo{
		position: absolute;
		top:20px;
		right: 10px;
		width: 60px;
		text-align: right;
	}
	.header{
		text-align: center;
	}
	</style>
	<div class="header">
		<img class="escudo" src="./img/corazon.png">
		<h1 class="titulo">Parroquia del Sagrado Corazón de Jesús</h1>
		<h4>Parroquia evangelizada, evangelizadora y misionera <br>Heredia, Costa Rica</h4>
	</div>
	<div>
		<?php
		date_default_timezone_set("America/Costa_Rica");
		 ?>
		<h3>Reporte de Cuentas bancarias</h3>
		@if($tipoReporte ==1)
	<p>Fecha de Registro: Desde: {{ date('d-m-Y', strtotime($fechaInicio))}} Hasta: {{ date('d-m-Y', strtotime($fechaFinal))}}<br>
	@endif
	<p>Fecha del reporte: {{ date ("d-m-Y g:i a",time())}} <br>
			Generado por: {{ Auth::user()->nombre }}</p>
		</div>
		<div class="">
			<div class="">
				<div class="row tabla-usuarios">
					<div class="table-responsive">
					@if(isset($mov_entrada) || isset($mov_salida))
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th scope="col center">Movimiento</th>
                    <th scope="col center">Rubro</th>

                    <th scope="col center">Monto</th>
                    <th scope="col center">Fecha registro</th>
                  </tr>
                </thead>
                  <tbody>
                  @if(isset($mov_entrada))
										<!-- print_r($mov_entrada); -->
                    @foreach($mov_entrada as $me)
                    <tr>
                      <!-- <th scope="row">{{ $me->cuenta }}</th> -->
                      <th scope="row">Entrada</th>
                      <td>{{ $me->rubro->nombre }}</td>

                      @if($me->moneda == "Dolares")
                      <td class="text-left">$ {{ number_format($me->monto, 2, ' ', ',') }}</td>
                      @endif
                      @if($me->moneda == "Colones")
                      <td class="text-left">₡ {{ number_format($me->monto, 2, ' ', ',') }}</td>
                      @endif
                      @if($me->moneda == "Euros")
                      <td class="text-left">>&#8364; {{ number_format($me->monto, 2, ' ', ',') }}</td>
                      @endif
                      <!-- verificar tipo moneda -->
                        <td>{{$me->fechaRegistro}}</td>
                    </tr>
                    @endforeach
                  @endif

                   @if(isset($mov_salida))

                    @foreach($mov_salida as $ms)

                    <tr>
                      <!-- <th scope="row">{{ $ms->cuenta }}</th> -->
                      <th scope="row">Salida</th>
                      <td>{{ $ms->rubro->nombre }}</td>
											 
                      @if($ms->moneda == "Dolares")
                      <td class="text-left">$ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
                      @endif
                      @if($ms->moneda == "Colones")
                      <td class="text-left">₡ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
                      @endif
                      @if($ms->moneda == "Euros")
                      <td class="text-left">>&#8364; {{ number_format($ms->monto, 2, ' ', ',') }}</td>
                      @endif
                      <!-- verificar tipo moneda -->
                        <td>{{$ms->fechaRegistro}}</td>
                    </tr>
                    @endforeach
                  @endif

                  </tbody>
              </table>
            @endif

		</div><br>
					<label for="">Firma Ecargado:</label><div style="border-bottom:solid black 1px; width:80%;margin-left:15%;"></div><br>
					<p style="text-align:center;">"Vayan por todo el mundo y proclamen la Buena Noticia a toda creatura" <br>
						Telefono y fax (506) 22370494 Apto 186-3000,Heredia Costa Rica<br>
						email: <a href="#" target="_top">parroquiacorjesus@gmail.com</a> Facebook:Sagrado Corazón
					</p>
				</div>
			</div>
		</div>
	</body></html>
