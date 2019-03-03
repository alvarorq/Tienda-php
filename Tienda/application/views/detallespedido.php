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

      <div class="mt-3 mb-2">
         <a href="<?=site_url('pedido_ctrl/pedidosRealizados');?>" class="btn btn-primary">Pedidos Realizados</a>
      </div>

      <table class="mt-3 col-8 table table-bordered table-hover ">
         <?php foreach($pedido as $datos){ ?>
            <tr>
               <th class="col-2 table-secondary">ID Pedido</th>
               <td><?= $datos->idPedidos ?></td>
            </tr>
            <tr>
               <th class="col-2 table-secondary">Nombre</th>
               <td><?= $datos->nombre ?></td>
            </tr>
            <tr>
               <th class="col-2 table-secondary">apellidos</th>
               <td><?= $datos->apellidos ?></td>
            </tr>
            <tr>
               <th class="col-2 table-secondary">DNI</th>
               <td><?= $datos->dni ?></td>
            </tr>
            <tr>
               <th class="col-2 table-secondary">Direccion</th>
               <td><?= $datos->direccion ?></td>
            </tr>
            <tr>
               <th class="col-2 table-secondary">Provincia</th>
               <td><?= $datos->provincia ?></td>
            </tr>
   
         <?php } $total=0;
         foreach($lineaspedido as $linea){ ?>
            <tr>
               <th class="col-2 table-info"><?=$linea->codigoProducto->nombre;?></th>
               <td><div class="media">
                  <img src="<?= base_url().$linea->codigoProducto->imagen; ?>" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                  <div class="media-body">
                     <h4><?= $linea->codigoProducto->descripcion; ?></h4>
                     <p>Cantidad: <?=$linea->cantidad;?> | Subtotal<?php echo $linea->subTotal; $total+=$linea->subTotal;?>€</p>
                  </div>
               </div>
               </td>
            </tr>
         <?php } ?>
         <tr>
            <th class="col-2 table-success">Total</th>
            <td><?= $total ?>€</td>
         </tr>   
      </table>


   </div>
</body>
</html>