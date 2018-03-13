<?php

if (AUTH_CLASSES == 1)
   return;

define( AUTH_CLASSES, 1);

include "Activity.php";
include "Array.php";

class ActLogin extends Activity{

    function execute( $request, $context ){

        $user = $request->getParameter( "User" );
        $pwd  = $request->getParameter( "Pwd" );
           
        if ( ! strcmp( $user, "" ) )
           return( "errors/loginFailed.htm" );
        if ( ! strcmp( $pwd, "" ) )
           return( "errors/loginFailed.htm" );
        if ( ! strcmp( strpos( $pwd, "%" ) , "0" ) )
           return( "errors/loginFailed.htm" );
        if ( ! strcmp( strpos( $user, "%" ) , "0") )
           return( "errors/loginFailed.htm" );

          $set = $this->m_reg->m_sqlMgr->generateSet( "MUSIKER" );
			$set->setValue( "USERNAME"  , $user );
			$set->setValue( "PASSWORD"  , $pwd );

          $musiker = $this->m_reg->m_api->findMUSIKERByWildcards( $set );
          if ( $musiker->length() == 1 ){

             $context->addParameter( "User", $user );
             return( null );
         }
         else
             return( "errors/loginFailed.htm" );

    }
    function security( $context ){

             return( TRUE );
    }
}

class ActLogoff extends Activity{

    function execute( $request, $context ){

        $context->addParameter( "User", "" );

        $_SESSION['state'] = null;
        $_SESSION['User'] = null;
        $_SESSION['Pwd'] = null;
        $_SESSION['stateEngine'] = null;
        $_SESSION['Context']     = null;
        $_SESSION['Registry']    = null;
    }
}
?>
