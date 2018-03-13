<?php

/*if (HTTP_CLASSES == 1)
   return;

define( HTTP_CLASSES, 1);
  */
include "Array.php";

class HttpParameter{

      var $m_name;
      var $m_value;
      
      function HttpParameter( $name, $value){

               $this->m_name = $name;
               $this->m_value = $value;
      }
      
      function matches( $name ){

               return( ! strcmp( $this->m_name , $name ) );
      }
      function getValue( ){

               return( $this->m_value );
      }
      function setValue( $value ){

               $this->m_value = $value;
      }
}
class HttpRequest {

      var $m_params;
      
      function HttpRequest( ){

               $this->m_params = new Collection( );
      }
      function addParameter( $name, $value ){

               $len = $this->m_params->length( );
               $i   = 0;
               for ( $i = 0; $i < $len; $i ++ ){

                     $param = $this->m_params->getElement( $i );
                     if ( $param->matches($name ) == TRUE ){

                        $param->setValue( $value );
                        return;
                     }
               }
               
               $param = new HttpParameter( $name, $value );
               $this->m_params->addElement( $param );
      }
      function getParameter( $name ){

                   $len = $this->m_params->length( );
                   $i   = 0;
               for ( $i = 0; $i < $len; $i ++ ){

                     $param = $this->m_params->getElement( $i );
                     if ( $param->matches($name ) == TRUE )
                        return( $param->getValue( ) );
               }
      }
}
?>
