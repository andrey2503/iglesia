<!DOCTYPE html>
<html lang="es"><head>
	<title>Reporte Salidas</title>
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
	<h3>Reporte de Salidas</h3>
	<p>Fecha del reporte: {{ date('Y-m-d')}} <br>
	Generado por: {{ Auth::user()->nombre }}</p>
</div>
<div class="container">
    <div class="row">
		    <table class="table-encabezado">
		    			<thead class="thead-dark">
							<th class="col">Descripcion</th>
							<th class="col">Monto</th>
						</thead>

				<tbody>
				<tr></tr>
				@foreach($salidas as $s)
					<tr>
						<td class="rigth">{{ $s->descripcion }}</td>
						<td class="rigth">{{ $s->monto }}</td>

					</tr>
				@endforeach
				</tbody>
			</table>
	</div>
</div>
</body></html>
