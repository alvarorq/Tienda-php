<?php
/**
@author Alvaro <alvarorq7@gmail.com>
@version 1.0.0
@date 06/02/2019
@lastChanges 09/02/2019
*/

class Usuario_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        /**
         * Comprobar si el usuario ha iniciado sesion, devolviendo los datos en caso afirmativo o en otro caso false
         *
         * @return boolean
         */
        public function estaDentro(){
                
        }

        /**
         * Validar si el usuario es correcto e iniciar la sesion 
         *
         * @param [array] $datos
         * @return boolean
         */
        public function autenticarUsuario($datos){
                
                echo '<pre>';
                print_r($datos);
                echo '</pre>';

                $usuario = $this->db->get('usuarios',array('nickName'=>$datos['usuario'],'password'=>$datos['logpass']));
                $resultados = $this->db->count_all_results('usuarios',array('nickName'=>$datos['usuario'],'password'=>$datos['logpass']));

                if($resultados != 0){
                        $iniciar=[
                                'logeado'=>TRUE,
                                'entra'=>'Ha entrado pisha',
                                'usuario'=>$usuario->result()
                        ];

                        $this->session->set_userdata($iniciar);
                        return TRUE;
                }else{
                        return FALSE;
                }


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