<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 function formatoArraySelect($result, $default){

      $datos=$default;
      foreach($result as $object){
         $datos[$object->cod]=$object->nombre;
      }
      return $datos;
   }

?>