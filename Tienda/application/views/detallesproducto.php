<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tienda PHP - Pruebas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container">
        <div class="row contenido">
            <?php foreach ($producto as $detalles) { ?>
                <div class="col-md-3 col-12" >
                    <img src="<?= base_url().$detalles->imagen; ?>" class="card-img-top" alt="<?= $detalles->nombre; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $detalles->nombre; ?></h5>
                        <p class="card-text"><?= $detalles->descripcion; ?></p>
                        <p class="card-text"><?= $detalles->precio.' '.$this->session->userdata('current_divisa');?></p>
                        <?php echo form_open('inicio_ctrl/addcarro'); ?>
                        <input type="hidden" name="idproduc" id="idproduc" value="<?=$detalles->codigoProducto;?>">
                        <p>Cant. </p><input type="number" name="cantidad" id="cantidad" value="<?php if(set_value('cantidad')){echo set_value('cantidad');}else{echo '1';}; ?>"><?php echo form_error('cantidad'); ?>
                        <hr>
                        <input class="btn btn-primary" type="submit" value="Al carrito">
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</body>
</html>