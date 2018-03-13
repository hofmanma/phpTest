<?php

if (AGENt_CLASSES == 1)
   return;

define( AGENT_CLASSES, 1);

class DAAgent{

	var  $m_registry;

    var $STATE_PERSISTED   = 1;
    var $STATE_UNDEFINE    = 2;
    var $STATE_CHANGE      = 3;
    var $STATE_NEW         = 4;
    var $STATE_UNCHANGED   = 5;
    var $STATE_DELETED     = 6;
    
	var  $m_table;
	var  $m_cache;

	function DAAgent( $table , $reg )
	{
		$this->m_table = $table;
		$this->m_cache = new DataSet( );
		$this->m_registry = $reg;
	}

	function find  ( $key , $cache , $keyMode ){

		// Search Database next
        //  echo "DAAgent->find()";

        /*$pKeySet  =  $this->m_registry->m_sqlMgr->generateSet( $this->m_table );
        $pKeyName = $key->getPKeyName( );
        $pKeyVal  = $key->getValue( $pKey );
        $pKeySet->setValue( $pKeyName, $pKeyVal ),
        $key = $pKeySet;*/
        
        $resDb    = $this->findInDb	( $key );
		if ( $resDb != null )
		{
			// Save data in cache
			if ( $cache )
			{
               $this->putInCache( $resDb );
				// Search cache first
					return( $this->findInCache( $key , $keyMode ) );
			}
			else
			{
				$resCache = $this->findInCache( $key , $keyMode );
				if ( $resCache != null )
					return( $resCache->adjust( $resDb ) );
				else
					return( $resDb );
			}
		}
		else
			return( $this->findInCache( $key, $keyMode ));
	}

	function create( $key ){


		if ( $this->checkExistence( $key ) )
			return( null );

		$key = $key->cloneRec( );
  
        //$key->setId( $key->getValue( $key->getPKeyName( ) ));
        $key->setState( $this->STATE_NEW );
			$this->m_cache->addRecordSet( $key );

		return( $key );
	}

	function delete( $id  ){

		$set = $this->m_cache->getSetById( $id );
        //echo "DaAgent " . $set->getId( ) . "|";

		if ( $set->getState( ) == $this->STATE_NEW ){

		   $this->m_cache->deleteRecordSet( $set );
           //echo "NEW";
        }
        else{

           //echo "DaAgent " . $set->getId( ) . "|";
		   $set->setState( $this->STATE_DELETED );
           //echo $set->getState( );
        }
	}

	function update( $data){

		$set = $this->m_cache->getSetByKey( $data );
			if ( $set != null )// && ! $set->keyMatches( $data ) )
			{
				$set->setState     ( $this->STATE_CHANGED );
				$set->setAttributes( $data         );
			}
	}


	function  findInCache( $key  , $keyMode ){

		$iter = null;
		$set  = new DataSet( );
		$found = false;

        //echo "findinCache";
		for( $iter  = $this->m_cache->begin( );
		     $iter != $this->m_cache->endElem  ( );
 	         $iter  = $this->m_cache->nextElem ( ) )
		{
             //echo ",";
			 if ( $iter->keyMatches( $key  ) )
			 {
				$set->addRecordSet( $iter->cloneRec( ) );
				$found = true;
			 }
		}

		if ( $found )
			return( $set );
		else
			return( null );
	}

	function   findInDb   ( $key  ){

		return( $this->m_registry->m_sqlMgr->find( $this->m_table, $key ));
	}

	function putInCache ( $data ){

		$iter     = null;
		$cacheSet = null;

		for( $iter  = $data->begin( );
             $iter != $data->endElem  ( );
             $iter  = $data->nextElem ( ) )
		{
			$cacheSet = $this->m_cache->getSetByKey( $iter );
			if ( $cacheSet == null ) // Attentione != null
			{
				$clone = $iter->cloneRec( );
				$this->m_cache->addRecordSet( $clone );
			}
		}
	}

	function checkExistence( $key )
	{
		$dbSet = $this->findInDb( $key ) ;
		if ( $dbSet->getRecordNmb() > 0 )
			return( true );
		else
			return( false );
	}

	function commit( $id )
	{
		$iter = null;
		for( $iter  = $this->m_cache->begin( );
             $iter != $this->m_cache->endElem  ( );
             $iter  = $this->m_cache->nextElem ( ))
		{

			if ( $iter -> hasId( $id ))
			{
               $state = $iter->getState( );
               switch( $state )
				{
				case $this->STATE_DELETED:
                    //echo "DaAgent-commit " . $id;
					$this->m_registry->m_sqlMgr->delete( $this->m_table, $iter );
					$this->m_cache->deleteRecordSet( $iter );
					break;
				case $this->STATE_NEW:
					$this->m_registry->m_sqlMgr->insert( $this->m_table, $iter );
						$iter->setState( $this->STATE_PERSISTED );
					break;
				case $this->STATE_CHANGED:
					$this->m_registry->m_sqlMgr->update( $this->m_table, $iter );
						$iter->setState( $this->STATE_PERSISTED );
					break;
				}
			}
		 }
	}

	function commitAll()
	{
		$iter = null;
		for( $iter  = $this->m_cache->begin( );
             $iter != $this->m_cache->endElem  ( );
             $iter  = $this->m_cache->nextElem ( ) )
		 {
			$state = $iter->getState( );
			switch( $state )
			{
			case $this->STATE_DELETED:
				$this->m_registry->m_sqlMgr->delete( $this->m_table, $iter );
					$this->m_cache->deleteRecordSet( $iter );
				break;
			case $this->STATE_NEW:
				$this->m_registry->m_sqlMgr->insert( $this->m_table, $iter );
					$iter->setState( $this->STATE_PERSISTED );
				break;
			case $this->STATE_CHANGED:
				$this->m_registry->m_sqlMgr . update( $this->m_table, $iter );
					$iter->setState( $this->STATE_PERSISTED );
				break;
			}
		 }
	}

	function  matches( $table )
	{
		return( !strcmp($this->m_table, $table ));
	}

	function findByWhere( $where )
	{
		  $result = $this->m_registry->m_sqlMgr->findByWhere( $this->m_table, $where );
		  $iter = null;
		  $oper = null;

		for( $iter  = $result->begin( );
		     $iter != $result->endElem  ( );
    	     $iter  = $result->nextElem ( ) )
		{
			// Adjust by cache
			$oper = $this->m_cache->getSetByKey( $iter );
			if ( $oper != null )
				$iter->setAttributes( $oper );
		}

		return( $result );
	}

	function setIdByKey ( $id, $key ){

		$set = $this->m_cache->getSetByKey( $key );
			$set->setId( $id );
	}
}
?>
