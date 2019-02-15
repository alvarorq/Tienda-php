<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.0
* @date 15/02/2019
* @lastChanges 15/02/2019
*/

class Pedido_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

/**
 * Tramitar pedido, haciendo los inserts necesarios en linea de pedido y pedido
 *
 * @return array()
 */
   public function tramitarPedido()
   {
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

      $query = $this->db->insert('pedidos',$pedido);

      $idpedido=$this->db->query('SELECT idPedidos FROM pedidos ORDER by idPedidos DESC LIMIT 1');

      $idpedido=$idpedido->row();
   
      foreach ($this->cart->contents() as $item) {
         $linea=[
            'codigoPedido'=> $idpedido->idPedidos,
            'codigoProducto'=>$item['id'],
            'cantidad'=>$item['qty'],
            'subtotal'=>$item['subtotal']
         ];
         
         $query = $this->db->insert('lineapedido',$linea);
      }
      
   }

}