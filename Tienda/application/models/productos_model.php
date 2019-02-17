<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.0
* @date 20/01/2019
* @lastChanges 29/02/2019
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
    public function getproductos($inicio=false, $limite=false)
    {
        if($inicio!==FALSE && $limite!==FALSE){
            $this->db->limit($limite, $inicio);
        }

        $query = $this->db->get_where('productos', array('visible' => 1));
        return $query->result();
    }

    /**
     * Obtener los productos destacados 
     *
     * @return array()
     */
    public function getdestacados($inicio=false, $limite=false)
    {
        if($inicio!==FALSE && $limite!==FALSE){
            $this->db->limit($limite, $inicio);
        }
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

    /**
     * Obtener productos pertenecientes a la categoria pasada por parametro
     *
     * @param [int] $cat
     * @return array()
     */
    public function getporcatego($cat){
        $query = $this->db->get_where('productos',array('Categoria'=> $cat, 'visible' => 1));
        return $query->result();
    }
}