<?php header('Content-Disposition: attachment; filename="productos.xml"');
 


echo "<productos>";

foreach($productos as $producto){

    echo "<productos>";
        echo "<codigoProducto>".$producto->codigoProducto."</codigoProducto>";
        echo "<nombre>".$producto->nombre."</nombre>";
        echo "<descripcion>".$producto->descripcion."</descripcion>";
        echo "<precio>".$producto->precio."</precio>";
        echo "<descuento>".$producto->descuento."</descuento>";
        echo "<imagen>".$producto->imagen."</imagen>";
        echo "<iva>".$producto->iva."</iva>";
        echo "<stock>".$producto->stock."</stock>";
        echo "<Categoria>".$producto->Categoria."</Categoria>";
        echo "<visible>".$producto->visible."</visible>";
        echo "<destacado>".$producto->destacado."</destacado>";
        echo "<fechainicio>".$producto->fechainicio."</fechainicio>";
        echo "<fechafin>".$producto->fechafin."</fechafin>";
    echo "</productos>";
}
echo "</productos>";

?>