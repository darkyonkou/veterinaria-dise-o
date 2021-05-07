<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de Mascotas</title>

	<!-- Bootstrap -->
	<link href="/pet/css/bootstrap.min.css" rel="stylesheet">
	<link href="/pet/css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="/pet/css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
	

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include("nav.php");?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Datos de Mascotas &raquo; Editar datos</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = mysqli_query($con, "SELECT * FROM mascota WHERE id_mascota='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$id_mascota		     = mysqli_real_escape_string($con,(strip_tags($_POST["id_mascota"],ENT_QUOTES)));//Escanpando caracteres 
				$id_cliente		     = mysqli_real_escape_string($con,(strip_tags($_POST["id_cliente"],ENT_QUOTES)));//Escanpando caracteres 
				$nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));//Escanpando caracteres 
				$raza		     = mysqli_real_escape_string($con,(strip_tags($_POST["raza"],ENT_QUOTES)));//Escanpando caracteres 
				$fecha_nacimiento	 = mysqli_real_escape_string($con,(strip_tags($_POST["fecha_nacimiento"],ENT_QUOTES)));//Escanpando caracteres 
				$Genero	     = mysqli_real_escape_string($con,(strip_tags($_POST["Genero"],ENT_QUOTES)));//Escanpando caracteres 
				$color		 = mysqli_real_escape_string($con,(strip_tags($_POST["color"],ENT_QUOTES)));//Escanpando caracteres 
				$esterilizado		 = mysqli_real_escape_string($con,(strip_tags($_POST["estilirizado"],ENT_QUOTES)));//Escanpando caracteres 
				$longitud		     = mysqli_real_escape_string($con,(strip_tags($_POST["longitud"],ENT_QUOTES)));//Escanpando caracteres
				$peso		     = mysqli_real_escape_string($con,(strip_tags($_POST["peso"],ENT_QUOTES)));//Escanpando caracteres  
				$vacunas     = mysqli_real_escape_string($con,(strip_tags($_POST["vacunas"],ENT_QUOTES)));//Escanpando caracteres
				
				
				$update = mysqli_query($con, "UPDATE mascota SET id_mascota='$id_mascota',id_cliente='$id_cliente', nombre='$nombre', raza='$raza', fecha_nacimiento='$fecha_nacimiento', Genero='$Genero', color='$color', esterilizado='$esterilizado', longitud='$longitud', peso='$peso', vacunas='$vacunas' WHERE id_mascota='$nik'") or die(mysqli_error());
				if($update){
					header("Location: edit.php?nik=".$nik."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Código</label>
					<div class="col-sm-2">
						<input type="text" name="id_mascota" value="<?php echo $row ['id_mascota']; ?>" class="form-control" placeholder="NIK" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Dueño</label>
					<div class="col-sm-2">
						<input type="text" name="id_cliente" value="<?php echo $row ['id_cliente']; ?>" class="form-control" placeholder="NIK" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-4">
						<input type="text" name="nombre" value="<?php echo $row ['nombre']; ?>" class="form-control" placeholder="Nombres" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Raza</label>
					<div class="col-sm-4">
						<input type="text" name="raza" value="<?php echo $row ['raza']; ?>" class="form-control" placeholder="Raza" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha de nacimiento</label>
					<div class="col-sm-4">
						<input type="text" name="fecha_nacimiento" value="<?php echo $row ['fecha_nacimiento']; ?>" class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Genero</label>
					<div class="col-sm-3">
						<select name="Genero" class="form-control">
							<option value="">- Selecciona Genero -</option>
                            <option value="Masculino" <?php if ($row ['Genero']==1){echo "selected";} ?>>Masculion</option>
							<option value="Femenino" <?php if ($row ['Genero']==2){echo "selected";} ?>>Femenino</option>
							
						</select> 
					</div>
                   
                </div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Color</label>
					<div class="col-sm-3">
						<input type="text" name="color" value="<?php echo $row ['color']; ?>" class="form-control" placeholder="color" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Esterilizado</label>
					<div class="col-sm-3">
						<select name="esterilizado" class="form-control">
							<option value="">- Selecciona opcion -</option>
                            <option value="1" <?php if ($row ['esterilizado']==1){echo "selected";} ?>>Si</option>
							<option value="2" <?php if ($row ['esterilizado']==2){echo "selected";} ?>>No</option>
							
						</select> 
					</div>
                   
                </div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Longitud</label>
					<div class="col-sm-3">
						<input type="text" name="longitud" value="<?php echo $row ['longitud']; ?>" class="form-control" placeholder="longitud" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Peso</label>
					<div class="col-sm-3">
						<input type="text" name="peso" value="<?php echo $row ['peso']; ?>" class="form-control" placeholder="peso" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Vacuna</label>
					<div class="col-sm-3">
						<select name="vacunas" class="form-control">
							<option value="">- Selecciona opcion -</option>
                            <option value="1" <?php if ($row ['vacunas']==1){echo "selected";} ?>>Si</option>
							<option value="2" <?php if ($row ['vacunas']==2){echo "selected";} ?>>No</option>
							
						</select> 
					</div>
                   
                </div>
				
			
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/pet/js/bootstrap.min.js"></script>
	<script src="/pet/js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>