<?php
     include "StateEngine.php";
     include "Array.php";
     include "Registry.php";
     include "Http.php";
     
     session_start( );
     
     if ( ! strcmp( $_SESSION['state'], "Active" ) ){

        $stateEngine = $_SESSION['stateEngine'];
        $context     = $_SESSION['Context'];
        $registry    = $_SESSION['Registry'];
        
        $registry->m_sqlMgr->openConnection( "localhost", "root", "", "horizonte2" );
     }
     else{

        $stateEngine = $_SESSION['stateEngine'] = new StateEngine( );
        $context     = $_SESSION['Context']     = new HttpRequest();
        $registry    = $_SESSION['Registry']    = new Registry();
        
        // Init references
             $registry->initialize();
             $stateEngine->initialize( $registry );

        $_SESSION['state'] = "Active";
     }


     $cmd = $_GET['cmd'];
     if ( $cmd == null ){
             $cmd = $_POST['cmd'];
             if ( $stateEngine->cmdExists( $cmd ) == FALSE ){

             echo "Invalid Command " . $cmd . ";";
             return;
          }

          $request = new HttpRequest();

          // Fill Http-Parameter
          reset($_POST);
          while (list($name, $value) = each($_POST)) {

              $request->addParameter( $name, $value );
          }
     }
     else{

          if ( $stateEngine->cmdExists( $cmd ) == FALSE ){

             echo "Invalid Command " . $cmd . ";";
             return;
          }
     
          $request = new HttpRequest();

          // Fill Http-Parameter
          reset($_GET);
          while (list($name, $value) = each($_GET)) {

               $request->addParameter( $name, $value );
          }
     }
            
     // Execute the desired activity
     $handler = $stateEngine->getHandler( $cmd );
     $view    = $stateEngine->getView   ( $cmd );
     if ( $handler->security( $context ) == TRUE ){
            
          $hdlView = $handler->execute( $request, $context );
          if ( $hdlView != null )
             $view = $hdlView;
             
          // Close connection
          //$registry->m_sqlMgr->closeConnection( );
             
          if ( $view ){

             $url = "http://hofmanma.dnsalias.com/Horizonte/%s";
             $url = sprintf( $url,  $view );

             header("Location: $url", false);
          }
     }
     else{

          header("Location: http://hofmanma.dnsalias.com/Horizonte/index.htm", true);
     }
     
?>
