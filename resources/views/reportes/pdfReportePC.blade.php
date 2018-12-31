<!DOCTYPE html>
<html lang="es"><head>
	<meta charset="UTF-8">
	<title>Reporte Cuenta por Cobrar</title>
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
		<h3>Reporte de Cuentas por Cobrar</h3>
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
						<th scope="col" style="width:60px;"># ID</th>
						<th scope="col"  style="width:200px;">Rubro</th>
						<th scope="col">Monto</th>
						<th scope="col">Edicion</th>
					</tr>
				</thead>
				<tbody>
				<?php $totalColones = 0; ?> 
                <?php $totalDolares = 0; ?> 
                <?php $totalEuros = 0; ?> 
		      @php $i=0;
		      @endphp
		      @if(isset($cuentasCobrar))
		        @foreach($cuentasCobrar as $cp)
		        @php
		        $i =   $cp->monto  + $i
		        @endphp
		      <tr>
		        <td>{{ $cp->nombre }}</td>
		        <td style="width:60px;">0{{ $cp->id }}PC</td>
		        <td  style="width:200px;">{{$cp->rubro->nombre}}</td>

		        @if($cp->moneda == "Dolares")
		        <td>$ {{ number_format($cp->monto, 2, ' ', ',') }}</td>
		        @endif
		        @if($cp->moneda == "Colones")
		        <td>C {{ number_format($cp->monto, 2, ' ', ',') }}</td>
		        @endif
		        @if($cp->moneda == "Euros")
		        <td>€ {{ number_format($cp->monto, 2, ' ', ',') }}</td>
		        @endif
		        <!-- verificar tipo moneda -->
		          <td>{{$cp->updated_at}}</td>
		      </tr>
			  		  @if($cp->moneda=='Colones')
                      <?php $totalColones = $totalColones + $cp->monto; ?> 
                      @endif
                      @if($cp->moneda=='Dolares')
                      <?php $totalDolares = $totalDolares + $cp->monto; ?> 
                      @endif
                      @if($cp->moneda=='Euros')
                      <?php $totalEuros = $totalEuros + $cp->monto; ?> 
                      @endif
		      @endforeach
		    @endif
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
					<label for="">Firma Encargado:</label><div style="border-bottom:solid black 1px; width:80%;margin-left:15%;"></div><br>
					<p style="text-align:center;">"Vayan por todo el mundo y proclamen la Buena Noticia a toda creatura" <br>
						Telefono y fax (506) 22370494 Apto 186-3000,Heredia Costa Rica<br>
						email: <a href="#" target="_top">parroquiacorjesus@gmail.com</a> Facebook:Sagrado Corazón
					</p>
				</div>
			</div>
		</div>
	</body></html>
