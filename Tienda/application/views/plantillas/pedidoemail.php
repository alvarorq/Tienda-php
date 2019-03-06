<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Page Title</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <style type="text/css">
      body,
      html, 
      .body {
         background: #f3f3f3 !important;
      }
   </style>
</head>
<body>


<!-- move the above styles into your custom stylesheet -->

<spacer size="16"></spacer>

<container>

  <spacer size="16"></spacer>

  <row>
    <columns>
      <h1>Thanks for your order.</h1>
      <p>Thanks for shopping with us! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad earum ducimus, non, eveniet neque dolores voluptas architecto sed, voluptatibus aut dolorem odio. Cupiditate a recusandae, illum cum voluptatum modi nostrum.</p>

      <spacer size="16"></spacer>
      <?php foreach($pedido as $datos){ ?>
      <callout class="secondary">
        <row>
          <columns large="6">
            <p>
              <strong>Metodo de pago</strong><br/>
              Transferencia Bancaria
            </p>
            <p>
              <strong>Direccion de Correo</strong><br/>
              <?= $this->session->userdata('usuario')[0]->email;?>
            </p>
            <p>
              <strong>ID Pedido</strong><br/>
              <?= $datos->idPedidos ?>
            </p>
          </columns>
          <columns large="6">
            <p>
              <strong>Metodo de Envio</strong><br/>
              Correos (1&ndash;2 semanas)<br/>
              <strong>Direccion de envio</strong><br/>
               <?= '<p>'.$datos->nombre.' ' ?><?= $datos->apellidos ?>
               <?='<p>DNI: '. $datos->dni ?>
               <?= '<p>Direccion: '.$datos->direccion ?>
               <?= $datos->provincia ?>, <?= $datos->cp ?>
            </p>
          </columns>
        </row>
      </callout>
      <?php } $total=0;
?>
      <h4>Order Details</h4>

      <table border="solid">
        <tr><th>Item</th><th>Cantidad</th><th>Price</th></tr>
         
         <?php foreach($lineaspedido as $linea){ ?>
      
            <tr><td><?=$linea->codigoProducto->nombre;?></td><td><?=$linea->cantidad;?></td><td><?php echo $linea->subTotal.' '.$this->session->userdata('current_divisa'); $total+=$linea->subTotal; ?></td></tr>
         
         <?php }?>

        <tr>
          <td colspan="2"><b>TOTAL:</b></td>
          <td><?= $total.' '.$this->session->userdata('current_divisa'); ?></td>
        </tr>
      </table>

      <hr/>

      <h4>What's Next?</h4>

      <p>Our carrier raven will prepare your order for delivery. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi necessitatibus itaque debitis laudantium doloribus quasi nostrum distinctio suscipit, magni soluta eius animi voluptatem qui velit eligendi quam praesentium provident culpa?</p>
    </columns>
  </row>
  <row class="footer text-center">
    <columns large="3">
      <img src="http://placehold.it/170x30" alt="">
    </columns>
    <columns large="3">
      <p>
        Call us at 800.555.1923<br/>
        Email us at support@discount.boat
      </p>
    </columns>
    <columns large="3">
      <p>
        123 Maple Rd<br/>
        Campbell, CA 95112
      </p>
    </columns>
  </row>
</container>
</body>
</html>