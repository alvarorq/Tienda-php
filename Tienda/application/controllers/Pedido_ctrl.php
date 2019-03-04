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
            redirect('Carrito_ctrl/vercarro');
        }else{
            if($this->session->userdata('logeado')!=false){
                $id=$this->pedido_model->tramitarPedido();
                if($id==0){
                    redirect('Carrito_ctrl/vercarro');
                    
                }else{
                    $this->detallesPedido($id);
                }
              
            }else{
                redirect('Formulario_ctrl/form');
            }
        }
    }

    /**
     * Vista previa confirmacion de pedido
     *
     */
    public function previewPedido(){
        $this->load->view('plantillas/previewpedido',[
                        $this->load->view('plantillas/plantilla'),
                        'datosusuario'=>$this->session->userdata('usuario')[0]
                    ]);
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

    /**
     * Visualizar el pdf del pedido generado
     *
     * @param [integer] $idpedido
     */
    public function verPDF($idpedido){
        $lineaspedido=$this->pedido_model->lineasPedido($idpedido);

        foreach($lineaspedido as $lineas){
            $lineas->codigoProducto=$this->productos_model->getproducto($lineas->codigoProducto)[0];
        }
        
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('plantillas/pdfpedido',[
                'pedido'=>$this->pedido_model->getPedido($idpedido),
                'lineaspedido'=>$lineaspedido],true);
                
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browser
        //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name


    }


    /**
     * Cancelamos el pedido y desde le modelo devolvemos el stock del producto al dependiendo de la cantidad establecida en linea de pedido
     *
     * @param [integer] $idpedido
     */
    public function cancelarPedido($idpedido){
      
        $lineaspedido=$this->pedido_model->lineasPedido($idpedido);
        
        foreach($lineaspedido as $lineas){
           $lineas->codigoProducto=$this->productos_model->getproducto($lineas->codigoProducto)[0];
           $idProducto=$lineas->codigoProducto;
           $cantidad=$lineas->cantidad;
           $this->pedido_model->restaurarStock($idProducto->codigoProducto, $cantidad);
        }
        
        $this->pedido_model->cancelarPedido($idpedido);
        
        $this->load->view('listadopedidos',
        [
           $this->load->view('plantillas/plantilla'),
           'pedidos'=>$this->pedido_model->pedidosRealizados()
        ]
        );
      }
}