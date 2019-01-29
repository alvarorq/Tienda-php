<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.1
* @date 25/1/2019
*/

class Carrito_ctrl extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('categorias_model');
    }

    /**
     * Facilitamos los productos destacados a la vista
     */
    public function vercarro(){
        //$this->cart->destroy();
        
        $this->load->view('carrito_view',[
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()])
            ]);
    }
}