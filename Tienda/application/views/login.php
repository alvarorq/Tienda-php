<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Page Title</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
        <div class="container">
                    <?php echo form_open('usuario_ctrl/iniciarSesion'); ?>
                        <div class="form-inline mt-5" action="">
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" name="usuario" placeholder="Ususario">
                        </div>
                        <div class="input-group ml-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">*</span>
                        </div>
                        <input type="password" class="form-control" name="logpass" placeholder="Contraseña">
                        </div>
                        <input type="submit" class="btn btn-success ml-4" value="Login">
                        <a href="<?=site_url('usuario_ctrl/resetPassword');?>" class="ml-4 btn btn-primary">¿Has olvidado tu Contraseña?</a>
                        </div>
                        <br>
                        <?php echo form_error('usuario'); ?> 
                        <?php echo form_error('logpass'); ?>
                    </form>
        </div>
</body>
</html>