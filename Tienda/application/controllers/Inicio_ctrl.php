<?php
/**
@author Alvaro <alvarorq7@gmail.com>
@version 1.0.0
*/

class Inicio_ctrl extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('productos_model');
        $this->load->model('categorias_model');
    }

    /**
     * Facilitamos los productos destacados a la vista
     */
    public function index(){
        $this->carrito->micarro();
        $this->load->view('inicio_view',[
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'productos'=>$this->productos_model->getdestacados()]);
    }

    /**
     * Facilitamos todos los productos visibles de la base de datos a la vista
     */
    public function todos(){
        $this->load->view('inicio_view',[
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()]),
            'productos'=>$this->productos_model->getproductos()
            ]);
    }

    /**
     * Destalles de un solo producto
     *
     * @param [int] $id
     */
    public function detallesproductos($id){
        $this->load->view('detallesproducto', [
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()]),
            'producto'=>$this->productos_model->getproducto($id)
        ]);
    }
}
