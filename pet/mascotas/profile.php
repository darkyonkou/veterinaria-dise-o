<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de mascota</title>

	<!-- Bootstrap -->
	<link href="/pet/css/bootstrap.min.css" rel="stylesheet">
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
			<h2>Datos de la mascota &raquo; Perfil</h2>
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
			
			if(isset($_GET['aksi']) == 'delete'){
				$delete = mysqli_query($con, "DELETE FROM mascota WHERE id_mascota='$nik'");
				if($delete){
					echo '<div class="alert alert-danger alert-dismissable">><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil dihapus.</div>';
				}else{
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal dihapus.</div>';
				}
			}
			?>
			
			<table class="table table-striped table-condensed">
				<tr>
					<th width="20%">Código</th>
					<td><?php echo $row['id_mascota']; ?></td>
				</tr>
				<tr>
					<th width="20%">Cliente</th>
					<td><?php echo $row['id_cliente']; ?></td>
				</tr>
				<tr>
					<th>Nombre mascota</th>
					<td><?php echo $row['nombre']; ?></td>
				</tr>
				<tr>
					<th>Raza</th>
					<td><?php echo $row['raza'].', '.$row['raza']; ?></td>
				</tr>
				<tr>
					<th>Fecha de nacimiento</th>
					<td><?php echo $row['fecha_nacimiento'].', '.$row['fecha_nacimiento']; ?></td>
				</tr>
				<th>Genero</th>
					<td>
						<?php 
							if ($row['Genero']==1) {
								echo "Masculino";
							} else if ($row['Genero']==2){
								echo "Femenino";
							}
						?>
					</td>
				<tr>
				<th>Color</th>
					<td><?php echo $row['color']; ?></td>
				</tr>
				<th>Esterilizacion</th>
					<td>
						<?php 
							if ($row['esterilizado']==1) {
								echo "si";
							} else if ($row['esterilizado']==2){
								echo "no";
							}
						?>
					</td>
				<tr>
				
				<tr>
					<th>Longitud cm</th>
					<td><?php echo $row['longitud']; ?></td>
				</tr>
				<tr>
					<th>Peso kg</th>
					<td><?php echo $row['peso']; ?></td>
				</tr>
				<th>Vacunas</th>
					<td>
						<?php 
							if ($row['vacunas']==1) {
								echo "si";
							} else if ($row['vacunas']==2){
								echo "no";
							}
						?>
					</td>
				<tr>
				
			</table>
			
			<a href="index.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Regresar</a>
			
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/pet/js/bootstrap.min.js"></script>
</body>
</html>