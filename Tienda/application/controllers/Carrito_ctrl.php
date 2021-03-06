<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.1
* @date 25/1/2019
* @lastChanges 15/02/2019
*/

class Carrito_ctrl extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('categorias_model');
        $this->load->model('productos_model');
        $this->load->model('usuario_model');
        $this->load->model('pedido_model');
    }

    /**
     * Facilitamos los productos destacados a la vista
     */
    public function vercarro(){
        if(null != ($this->session->userdata('erroresstock'))){
            foreach ($this->cart->contents() as $items) {

                if($items['qty'] > $this->productos_model->getStockProducto($items['id'])){
                    $data=array(
                        'rowid'=>$items['rowid'],
                        'qty'=>$this->productos_model->getStockProducto($items['id'])
                    );
            
                    $this->cart->update($data);
                }
            }
            unset($_SESSION['erroresstock']);
            $this->load->view('carrito_view',[
                'plantilla'=>$this->load->view('plantillas/plantilla'),
                'erroresstock'=>$this->load->view('plantillas/erroresdeStock'),
                'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()])
                ]);
        }else{
            unset($_SESSION['erroresstock']);
            $this->load->view('carrito_view',[
                    'plantilla'=>$this->load->view('plantillas/plantilla'),
                    'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()])
                    ]);
        }        
        
    }

    /**
     * Elimina un producto del carrito de la compra por el ROWID que le entregamos por parametros
     *
     * @param [String] $rowid
     */
    public function removecarro($rowid){
        $data=array(
            'rowid'=>$rowid,
            'qty'=>0
        );
        unset($_SESSION['erroresstock']);
        $this->cart->update($data);
        $this->load->view('carrito_view', [
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()])
        ]);
    }

    /**
     * Vaciar el carrito de la compra por completo
     */
    public function vaciarCarro(){
        unset($_SESSION['erroresstock']);
        $this->cart->destroy();
        $this->load->view('carrito_view', [
            'plantilla'=>$this->load->view('plantillas/plantilla'),
            'categorias'=>$this->load->view('plantillas/menu_categorias',['categorias'=>$this->categorias_model->getcategorias()])
        ]);
    }

}