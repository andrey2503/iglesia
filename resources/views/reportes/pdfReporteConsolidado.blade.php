<!DOCTYPE html>
<html lang="es"><head>
	<title>Reporte</title>
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
	td{
		width: 50%;
		padding: 5px;
		/*border-top:1px black solid;*/
		border-bottom:1px black solid;
		border-left:1px black solid;

	}
	.left{
		text-align: left;
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
		<h3>{{ $titulo }} por Rubros </h3>
		@endif

		@if($fechaInicio!="" && $fechaFinal!="" )
		<p>Desde : {{$fechaInicio}} hasta : {{ $fechaFinal }}</p>
		@endif
		<p>Fecha del reporte: {{ date ("d-m-Y g:i a",time())}} <br>
			Generado por: {{ Auth::user()->nombre }}</p>
		</div>
		<div class="container">
		    <div class="row">

						@if($tipoReporte==1 || $tipoReporte==2)
						<table  class="table-encabezado table table-striped">
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
									<td scope="row" class="left">{{ $movRubroEntrada[$i]['rubro'] }}</td>
									<td scope="row" class="left">₡ {{ number_format($movRubroEntrada[$i]['monto'], 2, ' ', ',') }}</td>
									<td scope="row" class="left">₡ {{ number_format($movRubroSalida[$i]['monto'], 2, ' ', ',') }}</td>
								</tr>
								@endif
								@endfor

								<tr>
									<td scope="row">Monto Neto</td>
									<td class="left" style="color:green;font-weight: bold;"> @if( $sumaColonesS < $sumaColonesE)₡ {{ number_format($sumaColonesE-$sumaColonesS, 2, ' ', ',') }}@endif</td>
									<td class="left" style="color:red;font-weight: bold;"> @if( $sumaColonesS > $sumaColonesE)₡ {{ number_format($sumaColonesS-$sumaColonesE, 2, ' ', ',') }}@endif</td>

								</tr>
								@endif
								<!-- fin tr todos los rubros -->
							</tbody>
						</table>


						@endif

						@if($tipoReporte == 0  || $tipoReporte == 4 || $tipoReporte == 3)
						<table class="table table-striped">
								<thead class="thead-dark">
									<tr>
										<th scope="col center">Fecha Registro</th>
											<th scope="col center">Documento</th>
										<th scope="col center">Tipo</th>
										<th scope="col center">Cuenta</th>
										<th scope="col center">Rubro</th>
										<!-- <th scope="col" >Nombre</th> -->
										<!-- <th scope="col"  style="width:20% !important;">Detalle</th> -->
										<th scope="col">Monto</th>

									</tr>
								</thead>
								<tbody>
								@if(isset($movEntrada))
									@foreach($movEntrada as $me)
								<tr>
									<td class="left">{{$me->fechaRegistro}}</td>
									<td scope="row" class="left">{{$me->entrada->documento}}</td>
									<td scope="row"class="left" >Entrada</td>

						<!-- verificar tipo moneda -->
									<td>{{$me->cuenta->nombre}}</td>
										<td class="left">{{$me->rubro->nombre}}</td>
										<!-- <td>{{$me->entrada->nombre}}</td> -->
										<!-- <td  style="width:100px;">{{$me->entrada->descripcion}}</td> -->
										@if($me->moneda == "Dolares")
										<td class="left">$ {{ number_format($me->monto, 2, ' ', ',') }}</td>
										@endif
										@if($me->moneda == "Colones")
										<td class="left">₡ {{ number_format($me->monto, 2, ' ', ',') }}</td>
										@endif
										@if($me->moneda == "Euros")
										<td class="left">{{ number_format($me->monto, 2, ' ', ',') }}</td>
										@endif
									</tr>
						@endforeach
						@endif
						<!--  segunda tabla-->
						@if(isset($movSalida))
						@foreach($movSalida as $ms)

						<tr>
						<td class="left">{{$ms->fechaRegistro}}</td>
						<td class="left">{{$ms->salida->documento}}</td>
						<td scope="row" class="left">Salida</td>


						<!-- verificar tipo moneda -->
							<td>{{$ms->cuenta->nombre}}</td>
							<td class="left">{{$ms->rubro->nombre}}</td>
							<!-- <td>{{$ms->salida->nombre}}</td> -->
							<!-- <td  style="width:100px;">{{$ms->salida->descripcion}}</td> -->
							@if($ms->moneda == "Dolares")
							<td class="left">$ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
							@endif
							@if($ms->moneda == "Colones")
							<td class="left" >₡ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
							@endif
							@if($ms->moneda == "Euros")
							<td class="left">{{ number_format($ms->monto, 2, ' ', ',') }}</td>
							@endif
						</tr>
						@endforeach
						@endif

						</tbody>

						</table>
						<!-- Datos de los reportes generales -->

						<!-- Suma de todos los valores -->
						@endif
						<br>
					<label for="">Firma Ecargado:</label><div style="border-bottom:solid black 1px; width:80%;margin-left:15%;"></div><br>
					<p style="text-align:center;">"Vayan por todo el mundo y proclamen la Buena Noticia a toda creatura" <br>
						Telefono y fax (506) 22370494 Apto 186-3000,Heredia Costa Rica<br>
						email: <a href="#" target="_top">parroquiacorjesus@gmail.com</a> Facebook:Sagrado Corazón
					</p>

			</div>
		</div>
	</body></html>
