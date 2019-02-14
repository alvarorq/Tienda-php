<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.1
* @date 25/1/2019
* @lastChanges 12/02/2019
*/

class Usuario_ctrl extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('productos_model');
        $this->load->model('categorias_model');
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
     * Vista principal de datos de usuario
     */
    public function verDatos(){
        $this->load->view('user_interface',[
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'usuario'=>$this->session->userdata('usuario')
            ]);
    }

}