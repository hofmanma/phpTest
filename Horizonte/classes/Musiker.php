<?php

if (MUSIKER_CLASSES == 1)
   return;

define( MUSIKER_CLASSES, 1);

include "Activity.php";

class ActFindMusiker extends Activity{

	function execute ( $request, $context  ) {

		    $ort 	= $request->getParameter("Ort" );
		    $PLZ 	= $request->getParameter("PLZ" );
		    $strasse 	= $request->getParameter("Strasse" );
	        $name 	= $request->getParameter("Name" );
		    $vorname 	= $request->getParameter("Vorname" );
		    $email 	= $request->getParameter("Email" );
	        $tel 	= $request->getParameter("Tel" );

		    $set = $this->m_reg->m_sqlMgr->generateSet( "MUSIKER" );
			$set->setValue( "ORT"  , $ort );
			$set->setValue( "PLZ"  , $PLZ );
			$set->setValue( "STRASSE"  , $strasse );
			$set->setValue( "NAME"  , $name );
			$set->setValue( "VORNAME"  , $vorname );
			$set->setValue( "EMAIL"  , $email );
			$set->setValue( "TEL"  , $tel );

		    $musiker = $this->m_reg->m_api->findMUSIKERByWildcards( $set );
        // Save result for the view
           $context->addParameter ( 'MusikerListe', $musiker );
	}
}

class ActUpdateMusiker extends Activity{

 	function execute ( $request, $context  ) {

		    $musikerId = $request->getParameter( "musikerId" );
		    $musiker = $this->m_reg->m_api->findMUSIKERByPrimaryKey( $musikerId );

        $musiker->setORT    ( $request->getParameter("Ort" ));
		$musiker->setPLZ    ( $request->getParameter("PLZ" ));
		$musiker->setSTRASSE( $request->getParameter("Strasse" ));
		$musiker->setNAME   ( $request->getParameter("Name" ));
		$musiker->setVORNAME( $request->getParameter("Vorname" ));
		$musiker->setEMAIL  ( $request->getParameter("Email"));
		$musiker->setTEL    ( $request->getParameter("Tel"));

		// Save data
			$musiker->save( );
   
        // Save result for the view
           $context->addParameter ( 'Musiker', $musiker );
	}
}
class ActShowMusiker extends Activity{

 	function execute ( $request, $context  ) {

		    $musikerId = $request->getParameter( "musikerId" );
		    $musiker = $this->m_reg->m_api->findMUSIKERByPrimaryKey( $musikerId );

        // Save result for the view
           $context->addParameter ( 'Musiker', $musiker );
	}
}
class ActCreateMusiker extends Activity{

	function execute ( $request, $context  ) {

        $user = $request->getParameter("User");
        $pwd1 = $request->getParameter("Pwd1");
        $pwd2 = $request->getParameter("Pwd2");

        if ( strcmp( $user, "" ) == 0 )
           return;
        if ( strcmp( $pwd1, "" ) == 0 )
           return;
        if ( strcmp( $pwd1, $pwd2 )  )
           return;
           
	        $musiker = $this->m_reg->m_api->createMUSIKER( );

		$musiker->setORT    ( $request->getParameter("Ort" ));
		$musiker->setPLZ    ( $request->getParameter("PLZ" ));
		$musiker->setSTRASSE( $request->getParameter("Strasse" ));
		$musiker->setNAME   ( $request->getParameter("Name" ));
		$musiker->setVORNAME( $request->getParameter("Vorname" ));
		$musiker->setEMAIL  ( $request->getParameter("Email"));
		$musiker->setTEL    ( $request->getParameter("Tel"));
        $musiker->setUSERNAME ( $user );
        $musiker->setPASSWORD ( $pwd1 );
        
		// Save data
			$musiker->save ( );
        // Save result for the view
           $context->addParameter ( 'Musiker', $musiker );
   }
}

class ActItsMe extends Activity{

	function execute ( $request, $context  ) {

            $userName = $context->getParameter( "User" );

		    $set = $this->m_reg->m_sqlMgr->generateSet( "MUSIKER" );
			$set->setValue( "USERNAME"  , $userName );

		    $musikerAll = $this->m_reg->m_api->findMUSIKERByWildcards( $set );
            $musiker = $musikerAll->getElement( 0 );
        // Save result for the view
           $context->addParameter ( 'Musiker', $musiker );
	}
}
?>
