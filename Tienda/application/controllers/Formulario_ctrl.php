<?php
/**
@author Alvaro <alvarorq7@gmail.com>
@version 1.0.0
*/

class Formulario_ctrl extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    /**
     * Validacion del formulario mediante las reglas(rules) establecidas
     */
    public function form(){
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('dni', 'Dni', 'required|exact_length[9]|callback_validardni');

        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('formulario',[
                'plantilla'=>$this->load->view('plantillas/plantilla')
                ]);
        }
        else
        {
            $this->load->view('inicio_view',[
                'plantilla'=>$this->load->view('plantillas/plantilla')
                ]);
        }
    }


    /**
     * Validacion del DNI y el mensaje de error
     *
     * @param [String] $dni
     * @return Boolean
     */
    public function validardni($dni){
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        $letra=substr($dni,-1);
        $num=substr($dni,0,-1);

        if($num<=0 || $num>99999999 || ctype_digit($num) || substr($letras,$num%23, 1) !=$letra){
            
            $this->form_validation->set_message('validardni', 'El {field} introducido no es valido');
            return false;
        }else {
            echo substr($letras,$num%23, 1);

            return true;
        }

    }
}