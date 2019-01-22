<?php
/**
@author Alvaro <alvarorq7@gmail.com>
@version 1.0.0
*/

class Pruebas extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('news_model');
    }

    /**
     * Facilitamos los datos del modelo a la vista
     */
    public function index(){
        $this->load->view('plantillas/menu_categorias',['categorias'=>$this->news_model->prueba()]);
    }
}