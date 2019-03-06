<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.2
* @date 20/01/2019
* @lastChanges 16/02/2019
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
        $this->monedas();                  
        //setpaginacion(ruta url, total registros, registros por pagina)
        $this->paginacion->setpaginacion(site_url().'/inicio_ctrl/index',$this->productos_model->getdestacados(),'4');
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
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required|is_natural_no_zero');
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
                    'name' => $detalles->nombre,
                    'imagen' =>$detalles->imagen
                ];
            }
        
            $this->cart->insert($linea);
            $this->load->view('detallesproducto', [
                'plantilla'=>$this->load->view('plantillas/plantilla'),
                'alerta'=>$this->load->view('plantillas/alertacarritoadd'),
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

    public function  monedas(){
        $xml = simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
        $monedas['EUR']=1;
        foreach ($xml->Cube->Cube->Cube as $c) {
            $attr = $c->attributes();
            //echo "Un euro equivale a ".$attr[1]." ".$attr[0]."<br>";
            $monedas[(string)$attr[0]]=(double)$attr[1];
                
        }

        $this->session->set_userdata('monedas',$monedas);
       
    }

    public function cambioMoneda(){
        //$this->form_validation->set_rules('moneda', 'Moneda');
        $this->input->post('moneda');
        $this->session->set_userdata('current_divisa',$this->input->post('moneda'));
        $this->session->userdata('monedas')[$this->session->userdata('current_divisa')];
        redirect('Inicio_ctrl/index');
    }

}
