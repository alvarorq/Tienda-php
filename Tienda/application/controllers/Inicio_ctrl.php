<?php
/**
@author Alvaro <alvarorq7@gmail.com>
@version 1.0.0
*/

class Inicio_ctrl extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('productos_model');
    }

    /**
     * Facilitamos los datos del modelo a la vista
     */
    public function index(){
        $this->load->view('inicio_view',['productos'=>$this->productos_model->getdestacados()]);
    }

    public function todos(){
        $this->load->view('inicio_view',['productos'=>$this->productos_model->getproductos()]);
    }
}
