<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xml_ctrl extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model("Productos_model");
		$this->load->model("xml_model");
    }

    public function importarCategorias(){
       
        $config['upload_path'] = './assets/xml';
        $config['file_name'] = time().'categorias.xml';
        $config['allowed_types']='xml';
            $this->load->library('upload',$config);
             
                  
                    if ( ! $this->upload->do_upload('xml_categorias')) { 
                        
                        $error = array('error' => $this->upload->display_errors()); 
                      var_dump($error);
                      die();
                    } else { 
                      
                        
         
                        $archivoCategoria = simplexml_load_file('./assets/xml/'.$config['file_name']);
                        
                    
                        foreach($archivoCategoria->categoria as $datos) {
                           
                                    $data= array(
                                        'codigoCategoria'=>$datos->codigoCategoria,
                                        'categoria'=>$datos->categoria,
                                        'descripcion'=>$datos->descripcion,
                                        'visible'=>$datos->visible,
                                    );
                             
                                    $this->xml_model->importarCategorias($data);
                                } 
                                redirect('inicio_ctrl/index'); 
                    }           
    }

    public function importarProductos(){
       
        $config['upload_path'] = './assets/xml';
        $config['file_name'] = time().'productos.xml';
        $config['allowed_types']='xml';
            $this->load->library('upload',$config);
             
                  
                    if ( ! $this->upload->do_upload('xml_productos')) { 
                        
                        $error = array('error' => $this->upload->display_errors()); 
                      var_dump($error);
                      die();
                    } else { 
                      
                        
         
                        $archivoProducto = simplexml_load_file('./assets/xml/'.$config['file_name']);
                        
                    
                        foreach($archivoProducto->producto as $datos) {
                           
                                    $data= array(
                                        'codigoProducto' => $datos->codigoProducto,
                                        'nombre' => $datos->nombre,
                                        'descripcion' => $datos->descripcion,
                                        'precio' => $datos->precio,
                                        'descuento' => $datos->descuento,
                                        'imagen' => $datos->imagen,
                                        'iva' => $datos->iva,
                                        'stock' => $datos->stock,
                                        'Categoria' => $datos->Categoria,
                                        'visible' => $datos->visible,
                                        'destacado' => $datos->destacado,
                                        'fechainicio' => $datos->fechainicio,
                                        'fechafin' => $datos->fechafin
                                    );
                             
                                    $this->xml_model->importarProductos($data);
                                }
                        redirect('inicio_ctrl/index'); 
                    }           
    }

    public function vista_importar(){

        $pag=$this->load->view("import_categorias");

       }

       public function vista_importar2(){

        $pag=$this->load->view("import_productos");

       }


    public function exportarCategorias(){
        $categorias=$this->xml_model->getCategorias();

        
        $cuerpo=$this->load->view("xmlcategorias",[
            'categorias'=>$categorias
        ]);
    }

    public function exportarProductos(){
        $productos=$this->xml_model->getProductos();

        
        $cuerpo=$this->load->view("xmlproductos",[
            'productos'=>$productos
        ]);
    }
    
    
}
