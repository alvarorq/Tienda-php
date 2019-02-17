<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.1
* @date 16/2/2019
* @lastChanges 16/02/2019
*/

class Pedido_ctrl extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('productos_model');
        $this->load->model('categorias_model');
        $this->load->model('usuario_model');
        $this->load->model('pedido_model');
    }

    /**
     * Tramitacion del carrito de la compra, si el carrito tiene algun producto se procede
     * en caso contrario se devuelve a la vista del carrito.
     */
    public function tramitar(){

      if($this->cart->total_items()<=0){
          redirect('Carrito_ctrl/ver_carro');
      }else{
          if($this->session->userdata('logeado')!=false){
              $id=$this->pedido_model->tramitarPedido();
              $this->detallesPedido($id);
          }else{
              redirect('Formulario_ctrl/form');
          }
      }
  }

    /**
    * Obtener pedidos realizados del usuario
    */
    public function pedidosRealizados(){
      $this->load->view('listadopedidos',
         [
            $this->load->view('plantillas/plantilla'),
            'pedidos'=>$this->pedido_model->pedidosRealizados()
         ]
         );
   }

   /**
    * Detalles de un pedido que coincida con la id obtenida, modificamos la estructura del objeto
    * $lineaspedido para que donde estaba el id del producto comprado almacenemos todos los datos de dicho producto
    * @param [integer] $idpedido
    */
    public function detallesPedido($idpedido){
      
      $lineaspedido=$this->pedido_model->lineasPedido($idpedido);

      foreach($lineaspedido as $lineas){
         $lineas->codigoProducto=$this->productos_model->getproducto($lineas->codigoProducto)[0];
      }

      $this->load->view('detallespedido',
         [
            $this->load->view('plantillas/plantilla'),
            'pedido'=>$this->pedido_model->getPedido($idpedido),
            'lineaspedido'=>$lineaspedido
         ]
         );
   
   }

}