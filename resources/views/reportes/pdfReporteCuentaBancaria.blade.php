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
		width: 80px;
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
		<h3>Reporte de Cuenta bancaria</h3>
		<p>Fecha del reporte: {{ date('Y-m-d')}} <br>
			Generado por: {{ Auth::user()->nombre }}</p>
		</div>
		<div class="">
			<div class="">
				<div class="row tabla-usuarios">
					<div class="table-responsive">
						<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Nombre</th>
						<th scope="col"># Cuenta</th>
						<th scope="col">Banco</th>
						<th scope="col">Tipo</th>
						<th scope="col">Moneda</th>
						<th scope="col">Monto</th>
					</tr>
				</thead>
				<tbody>
					@php $i=0;
					@endphp
					@if(isset($cuentas))
						@foreach($cuentas as $c)
						@php
						$i =   $c->monto  + $i
						@endphp
					<tr>
						<td >{{ $c->nombre }}</td>
						<td>{{ $c->cuenta }}</td>
						<td>{{$c->banco}}</td>
						<td>{{ $c->tipo }}</td>
						<td>{{ $c->moneda }}</td>
						<td>{{ number_format($c->monto, 2, ' ', ',') }}</td>
						<!-- verificar tipo moneda -->

					</tr>
					@endforeach
				@endif
				</tbody>
			</table>

		</div><br>
					<label for="">Firma Ecargado:</label><div style="border-bottom:solid black 1px; with:600px;"></div><br>
					<p style="text-align:center;">"Vayan por todo el mundo y proclamen la Buena Noticia" <br>
						Telefono y fax (506) 22370494 Apto -3000,heredia Costa Rica<br>
						email: <a href="mailto:parroquiacorazondejesus@gmail.com" target="_top">parroquiacorazondejesus@gmail.com</a> Facebook:parroquiacorazondejesus
					</p>
				</div>
			</div>
		</div>
	</body></html>
