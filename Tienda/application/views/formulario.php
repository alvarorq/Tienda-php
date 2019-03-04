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
		<?php echo form_open('formulario_ctrl/form'); ?>
		
		<h5>Username:</h5>
		<?php echo form_error('username'); ?>
		<input class="form-control" type="text" name="username" value="<?php echo set_value('username'); ?>" />

		<h5>Password:</h5>
		<?php echo form_error('password'); ?>
		<input class="form-control" type="text" name="password" value="<?php echo set_value('password'); ?>" />
		
		<h5>Password Confirm:</h5>
		<?php echo form_error('passconf'); ?>
		<input class="form-control" type="text" name="passconf" value="<?php echo set_value('passconf'); ?>" />

		<h5>Email Address:</h5>
		<?php echo form_error('email'); ?>
		<input class="form-control" type="text" name="email" value="<?php echo set_value('email'); ?>" />	
		
		<h5>Nombre:</h5>
		<?php echo form_error('nombre'); ?>
		<input class="form-control" type="text" name="nombre" value="<?php echo set_value('nombre'); ?>" />	
		
		<h5>Apellidos:</h5>
		<?php echo form_error('apellidos'); ?>
		<input class="form-control" type="text" name="apellidos" value="<?php echo set_value('apellidos'); ?>" />	
		
		<h5>DNI:</h5>
		<?php echo form_error('dni'); ?>
		<input class="form-control" type="text" name="dni" value="<?php echo set_value('dni'); ?>" />	
		
		<h5>Direccion:</h5>
		<?php echo form_error('direccion'); ?>
		<input class="form-control" type="text" name='direccion' value="<?php echo set_value('direccion'); ?>" />
		
		<h5>Codigo Postal:</h5>
		<?php echo form_error('cp'); ?>
		<input class="form-control" type="text" name="cp" value="<?php echo set_value('cp'); ?>" />	
		
		<h5>Provincia:</h5>
		<?php echo form_error('provincias'); ?>
		<?php echo form_dropdown('provincias',formatoArraySelect($provincias, $dafault=['00'=>'Seleccione una provincia'])); ?>
		
		
		<div><input class=" mt-3 btn btn-success" type="submit" value="Submit" /></div>
		</form>

</body>
</html>