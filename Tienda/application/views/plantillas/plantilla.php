<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>asset/css/main.css" />
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Tienda PHP</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="<?= site_url('inicio_ctrl/todos')?>">Todos <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url();?>">Destacados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('Carrito_ctrl/vercarro')?>">Carrito</a>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <?php if($this->session->userdata('logeado')==!FALSE){ ?>
                    <a href="<?=site_url('usuario_ctrl/verDatos');?>" class="btn btn-success mr-2 my-2 my-sm-0">Panel usuario</a>
                    <a href="<?=site_url('inicio_ctrl/cerrarSesion');?>" class="nav-item btn btn-danger ml-2">Cerrar Sesion</a>
                <?php }else { ?>
                        <a href="<?=site_url('usuario_ctrl/iniciarSesion');?>" class="btn btn-success mr-2 my-2 my-sm-0">Login</a>
                        <a href="<?=site_url('formulario_ctrl/form');?>" class="btn btn-primary ml-2 my-2 my-sm-0">Resgistrate</a>
                <?php } ?> 
            </form>
        </div>
    </nav>
        
    </header>
    
</body>
</html>