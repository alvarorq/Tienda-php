<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tienda PHP - Pruebas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<table cellpadding="3" cellspacing="1" border="1">
        <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Opciones</th>
        </tr>
        <?php foreach ($this->cart->contents() as $items) { ?>
                <tr>
                    <td><?= $items['name'] ;?></td>
                    <td><?= $items['price'] ;?>€</td>
                    <td><?= $items['qty'] ;?></td>
                    <td><?= $items['subtotal'] ;?>€</td>
                    <td><a href="<?= site_url('carrito_ctrl/removecarro').'/'. $items['rowid'];?>">borrar</a></td>
                </tr>      
        <?php } ?>
        <tr>
             <td></td>
             <td></td>
             <td></td>
             <td><strong>Total: <?= $this->cart->total(); ?>€</strong></td>  
             <td><a href="<?= site_url('carrito_ctrl/vaciarCarro');?>">Vaciar</a></td> 
        </tr>
</table>

<a href="<?=site_url('carrito_ctrl/tramitar');?>" class="btn btn-primary">Tramitar</a>

</body>
</html>