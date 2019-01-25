<?php
/**
@author Alvaro <alvarorq7@gmail.com>
@version 1.0.0
@date 25/1/2019
*/

class Carrito_ctrl extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    /**
     * Facilitamos los productos destacados a la vista
     */
    public function vercarro(){
        $this->load->view('carrito_view',[
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            ]);
    }

    /**
     * Añadir producto al carrito de la compra
     */
    public function addcarro(){

    }
    
    /**
     * Borrar producto del carrito de la compra
     */
    public function removecarro(){

    }
}