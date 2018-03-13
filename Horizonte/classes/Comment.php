<?php

if (COMMENT_CLASSES == 1)
   return;

define( COMMENT_CLASSES, 1);

include "Activity.php";

class ActFindCommentsBySong extends Activity{

	/********************************************
         * Finde alle Kommentare zu einem Song.
         ********************************************/
	function execute( $request, $context  ) {

		    $songId = $request->getParameter( "songId" );
		    $key = $this->m_reg->m_sqlMgr->generateSet( "COMMENT" );
			$key->setValue( "SONGID", $songId );

		    $comments = $this->m_reg->m_api->findCOMMENTByWildcards( $key );
            $song = $this->m_reg->m_api->findSONGByPrimaryKey( $songId );
      
               $context->addParameter ( 'Comments', $comments );
               $context->addParameter ( 'Song', $song );
      }
}

class ActFindCommentsByAuftritt extends Activity{

  	/********************************************
     * Finde alle Kommentare zu einem Auftritt.
     ********************************************/
	function execute( $request, $context  ) {

        $auftrId = $request->getParameter( "auftrId" );
		$key = $this->m_reg->m_sqlMgr->generateSet( "COMMENT" );
		$key->setValue( "AUFTRID" , $auftrId   );

		$comments = $this->m_reg->m_api->findCOMMENTByWildcards( $key );
        $auftritt = $this->m_reg->m_api->findAUFTRITTByPrimaryKey( $auftrId );
        
        $context->addParameter( "Comments", $comments  );
        $context->addParameter( "Auftritt", $auftritt  );
	}
}
?>
