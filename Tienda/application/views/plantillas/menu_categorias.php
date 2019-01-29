<div class="izq">
    <p><strong>Categorias:</strong></p>
    <ul>
        <?php foreach ($categorias as $categoria) { ?>
        <li><a href="<?=site_url('inicio_ctrl/porcatego/'.$categoria->codigoCategoria);?>"><?= $categoria->categoria?></a></li>
        <?php  } ?>
    </ul>
</div>