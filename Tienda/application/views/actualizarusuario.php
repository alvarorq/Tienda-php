<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="container">
	<div class="col-6">
		<?php echo form_open('Usuario_ctrl/actualizarDatos'); ?>
		<div class="form-group">
			<h5>Username:</h5>
			<?php echo form_error('username'); ?>
			<input class="form-control" type="text" name="username" value="<?php echo(isset($_POST['username'])) ?  set_value('username') :  $usuario['nickName']; ?>" />

			<h5>New Password:</h5>
			<?php echo form_error('password'); ?>
			<input class="form-control" type="text" name="password" value="<?php echo (isset($_POST['password'])) ?  set_value('password') :  ''; ?>" />
		</div>
		<div class="form-group">
		<h5>Email Address:</h5>
		<?php echo form_error('email'); ?>
		<input class="form-control" type="text" name="email" value="<?php echo (isset($_POST['email'])) ?  set_value('email') :  $usuario['email']; ?>" />	
		
		<h5>Nombre:</h5>
		<?php echo form_error('nombre'); ?>
		<input class="form-control" type="text" name="nombre" value="<?php echo (isset($_POST['nombre'])) ?  set_value('nombre') :  $usuario['nombre']; ?>" />	
		</div>
		<div class="form-group">
		<h5>Apellidos:</h5>
		<?php echo form_error('apellidos'); ?>
		<input class="form-control" type="text" name="apellidos" value="<?php echo (isset($_POST['apellidos'])) ?  set_value('apellidos') :  $usuario['apellidos']; ?>" />	
		
		<h5>DNI:</h5>
		<?php echo form_error('dni'); ?>
		<input class="form-control" type="text" name="dni" value="<?php echo (isset($_POST['dni'])) ?  set_value('dni') :  $usuario['dni']; ?>" />	
		</div>
		<div class="form-group">
		<h5>Direccion:</h5>
		<?php echo form_error('direccion'); ?>
		<input class="form-control" type="text" name='direccion' value="<?php echo (isset($_POST['direccion'])) ?  set_value('direccion') :  $usuario['direccion']; ?>" />
		
		<h5>Codigo Postal:</h5>
		<?php echo form_error('cp'); ?>
		<input class="form-control" type="text" name="cp" value="<?php echo (isset($_POST['cp'])) ?  set_value('cp') :  $usuario['cp']; ?>" />	
		</div>
		<div class="form-group">
		<h5>Provincia:</h5>
		<?php echo form_error('provincias'); ?>
		<?php echo form_dropdown('provincias',formatoArraySelect($provincias, $dafault=['00'=>'Seleccione una provincia'])); ?>
		</div>

		<div><input type="submit" class="mt-3 btn btn-primary" value="Submit" /></div>
		</form>
		</div>
	</div>
</body>
</html>