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
        
        $registry->m_sqlMgr->openConnection( "http://hofmanma.dnsalias.com", "root", "", "horizonte2" );

        if ( $context->getParameter( "User" ) == NULL ){

             header("Location: http://hofmanma.dnsalias.com/Horizonte/index.htm");
             return;
        }
        
        $songId = $_GET[ "songId" ];
        $song   = $registry->m_api->findSONGByPrimaryKey( $songId );

        // Lade Dokument
        $set = $registry->m_sqlMgr->generateSet( "DOKUMENT" );
            $field = $set->getField( "SONGID" );
			$field->setValue( $songId   );

		$dokumente = $registry->m_api->findDOKUMENTByWildcards( $set );
        if ( $dokumente->length( ) == 0 ){

        }
        else{

           $dokument = $dokumente->getElement( 0 );
           $context->addParameter("Song", $song );

           $file = "../Upload/Songs/UploadSong_" . $songId . ".data";

              header('Content-Description: File Transfer');
              header('Content-Type: application/octet-stream');
              header('Content-Length: ' . filesize($file));
              $header = 'Content-Disposition: attachment; filename="';
              $header .= $dokument->getDATEN( );
              $header .= '"';
              header($header);
              // Content of file
              readFile( $file );
           }
     }
     else{

     }
?>
