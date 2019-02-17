<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Page Title</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" media="screen" href="main.css">
   <script src="main.js"></script>
</head>
<body>

   <table>
      <tr>
         <th>Nombre</th>
         <th>Fecha</th>
         <th>Direccion</th>
      </tr>
      <?php foreach($pedidos as $pedido){ ?>
         <tr>
            <td><?= $pedido->nombre ?></td>      
            <td><?= $pedido->fechaCreacion ?></td>
            <td><?= $pedido->direccion ?></td>
            <td><a href="<?=site_url('pedido_ctrl/detallesPedido/'.$pedido->idPedidos);?>" class="btn btn-success">Detalles</a></td>
            
         </tr>
      <?php } ?>
   </table>
</body>
</html>