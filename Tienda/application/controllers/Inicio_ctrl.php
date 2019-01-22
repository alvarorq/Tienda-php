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
     * Facilitamos los datos del modelo a la vista
     */
    public function index(){
        $this->load->view('inicio_view',[
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'productos'=>$this->productos_model->getdestacados()]);
    }

    public function todos(){
        $this->load->view('inicio_view',[
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()]),
            'productos'=>$this->productos_model->getproductos()]);
    }
}
