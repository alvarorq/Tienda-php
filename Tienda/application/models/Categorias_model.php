<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.0
* @date 20/01/2019
* @lastChanges 05/02/2019
*/

class Categorias_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

/**
 * Obtener las cotegorias existentes
 *
 * @return array()
 */
    public function getcategorias()
    {
        $query = $this->db->get_where('categorias', array('visible' => 1));
        return $query->result();
    }
}