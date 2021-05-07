
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
		<?php include('nav.php');?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Lista de mascota</h2>
			<hr />
 
			<?php
			if(isset($_GET['aksi']) == 'delete'){
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM mascota WHERE id_mascota='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($con, "DELETE FROM mascota WHERE id_mascota='$nik'");
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>
 
			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Filtros de datos de mascota</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="1" <?php if($filter == 'Tetap'){ echo 'selected'; } ?>>Si</option>
						<option value="2" <?php if($filter == 'Kontrak'){ echo 'selected'; } ?>>No</option>
                        
					</select>
				</div>
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th>No</th>
					<th>Mascota</th>
					<th>Dueño</th>
					<th>Nombre</th>
                    <th>Raza</th>
                    <th>Fecha de nacimiento</th>
					<th>Genero</th>
					<th>Color</th>
					<th>Esterilizado</th>
					<th>Longitud</th>
					<th>Peso</th>
					<th>Vacunas</th>
					<th>Estado Vacunas</th>
					<th>Acciones</th>
				</tr>
				<?php
				if($filter){
					$sql = mysqli_query($con, "SELECT * FROM mascota WHERE vacunas='$filter' ORDER BY id_mascota ASC");
				}else{
					$sql = mysqli_query($con, "SELECT * FROM mascota ORDER BY id_mascota ASC");
				}
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['id_mascota'].'</td>
							<td>'.$row['id_cliente'].'</td>
							<td><a href="profile.php?nik='.$row['id_mascota'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['nombre'].'</a></td>
                            <td>'.$row['raza'].'</td>
                            <td>'.$row['fecha_nacimiento'].'</td>
							<td>'.$row['Genero'].'</td>
                            <td>'.$row['color'].'</td>
							<td>'.$row['esterilizado'].'</td>
							<td>'.$row['longitud'].'</td>
							<td>'.$row['peso'].'</td>
							<td>'.$row['vacunas'].'</td>
							<td>';
							if($row['vacunas'] == '1'){
								echo '<span class="label label-success">Si</span>';
							}
                            else if ($row['vacunas'] == '2' ){
								echo '<span class="label label-info">No</span>';
							}
                            
						echo '
						
							</td>
							<td>
 
								<a href="edit.php?nik='.$row['id_mascota'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="index.php?aksi=delete&nik='.$row['id_mascota'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['nombre'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div><center>
	<p>&copy;  <?php echo date("Y");?></p
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/pet/js/bootstrap.min.js"></script>
</body>
</html>
