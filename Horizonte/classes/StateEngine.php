<?php

if (STATEENGINE_CLASSES == 1)
   return;
   
define( STATEENGINE_CLASSES, 1);

include "Project.php";

class Handler{

      var $m_cmd;
      var $m_include;
      var $m_view;
      var $m_className;
      var $m_handler;

      function Handler( $cmd, $include, $view, $className, $class  ){

               $this->m_cmd         = $cmd;
               $this->m_include     = $include;
               $this->m_view        = $view;
               $this->m_className   = $className;
               $this->m_handler     = $class;
      }
      function matchesCmd ( $cmd ){
                  
               return(  ! strcmp ( $this->m_cmd , $cmd ) );
      }
      function getClassName ( ){

               return ( $this->m_className );
      }
      function getHandler ( ){

               return ( $this->m_handler );
      }
      function getView( ){

               return( $this->m_view );
      }
      function getCmd( ){

               return( $this->m_cmd );
      }
      function getInclude( ){

               return( $this->m_include );
      }
}

class Parser{

      function parse( $registry ){

           $project = new Collection( );
           $classLoader = new ClassLoader( );
           $lines = file ('proj.conf' );
           $len   = count( $lines );

           for ( $i = 0; $i < $len; $i ++){

              $tok = strtok( $lines[ $i ], ";");
              $cmd = $tok;
              $i2 = 0;
              while ($tok !== false) {
                    $tok = strtok(";");
                    switch ( $i2 ){
                           case 0: $include = $tok; break;
                           case 1: $className = $tok; break;
                           case 2: $view = $tok; break;
                    }
                    $i2 ++;
              }

              $cmd = trim( $cmd );
              $include = trim( $include );
              $className = trim( $className );
              $view = trim( $view );
              
              $class   = $classLoader->getClass( $className );
              $class->setRegistry( $registry );
              $handler = new Handler($cmd, $include, $view, $className, $class );
                       $project->addElement( $handler );
           }

         return( $project );
      }
}

class ClassLoader{

      var $m_handler = array( );

      function getClass( $className ){

            $len = count($this->m_handler);
            $class = $this->m_handler[ $className ];
            if ( $class )
               return( $class );
            else{
               
               $class = new $className( );
               $this->m_handler[ $className ] = $class;
                   return( $class );
            }
      }
}
class StateEngine{

      var $m_handler;
      function initialize( $registry){

           $parser = new Parser();
           //Parse project-structure
                   $this->m_handler = $parser->parse( $registry );
      }
      function getHandler( $cmd ){

            $len = $this->m_handler->length( );
            $i   = 0;
            
            for ( $i = 0; $i < $len; $i ++ ){

                $handler = $this->m_handler->getElement( $i );
                if ( $handler->matchesCmd( $cmd ) == TRUE ) {

                   return( $handler->getHandler( ) );
                }
            }
      }
      function getView( $cmd ){

            $len = $this->m_handler->length( );
            $i   = 0;

            for ( $i = 0; $i < $len; $i ++ ){

                $handler = $this->m_handler->getElement( $i );
                if ( $handler->matchesCmd( $cmd ) == TRUE ) {

                   return( $handler->getView( ) );
                }
            }
      }
      function cmdExists( $cmd ){


            $len = $this->m_handler->length( );
            for ( $i = 0; $i < $len; $i++ ){

                $handler = $this->m_handler->getElement( $i );
                if ( $handler->matchesCmd( $cmd ) == TRUE) {

                   return( TRUE );
                }
            }
            return( FALSE );
      }
}
?>
