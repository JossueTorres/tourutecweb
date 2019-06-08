<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>TourUtec|Login</title>
	<link  rel="stylesheet" href="<?php echo base_url('/lib/bootstrap/dist/css/bootstrap.min.css');?>"/>
	<style>
		.MainCont {
			height: auto;
			width: 90%;
			max-width: 300px;
			margin-top: 50px;
		}

		body {
			background-color: #5D0A28;
		}

		.Titulo {
			color: #fff;
			margin-bottom: 20px;
			transform: scale(1.5);
			font-weight: bold;
		}

		.Titulo:hover {
			transform: scale(1.6);
			cursor: pointer;

		}

		.onH:hover {
			transform: scale(1.1);
			cursor: pointer;
		}
	</style>
</head>

<body>
	<center>
		<div class="MainCont">
			<h1 class="Titulo">Tour Utec</h1>
			<div class="panel panel-primary">
				<form method="POST" action="<?php echo base_url('/Login/Ingresar'); ?>" name="formLogin">
					<div class="panel-header">
						<h4 class="onH">Iniciar Sesion</h4>
					</div>
					<div class="panel-body">
						<input name='txtUsr' id='txtUsr' type="text" placeholder="Usuario" class="form-control" /><br>
						<input name='txtPass' id='txtPass' type="password" placeholder="Contraseña" class="form-control" />
					</div>
					<div class="panel-footer">
						<button role="button" type="submit" class="btn">Ingresar</button>
					</div>
				</form>
			</div>
		</div>
	</center>


	<script src="<?php echo base_url('/lib/jquery-3.4.1.min.js');?>"></script>
</body>

</html>