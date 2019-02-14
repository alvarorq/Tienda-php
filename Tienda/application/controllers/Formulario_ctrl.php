<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.2
* @date 21/01/2019
* @lastChanges 12/02/2019
*/

class Formulario_ctrl extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('productos_model');
        $this->load->model('categorias_model');
        $this->load->model('provincias_model');
        $this->load->model('usuario_model');
    }

    public function iniciarSesion(){
        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required');
        $this->form_validation->set_rules('logpass', 'Logpass', 'trim|required');

        if($this->form_validation->run() == FALSE){
            $this->load->view(
                'login',
                [
                    'plantilla' => $this->load->view('plantillas/plantilla'),
                ]);
        }else{
            $datos = $this->input->post();
            $boleano = $this->usuario_model->autenticarUsuario($datos);
            if($boleano){
                $usuario=$this->session->userdata('usuario')[0];
                $this->load->view('inicio_view',[
                    'plantilla'=>$this->load->view('plantillas/plantilla'),
                    'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()]),
                    'productos'=>$this->productos_model->getdestacados()
                ]);
            }else{
                $this->load->view(
                    inicio_view,
                    [
                        'plantilla' => $this->load->view('plantillas/plantilla'),
                        'usuario' => $this->load->view('platillas/login', ['error'=> '<p>Usuario no encontrado</p>'])
                    ]);
            }   
        }
    }

    /**
     * Validacion del formulario de registro mediante las reglas(rules) establecidas
     */
    public function form(){
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('dni', 'Dni', 'required|exact_length[9]|callback_validardni');
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|required');
        $this->form_validation->set_rules('cp', 'Cp', 'trim|required|exact_length[5]');
        $this->form_validation->set_rules('provincias', 'Provincias', 'callback_provincias_check');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('formulario',[
                'provincias'=>$this->provincias_model->getprovincias(),
                'plantilla'=>$this->load->view('plantillas/plantilla')
            ]);
        }
        else
        {
            $datos = $this->input->post();
            $this->usuario_model->setusuario($datos);
            redirect('inicio_ctrl/index');
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
       
        if(!ctype_digit($num) || ctype_digit($letra) || $num<=0 || $num>99999999 || substr($letras,$num%23, 1)!=$letra)
        {
            $this->form_validation->set_message('validardni', 'El {field} introducido no es valido');
            return false;
        }else 
        {
            return true;
        }

    }

    /**
     * Filtrado de Provincias para verificar que se introduce
     *
     * @param [int] $valor
     * @return boolean
     */
    public function provincias_check($valor)
    {
        if ($valor == 00)
        {
            $this->form_validation->set_message('provincias_check', 'Selecciona una  {field}.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}