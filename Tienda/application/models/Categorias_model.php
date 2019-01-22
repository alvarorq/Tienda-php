<?php
class Categorias_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }


    public function getcategorias()
    {
        $query = $this->db->get('categorias');
        return $query->result();
    }
}