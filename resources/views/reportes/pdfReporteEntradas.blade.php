<!DOCTYPE html>
<html lang="es"><head>
	<title>Reporte Entradas</title>
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
	<h3>Reporte de Entradas</h3>
	<p>Fecha del reporte: {{ date('Y-m-d')}} <br>
	Generado por: {{ Auth::user()->nombre }}</p>
</div>
<div class="container">
    <div class="row">
		    <table class="table-encabezado">
		    			<thead class="thead-dark">
							<th class="col">Rubro</th>
							<th class="col">Descripcion</th>
							<th class="col">Monto</th>
							<th class="col">#Documento</th>
							<th class="col">Editado</th>
						</thead>

				<tbody>
				<?php $totalColones = 0; ?> 
				<?php $totalDolares = 0; ?> 
				<?php $totalEuros = 0; ?>
				<tr></tr>
				@foreach($entradas as $e)
					<tr>
							<td class="rigth">{{ $e->rubro->nombre }}</td>
						<td class="rigth">{{ $e->descripcion }}</td>
						<td class="rigth">{{ $e->monto }}</td>
						<td class="rigth">{{ $e->documento }}</td>
						<td>{{\Carbon\Carbon::parse($e->updated_at)->format('d/m/Y')}}</td>
					</tr>
					  @if($e->moneda=='Colones')
                      <?php $totalColones = $totalColones + $e->monto; ?> 
                      @endif
                      @if($e->moneda=='Dolares')
                      <?php $totalDolares = $totalDolares + $e->monto; ?> 
                      @endif
                      @if($e->moneda=='Euros')
                      <?php $totalEuros = $totalEuros + $e->monto; ?> 
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
						<td>C {{ $totalColones }} </td>
						<td>$ {{ $totalDolares }} </td>
						<td>€ {{ $totalEuros }} </td>
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
