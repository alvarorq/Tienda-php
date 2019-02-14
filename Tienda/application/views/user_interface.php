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
      <?php foreach($usuario as $datos){ ?>
         <tr>
            <th>Nombre</th>
            <td><?= $datos->nombre ?></td>
         </tr>
         <tr>
            <th>Apellidos</th>
            <td><?= $datos->apellidos ?></td>
         </tr><tr>
            <th>DNI</th>
            <td><?= $datos->dni ?></td>
         </tr>
         <tr>
            <th>Direccion</th>
            <td><?= $datos->direccion ?></td>
         </tr>
         <tr>
            <th>Codigo Postal</th>
            <td><?= $datos->cp ?></td>
         </tr>
         <tr>
            <th>Provincia</th>
            <td><?= $datos->provincia ?></td>
         </tr>

         <tr>
            <th></th>
            <td><a href="<?=site_url('usuario_ctrl/actualizarDatos');?>" class="btn btn-success">Modificar</a></td>
         </tr>
      <?php } ?>  
   </table>
</body>
</html>