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
		<h3>Reporte de Cuenta bancaria</h3>
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
						@if($tipoReporte == 1 || $tipoReporte == 2)
						<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Tipo</th>
					<th scope="col">Monto</th>
					<th scope="col">Cuenta</th>
					<th scope="col">Rubro</th>
					<th scope="col">Usuario</th>
					<th scope="col">Fecha Registro</th>

					</tr>
				</thead>
				<tbody>
					@if(isset($movEntrada))
						@foreach($movEntrada as $me)

					<tr>
						<td scope="row">Entrada</td>

						@if($me->moneda == "Dolares")
						<td>$ {{ number_format($me->monto, 2, ' ', ',') }}</td>
						@endif
						@if($me->moneda == "Colones")
						<td>C {{ number_format($me->monto, 2, ' ', ',') }}</td>
						@endif
						@if($me->moneda == "Euros")
						<td>€ {{ number_format($me->monto, 2, ' ', ',') }}</td>
						@endif

						<!-- verificar tipo moneda -->
						<td>{{$me->cuenta->cuenta}}</td>
							<td>{{$me->rubro->nombre}}</td>
							<td>{{$me->usuario->usuario}}</td>
							<td>{{$me->fechaRegistro}}</td>
					</tr>
					@endforeach
				@endif
<!--  segunda tabla-->
				@if(isset($movSalida))
					@foreach($movSalida as $ms)

					<tr>
						<td scope="row">Salida</td>

						@if($ms->moneda == "Dolares")
						<td>$ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
						@endif
						@if($ms->moneda == "Colones")
						<td>C {{ number_format($ms->monto, 2, ' ', ',') }}</td>
						@endif
						@if($ms->moneda == "Euros")
						<td>€ {{ number_format($ms->monto, 2, ' ', ',') }}</td>
						@endif

						<!-- verificar tipo moneda -->
							<td>{{$ms->cuenta->cuenta}}</td>
							<td>{{$ms->rubro->nombre}}</td>
							<td>{{$ms->usuario->usuario}}</td>
							<td>{{$ms->fechaRegistro}}</td>
					</tr>
				@endforeach
			@endif
				</tbody>
			</table>
				@endif
				@if($tipoReporte == 3)
				<table id="example" class="table table-striped">
			<thead>
			<tr>
				<th scope="col">Rubro</th>
				<th scope="col">Monto Entrada</th>
				<th scope="col">Monto Salida</th>

			</tr>
			</thead>
			<tbody>
				@php $totalentradas=0;$totalsalidas=0;
				@endphp
			@if(isset($movRubroEntrada) && isset($movRubroSalida))
			@for ($i = 0; $i < count($movRubroEntrada); $i++)
			<!-- verifica el monto que la suma sea mayor a 0 -->
				@if(($movRubroEntrada[$i]['monto'] )+($movRubroSalida[$i]['monto']) >0  )
				@php
				$totalentradas =   $movRubroEntrada[$i]['monto']  + $totalentradas;
				$totalsalidas =   $movRubroSalida[$i]['monto']  + $totalsalidas;
				@endphp
			<tr>
			<td scope="row">{{ $movRubroEntrada[$i]['rubro'] }}</td>
			<td scope="row">{{ $movRubroEntrada[$i]['monto'] }}</td>
			<td scope="row">{{ $movRubroSalida[$i]['monto'] }}</td>
			</tr>
				@endif

			@endfor
			@endif
			<tr>
				<th scope="row">Totales</th>
				<th scope="row">{{ number_format($totalentradas, 2, ' ', ',') }}</th>
				<th scope="row">{{ number_format($totalsalidas, 2, ' ', ',') }}</th>
			</tr>
			<!-- fin tr sumatorias -->
			<!-- fin tr todos los rubros -->
			</tbody>

			</table>
				@endif

				@if($tipoReporte == 4)
				<table id="example" class="table table-striped">


			<thead>
			<tr>
				<th scope="col">Tipo</th>
				<th scope="col">Rubro</th>
				<th scope="col">Monto </th>
				<th scope="col">Fecha Registro</th>

			</tr>
			</thead>
			<tbody>
				@php $totalentradas=0;$totalsalidas=0;
			  @endphp
			@if(isset($movEntrada))
				@foreach($movEntrada as $me)
				@php
				$totalentradas =   $me->monto  + $totalentradas;
				@endphp
			<tr>
			<td scope="row">Entrada</td>
			<td scope="row">{{ $me->rubro->nombre }}</td>
			<td scope="row">{{ $me->monto }}</td>
				<td scope="row">{{ $me->fechaRegistro }}</td>
			</tr>

			@endforeach
			@endif

			@if(isset($movSalida))
				@foreach($movSalida as $ms)
				@php
				$totalsalidas =   $ms->monto  + $totalsalidas;
				@endphp
			<tr>
			<td scope="row">Salida</td>
			<td scope="row">{{ $ms->rubro->nombre }}</td>
			<td scope="row">{{ $ms->monto }}</td>
				<td scope="row">{{ $ms->fechaRegistro }}</td>
			</tr>

			@endforeach
			@endif
			<tr>
				<th scope="row">Total Entradas</th>
				<th scope="row">{{ number_format($totalentradas, 2, ' ', ',') }}</th>
				<th scope="row"></th>
					<th scope="row"></th>
			</tr>
			<tr>
				<th scope="row">Total Salidas</th>
				<th scope="row">{{ number_format($totalsalidas, 2, ' ', ',') }}</th>
					<th scope="row"></th>
					<th scope="row"></th>
			</tr>
			<!-- fin tr sumatorias -->
			<!-- fin tr todos los rubros -->
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
