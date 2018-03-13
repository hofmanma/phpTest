<?php

if (AUFTRITT_CLASSES == 1)
   return;

define( AUFTRITT_CLASSES, 1);

include "Activity.php";

class ActFindAuftritt extends Activity{

    function execute( $request, $context ){

		$ort   = $request->getParameter( "Ort" );
		$datum = $request->getParameter( "Datum" );

		    $set = $this->m_reg->m_sqlMgr->generateSet( "AUFTRITT" );
			$set->setValue( "ORT"  , $ort   );
			$set->setValue( "DATUM", $datum );

            $auftritte = $this->m_reg->m_api->findAUFTRITTByWildcards( $set );

        // Save result for the view
           $context->addParameter ( 'Auftritte', $auftritte );
	}
}
class ActUpdateAuftritt extends Activity{
    
	function execute( $request, $context  ){

		$auftrId = $request->getParameter( "auftrId" );
  	    $auftritt = $this->m_reg->m_api->findAUFTRITTByPrimaryKey( $auftrId );

		//FormFile file = auftrForm.getFileForm( );

		$auftritt->setDATUM      ( $request->getParameter("Datum" ));
		$auftritt->setORT        ( $request->getParameter("Ort" ) );
		//$auftritt->setFILENAME   ( file.getFileName( ) );
		//auftritt.setFILEDATA   ( file.getFileData( ) );
		$auftritt->setDESCRIPTION( $request->getParameter("Description"));
		$auftritt->setNOTES      ( $request->getParameter("Notes"));

		// Save data
			$auftritt->save( );

        // Save result for the view
           $context->addParameter ( 'Auftritt', $auftritt );
	}
}

class ActShowAuftritt extends Activity{

	function execute( $request, $context  ){

		$auftrId = $request->getParameter( "auftrId" );
  	    $auftritt = $this->m_reg->m_api->findAUFTRITTByPrimaryKey( $auftrId );

        // Save result for the view
           $context->addParameter ( 'Auftritt', $auftritt );
	}
}

class ActCreateAuftritt extends Activity{

	function execute( $request, $context  ) {

		$auftritt = $this->m_reg->m_api->createAUFTRITT ( );

		//FormFile file = auftrForm.getFileForm( );

		$auftritt->setDATUM      ( $request->getParameter("Datum" ));
		$auftritt->setORT        ( $request->getParameter("Ort" ));
		//$auftritt->setFILENAME   ( file.getFileName( ) );
		//auftritt.setFILEDATA   ( file.getFileData( ) );
		$auftritt->setDESCRIPTION( $request->getParameter("Description" ));
		$auftritt->setNOTES      ( $request->getParameter("Notes" ));

		// save data
			$auftritt->save( );
   
        // Save result for the view
           $context->addParameter ( 'Auftritt', $auftritt );
	}
}
class ActFindAuftritteBySong extends Activity{

    /********************************************
     * Finde alle Auftritte, in denen ein Song
     * vorgetragen wurde
     ********************************************/
	function execute( $request, $context  ) {

		    $songId = $request->getParameter( "songId" );
		    $set = $this->m_reg->m_sqlMgr->generateSet( "PROGRAM" );
			$set->setValue( "SONGID"  , $songId   );
		    $programs = $this->m_reg->m_api->findPROGRAMByWildcards( $set );

		    $auftritte = new Collection( );

		for ( $i = 0; $i < $programs->length(); $i ++ ){

			$program = $programs->getElement( $i );
			    $auftrId = $program->getAUFTRID( );
				$auftritt = $this->m_reg->m_api->findAUFTRITTByPrimaryKey( $auftrId );

			$auftritte->addElement( $auftritt );
		}
  
       // Save result for the view
           $context->addParameter ( 'Auftritte', $auftritte );
	}
}
?>
