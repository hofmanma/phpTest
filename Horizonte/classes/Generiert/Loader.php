<?php

if (LOADER_CLASSES == 1 )
	return;

define ( LOADER_CLASSES, 1 );

include "DAAgent.php";
include "MySqlMgr.php";

class Loader  
{
	function Loader(){
	}
	function 	remove ( $entity ){
	}
	function 	commit ( $entity ){
	}
	function 	copyOut( $entity ){
	}
	function 	copyIn ( $entity, $data ){
	}

	function 	find   ( $key , $cache , $keyMode){
	}
	function 	create ( $key ){
	
		return(false);
	}

	function  matches	( $table   ){ 
	
		return(false); 
	}
	function	setIdByKey ( $id, $key ){
	}

	var $m_agent;
	var $m_table;
}


class LoaderSONG extends Loader 
{
	var $m_registry;
	var $m_table;

	function LoaderSONG( $reg){
		
		$this->m_table = "SONG";
		$this->m_agent = new DAAgent( $this->m_table, $reg );
		$this->m_registry = $reg;
	}
	function	 remove ( $entity ){
	
		$id = $entity->getId( );
			$this->m_agent->delete( $id );
	}
	function	 commit ( $entity ){
		
		$id = $entity->getId( );
			$this->m_agent->commit( $id );
	}
	function	 copyOut( $entity ){
		
		$data = $this->m_registry->m_sqlMgr->generateSet( $this->m_table );
		$field = null;

		$field = $data->getField( "SONGID" );
		$field->setIVal( $entity->getSONGID( ) );
		$field = $data->getField( "TITLE" );
		$field->setValue( $entity->getTITLE( ) );
		$field = $data->getField( "ORDERNMB" );
		$field->setValue( $entity->getORDERNMB( ) );
		$field = $data->getField( "NOTES" );
		$field->setValue( $entity->getNOTES( ) );
		$field = $data->getField( "DESCRIPTION" );
		$field->setValue( $entity->getDESCRIPTION( ) );
		$field = $data->getField( "FILENAME" );
		$field->setValue( $entity->getFILENAME( ) );
		$field = $data->getField( "CATEGORY" );
		$field->setValue( $entity->getCATEGORY( ) );
		$field = $data->getField( "SUBCATEGORY" );
		$field->setValue( $entity->getSUBCATEGORY( ) );
		$this->m_agent->update( $data );
	}

	function	 copyIn ( $entity, $data ){

		$id = $entity->getSONGID( );

		$field = null;

			// Get value of Field 'SONGID'
		$field = $data->getField( "SONGID" );
		$entity->setSONGID( $field->getIVal( ) );
		// Get value of Field 'TITLE'
		$field = $data->getField( "TITLE" );
		$entity->setTITLE( $field->getValue( ) );
		// Get value of Field 'ORDERNMB'
		$field = $data->getField( "ORDERNMB" );
		$entity->setORDERNMB( $field->getValue( ) );
		// Get value of Field 'NOTES'
		$field = $data->getField( "NOTES" );
		$entity->setNOTES( $field->getValue( ) );
		// Get value of Field 'DESCRIPTION'
		$field = $data->getField( "DESCRIPTION" );
		$entity->setDESCRIPTION( $field->getValue( ) );
		// Get value of Field 'FILENAME'
		$field = $data->getField( "FILENAME" );
		$entity->setFILENAME( $field->getValue( ) );
		// Get value of Field 'CATEGORY'
		$field = $data->getField( "CATEGORY" );
		$entity->setCATEGORY( $field->getValue( ) );
		// Get value of Field 'SUBCATEGORY'
		$field = $data->getField( "SUBCATEGORY" );
		$entity->setSUBCATEGORY( $field->getValue( ) );
	
	}

	function	 find   ( $key , $cache , $keyMode ){
		
		$result = $this->m_agent->find( $key, $cache , $keyMode );
		$iter = null;

		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( ))
				  $this->m_registry->m_EntityMgr->add( "SONG", $iter );
		}
	}

	function  create ( $key ){
		
		$newSet = $this->m_agent->create( $key );
		if ( $newSet != null )
		{
			// Create Businessobject
			$this->m_registry->m_EntityMgr->add( "SONG", $newSet );
			return( true );
		}
		else
			return( false );	
	}

	function	 setIdByKey ( $id, $key ){
	
		$this->m_agent->setIdByKey( $id, $key );
	}

	function   matches ( $table   ){

		return( ! strcmp( $this->m_table, $table) );
	
	}
}


class LoaderAUFTRITT extends Loader 
{
	var $m_registry;
	var $m_table;

	function LoaderAUFTRITT( $reg){
		
		$this->m_table = "AUFTRITT";
		$this->m_agent = new DAAgent( $this->m_table, $reg );
		$this->m_registry = $reg;
	}
	function	 remove ( $entity ){
	
		$id = $entity->getId( );
			$this->m_agent->delete( $id );
	}
	function	 commit ( $entity ){
		
		$id = $entity->getId( );
			$this->m_agent->commit( $id );
	}
	function	 copyOut( $entity ){
		
		$data = $this->m_registry->m_sqlMgr->generateSet( $this->m_table );
		$field = null;

		$field = $data->getField( "AUFTRID" );
		$field->setIVal( $entity->getAUFTRID( ) );
		$field = $data->getField( "DATUM" );
		$field->setValue( $entity->getDATUM( ) );
		$field = $data->getField( "ORT" );
		$field->setValue( $entity->getORT( ) );
		$field = $data->getField( "DESCRIPTION" );
		$field->setValue( $entity->getDESCRIPTION( ) );
		$field = $data->getField( "NOTES" );
		$field->setValue( $entity->getNOTES( ) );
		$field = $data->getField( "FILENAME" );
		$field->setValue( $entity->getFILENAME( ) );
		$this->m_agent->update( $data );
	}

	function	 copyIn ( $entity, $data ){

		$id = $entity->getAUFTRID( );

		$field = null;

			// Get value of Field 'AUFTRID'
		$field = $data->getField( "AUFTRID" );
		$entity->setAUFTRID( $field->getIVal( ) );
		// Get value of Field 'DATUM'
		$field = $data->getField( "DATUM" );
		$entity->setDATUM( $field->getValue( ) );
		// Get value of Field 'ORT'
		$field = $data->getField( "ORT" );
		$entity->setORT( $field->getValue( ) );
		// Get value of Field 'DESCRIPTION'
		$field = $data->getField( "DESCRIPTION" );
		$entity->setDESCRIPTION( $field->getValue( ) );
		// Get value of Field 'NOTES'
		$field = $data->getField( "NOTES" );
		$entity->setNOTES( $field->getValue( ) );
		// Get value of Field 'FILENAME'
		$field = $data->getField( "FILENAME" );
		$entity->setFILENAME( $field->getValue( ) );
	
	}

	function	 find   ( $key , $cache , $keyMode ){
		
		$result = $this->m_agent->find( $key, $cache , $keyMode );
		$iter = null;

		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( ))
				  $this->m_registry->m_EntityMgr->add( "AUFTRITT", $iter );
		}
	}

	function  create ( $key ){
		
		$newSet = $this->m_agent->create( $key );
		if ( $newSet != null )
		{
			// Create Businessobject
			$this->m_registry->m_EntityMgr->add( "AUFTRITT", $newSet );
			return( true );
		}
		else
			return( false );	
	}

	function	 setIdByKey ( $id, $key ){
	
		$this->m_agent->setIdByKey( $id, $key );
	}

	function   matches ( $table   ){

		return( ! strcmp( $this->m_table, $table) );
	
	}
}


class LoaderPROGRAM extends Loader 
{
	var $m_registry;
	var $m_table;

	function LoaderPROGRAM( $reg){
		
		$this->m_table = "PROGRAM";
		$this->m_agent = new DAAgent( $this->m_table, $reg );
		$this->m_registry = $reg;
	}
	function	 remove ( $entity ){
	
		$id = $entity->getId( );
			$this->m_agent->delete( $id );
	}
	function	 commit ( $entity ){
		
		$id = $entity->getId( );
			$this->m_agent->commit( $id );
	}
	function	 copyOut( $entity ){
		
		$data = $this->m_registry->m_sqlMgr->generateSet( $this->m_table );
		$field = null;

		$field = $data->getField( "PROGID" );
		$field->setIVal( $entity->getPROGID( ) );
		$field = $data->getField( "AUFTRID" );
		$field->setIVal( $entity->getAUFTRID( ) );
		$field = $data->getField( "SONGID" );
		$field->setIVal( $entity->getSONGID( ) );
		$this->m_agent->update( $data );
	}

	function	 copyIn ( $entity, $data ){

		$id = $entity->getPROGID( );

		$field = null;

			// Get value of Field 'PROGID'
		$field = $data->getField( "PROGID" );
		$entity->setPROGID( $field->getIVal( ) );
		// Get value of Field 'AUFTRID'
		$field = $data->getField( "AUFTRID" );
		$entity->setAUFTRID( $field->getIVal( ) );
		// Get value of Field 'SONGID'
		$field = $data->getField( "SONGID" );
		$entity->setSONGID( $field->getIVal( ) );
	
	}

	function	 find   ( $key , $cache , $keyMode ){
		
		$result = $this->m_agent->find( $key, $cache , $keyMode );
		$iter = null;

		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( ))
				  $this->m_registry->m_EntityMgr->add( "PROGRAM", $iter );
		}
	}

	function  create ( $key ){
		
		$newSet = $this->m_agent->create( $key );
		if ( $newSet != null )
		{
			// Create Businessobject
			$this->m_registry->m_EntityMgr->add( "PROGRAM", $newSet );
			return( true );
		}
		else
			return( false );	
	}

	function	 setIdByKey ( $id, $key ){
	
		$this->m_agent->setIdByKey( $id, $key );
	}

	function   matches ( $table   ){

		return( ! strcmp( $this->m_table, $table) );
	
	}
}


class LoaderPROBE extends Loader 
{
	var $m_registry;
	var $m_table;

	function LoaderPROBE( $reg){
		
		$this->m_table = "PROBE";
		$this->m_agent = new DAAgent( $this->m_table, $reg );
		$this->m_registry = $reg;
	}
	function	 remove ( $entity ){
	
		$id = $entity->getId( );
			$this->m_agent->delete( $id );
	}
	function	 commit ( $entity ){
		
		$id = $entity->getId( );
			$this->m_agent->commit( $id );
	}
	function	 copyOut( $entity ){
		
		$data = $this->m_registry->m_sqlMgr->generateSet( $this->m_table );
		$field = null;

		$field = $data->getField( "PROBEID" );
		$field->setIVal( $entity->getPROBEID( ) );
		$field = $data->getField( "DATUM" );
		$field->setValue( $entity->getDATUM( ) );
		$field = $data->getField( "ORT" );
		$field->setValue( $entity->getORT( ) );
		$field = $data->getField( "DESCRIPTION" );
		$field->setValue( $entity->getDESCRIPTION( ) );
		$this->m_agent->update( $data );
	}

	function	 copyIn ( $entity, $data ){

		$id = $entity->getPROBEID( );

		$field = null;

			// Get value of Field 'PROBEID'
		$field = $data->getField( "PROBEID" );
		$entity->setPROBEID( $field->getIVal( ) );
		// Get value of Field 'DATUM'
		$field = $data->getField( "DATUM" );
		$entity->setDATUM( $field->getValue( ) );
		// Get value of Field 'ORT'
		$field = $data->getField( "ORT" );
		$entity->setORT( $field->getValue( ) );
		// Get value of Field 'DESCRIPTION'
		$field = $data->getField( "DESCRIPTION" );
		$entity->setDESCRIPTION( $field->getValue( ) );
	
	}

	function	 find   ( $key , $cache , $keyMode ){
		
		$result = $this->m_agent->find( $key, $cache , $keyMode );
		$iter = null;

		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( ))
				  $this->m_registry->m_EntityMgr->add( "PROBE", $iter );
		}
	}

	function  create ( $key ){
		
		$newSet = $this->m_agent->create( $key );
		if ( $newSet != null )
		{
			// Create Businessobject
			$this->m_registry->m_EntityMgr->add( "PROBE", $newSet );
			return( true );
		}
		else
			return( false );	
	}

	function	 setIdByKey ( $id, $key ){
	
		$this->m_agent->setIdByKey( $id, $key );
	}

	function   matches ( $table   ){

		return( ! strcmp( $this->m_table, $table) );
	
	}
}


class LoaderPROGRAMPROBE extends Loader 
{
	var $m_registry;
	var $m_table;

	function LoaderPROGRAMPROBE( $reg){
		
		$this->m_table = "PROGRAMPROBE";
		$this->m_agent = new DAAgent( $this->m_table, $reg );
		$this->m_registry = $reg;
	}
	function	 remove ( $entity ){
	
		$id = $entity->getId( );
			$this->m_agent->delete( $id );
	}
	function	 commit ( $entity ){
		
		$id = $entity->getId( );
			$this->m_agent->commit( $id );
	}
	function	 copyOut( $entity ){
		
		$data = $this->m_registry->m_sqlMgr->generateSet( $this->m_table );
		$field = null;

		$field = $data->getField( "PROGPROBEID" );
		$field->setIVal( $entity->getPROGPROBEID( ) );
		$field = $data->getField( "SONGID" );
		$field->setIVal( $entity->getSONGID( ) );
		$field = $data->getField( "PROBEID" );
		$field->setIVal( $entity->getPROBEID( ) );
		$this->m_agent->update( $data );
	}

	function	 copyIn ( $entity, $data ){

		$id = $entity->getPROGPROBEID( );

		$field = null;

			// Get value of Field 'PROGPROBEID'
		$field = $data->getField( "PROGPROBEID" );
		$entity->setPROGPROBEID( $field->getIVal( ) );
		// Get value of Field 'SONGID'
		$field = $data->getField( "SONGID" );
		$entity->setSONGID( $field->getIVal( ) );
		// Get value of Field 'PROBEID'
		$field = $data->getField( "PROBEID" );
		$entity->setPROBEID( $field->getIVal( ) );
	
	}

	function	 find   ( $key , $cache , $keyMode ){
		
		$result = $this->m_agent->find( $key, $cache , $keyMode );
		$iter = null;

		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( ))
				  $this->m_registry->m_EntityMgr->add( "PROGRAMPROBE", $iter );
		}
	}

	function  create ( $key ){
		
		$newSet = $this->m_agent->create( $key );
		if ( $newSet != null )
		{
			// Create Businessobject
			$this->m_registry->m_EntityMgr->add( "PROGRAMPROBE", $newSet );
			return( true );
		}
		else
			return( false );	
	}

	function	 setIdByKey ( $id, $key ){
	
		$this->m_agent->setIdByKey( $id, $key );
	}

	function   matches ( $table   ){

		return( ! strcmp( $this->m_table, $table) );
	
	}
}


class LoaderCOMMENT extends Loader 
{
	var $m_registry;
	var $m_table;

	function LoaderCOMMENT( $reg){
		
		$this->m_table = "COMMENT";
		$this->m_agent = new DAAgent( $this->m_table, $reg );
		$this->m_registry = $reg;
	}
	function	 remove ( $entity ){
	
		$id = $entity->getId( );
			$this->m_agent->delete( $id );
	}
	function	 commit ( $entity ){
		
		$id = $entity->getId( );
			$this->m_agent->commit( $id );
	}
	function	 copyOut( $entity ){
		
		$data = $this->m_registry->m_sqlMgr->generateSet( $this->m_table );
		$field = null;

		$field = $data->getField( "COMMENTID" );
		$field->setIVal( $entity->getCOMMENTID( ) );
		$field = $data->getField( "DATUM" );
		$field->setValue( $entity->getDATUM( ) );
		$field = $data->getField( "USERNAME" );
		$field->setValue( $entity->getUSERNAME( ) );
		$field = $data->getField( "SONGID" );
		$field->setIVal( $entity->getSONGID( ) );
		$field = $data->getField( "AUFTRID" );
		$field->setIVal( $entity->getAUFTRID( ) );
		$field = $data->getField( "TEXTSTR" );
		$field->setValue( $entity->getTEXTSTR( ) );
		$this->m_agent->update( $data );
	}

	function	 copyIn ( $entity, $data ){

		$id = $entity->getCOMMENTID( );

		$field = null;

			// Get value of Field 'COMMENTID'
		$field = $data->getField( "COMMENTID" );
		$entity->setCOMMENTID( $field->getIVal( ) );
		// Get value of Field 'DATUM'
		$field = $data->getField( "DATUM" );
		$entity->setDATUM( $field->getValue( ) );
		// Get value of Field 'USERNAME'
		$field = $data->getField( "USERNAME" );
		$entity->setUSERNAME( $field->getValue( ) );
		// Get value of Field 'SONGID'
		$field = $data->getField( "SONGID" );
		$entity->setSONGID( $field->getIVal( ) );
		// Get value of Field 'AUFTRID'
		$field = $data->getField( "AUFTRID" );
		$entity->setAUFTRID( $field->getIVal( ) );
		// Get value of Field 'TEXTSTR'
		$field = $data->getField( "TEXTSTR" );
		$entity->setTEXTSTR( $field->getValue( ) );
	
	}

	function	 find   ( $key , $cache , $keyMode ){
		
		$result = $this->m_agent->find( $key, $cache , $keyMode );
		$iter = null;

		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( ))
				  $this->m_registry->m_EntityMgr->add( "COMMENT", $iter );
		}
	}

	function  create ( $key ){
		
		$newSet = $this->m_agent->create( $key );
		if ( $newSet != null )
		{
			// Create Businessobject
			$this->m_registry->m_EntityMgr->add( "COMMENT", $newSet );
			return( true );
		}
		else
			return( false );	
	}

	function	 setIdByKey ( $id, $key ){
	
		$this->m_agent->setIdByKey( $id, $key );
	}

	function   matches ( $table   ){

		return( ! strcmp( $this->m_table, $table) );
	
	}
}


class LoaderMUSIKER extends Loader 
{
	var $m_registry;
	var $m_table;

	function LoaderMUSIKER( $reg){
		
		$this->m_table = "MUSIKER";
		$this->m_agent = new DAAgent( $this->m_table, $reg );
		$this->m_registry = $reg;
	}
	function	 remove ( $entity ){
	
		$id = $entity->getId( );
			$this->m_agent->delete( $id );
	}
	function	 commit ( $entity ){
		
		$id = $entity->getId( );
			$this->m_agent->commit( $id );
	}
	function	 copyOut( $entity ){
		
		$data = $this->m_registry->m_sqlMgr->generateSet( $this->m_table );
		$field = null;

		$field = $data->getField( "MUSIKERID" );
		$field->setIVal( $entity->getMUSIKERID( ) );
		$field = $data->getField( "NAME" );
		$field->setValue( $entity->getNAME( ) );
		$field = $data->getField( "VORNAME" );
		$field->setValue( $entity->getVORNAME( ) );
		$field = $data->getField( "STRASSE" );
		$field->setValue( $entity->getSTRASSE( ) );
		$field = $data->getField( "PLZ" );
		$field->setValue( $entity->getPLZ( ) );
		$field = $data->getField( "ORT" );
		$field->setValue( $entity->getORT( ) );
		$field = $data->getField( "EMAIL" );
		$field->setValue( $entity->getEMAIL( ) );
		$field = $data->getField( "TEL" );
		$field->setValue( $entity->getTEL( ) );
		$field = $data->getField( "USERNAME" );
		$field->setValue( $entity->getUSERNAME( ) );
		$field = $data->getField( "PASSWORD" );
		$field->setValue( $entity->getPASSWORD( ) );
		$this->m_agent->update( $data );
	}

	function	 copyIn ( $entity, $data ){

		$id = $entity->getMUSIKERID( );

		$field = null;

			// Get value of Field 'MUSIKERID'
		$field = $data->getField( "MUSIKERID" );
		$entity->setMUSIKERID( $field->getIVal( ) );
		// Get value of Field 'NAME'
		$field = $data->getField( "NAME" );
		$entity->setNAME( $field->getValue( ) );
		// Get value of Field 'VORNAME'
		$field = $data->getField( "VORNAME" );
		$entity->setVORNAME( $field->getValue( ) );
		// Get value of Field 'STRASSE'
		$field = $data->getField( "STRASSE" );
		$entity->setSTRASSE( $field->getValue( ) );
		// Get value of Field 'PLZ'
		$field = $data->getField( "PLZ" );
		$entity->setPLZ( $field->getValue( ) );
		// Get value of Field 'ORT'
		$field = $data->getField( "ORT" );
		$entity->setORT( $field->getValue( ) );
		// Get value of Field 'EMAIL'
		$field = $data->getField( "EMAIL" );
		$entity->setEMAIL( $field->getValue( ) );
		// Get value of Field 'TEL'
		$field = $data->getField( "TEL" );
		$entity->setTEL( $field->getValue( ) );
		// Get value of Field 'USERNAME'
		$field = $data->getField( "USERNAME" );
		$entity->setUSERNAME( $field->getValue( ) );
		// Get value of Field 'PASSWORD'
		$field = $data->getField( "PASSWORD" );
		$entity->setPASSWORD( $field->getValue( ) );
	
	}

	function	 find   ( $key , $cache , $keyMode ){
		
		$result = $this->m_agent->find( $key, $cache , $keyMode );
		$iter = null;

		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( ))
				  $this->m_registry->m_EntityMgr->add( "MUSIKER", $iter );
		}
	}

	function  create ( $key ){
		
		$newSet = $this->m_agent->create( $key );
		if ( $newSet != null )
		{
			// Create Businessobject
			$this->m_registry->m_EntityMgr->add( "MUSIKER", $newSet );
			return( true );
		}
		else
			return( false );	
	}

	function	 setIdByKey ( $id, $key ){
	
		$this->m_agent->setIdByKey( $id, $key );
	}

	function   matches ( $table   ){

		return( ! strcmp( $this->m_table, $table) );
	
	}
}


class LoaderDOKUMENT extends Loader 
{
	var $m_registry;
	var $m_table;

	function LoaderDOKUMENT( $reg){
		
		$this->m_table = "DOKUMENT";
		$this->m_agent = new DAAgent( $this->m_table, $reg );
		$this->m_registry = $reg;
	}
	function	 remove ( $entity ){
	
		$id = $entity->getId( );
			$this->m_agent->delete( $id );
	}
	function	 commit ( $entity ){
		
		$id = $entity->getId( );
			$this->m_agent->commit( $id );
	}
	function	 copyOut( $entity ){
		
		$data = $this->m_registry->m_sqlMgr->generateSet( $this->m_table );
		$field = null;

		$field = $data->getField( "DOCID" );
		$field->setIVal( $entity->getDOCID( ) );
		$field = $data->getField( "SONGID" );
		$field->setIVal( $entity->getSONGID( ) );
		$field = $data->getField( "DATEN" );
		$field->setValue( $entity->getDATEN( ) );
		$this->m_agent->update( $data );
	}

	function	 copyIn ( $entity, $data ){

		$id = $entity->getDOCID( );

		$field = null;

			// Get value of Field 'DOCID'
		$field = $data->getField( "DOCID" );
		$entity->setDOCID( $field->getIVal( ) );
		// Get value of Field 'SONGID'
		$field = $data->getField( "SONGID" );
		$entity->setSONGID( $field->getIVal( ) );
		// Get value of Field 'DATEN'
		$field = $data->getField( "DATEN" );
		$entity->setDATEN( $field->getValue( ) );
	
	}

	function	 find   ( $key , $cache , $keyMode ){
		
		$result = $this->m_agent->find( $key, $cache , $keyMode );
		$iter = null;

		if ( $result != null )
		{
			for ( $iter  = $result->begin( ); 
			      $iter != $result->endElem  ( ); 
			      $iter  = $result->nextElem ( ))
				  $this->m_registry->m_EntityMgr->add( "DOKUMENT", $iter );
		}
	}

	function  create ( $key ){
		
		$newSet = $this->m_agent->create( $key );
		if ( $newSet != null )
		{
			// Create Businessobject
			$this->m_registry->m_EntityMgr->add( "DOKUMENT", $newSet );
			return( true );
		}
		else
			return( false );	
	}

	function	 setIdByKey ( $id, $key ){
	
		$this->m_agent->setIdByKey( $id, $key );
	}

	function   matches ( $table   ){

		return( ! strcmp( $this->m_table, $table) );
	
	}
}
?>
