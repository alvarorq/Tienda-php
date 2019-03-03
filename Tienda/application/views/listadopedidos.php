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
      <table class="mt-4 col-12 table table-bordered table-hover text-center">
         <thead class="thead-dark">
            <tr>
               <th>Nombre</th>
               <th>Fecha</th>
               <th>Direccion</th>
               <th>Estado</th>
               <th>Ver detalles</th>
            </tr>
         </thead>
         <?php foreach($pedidos as $pedido){ ?>
            <tr>
               <td><?= $pedido->nombre ?></td>      
               <td><?= $pedido->fechaCreacion ?></td>
               <td><?= $pedido->direccion ?></td>
               <td class="table-info"><?php switch($pedido->estado){
                           case 'E': echo "Pendiente de Procesado   "; echo '<a href="'.site_url('pedido_ctrl/cancelarPedido/'.$pedido->idPedidos).'" class="btn btn-danger">Cancelar</a>'; break;
                           case 'P': echo 'En transito'; break;
                           case 'R': echo 'Entregado'; break;
                           case 'A': echo 'Anulado'; break;
                           default: echo 'Pendiente de envio'; break;
                           
                        }
                     ?>
               <td>
                  <a href="<?=site_url('pedido_ctrl/detallesPedido/'.$pedido->idPedidos);?>" class="mr-1 btn btn-primary">Detalles</a>
                  <a href="<?=site_url('pedido_ctrl/verPDF/'.$pedido->idPedidos);?>" class="ml-1 btn btn-info">PDF</a>      
               </td>
               
            </tr>
         <?php } ?>
      </table>
   </div>
</body>
</html>