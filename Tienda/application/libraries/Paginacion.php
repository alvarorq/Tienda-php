<?php
/**
* @author Alvaro <alvarorq7@gmail.com>
* @version 1.0.0
* @date 12/2/2019
* @lastChanges 12/02/2019
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Paginacion {

    protected $CI;

    public function __construct(){
        $this->CI = get_instance();  
    }

    /**
     * Creamos la configuracion de la paginacion
     *
     * @param [str] $url
     * @param [array] $array
     * @param [integer] $mostrar
     */
    public function setpaginacion($url, $array,$mostrar){
      $config['base_url'] = $url;
      $config['total_rows'] = count($array);
      $config['per_page'] = $mostrar;
      
      $this->CI->pagination->initialize($config);
         
      }
}
 
?>