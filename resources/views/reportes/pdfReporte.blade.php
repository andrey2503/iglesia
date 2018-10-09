<!DOCTYPE html>
<html lang="es"><head>
	<title>Reporte</title>
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
		}
		.header{
			text-align: center;
		}
	</style>
<div class="header">
	<img class="escudo" src="./img/escudoMuni.jpg">
	<h1 class="titulo">Titulo del reporte</h1>
</div>
<div>
	<h3>Reporte de usuarios</h3>
	<p>Fecha del reporte: {{ date('Y-m-d')}} <br>
	Cantidad usuarios en el reporte: {{ count($user) }}<br>
	Generado por: {{ Auth::user()->nombre }}</p>
</div>
<div class="container">
    <div class="row">
		    <table class="table-encabezado">
		    			<thead class="thead-dark">
							<th class="col">Nombre</th>
							<th class="col">Email</th>
						</thead>
				
				<tbody>
				<tr></tr>
				@foreach($user as $e)
					<tr>
						<td class="rigth">{{ $e->nombre }}</td>
						<td class="rigth">{{ $e->email }}</td>
						
					</tr>
				@endforeach
				</tbody>
			</table>
	</div>
</div>
</body></html>