<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.0
* @date 06/02/2019
* @lastChanges 16/02/2019
*/

class Usuario_model extends CI_Model {

        public function __construct()
        {       
                $this->load->database();        
        }

        /**
         * Cierra la sesion del usuario en caso de que este abierta
         *
         * @return boolean
         */
        public function cerrarSesion(){
                if($this->session->userdata('logeado')==TRUE){
                        $this->session->unset_userdata('usuario');
                        $this->session->set_userdata('logeado',FALSE);
                }

        }

        /**
         * Validar si el usuario es correcto e iniciar la sesion 
         *
         * @param [array] $datos
         * @return boolean
         */
        public function autenticarUsuario($datos){
                $usuario = $this->db->get_where('usuarios',array('email'=>$datos['usuario']));
                $resultados = count($usuario->result());
                $pass=$usuario->result();

                if($resultados != 0 && password_verify($datos['logpass'],$pass[0]->password) && $pass[0]->estado!=0){
                        $iniciar=[
                                'logeado'=>TRUE,
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


        /**
         * Dar de baja la cuenta del usuario actualmente logeado, esto solo modifica el estado del usuario para que no le permita logearse
         *
         */
        public function bajaUsuario(){
                $this->db->set('estado',0);
                $this->db->where('idUsuarios',$this->session->userdata('usuario')[0]->idUsuarios);
                $this->db->update('usuarios');
        }

        public function restablecerPassword($datos){
                $newpass=substr(md5(uniqid()), 0, 10);
                $passHash= password_hash($newpass,PASSWORD_DEFAULT);

                $this->db->set('password',$passHash);
                $this->db->where('email',$datos['email']);
                $this->db->update('usuarios');

                $this->email->from('arq12daw@gmail.com', 'Alvaro');
                $this->email->to('alvarorq7@gmail.com');
        
                $this->email->subject('Restablecer Contraseña');
                $this->email->message('Tu contraseña ha sido cambiada por : '.$newpass.' Si deseas volverla a cambiar por favor inicia sesion para cambiarla.');
        
                $this->email->send();
        }

        public function userExist($datos){
                $query = $this->db->get_where('usuarios',array('email'=>$datos['email']));
                $resultados = count($query->result());

                if($resultados!=0){
                        return true;
                }else{
                        return false;
                }
        }

        /**
         * Actualizar los datos del usuario actualmente activo en la sesion mediante los datos obtenidos del formulario
         *
         * @param (array) $datos
         * 
         */
        public function updateUser($datos)
        {
                if(isset($datos['password'])){
                $usuario=array(
                        'nickName' => $datos['username'],
                        'email' => $datos['email'],
                        'password' => $datos['password'],
                        'nombre' => $datos['nombre'],
                        'apellidos' => $datos['apellidos'],
                        'dni' => $datos['dni'],
                        'direccion' => $datos['direccion'],
                        'cp' => $datos['cp'],
                        'provincia' => $datos['provincias'],
                        'estado' => '1',
                );
                }else{
                        $usuario=array(
                                'nickName' => $datos['username'],
                                'email' => $datos['email'],
                                'nombre' => $datos['nombre'],
                                'apellidos' => $datos['apellidos'],
                                'dni' => $datos['dni'],
                                'direccion' => $datos['direccion'],
                                'cp' => $datos['cp'],
                                'provincia' => $datos['provincias'],
                                'estado' => '1',
                        );
                }

                $this->db->where('idUsuarios',$this->session->userdata('usuario')[0]->idUsuarios);
                $this->db->update('usuarios',$usuario);
                $datosusuario = $this->db->get_where('usuarios',array('idUsuarios'=>$this->session->userdata('usuario')[0]->idUsuarios));
                $this->session->set_userdata('usuario',$datosusuario->result());
        }
        
}