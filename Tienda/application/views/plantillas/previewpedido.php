<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Page Title</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
   <div class="container">
   <h3>Este es el resumen de su pedido:</h3>
      <table class="mt-3 col-8 table table-bordered table-hover ">
         
            <tr>
               <th class="col-2 table-secondary">Nombre</th>
               <td><?= $datosusuario->nombre ?></td>
            </tr>
            <tr>
               <th class="col-2 table-secondary">apellidos</th>
               <td><?= $datosusuario->apellidos ?></td>
            </tr>
            <tr>
               <th class="col-2 table-secondary">DNI</th>
               <td><?= $datosusuario->dni ?></td>
            </tr>
            <tr>
               <th class="col-2 table-secondary">Provincia</th>
               <td><?= $datosusuario->provincia ?></td>
            </tr>
            
         <?php 
         foreach($this->cart->contents() as $linea){ ?>
            <tr>
               <th class="col-2 table-info"><?=$linea['name'];?></th>
               <td><div class="media">
                  <img src="<?= base_url().$linea['imagen']; ?>" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                  <div class="media-body">
                     <h4><?= $linea['name']; ?></h4>
                     <p>Cantidad: <?=$linea['qty'];?> | Subtotal: <?= $linea['subtotal'].' '.$this->session->userdata('current_divisa');?></p>
                  </div>
               </div>
               </td>
            </tr>
         <?php } ?>
         <tr>
            <th class="col-2 table-success">Total</th>
            <td><?= $this->cart->total() ?><?= ' '.$this->session->userdata('current_divisa'); ?></td>
         </tr>   
      </table>
      <a href="<?= site_url('Carrito_ctrl/vercarro')?>" class="btn btn-danger mt-2">Cancelar</a>
      <a href="<?=site_url('pedido_ctrl/tramitar');?>" class="btn btn-success mt-2">Tramitar</a>
   </div>
</body>
</html>