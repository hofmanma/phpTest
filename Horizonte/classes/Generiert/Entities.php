<?php

class Entity{

	var $m_registry;
	var $m_entity;
	var $m_id;
        var $m_marked;
    
	function Entity( $registry ){
	
		$this->m_registry = $registry;
	}


	function setAttributes( $entity, $id ){

		$this->m_entity = $entity;
		$this->m_id     = $id;
	}

	function matches      ( $id ){
	
		return( ! strcmp( $this->m_id, $id ) );
	}


	function commit( ){

	}

	function finish( ){

		return( false );
	}

	function isMarked   ( ){
	
		return( $this->m_marked );
	}

	function setMarked  ( $marked ){

		$this->m_marked = $marked;
	}	

	function getId( ){

		return( $this->m_id );
	}
	
	function updatePKey( $pKey ){

	}

	function hasType ( $type ){
		
		return( ! strcmp ($this->m_entity, $type ));
	}

	function getLoader ( ){

		return( $this->m_registry->m_factory->getLoader( $this->m_entity ));
	}

	function keyMatches	( $key ){
	
		return( false );
	}

	function save( ){
	
		$this->finish( );
		$this->commit( );
	}
}

 


/*********************************************
 * Declaration of Entity 'SONG'
 *********************************************/
class EntitySONG extends Entity
{
	function EntitySONG( $registry ){

		parent::Entity($registry);
	}
/**************************
 * ==> Get and Set-Methods
 **************************/
 
	// Set Value of 'SONGID'
	function setSONGID( $SONGID ){
	
		$this->m_SONGID = $SONGID; 
	}
	// Get Value of 'SONGID'
 
	function  getSONGID(){
	
		return( $this->m_SONGID );	
	}

 
	// Set Value of 'TITLE'
	function setTITLE( $TITLE ){
	
		$this->m_TITLE = $TITLE; 
	}
	// Get Value of 'TITLE'
 
	function  getTITLE(){
	
		return( $this->m_TITLE );	
	}

 
	// Set Value of 'ORDERNMB'
	function setORDERNMB( $ORDERNMB ){
	
		$this->m_ORDERNMB = $ORDERNMB; 
	}
	// Get Value of 'ORDERNMB'
 
	function  getORDERNMB(){
	
		return( $this->m_ORDERNMB );	
	}

 
	// Set Value of 'NOTES'
	function setNOTES( $NOTES ){
	
		$this->m_NOTES = $NOTES; 
	}
	// Get Value of 'NOTES'
 
	function  getNOTES(){
	
		return( $this->m_NOTES );	
	}

 
	// Set Value of 'DESCRIPTION'
	function setDESCRIPTION( $DESCRIPTION ){
	
		$this->m_DESCRIPTION = $DESCRIPTION; 
	}
	// Get Value of 'DESCRIPTION'
 
	function  getDESCRIPTION(){
	
		return( $this->m_DESCRIPTION );	
	}

 
	// Set Value of 'FILENAME'
	function setFILENAME( $FILENAME ){
	
		$this->m_FILENAME = $FILENAME; 
	}
	// Get Value of 'FILENAME'
 
	function  getFILENAME(){
	
		return( $this->m_FILENAME );	
	}

 
	// Set Value of 'CATEGORY'
	function setCATEGORY( $CATEGORY ){
	
		$this->m_CATEGORY = $CATEGORY; 
	}
	// Get Value of 'CATEGORY'
 
	function  getCATEGORY(){
	
		return( $this->m_CATEGORY );	
	}

 
	// Set Value of 'SUBCATEGORY'
	function setSUBCATEGORY( $SUBCATEGORY ){
	
		$this->m_SUBCATEGORY = $SUBCATEGORY; 
	}
	// Get Value of 'SUBCATEGORY'
 
	function  getSUBCATEGORY(){
	
		return( $this->m_SUBCATEGORY );	
	}

 


/***********************
 * ==> Standard-Methods
 ***********************/
	function  keyMatches	( $key ){
			
		return( ! strcmp( $this->m_SONGID , $key->getValue( "SONGID" )) ); 
	}
	
	function  commit		( ){
		
	      // Commit the object itself
	        $this->m_registry->m_EntityMgr->commit( $this->m_id );
	}

	function finish 		( ){
		
	      // finish the object itself
	       return( $this->m_registry->m_EntityMgr->finish( $this->m_id ));

	}
	function remove 		( ){
		
	      // finish the object itself
	        $this->m_registry->m_EntityMgr->delete( $this->m_id );

	}

	function updatePKey	( $pKey ){	
		
		$this->m_SONGID = $pKey;
	}

/************************
 * ==> Entity-Attributes
 ************************/
 
	 var $m_SONGID; 
 
	 var $m_TITLE; 
 
	 var $m_ORDERNMB; 
 
	 var $m_NOTES; 
 
	 var $m_DESCRIPTION; 
 
	 var $m_FILENAME; 
 
	 var $m_CATEGORY; 
 
	 var $m_SUBCATEGORY; 
 
};

 


/*********************************************
 * Declaration of Entity 'AUFTRITT'
 *********************************************/
class EntityAUFTRITT extends Entity
{
	function EntityAUFTRITT( $registry ){

		parent::Entity($registry);
	}
/**************************
 * ==> Get and Set-Methods
 **************************/
 
	// Set Value of 'AUFTRID'
	function setAUFTRID( $AUFTRID ){
	
		$this->m_AUFTRID = $AUFTRID; 
	}
	// Get Value of 'AUFTRID'
 
	function  getAUFTRID(){
	
		return( $this->m_AUFTRID );	
	}

 
	// Set Value of 'DATUM'
	function setDATUM( $DATUM ){
	
		$this->m_DATUM = $DATUM; 
	}
	// Get Value of 'DATUM'
 
	function  getDATUM(){
	
		return( $this->m_DATUM );	
	}

 
	// Set Value of 'ORT'
	function setORT( $ORT ){
	
		$this->m_ORT = $ORT; 
	}
	// Get Value of 'ORT'
 
	function  getORT(){
	
		return( $this->m_ORT );	
	}

 
	// Set Value of 'DESCRIPTION'
	function setDESCRIPTION( $DESCRIPTION ){
	
		$this->m_DESCRIPTION = $DESCRIPTION; 
	}
	// Get Value of 'DESCRIPTION'
 
	function  getDESCRIPTION(){
	
		return( $this->m_DESCRIPTION );	
	}

 
	// Set Value of 'NOTES'
	function setNOTES( $NOTES ){
	
		$this->m_NOTES = $NOTES; 
	}
	// Get Value of 'NOTES'
 
	function  getNOTES(){
	
		return( $this->m_NOTES );	
	}

 
	// Set Value of 'FILENAME'
	function setFILENAME( $FILENAME ){
	
		$this->m_FILENAME = $FILENAME; 
	}
	// Get Value of 'FILENAME'
 
	function  getFILENAME(){
	
		return( $this->m_FILENAME );	
	}

 


/***********************
 * ==> Standard-Methods
 ***********************/
	function  keyMatches	( $key ){
			
		return( ! strcmp( $this->m_AUFTRID , $key->getValue( "AUFTRID" )) ); 
	}
	
	function  commit		( ){
		
	      // Commit the object itself
	        $this->m_registry->m_EntityMgr->commit( $this->m_id );
	}

	function finish 		( ){
		
	      // finish the object itself
	       return( $this->m_registry->m_EntityMgr->finish( $this->m_id ));

	}
	function remove 		( ){
		
	      // finish the object itself
	        $this->m_registry->m_EntityMgr->delete( $this->m_id );

	}

	function updatePKey	( $pKey ){	
		
		$this->m_AUFTRID = $pKey;
	}

/************************
 * ==> Entity-Attributes
 ************************/
 
	 var $m_AUFTRID; 
 
	 var $m_DATUM; 
 
	 var $m_ORT; 
 
	 var $m_DESCRIPTION; 
 
	 var $m_NOTES; 
 
	 var $m_FILENAME; 
 
};

 


/*********************************************
 * Declaration of Entity 'PROGRAM'
 *********************************************/
class EntityPROGRAM extends Entity
{
	function EntityPROGRAM( $registry ){

		parent::Entity($registry);
	}
/**************************
 * ==> Get and Set-Methods
 **************************/
 
	// Set Value of 'PROGID'
	function setPROGID( $PROGID ){
	
		$this->m_PROGID = $PROGID; 
	}
	// Get Value of 'PROGID'
 
	function  getPROGID(){
	
		return( $this->m_PROGID );	
	}

 
	// Set Value of 'AUFTRID'
	function setAUFTRID( $AUFTRID ){
	
		$this->m_AUFTRID = $AUFTRID; 
	}
	// Get Value of 'AUFTRID'
 
	function  getAUFTRID(){
	
		return( $this->m_AUFTRID );	
	}

 
	// Set Value of 'SONGID'
	function setSONGID( $SONGID ){
	
		$this->m_SONGID = $SONGID; 
	}
	// Get Value of 'SONGID'
 
	function  getSONGID(){
	
		return( $this->m_SONGID );	
	}

 


/***********************
 * ==> Standard-Methods
 ***********************/
	function  keyMatches	( $key ){
			
		return( ! strcmp( $this->m_PROGID , $key->getValue( "PROGID" )) ); 
	}
	
	function  commit		( ){
		
	      // Commit the object itself
	        $this->m_registry->m_EntityMgr->commit( $this->m_id );
	}

	function finish 		( ){
		
	      // finish the object itself
	       return( $this->m_registry->m_EntityMgr->finish( $this->m_id ));

	}
	function remove 		( ){
		
	      // finish the object itself
	        $this->m_registry->m_EntityMgr->delete( $this->m_id );

	}

	function updatePKey	( $pKey ){	
		
		$this->m_PROGID = $pKey;
	}

/************************
 * ==> Entity-Attributes
 ************************/
 
	 var $m_PROGID; 
 
	 var $m_AUFTRID; 
 
	 var $m_SONGID; 
 
};

 


/*********************************************
 * Declaration of Entity 'PROBE'
 *********************************************/
class EntityPROBE extends Entity
{
	function EntityPROBE( $registry ){

		parent::Entity($registry);
	}
/**************************
 * ==> Get and Set-Methods
 **************************/
 
	// Set Value of 'PROBEID'
	function setPROBEID( $PROBEID ){
	
		$this->m_PROBEID = $PROBEID; 
	}
	// Get Value of 'PROBEID'
 
	function  getPROBEID(){
	
		return( $this->m_PROBEID );	
	}

 
	// Set Value of 'DATUM'
	function setDATUM( $DATUM ){
	
		$this->m_DATUM = $DATUM; 
	}
	// Get Value of 'DATUM'
 
	function  getDATUM(){
	
		return( $this->m_DATUM );	
	}

 
	// Set Value of 'ORT'
	function setORT( $ORT ){
	
		$this->m_ORT = $ORT; 
	}
	// Get Value of 'ORT'
 
	function  getORT(){
	
		return( $this->m_ORT );	
	}

 
	// Set Value of 'DESCRIPTION'
	function setDESCRIPTION( $DESCRIPTION ){
	
		$this->m_DESCRIPTION = $DESCRIPTION; 
	}
	// Get Value of 'DESCRIPTION'
 
	function  getDESCRIPTION(){
	
		return( $this->m_DESCRIPTION );	
	}

 


/***********************
 * ==> Standard-Methods
 ***********************/
	function  keyMatches	( $key ){
			
		return( ! strcmp( $this->m_PROBEID , $key->getValue( "PROBEID" )) ); 
	}
	
	function  commit		( ){
		
	      // Commit the object itself
	        $this->m_registry->m_EntityMgr->commit( $this->m_id );
	}

	function finish 		( ){
		
	      // finish the object itself
	       return( $this->m_registry->m_EntityMgr->finish( $this->m_id ));

	}
	function remove 		( ){
		
	      // finish the object itself
	        $this->m_registry->m_EntityMgr->delete( $this->m_id );

	}

	function updatePKey	( $pKey ){	
		
		$this->m_PROBEID = $pKey;
	}

/************************
 * ==> Entity-Attributes
 ************************/
 
	 var $m_PROBEID; 
 
	 var $m_DATUM; 
 
	 var $m_ORT; 
 
	 var $m_DESCRIPTION; 
 
};

 


/*********************************************
 * Declaration of Entity 'PROGRAMPROBE'
 *********************************************/
class EntityPROGRAMPROBE extends Entity
{
	function EntityPROGRAMPROBE( $registry ){

		parent::Entity($registry);
	}
/**************************
 * ==> Get and Set-Methods
 **************************/
 
	// Set Value of 'PROGPROBEID'
	function setPROGPROBEID( $PROGPROBEID ){
	
		$this->m_PROGPROBEID = $PROGPROBEID; 
	}
	// Get Value of 'PROGPROBEID'
 
	function  getPROGPROBEID(){
	
		return( $this->m_PROGPROBEID );	
	}

 
	// Set Value of 'SONGID'
	function setSONGID( $SONGID ){
	
		$this->m_SONGID = $SONGID; 
	}
	// Get Value of 'SONGID'
 
	function  getSONGID(){
	
		return( $this->m_SONGID );	
	}

 
	// Set Value of 'PROBEID'
	function setPROBEID( $PROBEID ){
	
		$this->m_PROBEID = $PROBEID; 
	}
	// Get Value of 'PROBEID'
 
	function  getPROBEID(){
	
		return( $this->m_PROBEID );	
	}

 


/***********************
 * ==> Standard-Methods
 ***********************/
	function  keyMatches	( $key ){
			
		return( ! strcmp( $this->m_PROGPROBEID , $key->getValue( "PROGPROBEID" )) ); 
	}
	
	function  commit		( ){
		
	      // Commit the object itself
	        $this->m_registry->m_EntityMgr->commit( $this->m_id );
	}

	function finish 		( ){
		
	      // finish the object itself
	       return( $this->m_registry->m_EntityMgr->finish( $this->m_id ));

	}
	function remove 		( ){
		
	      // finish the object itself
	        $this->m_registry->m_EntityMgr->delete( $this->m_id );

	}

	function updatePKey	( $pKey ){	
		
		$this->m_PROGPROBEID = $pKey;
	}

/************************
 * ==> Entity-Attributes
 ************************/
 
	 var $m_PROGPROBEID; 
 
	 var $m_SONGID; 
 
	 var $m_PROBEID; 
 
};

 


/*********************************************
 * Declaration of Entity 'COMMENT'
 *********************************************/
class EntityCOMMENT extends Entity
{
	function EntityCOMMENT( $registry ){

		parent::Entity($registry);
	}
/**************************
 * ==> Get and Set-Methods
 **************************/
 
	// Set Value of 'COMMENTID'
	function setCOMMENTID( $COMMENTID ){
	
		$this->m_COMMENTID = $COMMENTID; 
	}
	// Get Value of 'COMMENTID'
 
	function  getCOMMENTID(){
	
		return( $this->m_COMMENTID );	
	}

 
	// Set Value of 'DATUM'
	function setDATUM( $DATUM ){
	
		$this->m_DATUM = $DATUM; 
	}
	// Get Value of 'DATUM'
 
	function  getDATUM(){
	
		return( $this->m_DATUM );	
	}

 
	// Set Value of 'USERNAME'
	function setUSERNAME( $USERNAME ){
	
		$this->m_USERNAME = $USERNAME; 
	}
	// Get Value of 'USERNAME'
 
	function  getUSERNAME(){
	
		return( $this->m_USERNAME );	
	}

 
	// Set Value of 'SONGID'
	function setSONGID( $SONGID ){
	
		$this->m_SONGID = $SONGID; 
	}
	// Get Value of 'SONGID'
 
	function  getSONGID(){
	
		return( $this->m_SONGID );	
	}

 
	// Set Value of 'AUFTRID'
	function setAUFTRID( $AUFTRID ){
	
		$this->m_AUFTRID = $AUFTRID; 
	}
	// Get Value of 'AUFTRID'
 
	function  getAUFTRID(){
	
		return( $this->m_AUFTRID );	
	}

 
	// Set Value of 'TEXTSTR'
	function setTEXTSTR( $TEXTSTR ){
	
		$this->m_TEXTSTR = $TEXTSTR; 
	}
	// Get Value of 'TEXTSTR'
 
	function  getTEXTSTR(){
	
		return( $this->m_TEXTSTR );	
	}

 


/***********************
 * ==> Standard-Methods
 ***********************/
	function  keyMatches	( $key ){
			
		return( ! strcmp( $this->m_COMMENTID , $key->getValue( "COMMENTID" )) ); 
	}
	
	function  commit		( ){
		
	      // Commit the object itself
	        $this->m_registry->m_EntityMgr->commit( $this->m_id );
	}

	function finish 		( ){
		
	      // finish the object itself
	       return( $this->m_registry->m_EntityMgr->finish( $this->m_id ));

	}
	function remove 		( ){
		
	      // finish the object itself
	        $this->m_registry->m_EntityMgr->delete( $this->m_id );

	}

	function updatePKey	( $pKey ){	
		
		$this->m_COMMENTID = $pKey;
	}

/************************
 * ==> Entity-Attributes
 ************************/
 
	 var $m_COMMENTID; 
 
	 var $m_DATUM; 
 
	 var $m_USERNAME; 
 
	 var $m_SONGID; 
 
	 var $m_AUFTRID; 
 
	 var $m_TEXTSTR; 
 
};

 


/*********************************************
 * Declaration of Entity 'MUSIKER'
 *********************************************/
class EntityMUSIKER extends Entity
{
	function EntityMUSIKER( $registry ){

		parent::Entity($registry);
	}
/**************************
 * ==> Get and Set-Methods
 **************************/
 
	// Set Value of 'MUSIKERID'
	function setMUSIKERID( $MUSIKERID ){
	
		$this->m_MUSIKERID = $MUSIKERID; 
	}
	// Get Value of 'MUSIKERID'
 
	function  getMUSIKERID(){
	
		return( $this->m_MUSIKERID );	
	}

 
	// Set Value of 'NAME'
	function setNAME( $NAME ){
	
		$this->m_NAME = $NAME; 
	}
	// Get Value of 'NAME'
 
	function  getNAME(){
	
		return( $this->m_NAME );	
	}

 
	// Set Value of 'VORNAME'
	function setVORNAME( $VORNAME ){
	
		$this->m_VORNAME = $VORNAME; 
	}
	// Get Value of 'VORNAME'
 
	function  getVORNAME(){
	
		return( $this->m_VORNAME );	
	}

 
	// Set Value of 'STRASSE'
	function setSTRASSE( $STRASSE ){
	
		$this->m_STRASSE = $STRASSE; 
	}
	// Get Value of 'STRASSE'
 
	function  getSTRASSE(){
	
		return( $this->m_STRASSE );	
	}

 
	// Set Value of 'PLZ'
	function setPLZ( $PLZ ){
	
		$this->m_PLZ = $PLZ; 
	}
	// Get Value of 'PLZ'
 
	function  getPLZ(){
	
		return( $this->m_PLZ );	
	}

 
	// Set Value of 'ORT'
	function setORT( $ORT ){
	
		$this->m_ORT = $ORT; 
	}
	// Get Value of 'ORT'
 
	function  getORT(){
	
		return( $this->m_ORT );	
	}

 
	// Set Value of 'EMAIL'
	function setEMAIL( $EMAIL ){
	
		$this->m_EMAIL = $EMAIL; 
	}
	// Get Value of 'EMAIL'
 
	function  getEMAIL(){
	
		return( $this->m_EMAIL );	
	}

 
	// Set Value of 'TEL'
	function setTEL( $TEL ){
	
		$this->m_TEL = $TEL; 
	}
	// Get Value of 'TEL'
 
	function  getTEL(){
	
		return( $this->m_TEL );	
	}

 
	// Set Value of 'USERNAME'
	function setUSERNAME( $USERNAME ){
	
		$this->m_USERNAME = $USERNAME; 
	}
	// Get Value of 'USERNAME'
 
	function  getUSERNAME(){
	
		return( $this->m_USERNAME );	
	}

 
	// Set Value of 'PASSWORD'
	function setPASSWORD( $PASSWORD ){
	
		$this->m_PASSWORD = $PASSWORD; 
	}
	// Get Value of 'PASSWORD'
 
	function  getPASSWORD(){
	
		return( $this->m_PASSWORD );	
	}

 


/***********************
 * ==> Standard-Methods
 ***********************/
	function  keyMatches	( $key ){
			
		return( ! strcmp( $this->m_MUSIKERID , $key->getValue( "MUSIKERID" )) ); 
	}
	
	function  commit		( ){
		
	      // Commit the object itself
	        $this->m_registry->m_EntityMgr->commit( $this->m_id );
	}

	function finish 		( ){
		
	      // finish the object itself
	       return( $this->m_registry->m_EntityMgr->finish( $this->m_id ));

	}
	function remove 		( ){
		
	      // finish the object itself
	        $this->m_registry->m_EntityMgr->delete( $this->m_id );

	}

	function updatePKey	( $pKey ){	
		
		$this->m_MUSIKERID = $pKey;
	}

/************************
 * ==> Entity-Attributes
 ************************/
 
	 var $m_MUSIKERID; 
 
	 var $m_NAME; 
 
	 var $m_VORNAME; 
 
	 var $m_STRASSE; 
 
	 var $m_PLZ; 
 
	 var $m_ORT; 
 
	 var $m_EMAIL; 
 
	 var $m_TEL; 
 
	 var $m_USERNAME; 
 
	 var $m_PASSWORD; 
 
};

 


/*********************************************
 * Declaration of Entity 'DOKUMENT'
 *********************************************/
class EntityDOKUMENT extends Entity
{
	function EntityDOKUMENT( $registry ){

		parent::Entity($registry);
	}
/**************************
 * ==> Get and Set-Methods
 **************************/
 
	// Set Value of 'DOCID'
	function setDOCID( $DOCID ){
	
		$this->m_DOCID = $DOCID; 
	}
	// Get Value of 'DOCID'
 
	function  getDOCID(){
	
		return( $this->m_DOCID );	
	}

 
	// Set Value of 'SONGID'
	function setSONGID( $SONGID ){
	
		$this->m_SONGID = $SONGID; 
	}
	// Get Value of 'SONGID'
 
	function  getSONGID(){
	
		return( $this->m_SONGID );	
	}

 
	// Set Value of 'DATEN'
	function setDATEN( $DATEN ){
	
		$this->m_DATEN = $DATEN; 
	}
	// Get Value of 'DATEN'
 
	function  getDATEN(){
	
		return( $this->m_DATEN );	
	}

 


/***********************
 * ==> Standard-Methods
 ***********************/
	function  keyMatches	( $key ){
			
		return( ! strcmp( $this->m_DOCID , $key->getValue( "DOCID" )) ); 
	}
	
	function  commit		( ){
		
	      // Commit the object itself
	        $this->m_registry->m_EntityMgr->commit( $this->m_id );
	}

	function finish 		( ){
		
	      // finish the object itself
	       return( $this->m_registry->m_EntityMgr->finish( $this->m_id ));

	}
	function remove 		( ){
		
	      // finish the object itself
	        $this->m_registry->m_EntityMgr->delete( $this->m_id );

	}

	function updatePKey	( $pKey ){	
		
		$this->m_DOCID = $pKey;
	}

/************************
 * ==> Entity-Attributes
 ************************/
 
	 var $m_DOCID; 
 
	 var $m_SONGID; 
 
	 var $m_DATEN; 
 
};
?>
