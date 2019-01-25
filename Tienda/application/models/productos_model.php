<?php
/**
@author Alvaro <alvarorq7@gmail.com>
@version 1.0.0
*/

class Productos_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

/**
 * Obtener los productos que sean visibles
 *
 * @return array()
 */
    public function getproductos()
    {
        $query = $this->db->get_where('productos', array('visible' => 1));
        return $query->result();
    }

/**
 * Obtener los productos destacados 
 *
 * @return array()
 */
    public function getdestacados()
    {
        $query = $this->db->get_where('productos', array('visible' => 1, 'destacado' => 1));
        return $query->result();
    }

    /**
     * Obtener un unico producto
     *
     * @return array()
     */
    public function getproducto($id){
        $query = $this->db->get_where('productos',array('codigoProducto'=> $id));
        return $query->result();
    }

}