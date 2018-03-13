<?php

include "Array.php";

class Field
{
    function Field( ){

        $this->m_is_key = false;
    }
	function getValue( ){

		return( $this->m_value );
	}

	function hasName ( $name ){

		return( ! strcmp( $this->m_name , $name ) );
	}

	function isKey   ( ){

		return( $this->m_is_key );
	}

	function setKey  ( $key ){

		$this->m_is_key = $key;
	}

	function cloneField( ){

        $clone = new Field( );

		$clone->setValue( $this->m_value );
		$clone->setName ( $this->m_name );
		$clone->setKey  ( $this->m_is_key );

	    return ( $clone );
	}

	function setName ( $name ){

		$this->m_name = $name;
	}

	function getName () {

		return( $this->m_name );
	}

	function setValue( $val  ){

		$this->m_value = $val;
	}

	function setIVal( $val  ){

          $this->m_value = $val;
	}
	function getIVal( ){

		return( $this->m_value );
	}
	function setDVal( $val  ){

        $this->m_value = $val;
	}
	function  getDVal( ){

		return( $this->m_value );
	}
 
    function setType ( $type  ){

		$this->m_type = $type;
	}
    function getType( ){

         return( $this->m_type);
    }

	var $m_value;
    var $m_type;
	var $m_is_key;
	var $m_name;
}

class DataSet{

    function DataSet( ){

        $this->m_nmb = 0;
	    $this->m_pos = 0;
        $this->m_recSets = new Collection();
        
    }
	function   addRecordSet    ( $recSet ){

		$this->m_recSets->addElement( $recSet );
        $this->m_nmb = $this->m_recSets->length( );
	}

	function  getSetByKey     ( $key    ){

         $iter = NULL;
	     for ( $iter = $this->begin() ;$iter != $this->endElem( ); $iter = $this->nextElem( )  )
         {
		    if ( $iter->keyMatches( $key ) ){

                 return($iter );
            }
	     }
	     return( NULL );
	}

	function  getSetById      ( $id	){

         $iter = NULL;

         for ( $iter  = $this->begin( ); $iter != $this->endElem  ( ); $iter  = $this->nextElem ( ) )
			  if ( $iter->hasId( $id ) )
                  return( $iter );

	     return( NULL );
	}

	function	      deleteRecordSet ( $set ){

        $delSet = $this->getSetByKey( $set );
	    if ( $delSet )
	    {
		   for ( $i = 0; $i <  $this->m_recSets->length(); $i ++ )
		   {
			  if ( $this->m_recSets->getElement( $i )->keyMatches( $delSet ))
			  {
                 $this->m_recSets->removeElement( $i );
                 $this->m_nmb = $this->m_recSets->length( );
                 
                 return( true );
			  }
		   }
	    }
	    return( false );
	}

	function    adjust	      ( $set ){

		$iter     = NULL;
	    $changed  = NULL;

	    for ( $iter = $this->begin( ); $iter != $this->endElem( ); $iter = $this->nextElem( ))
	    {
		    $changed = $set->getSetByKey( $iter );
		    if ( $changed ){

			  $iter->setAttributes( $changed );
             }
	    }
	    return( $this );
	}

	function  begin( ){

        $this->m_pos = 0;
		   return ( $this->m_recSets->getElement( 0 ) );
	}

	function  nextElem ( ){

        $this->m_pos ++;
	    if ( $this->m_pos == $this->m_nmb )
		   return( NULL );
        else
		   return ( $this->m_recSets->getElement( $this->m_pos ) );
	}

	function  endElem  ( ){

		return( null );
	}
    function printContent( $fieldName ){

        echo $this->m_recSets->length();
        for ( $i = 0; $i < $this->m_recSets->length(); $i ++){

            $rec =  $this->m_recSets->getElement( $i );
            $field = $rec->getField( $fieldName );
            echo $field->getValue( );
        }
    }

	function getRecordNmb( ){

		return( $this->m_recSets->length());
	}

	var $m_recSets;
	var $m_pos;
 	var $m_nmb;
}

class RecordSet
{
    function RecordSet( ){

        $this->m_state = $this->STATE_UNDEFINED;
        $this->m_nmb   = 0;
        $this->m_fields = new Collection();
    }
	function getField   ( $field ){

         for ( $i = 0; $i < $this->m_fields->length(); $i ++ )
		       if ( $this->m_fields->getElement( $i )->hasName( $field ))
			      return( $this->m_fields->getElement( $i ) );

	        return( null );
	}
	function    setValue    ( $field, $value ){

         $field = $this->getField( $field );
         if ( $field )
		     $field->setValue( $value );
    }
	function  getValue    ( $field ){

	     $field = $this->getField( $field );
	     if ( $field )
		    return( $field->getValue( ) );
	     else
	     {
		  // TODO: Exception
		    return( NULL );
	     }
	}
	function    setState    ( $state ){

         switch( $this->m_state )
         {
	        case $this->STATE_UNDEFINED:
		       $this->m_state = $state;
		       break;
	        case $this->STATE_NEW:
               if ( $state == $this->STATE_PERSISTED )
                  $this->m_state = $state;
		       break;

	        case $this->STATE_CHANGED:
		       if ( $state != $this->STATE_NEW )
			      $this->m_state = $state;
		       else
		       {
			      // TODO: Exception
		       }
		       break;

	        case $this->STATE_UNCHANGED:
		       if ( $state != $this->STATE_NEW )
			      $this->m_state = $state;
		       else
		       {
			      // TODO: Exception
		       }
		       break;

	        case $this->STATE_DELETED:
		       if ( $state == $this->STATE_DELETED )
			      $this->m_state = $state;
		       else
		       {
			      // TODO: Exception
		       }
		       break;
            case $this->STATE_PERSISTED:

               $this->m_state = $state;
               break;
	        }
	}
	function    addField ($isKey, $field, $value  ){

		$field = new Field( );
		$field->setName( $field  );
		$field->setValue($value );
		$field->setKey( $isKey );

			$this->m_fields->addElement($field);
	}
    function insertField( $field ){

         $this->m_fields->addElement($field);
    }

	function	keyMatches  ( $key ){

        $iter   = NULL;
	    $field  = NULL;
	    $name   = "";
	    $value1 = NULL;
	    $value2 = NULL;

	    for ( $iter = $this->begin( ); $iter != $this->endElem( ); $iter = $this->nextElem( ) )
	    {
		   if ( $iter -> isKey ( ) )
		   {
			  $value1 = $iter->getValue( );
			  $name   = $iter->getName ( );
		          $field  = $key->getField( $name );

              if ( $field )
			  {
				 $value2 = $field->getValue( );
				 if ( strcmp( $value1 , $value2 ) )
					 return( false );
			  }
              else
                  return( false );
		   }
	    }
	    return( true );
	}

	function	getState     ( ){

		return( $this->m_state );
	}

	function cloneRec	( ){

        $clone = new RecordSet( );
               $clone->setPKeyName($this->m_pKey);
               $clone->setId( $this->m_id );
               $clone->setState( $this->m_state);
        
	    for ( $i = 0; $i < $this->m_fields->length( ); $i ++ )
		    $clone->insertField( $this->m_fields->getElement( $i )->cloneField( ) );

        return( $clone );
	}

	function	setId		( $id		 ){

        $this->m_id = $id;
	}
	function 	getId		(                ){

        return( $this->m_id );
	}
	function hasId		( $id		 ){

		return( $this->m_id == $id ); // Attentione
	}
	function     getFieldNmb	(                ){

		return( $this->m_fields->length());
	}
	function getFieldByIndex( $index     ){

        return( $this->m_fields->getElement( $index ) );
	}

	function begin	 ( ){

		$this->m_pos = 0;
		       return( $this->m_fields->getElement( $this->m_pos ) );
	}
	function nextElem	 ( ){

        $this->m_pos ++;
        if ( $this->m_pos == $m_nmb )
		      return( NULL );
        else
		      return( $this->m_fields->getElement( $this->m_pos ) );

	}
	function endElem	 ( ){

		return( null );
	}
    function setAttributes( $data ){

	    for ( $iter = $this->begin( ); $iter != $this->endElem( ); $iter = $this->nextElem( ) )
	    {
		   if ( ! $iter -> isKey ( ) )
		   {
			  $name   = $iter->getName ( );
		          $field  = $data->getField( $name );

              if ( $field )
			  {
				 $value = $field->getValue( );
                 $iter->setValue( $value );
			  }
		   }
	    }
    }

    function printContent( $fieldName ){

             $field = $this->getField( $fieldName );
             echo $field->getValue( );
    }
    function setPKeyName( $pKey ){

             $this->m_pKey = $pKey;
    }

    function getPKeyName( ){

             return( $this->m_pKey );
    }
    
	var $m_fields;
	var $m_state;
	var $m_pos;
	var $m_id;
    var $m_pKey;
 
    var $STATE_PERSISTED   = 1;
    var $STATE_UNDEFINE    = 2;
    var $STATE_CHANGE      = 3;
    var $STATE_NEW         = 4;
    var $STATE_UNCHANGED   = 5;
    var $STATE_DELETED     = 6;
}
?>
