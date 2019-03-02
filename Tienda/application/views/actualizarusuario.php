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

	<?php echo form_open('Usuario_ctrl/actualizarDatos'); ?>

	<h5>Username:</h5>
	<?php echo form_error('username'); ?>
	<input type="text" name="username" value="<?php echo(isset($_POST['username'])) ?  set_value('username') :  $usuario['nickName']; ?>" />

	<h5>New Password:</h5>
	<?php echo form_error('password'); ?>
	<input type="text" name="password" value="<?php echo (isset($_POST['password'])) ?  set_value('password') :  ''; ?>" />

	<h5>Email Address:</h5>
	<?php echo form_error('email'); ?>
	<input type="text" name="email" value="<?php echo (isset($_POST['email'])) ?  set_value('email') :  $usuario['email']; ?>" />	
	
	<h5>Nombre:</h5>
	<?php echo form_error('nombre'); ?>
	<input type="text" name="nombre" value="<?php echo (isset($_POST['nombre'])) ?  set_value('nombre') :  $usuario['nombre']; ?>" />	
	
	<h5>Apellidos:</h5>
	<?php echo form_error('apellidos'); ?>
	<input type="text" name="apellidos" value="<?php echo (isset($_POST['apellidos'])) ?  set_value('apellidos') :  $usuario['apellidos']; ?>" />	
	
	<h5>DNI:</h5>
	<?php echo form_error('dni'); ?>
	<input type="text" name="dni" value="<?php echo (isset($_POST['dni'])) ?  set_value('dni') :  $usuario['dni']; ?>" />	
	
	<h5>Direccion:</h5>
	<?php echo form_error('direccion'); ?>
	<input type="text" name='direccion' value="<?php echo (isset($_POST['direccion'])) ?  set_value('direccion') :  $usuario['direccion']; ?>" />
	
	<h5>Codigo Postal:</h5>
	<?php echo form_error('cp'); ?>
	<input type="text" name="cp" value="<?php echo (isset($_POST['cp'])) ?  set_value('cp') :  $usuario['cp']; ?>" />	
	
	<h5>Provincia:</h5>
	<?php echo form_error('provincias'); ?>
	<?php echo form_dropdown('provincias',formatoArraySelect($provincias, $dafault=['00'=>'Seleccione una provincia'])); ?>
	

	<div><input type="submit" value="Submit" /></div>
	</form>

</body>
</html>