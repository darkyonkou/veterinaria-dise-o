<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Latihan MySQLi</title>

	<!-- Bootstrap -->
	<link href="/pet/css/bootstrap.min.css" rel="stylesheet">
	<link href="pet/css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="pet/css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include("nav.php");?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Datos veterinario &raquo; Agregar datos</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$id_mascota		     = mysqli_real_escape_string($con,(strip_tags($_POST["id_mascota"],ENT_QUOTES)));//Escanpando caracteres 
				$id_cliente		     = mysqli_real_escape_string($con,(strip_tags($_POST["id_cliente"],ENT_QUOTES)));//Escanpando caracteres 
				$nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));//Escanpando caracteres 
				$raza		     = mysqli_real_escape_string($con,(strip_tags($_POST["raza"],ENT_QUOTES)));//Escanpando caracteres 
				$fecha_nacimiento	 = mysqli_real_escape_string($con,(strip_tags($_POST["fecha_nacimiento"],ENT_QUOTES)));//Escanpando caracteres 
				$Genero	     = mysqli_real_escape_string($con,(strip_tags($_POST["Genero"],ENT_QUOTES)));//Escanpando caracteres 
				$color		 = mysqli_real_escape_string($con,(strip_tags($_POST["color"],ENT_QUOTES)));//Escanpando caracteres 
				$esterilizado		 = mysqli_real_escape_string($con,(strip_tags($_POST["esterilizado"],ENT_QUOTES)));//Escanpando caracteres 
				$longitud		     = mysqli_real_escape_string($con,(strip_tags($_POST["longitud"],ENT_QUOTES)));//Escanpando caracteres
				$peso		     = mysqli_real_escape_string($con,(strip_tags($_POST["peso"],ENT_QUOTES)));//Escanpando caracteres  
				$vacunas     = mysqli_real_escape_string($con,(strip_tags($_POST["vacunas"],ENT_QUOTES)));//Escanpando caracteres
				
			

				$cek = mysqli_query($con, "SELECT * FROM mascota WHERE id_mascota='$id_mascota'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($con, "INSERT INTO mascota(id_mascota, id_cliente, nombre, raza, fecha_nacimiento, Genero, color, esterilizado, longitud, peso, vacunas, observaciones)
															VALUES('$id_mascota', '$id_cliente', '$nombre', '$raza', '$fecha_nacimiento', '$Genero', '$color', '$esterilizado', '$longitud','$peso','$vacunas')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
					 
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. código exite!</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Código</label>
					<div class="col-sm-2">
						<input type="text" name="id_mascota" class="form-control" placeholder="Código" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Dueño</label>
					<div class="col-sm-2">
						<input type="text" name="id_cliente" class="form-control" placeholder="Dueño" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-4">
						<input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Raza</label>
					<div class="col-sm-4">
						<input type="text" name="raza" class="form-control" placeholder="Nombre" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha de nacimiento</label>
					<div class="col-sm-4">
						<input type="text" name="fecha_nacimiento" class="input-group date form-control" date="" data-date-format="dd-mm-yyyy" placeholder="00-00-0000" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Genero</label>
					<div class="col-sm-3">
						<select name="Genero" class="form-control">
							<option value=""> ----- </option>
                           <option value="Masculino">Masculino</option>
							<option value="Femenino">Femenino</option>
							
							 
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Color</label>
					<div class="col-sm-3">
						<input type="text" name="color" class="form-control" placeholder="color" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Esterilizado</label>
					<div class="col-sm-3">
						<select name="esterilizado" class="form-control">
							<option value=""> ----- </option>
                           <option value="1">Si</option>
							<option value="2">No</option>
							
							
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Longitud cm</label>
					<div class="col-sm-3">
						<input type="text" name="longitud" class="form-control" placeholder="color" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Peso</label>
					<div class="col-sm-3">
						<input type="text" name="peso" class="form-control" placeholder="color" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Vacunas</label>
					<div class="col-sm-3">
						<select name="vacunas" class="form-control">
							<option value=""> ----- </option>
                           <option value="1">Si</option>
							<option value="2">No</option>
							
							 
						</select>
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>
