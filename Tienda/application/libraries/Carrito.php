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
        $this->CI = get_instance();  
        $this->CI->session->set_userdata($lineaspedido[]);
    }

    /**
     * Facilitamos los productos destacados a la vista
     */
    public function micarro(){
        echo '<p>'.$this->CI->session->userdata('datos');
    }

    /**
     * Añadir producto al carrito de la compra
     */
    public function addcarro($linea){
        $this->CI->session->set_userdata($lineaspedido[$linea]);
    }
    
    /**
     * Borrar producto del carrito de la compra
     */
    public function removecarro(){

    }
}