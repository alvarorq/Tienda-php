<?php
/**
@author Alvaro <alvarorq7@gmail.com>
@version 1.0.0
@date 06/02/2019
@lastChanges 07/02/2019
*/

class Usuario_model extends CI_Model {

        public function __construct()
        {
                $this->db->db_select('default');
                $this->load->database();
        }

        /**
         * Insertar un nuevo usuario
         *
         * @param (array) $datos
         * 
         */
        public function setUsuario($datos)
        {
                $usuario=[
                        'nickName' => $datos['username'],
                        'password' => $datos['password'],
                        'email' => $datos['email'],
                        'nombre' => $datos['nombre'],
                        'apellidos' => $datos['apellidos'],
                        'dni' => $datos['dni'],
                        'direccion' => $datos['direccion'],
                        'cp' => $datos['cp'],
                        'provincia' => $datos['provincias'],
                        'estado' => '1',
                ];


                $query = $this->db->insert('usuarios',$usuario);
        }

}