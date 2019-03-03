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
         <a href="<?=site_url('usuario_ctrl/actualizarDatos');?>" class="btn btn-success ml-2">Modificar Datos usuario</a></td>
      </div>

      <table class="col-8 table-bordered table-hover ">
         <?php foreach($usuario as $datos){ ?>
            <tr>
               <th class="col-2 table-secondary">Email</th>
               <td class="col-5 text-center"><?= $datos->email ?></td>
            </tr>
            <tr>
               <th class="col-2 table-secondary">Nombre</th>
               <td class="col-5 text-center"><?= $datos->nombre ?></td>
            </tr>
            <tr>
               <th class="col-2 table-secondary">Apellidos</th>
               <td class="col-5 text-center"><?= $datos->apellidos ?></td>
            </tr><tr>
               <th class="col-2 table-secondary">DNI</th>
               <td class="col-5 text-center"><?= $datos->dni ?></td>
            </tr>
            <tr>
               <th class="col-2 table-secondary">Direccion</th>
               <td class="col-5 text-center"><?= $datos->direccion ?></td>
            </tr>
            <tr>
               <th class="col-2 table-secondary">Codigo Postal</th>
               <td class="col-5 text-center"><?= $datos->cp ?></td>
            </tr>
            <tr>
               <th class="col-2 table-secondary">Provincia</th>
               <td class="col-5 text-center"><?= $datos->provincia ?></td>
            </tr>

         <?php } ?>  
      </table>
      <a href="<?=site_url('usuario_ctrl/darDebaja');?>" class="btn btn-danger mt-2">Dar de baja</a>
   </div>
</body>
</html>