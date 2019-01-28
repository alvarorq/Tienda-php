<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <header>
        <div class="menu">
            <h1>Hola mundo</h1>
            <p>Tienda de componentes informaticos</p>
            <h1>Tienda PHP</h1>
            <a href="<?= site_url('inicio_ctrl/todos')?>">Todos</a>
            <a href="<?= site_url();?>">Destacados</a>
            <a href="<?= site_url('Carrito_ctrl/vercarro')?>">CARRITO</a>
        </div>
    </header>
    
</body>
</html>