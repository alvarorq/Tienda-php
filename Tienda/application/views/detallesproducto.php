<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tienda PHP - Pruebas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>asset/bootstrap/css/bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <h1>Tienda PHP</h1>
        <a href="<?= base_url();?>index.php/inicio_ctrl/todos">Todos</a>
        <a href="<?= base_url();?>">Destacados</a>
            
        <div class="row contenido">
            <?php foreach ($producto as $detalles) { ?>
                <div class="col-md-3 col-12" >
                    <img src="<?= base_url().$detalles->imagen; ?>" class="card-img-top" alt="<?= $detalles->nombre; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $detalles->nombre; ?></h5>
                        <p class="card-text"><?= $detalles->descripcion; ?></p>
                        <p class="card-text"><?= $detalles->precio; ?>€</p>
                        <p>Cant. </p><input type="number" name="cantidad" id="cantidad">
                        <hr>
                        <a href="<?= site_url('inicio_ctrl/detallesproductos').'/'. $producto->codigoProducto; ?>" class="btn btn-primary"> Al carrito</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>