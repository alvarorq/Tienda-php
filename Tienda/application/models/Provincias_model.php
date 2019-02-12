<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.0
* @date 05/02/2019
* @lastChanges 07/02/2019
*/

class Provincias_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

/**
 * Obtener las provincias para el formulario
 *
 * @return array()
 */
    public function getprovincias()
    {
        $query = $this->db->get('provincias');
        return $query->result();
    }

}