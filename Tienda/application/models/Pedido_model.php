<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.0
* @date 15/02/2019
* @lastChanges 16/02/2019
*/

class Pedido_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

/**
 * Tramitar pedido, haciendo los inserts necesarios en linea de pedido y pedido
 * comprobando si existe stock y restandolo si fuera posible
 * 
 * @return array()
 */
   public function tramitarPedido()
   {
      //Creamos los datos del pedido
      $usuario=$this->session->userdata('usuario')[0];
      $pedido=[
         'idUsuario'=> $usuario->idUsuarios,
         'nombre'=>$usuario->nombre,
         'apellidos'=>$usuario->apellidos,
         'dni'=>$usuario->dni,
         'direccion'=>$usuario->direccion,
         'cp'=>$usuario->cp,
         'provincia'=>$usuario->provincia
      ];

      //Recoger errores stock
      $errores=[];
      //Comprobar si todas las cantidades estan disponibles en stock
      foreach ($this->cart->contents() as $item) {
         
         if($this->nuevoStock($item['id'],$item['qty'])){
            //no hacemos nada
         }else{
            //creamos error
            $query3=$this->db->get_where('productos',array('codigoProducto'=>$item['id']));
            $producto=$query3->result();
            $errores[]=$producto[0]->nombre.': No tenemos stock suficiente, quedan '.$producto[0]->stock.'unidades';
         }
      }

      //si existen errores
      if(count($errores)>0){
         //recogemos en la sesion
         $this->session->set_userdata('erroresstock',$errores);
         return 0;
      }else{
         //insertamos el pedido y sus lineas de pedido con foreach
         $query1 = $this->db->insert('pedidos',$pedido);
         $idpedido=$this->db->query('SELECT idPedidos FROM pedidos ORDER by idPedidos DESC LIMIT 1');
         $idpedido=$idpedido->row();
         
         foreach ($this->cart->contents() as $item) {
            $linea=[
               'codigoPedido'=> $idpedido->idPedidos,
               'codigoProducto'=>$item['id'],
               'cantidad'=>$item['qty'],
               'subtotal'=>$item['subtotal']
            ];

            $query=$this->db->get_where('productos',array('codigoProducto'=>$item['id']));
            $producto=$query->result();
            $stock=$producto[0]->stock;

            $this->db->set('stock',($stock-$item['qty']));
            $this->db->where('codigoProducto',$item['id']);
            $this->db->update('productos');

            $query2 = $this->db->insert('lineapedido',$linea);
         }

         $datosemail = $this->datosdepedidoemail($idpedido->idPedidos);

         $mpdf = new \Mpdf\Mpdf();
         $html = $this->load->view('plantillas/pdfpedido',[
                              'lineaspedido' => $datosemail['lineaspedido'],
                              'pedido' => $datosemail['pedido']
                              ],true);
                
                            
         $pdfFilePath = FCPATH . "attach/pdf_name.pdf";
         $mpdf->WriteHTML($html); 
         $mpdf->Output($pdfFilePath, "F");

         
         $this->email->set_header('Content-Type', 'text/html');

         $this->email->from('arq12daw@gmail.com', 'Alvaro');
         $this->email->to('alvarorq7@gmail.com');
        
         $this->email->subject('Resumen de tu pedido');
         $datosemail = $this->datosdepedidoemail($idpedido->idPedidos);
         $message = $this->load->view('plantillas/pedidoemail',[
                                       'lineaspedido' => $datosemail['lineaspedido'],
                                       'pedido' => $datosemail['pedido']
                                       ],
                                       true);
         $this->email->message($message);
         $this->email->attach(__DIR__.'/attach/pdf_name.pdf');
         $this->email->send();

         $this->cart->destroy();

         return $idpedido->idPedidos;
      }
   }

   public function datosdepedidoemail($idpedido){
      $lineaspedido=$this->lineasPedido($idpedido);

      foreach($lineaspedido as $lineas){
         $lineas->codigoProducto=$this->productos_model->getproducto($lineas->codigoProducto)[0];
      }

      $datos=[
         'lineaspedido'=>$lineaspedido,
         'pedido'=>$this->getPedido($idpedido)
      ];
      return $datos;
   }

   public function nuevoStock($id,$restar){

      $query=$this->db->get_where('productos',array('codigoProducto'=>$id));
      $producto=$query->result();
      $stock=$producto[0]->stock;

      if($stock-$restar<0){
         return false;
      }else{
         return true;
      }
   }

   /**
    * Devuelve los datos de un pedido que coincida con la ID pasada por parametro
    *
    * @param [integer] $idpedido
    * @return [object]
    */
   public function getPedido($idpedido){
      $query = $this->db->get_where('pedidos',array('idPedidos'=>$idpedido));
      return $query->result();
   }

   /**
    * Nos devuelve todas las lineas de pedido que componen al pedido que coincida con la ID
    * pasada por parametro
    * @param [integer] $idpedido
    * @return [object]
    */
   public function lineasPedido($idpedido){
      $query = $this->db->get_where('lineapedido',array('codigoPedido'=>$idpedido));
      return $query->result();
   }

   /**
    * obtenemos todos los pedidos realizados por el cliente que está logeado ahora mismo
    *
    * @return [object]
    */
   public function pedidosRealizados(){
      $query = $this->db->get_where('pedidos',array('idUsuario'=>$this->session->userdata('usuario')[0]->idUsuarios));
      return $query->result();
   }

   public function restaurarStock($idproducto, $cantidad){
      $query=$this->db->get_where('productos',array('codigoProducto'=>$idproducto));
           
      $producto=$query->result();
      $stock=$producto[0]->stock;

      $this->db->set('stock',($stock+$cantidad));
      $this->db->where('codigoProducto',$idproducto);
      $this->db->update('productos');
   }

   public function cancelarPedido($idpedido){
      $this->db->set('estado','A');
      $this->db->where('idPedidos',$idpedido);
      $this->db->update('pedidos');
   }
}