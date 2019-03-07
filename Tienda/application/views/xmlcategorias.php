<?php header('Content-Disposition: attachment; filename="categorias.xml"');
 


echo "<categorias>";

foreach($categorias as $categoria){

    echo "<categoria>";
        echo "<codigoCategoria>".$categoria->codigoCategoria."</codigoCategoria>";
        echo "<categoria>".$categoria->categoria."</categoria>";
        echo "<descripcion>".$categoria->descripcion."</descripcion>";
        echo "<visible>".$categoria->visible."</visible>";
    echo "</categoria>";
}
echo "</categorias>";

?>