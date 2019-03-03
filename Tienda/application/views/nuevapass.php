<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Page Title</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
                    <?php echo form_open('usuario_ctrl/resetPassword'); ?>
                        <div class="form-inline" action="">
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <input type="submit" class="btn btn-success" value="Login">
                        
                        <br>
                        <?php echo form_error('usuario'); ?> 
                        <?php 
                           if(isset($error)){echo $error;}
                           if(isset($success)){echo $success;}
                        ?>
                    </form>
</body>
</html>