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
            
        <div class="row contenido">
            
            <?php foreach ($productos as $producto) { ?>
                <div class="card col-md-3 col-12" >
                    <img src="<?= base_url().$producto->imagen; ?>" class="card-img-top" alt="<?= $producto->nombre; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $producto->nombre; ?></h5>
                        <p class="card-text"><?= $producto->descripcion; ?></p>
                        <p class="card-text"><?= $producto->precio; ?>€</p>
                        <a href="<?= base_url();?>index.php/inicio_ctrl/detallesproductos/<?= $producto->codigoProducto; ?>" class="btn btn-primary"> Detalles</a>
                    </div>
                </div>
            <?php } ?>
            
            
          
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php  echo $this->pagination->create_links();?>
            </ul>
        </nav>
    </div>
</body>
</html>