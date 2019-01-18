<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tienda PHP - Pruebas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Tienda PHP</h1>
    <a href="<?= base_url();?>/index.php/inicio_ctrl/todos">Todos</a>
    <a href="http://localhost/DWES/framework/CodeIgniter/">Destacados</a>
    <table border=solid>
    <tr>
    <th>Nombre</th>
    <th>Descripcion</th>
    <th>Precio</th>
    <th>Stock</th>
    <th>Visible</th>
    </tr>
    <?php foreach ($productos as $producto) { ?>
        <tr>
            <td><?= $producto->nombre ?></td>
            <td><?= $producto->descripcion ?></td>
            <td><?= $producto->precio ?></td>
            <td><?= $producto->stock ?></td>
            <td><?= $producto->visible ?></td>
        </tr>
    <?php } ?>
    </table>
</body>
</html>