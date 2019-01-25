<?php
/**
@author Alvaro <alvarorq7@gmail.com>
@version 1.0.0
@date 25/1/2019
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito {

    protected $CI;

    public function __construct(){
        $this->CI =get_instance();  
    }

    /**
     * Facilitamos los productos destacados a la vista
     */
    public function micarro(){
        $this->CI->session->set_userdata('dato','PRUEBA DE LIBRERIA');
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