<?php

class API{

	var $m_registry;
	
	function API(  $reg ){
	
		$this->m_registry = $reg;
	}
  
   
/***************************************
 * findSONGByWhere
 ***************************************/
	function findSONGByWildcards( $key ){ 

		$entities = new Collection( );
		$whereSql = $this->m_registry->m_sqlMgr->createWhereClause( "SONG", $key );
		
		$result = $this->m_registry->m_sqlMgr->findByWhere( "SONG", $whereSql );
		$iter = null;
		$entity = null;
		$coll   = null;
		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( )){

			    $coll = $this->m_registry->m_EntityMgr->load( "SONG", $iter , false);
			    	$entities->addElement( $coll->getElement( 0 ) );
			}
		}
		
		return( $entities );
	}
/***************************************
 * findSONGByPrimaryKey
 ***************************************/
	function  findSONGByPrimaryKey( $id ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateSet( "SONG" );
		$field =
			$key->getField( "SONGID" );
			    $field->setValue( $id ); 
		$coll = $this->m_registry->m_EntityMgr->load( "SONG", $key, false );
		$entity = $coll->getElement( 0 );
			return( $entity );
	}
/*********************************
 * createSONG *********************************/
	function  createSONG( ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateKey( "SONG" ); 
		$entity = $this->m_registry->m_EntityMgr->create ( "SONG" , $key );
		return( $entity );
	} 
   
/***************************************
 * findAUFTRITTByWhere
 ***************************************/
	function findAUFTRITTByWildcards( $key ){ 

		$entities = new Collection( );
		$whereSql = $this->m_registry->m_sqlMgr->createWhereClause( "AUFTRITT", $key );
		
		$result = $this->m_registry->m_sqlMgr->findByWhere( "AUFTRITT", $whereSql );
		$iter = null;
		$entity = null;
		$coll   = null;
		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( )){

			    $coll = $this->m_registry->m_EntityMgr->load( "AUFTRITT", $iter , false);
			    	$entities->addElement( $coll->getElement( 0 ) );
			}
		}
		
		return( $entities );
	}
/***************************************
 * findAUFTRITTByPrimaryKey
 ***************************************/
	function  findAUFTRITTByPrimaryKey( $id ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateSet( "AUFTRITT" );
		$field =
			$key->getField( "AUFTRID" );
			    $field->setValue( $id ); 
		$coll = $this->m_registry->m_EntityMgr->load( "AUFTRITT", $key, false );
		$entity = $coll->getElement( 0 );
			return( $entity );
	}
/*********************************
 * createAUFTRITT *********************************/
	function  createAUFTRITT( ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateKey( "AUFTRITT" ); 
		$entity = $this->m_registry->m_EntityMgr->create ( "AUFTRITT" , $key );
		return( $entity );
	} 
   
/***************************************
 * findPROGRAMByWhere
 ***************************************/
	function findPROGRAMByWildcards( $key ){ 

		$entities = new Collection( );
		$whereSql = $this->m_registry->m_sqlMgr->createWhereClause( "PROGRAM", $key );
		
		$result = $this->m_registry->m_sqlMgr->findByWhere( "PROGRAM", $whereSql );
		$iter = null;
		$entity = null;
		$coll   = null;
		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( )){

			    $coll = $this->m_registry->m_EntityMgr->load( "PROGRAM", $iter , false);
			    	$entities->addElement( $coll->getElement( 0 ) );
			}
		}
		
		return( $entities );
	}
/***************************************
 * findPROGRAMByPrimaryKey
 ***************************************/
	function  findPROGRAMByPrimaryKey( $id ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateSet( "PROGRAM" );
		$field =
			$key->getField( "PROGID" );
			    $field->setValue( $id ); 
		$coll = $this->m_registry->m_EntityMgr->load( "PROGRAM", $key, false );
		$entity = $coll->getElement( 0 );
			return( $entity );
	}
/*********************************
 * createPROGRAM *********************************/
	function  createPROGRAM( ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateKey( "PROGRAM" ); 
		$entity = $this->m_registry->m_EntityMgr->create ( "PROGRAM" , $key );
		return( $entity );
	} 
   
/***************************************
 * findPROBEByWhere
 ***************************************/
	function findPROBEByWildcards( $key ){ 

		$entities = new Collection( );
		$whereSql = $this->m_registry->m_sqlMgr->createWhereClause( "PROBE", $key );
		
		$result = $this->m_registry->m_sqlMgr->findByWhere( "PROBE", $whereSql );
		$iter = null;
		$entity = null;
		$coll   = null;
		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( )){

			    $coll = $this->m_registry->m_EntityMgr->load( "PROBE", $iter , false);
			    	$entities->addElement( $coll->getElement( 0 ) );
			}
		}
		
		return( $entities );
	}
/***************************************
 * findPROBEByPrimaryKey
 ***************************************/
	function  findPROBEByPrimaryKey( $id ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateSet( "PROBE" );
		$field =
			$key->getField( "PROBEID" );
			    $field->setValue( $id ); 
		$coll = $this->m_registry->m_EntityMgr->load( "PROBE", $key, false );
		$entity = $coll->getElement( 0 );
			return( $entity );
	}
/*********************************
 * createPROBE *********************************/
	function  createPROBE( ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateKey( "PROBE" ); 
		$entity = $this->m_registry->m_EntityMgr->create ( "PROBE" , $key );
		return( $entity );
	} 
   
/***************************************
 * findPROGRAMPROBEByWhere
 ***************************************/
	function findPROGRAMPROBEByWildcards( $key ){ 

		$entities = new Collection( );
		$whereSql = $this->m_registry->m_sqlMgr->createWhereClause( "PROGRAMPROBE", $key );
		
		$result = $this->m_registry->m_sqlMgr->findByWhere( "PROGRAMPROBE", $whereSql );
		$iter = null;
		$entity = null;
		$coll   = null;
		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( )){

			    $coll = $this->m_registry->m_EntityMgr->load( "PROGRAMPROBE", $iter , false);
			    	$entities->addElement( $coll->getElement( 0 ) );
			}
		}
		
		return( $entities );
	}
/***************************************
 * findPROGRAMPROBEByPrimaryKey
 ***************************************/
	function  findPROGRAMPROBEByPrimaryKey( $id ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateSet( "PROGRAMPROBE" );
		$field =
			$key->getField( "PROGPROBEID" );
			    $field->setValue( $id ); 
		$coll = $this->m_registry->m_EntityMgr->load( "PROGRAMPROBE", $key, false );
		$entity = $coll->getElement( 0 );
			return( $entity );
	}
/*********************************
 * createPROGRAMPROBE *********************************/
	function  createPROGRAMPROBE( ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateKey( "PROGRAMPROBE" ); 
		$entity = $this->m_registry->m_EntityMgr->create ( "PROGRAMPROBE" , $key );
		return( $entity );
	} 
   
/***************************************
 * findCOMMENTByWhere
 ***************************************/
	function findCOMMENTByWildcards( $key ){ 

		$entities = new Collection( );
		$whereSql = $this->m_registry->m_sqlMgr->createWhereClause( "COMMENT", $key );
		
		$result = $this->m_registry->m_sqlMgr->findByWhere( "COMMENT", $whereSql );
		$iter = null;
		$entity = null;
		$coll   = null;
		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( )){

			    $coll = $this->m_registry->m_EntityMgr->load( "COMMENT", $iter , false);
			    	$entities->addElement( $coll->getElement( 0 ) );
			}
		}
		
		return( $entities );
	}
/***************************************
 * findCOMMENTByPrimaryKey
 ***************************************/
	function  findCOMMENTByPrimaryKey( $id ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateSet( "COMMENT" );
		$field =
			$key->getField( "COMMENTID" );
			    $field->setValue( $id ); 
		$coll = $this->m_registry->m_EntityMgr->load( "COMMENT", $key, false );
		$entity = $coll->getElement( 0 );
			return( $entity );
	}
/*********************************
 * createCOMMENT *********************************/
	function  createCOMMENT( ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateKey( "COMMENT" ); 
		$entity = $this->m_registry->m_EntityMgr->create ( "COMMENT" , $key );
		return( $entity );
	} 
   
/***************************************
 * findMUSIKERByWhere
 ***************************************/
	function findMUSIKERByWildcards( $key ){ 

		$entities = new Collection( );
		$whereSql = $this->m_registry->m_sqlMgr->createWhereClause( "MUSIKER", $key );
		
		$result = $this->m_registry->m_sqlMgr->findByWhere( "MUSIKER", $whereSql );
		$iter = null;
		$entity = null;
		$coll   = null;
		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( )){

			    $coll = $this->m_registry->m_EntityMgr->load( "MUSIKER", $iter , false);
			    	$entities->addElement( $coll->getElement( 0 ) );
			}
		}
		
		return( $entities );
	}
/***************************************
 * findMUSIKERByPrimaryKey
 ***************************************/
	function  findMUSIKERByPrimaryKey( $id ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateSet( "MUSIKER" );
		$field =
			$key->getField( "MUSIKERID" );
			    $field->setValue( $id ); 
		$coll = $this->m_registry->m_EntityMgr->load( "MUSIKER", $key, false );
		$entity = $coll->getElement( 0 );
			return( $entity );
	}
/*********************************
 * createMUSIKER *********************************/
	function  createMUSIKER( ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateKey( "MUSIKER" ); 
		$entity = $this->m_registry->m_EntityMgr->create ( "MUSIKER" , $key );
		return( $entity );
	} 
   
/***************************************
 * findDOKUMENTByWhere
 ***************************************/
	function findDOKUMENTByWildcards( $key ){ 

		$entities = new Collection( );
		$whereSql = $this->m_registry->m_sqlMgr->createWhereClause( "DOKUMENT", $key );
		
		$result = $this->m_registry->m_sqlMgr->findByWhere( "DOKUMENT", $whereSql );
		$iter = null;
		$entity = null;
		$coll   = null;
		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( )){

			    $coll = $this->m_registry->m_EntityMgr->load( "DOKUMENT", $iter , false);
			    	$entities->addElement( $coll->getElement( 0 ) );
			}
		}
		
		return( $entities );
	}
/***************************************
 * findDOKUMENTByPrimaryKey
 ***************************************/
	function  findDOKUMENTByPrimaryKey( $id ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateSet( "DOKUMENT" );
		$field =
			$key->getField( "DOCID" );
			    $field->setValue( $id ); 
		$coll = $this->m_registry->m_EntityMgr->load( "DOKUMENT", $key, false );
		$entity = $coll->getElement( 0 );
			return( $entity );
	}
/*********************************
 * createDOKUMENT *********************************/
	function  createDOKUMENT( ){
	
		$key = 
			$this->m_registry->m_sqlMgr->generateKey( "DOKUMENT" ); 
		$entity = $this->m_registry->m_EntityMgr->create ( "DOKUMENT" , $key );
		return( $entity );
	} 
}
?>
