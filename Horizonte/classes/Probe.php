<?php

include "Activity.php";

class ActFindProben extends Activity{
    
    function execute( $request, $context  ){

		      $ort = $request->getParameter("Ort" );
		      $datum = $request->getParameter("Datum" );

	        $set = $this->m_reg->m_sqlMgr->generateSet( "PROBE" );
			$set->setValue( "ORT"  , $ort   );
			$set->setValue( "DATUM", $datum );

            $proben = $this->m_reg->m_api->findPROBEByWildcards( $set );
        // Save result for the view
           $context->addParameter ( 'Proben', $proben );
	}
}
class ActUpdateProbe extends Activity{

    function execute( $request, $context ){

		    $probeId = $request->getParameter( "probeId" );
            $probe = $this->m_reg->m_api->findPROBEByPrimaryKey( $probeId );

        $probe->setDATUM      ( $request->getParameter("Datum" ) );
		$probe->setORT        ( $request->getParameter("Ort" ) );
		$probe->setDESCRIPTION( $request->getParameter("Description") );
  
		// Save probe
			$probe->save( );
        // Save result for the view
           $context->addParameter ( 'Probe', $probe );

	}
}
class ActShowProbe extends Activity{

    function execute( $request, $context ){

		    $probeId = $request->getParameter( "probeId" );
            $probe = $this->m_reg->m_api->findPROBEByPrimaryKey( $probeId );

        // Save result for the view
           $context->addParameter ( 'Probe', $probe );

	}
}
class ActCreateProbe extends Activity{

    function execute( $request, $context  ){

		    $probe = $this->m_reg->m_api->createPROBE( );

		$probe->setDATUM      ( $request->getParameter("Datum" ) );
		$probe->setORT        ( $request->getParameter("Ort" ) );
		$probe->setDESCRIPTION( $request->getParameter("Description") );
		// Save probe
			$probe->save( );
   
        // Save result for the view
           $context->addParameter ( 'Probe', $probe );
	}
}
class ActFindProbenBySong extends Activity{

	/********************************************
     * Finde alle Proben, in denen ein Song
     * gespielt wurde
     ********************************************/
    function execute( $request, $context){

		    $songId = $request->getParameter( "songId" );
		    $set = $this->m_reg->m_sqlMgr->generateSet( "PROGRAMPROBE" );
			$set->setValue( "SONGID"  , $songId   );
		    $programs = $this->m_reg->m_api->findPROGRAMPROBEByWildcards( $set );

		    $proben = new Collection();
		for (  $i = 0; $i < $programs->length(); $i ++ ){

			$program = $programs->getElement($i);
			    $probeId = $program->getPROBEID( );
				$probe = $this->m_reg->m_api->findPROBEByPrimaryKey( $probeId );

			$proben->addElement( $probe );
		}
  
        // Save result for the view
           $context->addParameter ( 'Proben', $proben );
	}
}
?>
