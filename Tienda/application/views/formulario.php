<?php
/**
@author Alvaro <alvarorq7@gmail.com>
@version 1.0.0
@lastChanges 06/02/2019
*/

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

	<?php echo form_open('formulario_ctrl/form'); ?>

	<h5>Username:</h5>
	<?php echo form_error('username'); ?>
	<input type="text" name="username" value="<?php echo set_value('username'); ?>" />

	<h5>Password:</h5>
	<?php echo form_error('password'); ?>
	<input type="text" name="password" value="<?php echo set_value('password'); ?>" />

	<h5>Password Confirm:</h5>
	<?php echo form_error('passconf'); ?>
	<input type="text" name="passconf" value="<?php echo set_value('passconf'); ?>" />

	<h5>Email Address:</h5>
	<?php echo form_error('email'); ?>
	<input type="text" name="email" value="<?php echo set_value('email'); ?>" />	
	
	<h5>Nombre:</h5>
	<?php echo form_error('nombre'); ?>
	<input type="text" name="nombre" value="<?php echo set_value('nombre'); ?>" />	
	
	<h5>Apellidos:</h5>
	<?php echo form_error('apellidos'); ?>
	<input type="text" name="apellidos" value="<?php echo set_value('apellidos'); ?>" />	
	
	<h5>DNI:</h5>
	<?php echo form_error('dni'); ?>
	<input type="text" name="dni" value="<?php echo set_value('dni'); ?>" />	
	
	<h5>Direccion:</h5>
	<?php echo form_error('direccion'); ?>
	<input type="text" name='direccion' value="<?php echo set_value('direccion'); ?>" />
	
	<h5>Codigo Postal:</h5>
	<?php echo form_error('cp'); ?>
	<input type="text" name="cp" value="<?php echo set_value('cp'); ?>" />	
	
	<h5>Provincia:</h5>
	<?php echo form_error('provincias'); ?>
	<?php echo form_dropdown('provincias',formatoArraySelect($provincias, $dafault=['00'=>'Seleccione una provincia'])); ?>
	

	<div><input type="submit" value="Submit" /></div>
	</form>

</body>
</html>