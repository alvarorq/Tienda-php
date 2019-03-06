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

        $query = $this->db->get_where('productos', array('visible' => 1, 'stock >'=> 0));
        
        foreach ($query->result() as $producto) {
            $producto->precio=$this->getDescuentosiva($producto->descuento,$producto->iva,$producto->precio);
        }

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
        
        $query = $this->db->get_where('productos', array('visible' => 1, 'destacado' => 1, 'stock >'=> 0));
        
        foreach ($query->result() as $producto) {
            $producto->precio=$this->getDescuentosiva($producto->descuento,$producto->iva,$producto->precio);
        }

        return $query->result();
    }

    /**
     * Obtener un unico producto
     *
     * @return array()
     */
    public function getproducto($id){
        $query = $this->db->get_where('productos',array('codigoProducto'=> $id, 'stock >'=> 0));
        
        foreach ($query->result() as $producto) {
            $producto->precio=$this->getDescuentosiva($producto->descuento,$producto->iva,$producto->precio);
        }

        return $query->result();
    }

    public function getStockProducto($id){
        $query=$this->db->get_where('productos',array('codigoProducto'=>$id));
        $producto=$query->result();
        $stock=$producto[0]->stock;
        return $stock;
    }

    /**
     * Obtener productos pertenecientes a la categoria pasada por parametro
     *
     * @param [int] $cat
     * @return array()
     */
    public function getporcatego($cat){
        $query = $this->db->get_where('productos',array('Categoria'=> $cat, 'visible' => 1, 'stock >'=> 0));

        foreach ($query->result() as $producto) {
            $producto->precio=$this->getDescuentosiva($producto->descuento,$producto->iva,$producto->precio);
        }

        return $query->result();
    }

    public function getDescuentosiva($descuento, $iva, $precio){

        $precioiva=$precio*0.21;
        if($descuento>0){
        $preciodescuento=$precio/$descuento;}
        else{
            $preciodescuento=0;
        }
        $preciofin=$precioiva + $preciodescuento+$precio;
        if($this->session->userdata('current_divisa')==null){
            $preciofin*=$this->session->userdata('monedas')['EUR'];
            $this->session->set_userdata('current_divisa','EUR');
        }else{
            $preciofin*=$this->session->userdata('monedas')[$this->session->userdata('current_divisa')];
        }
        return $preciofin;
    }

}
