<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.2
* @date 20/01/2019
* @lastChanges 12/02/2019
*/

class Inicio_ctrl extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('productos_model');
        $this->load->model('categorias_model');
        $this->load->model('usuario_model');
    }

    /**
     * Facilitamos los productos destacados a la vista
     *
     * @param integer $pagina
     */
    public function index($pagina=FALSE){
        $inicio=0;
        if($pagina){
            $inicio=$pagina;
        }                               
        //setpaginacion(ruta url, total registros, registros por pagina)
        $this->paginacion->setpaginacion(site_url().'/inicio_ctrl/todos',$this->productos_model->getdestacados(),'4');
        $this->load->view('inicio_view',[
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()]),
            'productos'=>$this->productos_model->getdestacados($inicio,'4')
            ]);
    }

    /**
     * Facilitamos todos los productos visibles de la base de datos a la vista
     *
     * @param integer $pagina
     */
    public function todos($pagina=FALSE)
    {   
        $inicio=0;
        if($pagina){
            $inicio=$pagina;
        }
        //setpaginacion(ruta url, total registros, registros por pagina)
        $this->paginacion->setpaginacion(site_url().'/inicio_ctrl/todos',$this->productos_model->getproductos(),'4');
        $this->load->view('inicio_view',[
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()]),
            'productos'=>$this->productos_model->getproductos($inicio,'4')
            ]);
    }

    /**
     * Productos pertenecientes a una categoria concreta
     *
     * @param [int] $id
     */
    public function porcatego($id){
        $this->load->view('inicio_view', [
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()]),
            'productos'=>$this->productos_model->getporcatego($id)
        ]);
    }

    /**
     * Destalles de un solo producto
     *
     * @param [int] $id
     */
    public function detallesproductos($id){
        $this->load->view('detallesproducto', [
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()]),
            'producto'=>$this->productos_model->getproducto($id)
        ]);
    }

    /**
     * Añadir un producto al carro de la compra sin cambiar de vista
     *
     * @param [int] $id
     */
    public function addcarro(){
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required|integer');
        $campos=$this->input->post();
        if($this->form_validation->run() == FALSE){
            $this->load->view('detallesproducto', [
                'plantilla'=>$this->load->view('plantillas/plantilla'),
                'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()]),
                'producto'=>$this->productos_model->getproducto($campos['idproduc'])
            ]);
        }else{
            foreach ($producto=$this->productos_model->getproducto($campos['idproduc']) as $detalles) {
                $linea=[
                    'id' => $campos['idproduc'],
                    'qty' => $campos['cantidad'],
                    'price' => $detalles->precio,
                    'name' => $detalles->nombre
                ];
            }
        
            $this->cart->insert($linea);
            $this->load->view('detallesproducto', [
                'plantilla'=>$this->load->view('plantillas/plantilla'),
                'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()]),
                'producto'=>$this->productos_model->getproducto($campos['idproduc'])
            ]);
        }
    }

    

    /**
     * Cerrar la sesion del usuario que este logeado en ese momento
     */
    public function cerrarSesion(){
        $this->usuario_model->cerrarSesion();
        $this->load->view('inicio_view',[
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()]),
            'productos'=>$this->productos_model->getdestacados()
            ]);
    }
}
