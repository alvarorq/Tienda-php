<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Page Title</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" media="screen" href="main.css">
</head>
<body>

   <table>
      <?php foreach($pedido as $datos){ ?>
         <tr>
            <th>ID</th>
            <td><?= $datos->idPedidos ?></td>
         </tr>
         <tr>
            <th>Id-Usuario</th>
            <td><?= $datos->idUsuario ?></td>
         </tr><tr>
            <th>Nombre</th>
            <td><?= $datos->nombre ?></td>
         </tr>
         <tr>
            <th>apellidos</th>
            <td><?= $datos->apellidos ?></td>
         </tr>
         <tr>
            <th>DNI</th>
            <td><?= $datos->dni ?></td>
         </tr>
         <tr>
            <th>Provincia</th>
            <td><?= $datos->provincia ?></td>
         </tr>
      <?php } 
      foreach($lineaspedido as $linea){ ?>
         <tr>
            <th><?=$linea->codigoProducto->nombre;?></th>
            <td><div class="media border p-3 col-6">
               <img src="<?= base_url().$linea->codigoProducto->imagen; ?>" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
               <div class="media-body">
                  <h4><?= $linea->codigoProducto->descripcion; ?></h4>
                  <p>Cantidad: <?=$linea->cantidad;?></p>
                  <p><?= $linea->subTotal; ?>€</p>      
               </div>
            </div>
            </td>
         </tr>
      <?php } ?>
   </table>
</body>
</html>