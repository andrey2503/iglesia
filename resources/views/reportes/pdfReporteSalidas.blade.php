<!DOCTYPE html>
<html lang="es"><head>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Reporte Salidas</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

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
		body { font-family: DejaVu Sans; }
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
		.center{
			text-align:center;
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
	<h3>Reporte de Salidas</h3>
	@if($tipoReporte ==1)
<p>Fecha de Registro: Desde: {{ date('d-m-Y', strtotime($fechaInicio))}} Hasta: {{ date('d-m-Y', strtotime($fechaFinal))}}<br>
@endif
<p>Fecha del reporte: {{ date ("d-m-Y g:i a",time())}} <br>
		Generado por: {{ Auth::user()->nombre }}</p>
</div>
<div class="container">
    <div class="row">
		    <table class="table-encabezado">
		    			<thead class="thead-dark">
								<th class="col center" >Fecha Registro</th>
								<th class="col center">Rubro</th>
								<th class="col center">#Documento</th>
								<th class="col center">Nombre</th>
								<th class="col center">Descripcion</th>
								<th class="col center">Monto</th>
						</thead>

				<tbody>
				<?php $totalColones = 0; ?>
				<?php $totalDolares = 0; ?>
				<?php $totalEuros = 0; ?>
				<tr></tr>
				@foreach($salidas as $s)
					<tr>
						<td>{{\Carbon\Carbon::parse($s->updated_at)->format('d/m/Y')}}</td>
						<td class="rigth">{{ $s->rubro->nombre }}</td>
							<td class="rigth">{{ $s->documento }}</td>
								<td class="rigth">{{ $s->nombre }}</td>
						<td class="rigth">{{ $s->descripcion }}</td>
						<td class="rigth">
							@if($s->moneda=='Colones')
							₡ {{ number_format($s->monto, 2, ' ', ',') }}
							@endif
							@if($s->moneda=='Dolares')
							$ {{ number_format($s->monto, 2, ' ', ',') }}
							@endif
							@if($s->moneda=='Euros')
							€ {{ number_format($s->monto, 2, ' ', ',') }}
							@endif
									 </td>


					</tr>
					  @if($s->moneda=='Colones')
                      <?php $totalColones = $totalColones + $s->monto; ?>
                      @endif
                      @if($s->moneda=='Dolares')
                      <?php $totalDolares = $totalDolares + $s->monto; ?>
                      @endif
                      @if($s->moneda=='Euros')
                      <?php $totalEuros = $totalEuros + $s->monto; ?>
                      @endif
				@endforeach
				</tbody>
			</table>
			<h5>Totales</h5>
			<table class="table table-striped">
				<thead>
					<tr>
					<th scope="col">Colones</th>
					<th scope="col">Dolares</th>
					<th scope="col">Euros</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>₡ {{ number_format($totalColones, 2, ' ', ',') }}</td>
						<td>$ {{ number_format($totalDolares, 2, ' ', ',') }} </td>
						<td>&#8364; {{ number_format($totalEuros, 2, ' ', ',') }}</td>
					</tr>
				</tbody>
			</table>
	</div><br>
				<label for="">Firma Ecargado:</label><div style="border-bottom:solid black 1px; width:80%;margin-left:15%;"></div><br>
				<p style="text-align:center;">"Vayan por todo el mundo y proclamen la Buena Noticia a toda creatura" <br>
					Telefono y fax (506) 22370494 Apto 186-3000,Heredia Costa Rica<br>
					email: <a href="#" target="_top">parroquiacorjesus@gmail.com</a> Facebook:Sagrado Corazón
				</p>
</div>
</body></html>
