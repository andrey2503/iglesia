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
	.tabla-datos{
		width: 100%;
		text-align: center;
	}
	td{
		width: 50%;
		padding: 5px;
		/*border-top:1px black solid;*/
		border-bottom:1px black solid;
		border-left:1px black solid;

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
		@if(isset($titulo))
		<h3>{{ $titulo }} en {{ $moneda }} </h3>
		@endif

		@if($fechaInicio!="" && $fechaFinal!="" )
		<p>Desde : {{$fechaInicio}} hasta : {{ $fechaFinal }}</p>
		@endif
		<p>Fecha del reporte: {{ date ("d-m-Y g:i a",time())}} <br>
			Generado por: {{ Auth::user()->nombre }}</p>
		</div>
		<div class="">
			<div class="">
				<div class="row tabla-usuarios">
					<div class="table-responsive">
						@if($tipoReporte==1 || $tipoReporte==2)
						<table id="example" class="table table-striped">
							<thead>
								<tr>
									<th scope="col">Rubro</th>
									<th scope="col">Monto Entrada</th>
									<th scope="col">Monto Salida</th>
								</tr>
							</thead>
							<tbody>

								@if(isset($movRubroEntrada) && isset($movRubroSalida))
								@for ($i = 0; $i < count($movRubroEntrada); $i++)
								<!-- verifica el monto que la suma sea mayor a 0 -->
								@if(($movRubroEntrada[$i]['monto'] )+($movRubroSalida[$i]['monto']) >0  )
								<tr>
									<td scope="row">{{ $movRubroEntrada[$i]['rubro'] }}</td>
									<td scope="row" class="text-right">{{ $movRubroEntrada[$i]['monto'] }}</td>
									<td scope="row" class="text-right">{{ $movRubroSalida[$i]['monto'] }}</td>
								</tr>
								@endif
								@endfor

								<tr>
									<td scope="row">Monto Neto</td>
									<td class="text-right" style="color:green;font-weight: bold;"> @if( $sumaColonesS < $sumaColonesE)C {{ number_format($sumaColonesE-$sumaColonesS, 2, ' ', ',') }}@endif</td>
									<td class="text-right" style="color:red;font-weight: bold;"> @if( $sumaColonesS > $sumaColonesE)C {{ number_format($sumaColonesS-$sumaColonesE, 2, ' ', ',') }}@endif</td>

								</tr>
								@endif
								<!-- fin tr todos los rubros -->
							</tbody>
						</table>


						@endif

						@if($tipoReporte == 0  || $tipoReporte == 4 || $tipoReporte == 3)
						<table id="example" class="table table-striped">
								<thead>
									<tr>
										<th scope="col">Fecha Registro</th>
										<th scope="col">Tipo</th>
										<th scope="col">Monto</th>
										<th scope="col">Cuenta</th>
										<th scope="col">Rubro</th>
										<th scope="col">Nombre</th>

									</tr>
								</thead>
								<tbody>
								@if(isset($movEntrada))
									@foreach($movEntrada as $me)
								<tr>
									<td>{{$me->fechaRegistro}}</td>
									<td scope="row" style="width:60px;">Entrada</td>
									@if($me->moneda == "Dolares")
									<td class="text-right">$ {{ number_format($me->monto, 2, ' ', ',') }}</td>
									@endif
									@if($me->moneda == "Colones")
									<td class="text-right">C {{ number_format($me->monto, 2, ' ', ',') }}</td>
									@endif
									@if($me->moneda == "Euros")
									<td class="text-right">€ {{ number_format($me->monto, 2, ' ', ',') }}</td>
									@endif

						<!-- verificar tipo moneda -->
									<td>{{$me->cuenta->cuenta}}</td>
										<td>{{$me->rubro->nombre}}</td>
										<td>{{$me->entrada->nombre}}</td>

									</tr>
						@endforeach
						@endif
						<!--  segunda tabla-->
						@if(isset($movSalida))
						@foreach($movSalida as $ms)

						<tr>
						<td>{{$ms->fechaRegistro}}</td>
						<td scope="row" style="width:60px;">Salida</td>
						@if($ms->moneda == "Dolares")
						<td class="text-right">$ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
						@endif
						@if($ms->moneda == "Colones")
						<td class="text-right">C {{ number_format($ms->monto, 2, ' ', ',') }}</td>
						@endif
						@if($ms->moneda == "Euros")
						<td class="text-right">€ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
						@endif

						<!-- verificar tipo moneda -->
							<td>{{$ms->cuenta->cuenta}}</td>
							<td>{{$ms->rubro->nombre}}</td>
							<td>{{$ms->salida->nombre}}</td>

						</tr>
						@endforeach
						@endif

						</tbody>

						</table>
						<!-- Datos de los reportes generales -->

						<!-- Suma de todos los valores -->
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
