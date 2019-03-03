<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.1
* @date 25/1/2019
* @lastChanges 16/02/2019
*/

class Usuario_ctrl extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('productos_model');
        $this->load->model('categorias_model');
        $this->load->model('usuario_model');
        $this->load->model('provincias_model');
        
    }

    /**
     * Verificar si los datos introducidos son validos, si existen en la base de datos y son los correctos 
     */
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
                redirect('inicio_ctrl');
            }   
        }
    }

    /**
     * Vista principal de datos de usuario
     */
    public function verDatos(){
        $this->load->view('user_interface',[
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'usuario'=>$this->session->userdata('usuario')
            ]);
    }

    public function resetPassword(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required');

        if($this->form_validation->run() == FALSE){
            $this->load->view(
                'nuevapass',
                [
                    'plantilla' => $this->load->view('plantillas/plantilla'),
                ]);
        }else{
            $datos = $this->input->post();
            $boleano = $this->usuario_model->userExist($datos);

            if($boleano){
               $this->usuario_model->restablecerPassword($datos);
               $this->load->view(
                'nuevapass',
                [
                    'plantilla' => $this->load->view('plantillas/plantilla'),
                    'success'=>'Se ha enviado la nueva contraseña a tu correo'
                ]);;
            }else{
                $this->load->view(
                    'nuevapass',
                    [
                        'plantilla' => $this->load->view('plantillas/plantilla'),
                        'error'=>'El usuario introducido no existe'
                    ]);;
            }   
        }
    }

    /**
     * Dar de baja la cuenta del usuario
     *
     * @return void
     */
    public function darDebaja(){
        $this->usuario_model->bajaUsuario();
        redirect('inicio_ctrl');
    }

    
    /**
     * Preparar el formulario con los datos obtenidos de la sesion para mostrarla en el formulario para que sea posible su modificacion
     *
     */
    public function actualizarDatos(){
        $userdatas = array(
            'email' => $this->session->userdata('usuario')[0]->email,
            'nickName' => $this->session->userdata('usuario')[0]->nickName,
            'apellidos' => $this->session->userdata('usuario')[0]->apellidos,
            'nombre' => $this->session->userdata('usuario')[0]->nombre,
            'dni' => $this->session->userdata('usuario')[0]->dni, 
            'direccion' => $this->session->userdata('usuario')[0]->direccion,
            'cp' => $this->session->userdata('usuario')[0]->cp
        );

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('dni', 'Dni', 'exact_length[9]|callback_validardni');
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|required');
        $this->form_validation->set_rules('cp', 'Cp', 'trim|required|exact_length[5]');
        $this->form_validation->set_rules('provincias', 'Provincias', 'callback_provincias_check');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('actualizarusuario',[
                'provincias'=>$this->provincias_model->getprovincias(),
                'usuario'=>$userdatas,
                'plantilla'=>$this->load->view('plantillas/plantilla')
            ]);
        }
        else
        {
            $datos = $this->input->post();
            if(isset($_POST['password'])){
            $dat= password_hash($this->input->post('password'),PASSWORD_DEFAULT);
            $datos['password']=$dat;
            $datos['passconf']=$dat;
        }
            $this->usuario_model->updateUser($datos);
            redirect('Usuario_ctrl/verDatos');
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
