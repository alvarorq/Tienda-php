<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xml_model extends CI_Model {

	public function __construct() { 
		$this->load->database(); 
	}

	/**  Método encargado de buscar en la base de datos todas las categorias 
	 * para crear el cual los clientes usaran para navegar entre las distintas categorias*/
	public function getCategorias(){
		$query = $this->db->query("SELECT * FROM categorias");
		return $query->result();
	}

	public function getProductos(){
		$query = $this->db->query("SELECT * FROM productos");
		return $query->result();
	}

	public function importarCategorias($data){
		$result=$this->db->get_where('categorias', array('codigoCategoria' => $data['codigoCategoria']->__toString()))->row();
      
		if(!empty($result)){
			 $this->db
			->where('codigoCategoria', $data['codigoCategoria']->__toString())
		   ->update("categorias", $data);
		}else{
			$this->db->insert('categorias', $data);
		}
		
	}
	
	public function importarProductos($data){
		$result=$this->db->get_where('productos', array('codigoProducto' => $data['codigoProducto']->__toString()))->row();
      
		if(!empty($result)){
			 $this->db
			->where('codigoProducto', $data['codigoProducto']->__toString())
		   ->update("productos", $data);
		}else{
			$this->db->insert('productos', $data);
		}
		
	}
	
	
}