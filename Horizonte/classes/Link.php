<?php

if (LINK_CLASSES == 1)
   return;

define( LINK_CLASSES, 1);

include "Activity.php";

/********************************************
 * Hinzufügen eines Songs zu einem Auftritt
 ********************************************/
class ActAddSongToAuftritt extends Activity{
 
    function execute( $request, $context ){

		$orderNmb = $request->getParameter( "OrderNmb" );
		$auftrId  = $request->getParameter( "auftrId" );
        $title    = $request->getParameter( "Title" );

        $set = $this->m_reg->m_sqlMgr->generateSet( "SONG" );
            $field = $set->getField( "ORDERNMB" );
			$field->setValue( $orderNmb   );
            $field = $set->getField( "TITLE" );
			$field->setValue( $title   );

		$songs = $this->m_reg->m_api->findSONGByWildcards( $set );
        $len = $songs->length( );

        for ( $i = 0; $i < $len; $i ++ ){

            $song = $songs->getElement( $i );

            $set = $this->m_reg->m_sqlMgr->generateSet( "PROGRAM" );
            $field = $set->getField( "SONGID" );
			$field->setValue( $song->getSONGID()  );
            $field = $set->getField( "AUFTRID" );
			$field->setValue( $auftrId   );

            // Only link songs that are not already assigned to
            // the auftritt.
            $programs = $this->m_reg->m_api->findPROGRAMByWildcards( $set );
            if ( $programs->length() == 0 ){

		           $program = $this->m_reg->m_api->createPROGRAM ( );
			          $program->setSONGID ( $song->getSONGID() );
			          $program->setAUFTRID( $auftrId );
            	   // Save data
			          $program->save( );
            }
        }
    }
}
/********************************************
 * Hinzufügen eines Songs zu einer Probe
 ********************************************/
class ActAddSongToProbe extends Activity{

     function execute( $request, $context ){

        $orderNmb = $request->getParameter( "OrderNmb" );
		$probeId  = $request->getParameter( "probeId" );
        $title    = $request->getParameter( "Title" );

        $set = $this->m_reg->m_sqlMgr->generateSet( "SONG" );
            $field = $set->getField( "ORDERNMB" );
			$field->setValue( $orderNmb   );
            $field = $set->getField( "TITLE" );
			$field->setValue( $title   );

		$songs = $this->m_reg->m_api->findSONGByWildcards( $set );
        $len = $songs->length( );
        for ( $i = 0; $i < $len; $i ++ ){

            $song = $songs->getElement( $i );
            $songId = $song->getSONGID( );
            
            $set = $this->m_reg->m_sqlMgr->generateSet( "PROGRAMPROBE" );
            $field = $set->getField( "SONGID" );
			$field->setValue( $song->getSONGID()  );
            $field = $set->getField( "PROBEID" );
			$field->setValue( $probeId   );

            // Only link songs that are not already assigned to
            // the auftritt.
            $programs = $this->m_reg->m_api->findPROGRAMPROBEByWildcards( $set );
            if ( $programs->length() == 0 ){

		           $program = $this->m_reg->m_api->createPROGRAMPROBE ( );
			          $program->setSONGID ( $songId );
			          $program->setPROBEID( $probeId );
            	   // Save data
			          $program->save( );
            }
        }
    }
}
class ActAddCommentToSong extends Activity{

    function execute( $request, $context ){

            $songId = $request->getParameter( "songId" );
            $user    = $context->getParameter( "User" );

            $comment = $this->m_reg->m_api->createCOMMENT ( );
            $comment->setSONGID( $songId );
            $comment->setUSERNAME( $user );
            
            $date = getdate ( );
            $year = $date[ "year"];
            $month = $date[ "month" ];
            $day   = $date[ "mday" ];
            $comment->setDATUM( $day . " " . $month . " " . $year );
            
            $comment->setTEXTSTR( $request->getParameter( "Text" ) );

            // Save changes
            $comment->save( );
	}
}
class ActAddCommentToAuftritt extends Activity {

	/************************************************
   	 * Hinzufügen eines Kommentars zu einem Auftritt
	 ************************************************/
    function execute( $request, $context ){

            $auftrId = $request->getParameter( "auftrId" );
            $user    = $context->getParameter( "User" );
            
            $comment = $this->m_reg->m_api->createCOMMENT ( );
            $comment->setAUFTRID( $auftrId );
            $comment->setUSERNAME( $user );
            
            $date = getdate ( );
            $year = $date[ "year"];
            $month = $date[ "month" ];
            $day   = $date[ "mday" ];
            $comment->setDATUM( $day . " " . $month . " " . $year );

            $comment->setTEXTSTR( $request->getParameter( "Text" ) );
            
            // Save changes
            $comment->save( );
	}
}
class ActRemoveSongFromAuftritt extends Activity {
	/********************************************
   	 * Löschen eines Songs aus einem Auftritt
	 ********************************************/
    function execute( $request, $context ){

             $auftrId = $request->getParameter( "auftrId" );
             $songId  = $request->getParameter( "songId" );
             
             $set = $this->m_reg->m_sqlMgr->generateSet( "PROGRAM" );
             $field = $set->getField( "SONGID" );
			    $field->setValue( $songId   );
             $field = $set->getField( "AUFTRID" );
		        $field->setValue( $auftrId   );
   
             $programs = $this->m_reg->m_api->findPROGRAMByWildcards ( $set );
             $program = $programs->getElement( 0 );
                 $program->remove( );
	}
}
class ActRemoveSongFromProbe extends Activity {
	/********************************************
   	 * Löschen eines Songs aus einer Probe
	 ********************************************/
     function execute( $request , $context){

             $probeId = $request->getParameter( "probeId" );
             $songId  = $request->getParameter( "songId" );

             $set = $this->m_reg->m_sqlMgr->generateSet( "PROGRAMPROBE" );
             $field = $set->getField( "SONGID" );
			    $field->setValue( $songId   );
             $field = $set->getField( "PROBEID" );
		        $field->setValue( $auftrId   );

             $programs = $this->m_reg->m_api->findPROGRAMPROBEByWildcards ( $set );
             $program = $programs->getElement( 0 );
                      $program->remove( );
     }
}
?>
