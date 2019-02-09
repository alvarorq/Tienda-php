<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>asset/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>asset/css/main.css" />
</head>
<body>
    <header>
        <div class="menu">
            <h1>Hola mundo</h1>
            <p>Tienda de componentes informaticos</p>
            <h1>Tienda PHP</h1>
            <div class="rig">
                <?php if($this->session->userdata('logeado')==!null){ ?>
                    <p>HAS INICIADO SESION</p>
                <?php }else { ?>
                        <a href="<?=site_url('formulario_ctrl/iniciarSesion');?>" class="btn btn-primary">Login</a>
                        <a href="<?=site_url('formulario_ctrl/form');?>" class="btn btn-primary">Resgistrate</a>
                <?php } ?>                
            </div>
            <h3>
            <a href="<?= site_url('inicio_ctrl/todos')?>">Todos</a>
            <a href="<?= site_url();?>">Destacados</a>
            <a href="<?= site_url('Carrito_ctrl/vercarro')?>">Carrito</a>
            </h3>
        </div>
    </header>
    
</body>
</html>