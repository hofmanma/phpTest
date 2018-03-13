<?php

if (ACTIVITY_CLASSES == 1)
   return;

define( ACTIVITY_CLASSES, 1);

class Activity{

      var $m_reg;
      function setRegistry( $reg ){

               $this->m_reg = $reg;
      }
      function execute( $request ){

      }
      function security( $context ){

               if ( ! strcmp( $context->getParameter( "User" ), "" ))
                  return( FALSE );

               return( TRUE );
      }
}
?>
