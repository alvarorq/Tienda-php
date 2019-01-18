<?php
class News_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }


    public function prueba()
    {
        $query = $this->db->get('usuarios');
        return $query->result_array();
    }
}