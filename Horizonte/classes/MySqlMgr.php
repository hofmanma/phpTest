<?php

if (MYSQLMGR_CLASSES == 1)
   return;

define( MYSQLMGR_CLASSES, 1);

include "RecordSet.php";

class MySqlMgr
{
	var $m_ip;
	var $m_db;
	var $m_user;
	var	$m_passwd;

	var $m_registry;
	var $m_connection;
	var $m_result;

	function MySqlMgr( $reg ){

		$this->m_registry = $reg;
	}
	function		openConnection  ( $ip, $user, $passwd, $db){

         $this->m_db = $db;
         $this->m_user = $user;
         $this->m_passwd = $passwd;
         $this->m_ip = $ip;

         $this->m_connection = @mysql_connect( "localhost",
									$user,
									$passwd,
                                    "horizonte2");

          if ( $this->m_connection == null ){

               echo  "Verbindung fehlgeschlagen";
               return ( false );
          }

          return ( true );
	}
    function closeConnection( ){

          if  ( $this->m_connection )
               @mysql_close( $this->m_connection );

          $this->m_connection = null;
    }
    
	function		executeQuery	( $statement ){

        if ( ! $this->m_connection )
		      return( "Connection was not opened yet!" );
                                    
        $this->m_result = mysql_query( $statement , $this->m_connection);
        if ( $this->m_result != 0 )
		      return  ( mysql_error( $this->m_connection ));

         return ( "SUCCESS" );
    }

	function	find		( $table, $key ){

            $query = "SELECT * FROM ";
			$query .= $table;
			$query .= " WHERE ";
			$query .= $this->createPrimaryKeyWhereClause( $table, $key );
			$query .= ";";

            $this->executeQuery( $query, false );

	    $result = new DataSet( );
        $type  = 0;
	    $fieldNmb =  mysql_num_fields( $this->m_result);

	    while( ( $row = mysql_fetch_row( $this->m_result )) != null )
	    {
		   if ( $fieldNmb > 0 )
			  $record = new RecordSet( );

		   for ( $i = 0; $i < $fieldNmb; $i ++ )
		   {
			  $fieldName = mysql_field_name($this->m_result,  $i);
              $fieldType = mysql_field_type($this->m_result,  $i);
              $flags     = mysql_field_flags( $this->m_result, $i );
              
			  $field = new Field( );
			  $field->setName( $fieldName );
			  $field->setType( $fieldType );
     
                //$value = str_replace( "###ABC###", "'", $row[ $i ] );
                //$value = $this->redo_escape_string( $row[ $i ] );
                $field->setValue( $row[ $i ] );
               
              //$field->setValue( $value );
              if ( strpos( $flags, "primary_key" ) != FALSE ) {

                  $field->setKey( TRUE );
                  $record->setPKeyName( $fieldName );
                  //$record->setId( $row[ $i ] );
              }

			  $record->insertField( $field );
		   }

		   $result->addRecordSet( $record );
	    }
	    return( $result );
	}

	function    findByWhere	( $table, $where ){
            
            $query = "SELECT * FROM ";
			$query .= $table;
			$query .= " WHERE ";
			$query .= $where;
			$query .= ";";

            //echo $query;
            $this->executeQuery( $query, false );
            
	     $result = new DataSet( );
	     $record = null;

	     $field = null;
	     $value = null;

	     $type  = 0;
	     $fieldNmb =  mysql_num_fields($this->m_result);
         $ergebnis =  mysql_list_fields( "horizonte2", $table );
         
	     while( $row = mysql_fetch_row( $this->m_result ) )
	     {
            //echo "+";
		    if ( $fieldNmb > 0 )
			   $record = new RecordSet( );

		    for ( $i = 0; $i < $fieldNmb; $i ++ )
		    {
			   $fieldName = mysql_field_name($this->m_result, $i );
               $flags     = mysql_field_flags( $this->m_result, $i );

               $field = new Field( );
			   $field->setName( $fieldName );
			   $field->setType( mysql_field_type( $this->m_result, $i ));
      
               //$value = str_replace( "###ABC###", "'", $row[ $i ] );
               //$value = $this->redo_escape_string( $row[ $i ] );
                      $field->setValue( $row[ $i ] );
               
               if ( strpos( $flags, "primary_key" ) != FALSE )  {

                  $field->setKey( TRUE );
                  $record->setPKeyName( $fieldName );
                }

			   $record->insertField( $field );
            }
            $result->addRecordSet( $record );
         }
         return( $result );
	}

	function	insert		( $table, $data ){

            $query  = "INSERT INTO ";
			$query .= $table;
			$query .= " ( ";

            $fieldNmb = $data->getFieldNmb( );
	        $field = null;
	        $value = null;
            $i = 0;

	    for ( $i = 0 ; $i < $fieldNmb; $i ++ )
	    {
		   $field = $data->getFieldByIndex( $i );
		   $name  = $field->getName        (   );
		   $value = $field->getValue       (   );

		   $query .= $name;
		   if ( $i < $fieldNmb - 1 )
			  $query .= ", ";
		   else
			  $query .= " ) ";
	    }

	    $query .= " VALUES ( ";
	    for ( $i = 0 ; $i < $fieldNmb; $i ++ )
	    {
		   $field  = $data->getFieldByIndex( $i );
		   $name   = $field->getName       (   );
		   $value  = $field->getValue      (   );

           //$value = str_replace( "'", "###ABC###", $value );
           //$value = mysql_escape_string( $value );
           
		   $query .= "'";
		   $query .= $value;
		   $query .= "'";

		   if ( $i < $fieldNmb - 1 )
			  $query .= ", ";
		   else
			  $query .= " ) ";
	    }

	    $query .= ";";
        
	    $this->executeQuery( $query, false );
		   return( true );
    }

    function		update		( $table, $data ){

            $query  = "UPDATE ";
			$query .= $table;
			$query .= " SET ";

	        $fieldNmb = $data->getFieldNmb( );
            $field = null;
	        $value = null;


	    for ( $i = 0 ; $i < $fieldNmb; $i ++ )
	    {
		   $field  = $data->getFieldByIndex( $i );
		   $name   = $field->getName       (   );
		   $value  = $field->getValue      (   );
           
           if ( strcmp( $data->getPKeyName(), $name )){

              //$value = str_replace( "'", "###ABC###", $value );
              //$value = mysql_escape_string( $value );
              $query .= $name;
		      $query .= " = ";
		      $query .= "'";
		      $query .= $value;
		      $query .= "'";

		     if ( $i < $fieldNmb - 1 )
			    $query .= ", ";
          }
	    }

        $query .= " WHERE ";
        $query .= $data->getPKeyName();
        $query .= " = '";
        $query .= $data->getValue( $data->getPKeyName()) ;
        $query .= "'";
	    $query .= ";";
     
   	    $this->executeQuery( $query, false );

        return( true );
	}
	function		delete		( $table, $data ){

		    $query  = "DELETE FROM ";
		    $query .= $table;
		    $query .= " WHERE ";
		    $query .= $data->getPKeyName( );
		    $query .= " = '";
            $query .= $data->getValue( $data->getPKeyName() );
            $query .= "';";
            
            //echo $query;
		    $this->executeQuery( $query );

		    return( true );
	}

	function	createWhereClause( $table, $key ){

            $fieldNmb = $key->getFieldNmb( );
	        $field = null;
	        $value = null;
            $i2 = 0;
	    for ( $i = 0 ; $i < $fieldNmb; $i ++ )
	    {
		   $field = $key->getFieldByIndex( $i );
		   $name  = $field->getName      (   );
		   $value = $field->getValue     (   );

           if ( strcmp( $value, "" ) ){
              if ( $i2 > 0 && $i < $fieldNmb ) // Attentione -1
			    $where .= " AND ";
     
              $fieldVal = $value;

			  $where .= " ";
			  $where .= $name;
			  $where .= " LIKE '";
			  $where .= $fieldVal;
			  $where .= "'";
              $i2 ++;
           }
        }
        return( $where );
	}

    function	createPrimaryKeyWhereClause( $table, $key ){

            $fieldNmb = $key->getFieldNmb( );
	        $field = null;
	        $value = null;
            $i2 = 0;
            
            $pKeyName = $key->getPKeyName( );
            $pKeyValue = $key->getValue( $pKeyName );
            
        $where = " " . $pKeyName . " = '" . $pKeyValue . "'";
                   
        return( $where );
	}
	function    	generateSet      ( $table ){

            $result = mysql_list_fields( "horizonte2" , $table,
										 $this->m_connection);
	        $fieldNmb = mysql_num_fields( $result );
	    	$type	  = 0;

	        $set = new RecordSet( );
	        $field = null;
	        $value = null;

	    for ( $i = 0; $i < $fieldNmb ; $i ++)
	    {
		   $fieldName = mysql_field_name( $result, $i );
		   $type      = mysql_field_type( $result, $i);
           $flags     = mysql_field_flags( $result, $i );

		   $field = new Field( );

           $field->setName( $fieldName );
		   $field->setValue( "" );

           if ( strpos( $flags, "primary_key" ) != FALSE )  {

                  $field->setKey( TRUE );
                  $set->setPKeyName( $fieldName );
           }
            
		   $set->insertField( $field );
	    }
     
        return( $set );
	}

	function 		generateGuid     ( $table ){

        $result = mysql_list_fields( "horizonte2" , $table,
							         $this->m_connection);
        $fieldNmb = mysql_num_fields( $result );
         
        for ( $i = 0; $i < $fieldNmb ; $i ++)
        {
                 $fieldName = mysql_field_name( $result, $i );
                 $flags     = mysql_field_flags( $result, $i );
                 if ( strpos( $flags, "primary_key" ) != FALSE )
                     break;
        }

        $query  = "SELECT MAX(";
        $query .= $fieldName;
        $query .= ") FROM ";
		$query .= $table;
		$query .= ";";
        
            $this->executeQuery( $query, false );

	    $count = mysql_result( $this->m_result, 0 );
		      $count ++;

	    return( $count );
	}
    function   generateKey      ( $table ){

		$set = $this->generateSet( $table );

		if ( ! strcmp( $table , "SONG" )  )
		{
			$field =   $set->getField( "SONGID" );
			$field->setKey( true );
			$field->setValue( $this->generateGuid( "SONG" ));
		}
		else if ( ! strcmp($table , "AUFTRITT") )
		{
			$field =   $set->getField( "AUFTRID" );
			$field->setKey( true );
			$field->setValue( $this->generateGuid( "AUFTRITT" ));
		}
		else if ( ! strcmp($table , "MUSIKER" ))
		{
			$field =   $set->getField( "MUSIKERID" );
			$field->setKey( true );
			$field->setValue( $this->generateGuid( "MUSIKER" ));
		}
		else if ( ! strcmp($table , "PROGRAM" ))
		{
			$field =   $set->getField( "PROGID" );
			$field->setKey( true );
			$field->setValue( $this->generateGuid( "PROGRAM" ));
		}
		else if ( ! strcmp($table , "COMMENT") )
		{
			$field =   $set->getField( "COMMENTID" );
			$field->setKey( true );
			$field->setValue( $this->generateGuid( "COMMENT" ));
		}
		else if ( ! strcmp($table , "PROBE"))
		{
			$field =   $set->getField( "PROBEID" );
			$field->setKey( true );
			$field->setValue( $this->generateGuid( "PROBE" ));
		}
		else if ( ! strcmp($table , "PROGRAMPROBE" ))
		{
			$field =   $set->getField( "PROGPROBEID" );
			$field->setKey( true );
			$field->setValue( $this->generateGuid( "PROGRAMPROBE" ));
		}
        else if ( ! strcmp($table , "DOKUMENT" ))
		{
			$field =   $set->getField( "DOCID" );
			$field->setKey( true );
			$field->setValue( $this->generateGuid( "DOKUMENT" ));
		}


		return( $set );
	}
}
?>
