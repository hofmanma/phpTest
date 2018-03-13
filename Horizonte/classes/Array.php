<?php

if (ARRAY_CLASSES == 0){
   
define( ARRAY_CLASSES, 1);

class Collection{

      var $m_array = array();
      var $m_len;

      function Collection( ){

               $this->m_array = array();
               $this->m_len = 0;
      }
      function addElement( $element ){

         $this->m_array[ $this->m_len ] = $element;
         $this->m_len ++;
      }
      function removeElement( $index ){

               for ( $i = $index ; $i < $this->m_len - 1; $i++ )
                        $this->m_array[ $i ] = $this->m_array[ $i + 1 ];
                        
               if ( $this->m_len > 0 )
                  $this->m_len -- ;
      }
      function length( ){

          return( $this->m_len );
      }
      function getElement( $index ){

           if ( $this->m_len == 0 )
              return( null );
              
           if ( $index >= $this->m_len )
              return( null );
              
           return( $this->m_array[ $index ] );
      }
}
}
?>
