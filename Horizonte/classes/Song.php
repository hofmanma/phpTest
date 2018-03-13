<?php

if (SONG_CLASSES == 1)
   return;

define( SONG_CLASSES, 1);

include "Activity.php";

class ActFindSongs extends Activity{

     function execute( $request , $context){

        $context->addParameter( "Songs", new Collection( ) );
        
		$nmb = $request->getParameter("OrderNmb" );
		$title = $request->getParameter("Title");
        $cat = $request->getParameter("Category");
        $subcat = $request->getParameter("Subcategory");
        
		    $set = $this->m_reg->m_sqlMgr->generateSet( "SONG" );
            $field = $set->getField( "ORDERNMB" );
			$field->setValue( $nmb   );
            $field = $set->getField( "TITLE" );
			$field->setValue( $title );
            $field = $set->getField( "CATEGORY" );
			$field->setValue( $cat );
            $field = $set->getField( "SUBCATEGORY" );
			$field->setValue( $subcat );

		$songs = $this->m_reg->m_api->findSONGByWildcards( $set );

        $context->addParameter( "Songs", $songs );

	}
}
class ActUpdateSong extends Activity{

    function execute( $request , $context ){

		$songId = $request->getParameter( "songId" );
        $song = $this->m_reg->m_api->findSONGByPrimaryKey( $songId );

		//FormFile file = songForm.getFileForm( );
		$song->setORDERNMB   ( $request->getParameter("OrderNmb") );
		$song->setTITLE      ( $request->getParameter("Title"  ) );
		//$song->setFILENAME   ( file.getFileName ) );
		//song.setFILEDATA   ( file.getFileData( ) );
		$song->setDESCRIPTION( $request->getParameter("Description" ) );
		$song->setNOTES      ( $request->getParameter("Notes" ) );
        $song->setCATEGORY   ( $request->getParameter("Category" ) );
        $song->setSUBCATEGORY   ( $request->getParameter("Subcategory" ) );

		// Save data
			$song->save( );
   
        $context->addParameter( "Song", $song );
	}
 }
 class ActShowSong extends Activity{

    function execute( $request , $context ){

		$songId = $request->getParameter( "songId" );
        $song = $this->m_reg->m_api->findSONGByPrimaryKey( $songId );

        $context->addParameter( "Song", $song );
	}
 }
 class ActCreateSong extends Activity{

    function execute( $request, $context ){

        $song = $this->m_reg->m_api->createSONG ( );
        
		//FormFile file = songForm.getFileForm( );
        $song->setORDERNMB   ( $request->getParameter("OrderNmb") );
		$song->setTITLE      ( $request->getParameter("Title"  ) );
		//$song->setFILENAME   ( file.getFileName ) );
		//song.setFILEDATA   ( file.getFileData( ) );
		$song->setDESCRIPTION( $request->getParameter("Description" ) );
		$song->setNOTES      ( $request->getParameter("Notes" ) );
        $song->setCATEGORY   ( $request->getParameter("Category" ) );
        $song->setSUBCATEGORY( $request->getParameter("Subcategory" ) );

		// Save data
			$song->save( );
   
        $context->addParameter( "Song", $song );
	}
}
class ActFindSongsByAuftritt extends Activity{

	/********************************************
     * Finde alle Songs eines Auftritts
     ********************************************/
     function execute( $request , $context){

		$auftrId = $request->getParameter( "auftrId" );
		$key = $this->m_reg->m_sqlMgr->generateSet( "PROGRAM" );
		$key->setValue( "AUFTRID" , $auftrId   );

		$programs = $this->m_reg->m_api->findPROGRAMByWildcards( $key );
		$program;
        $songs = new Collection();
		$song;

		for ( $i = 0; $i < $programs->length(); $i ++ ){

			$program = $programs->getElement($i);
			 $songId = $program->getSONGID( );
			   $song = $this->m_reg->m_api->findSONGByPrimaryKey( $songId );

			$songs->addElement( $song );
		}


        $auftritt = $this->m_reg->m_api->findAUFTRITTByPrimaryKey( $auftrId );
  
        $context->addParameter( "Songs", $songs );
        $context->addParameter( "Auftritt", $auftritt );

	}
}
class ActFindSongsByProbe extends Activity{
 /********************************************
  * Finde alle Songs einer Probe
  ********************************************/
    function execute( $request, $context){

        $probeId = $request->getParameter( "probeId" );

		$key = $this->m_reg->m_sqlMgr->generateSet( "PROGRAMPROBE" );
		$key->setValue( "PROBEID" , $probeId   );

		$programs = $this->m_reg->m_api->findPROGRAMPROBEByWildcards( $key );
        $songs = new Collection();

		for ( $i = 0; $i < $programs->length(); $i ++ ){

			$program = $programs->getElement($i);
			 $songId = $program->getSONGID( );
			   $song = $this->m_reg->m_api->findSONGByPrimaryKey( $songId );

			$songs->addElement( $song );
		}


        $probe = $this->m_reg->m_api->findPROBEByPrimaryKey( $probeId );

        $context->addParameter( "Songs", $songs );
        $context->addParameter( "Probe", $probe );

	}
}

class ActUploadSong extends Activity{

    function execute( $request , $context ){

        $songId   = $request->getParameter( "songId" );
        $song     = $this->m_reg->m_api->findSONGByPrimaryKey( $songId );
        
        $context->addParameter( "Song", $song );
    }
}

class ActSaveFileSong extends Activity{

    function execute( $request , $context ){

        $songId   = $request->getParameter( "songId" );
        $fileName = $request->getParameter( "Daten" );
        
        $name  = "UploadSong_" . $songId . ".data";
        $dest  = "../Upload/Songs/";
        $dest .= $name;
        
        if ($_FILES["Daten"]["error"] <= 0)
        {
             if ( move_uploaded_file ( $_FILES["Daten"]["tmp_name"] , $dest ) == FALSE )
                $dest = "";

             $key = $this->m_reg->m_sqlMgr->generateSet( "DOKUMENT" );
		            $key->setValue( "SONGID" , $songId   );
             $dokumente = $this->m_reg->m_api->findDOKUMENTByWildcards( $key );
             if ( $dokumente->length( ) == 1 ){

                 $dokument = $dokumente->getElement( 0 );
                 $dokument->setDATEN( $_FILES["Daten"]["name"] );
                  $dokument->save( );
             }
             else{

                 $dokument = $this->m_reg->m_api->createDOKUMENT( );
                 $dokument->setSONGID( $songId );
                 $dokument->setDATEN( $_FILES["Daten"]["name"] );
                  $dokument->save( );
              }
        }
    }
}
?>
