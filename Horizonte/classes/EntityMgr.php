<?php

if (ENTITYMGR_CLASSES == 1)
   return;

define( ENTITYMGR_CLASSES, 1);

include "Array.php";
include "Generiert/Loader.php";
include "Generiert/Entities.php";

class EntityMgr{

	var $m_registry;
    var $m_uoid = 0;
    var $m_entities;
    
	function EntityMgr( $reg)
	{
        $this->m_entities = new Collection( );
		$this->m_uoid     = 0;
		$this->m_registry = $reg;
	}

	function load( $table, $key, $keyMode )
    {

		$coll = new Collection( );
		
		$entity = $this->getEntityByKey( $table, $key );
		if ( $entity != null )
			$coll->addElement( $entity );
		else
		{
			$loader = $this->m_registry->m_factory->getLoader( $table );
				$loader->find( $key, true , $keyMode );

			$setNmb = 0;
            //echo $this->m_entities->length();
			for ( $i = 0; $i < $this->m_entities->length(); $i++ )
			{ 
				$entity = $this->m_entities->getElement( $i );
				if ( $entity->isMarked ( ) )
				{
					$entity->setMarked( false );

					if(	 $entity->hasType( $table ))
						$coll->addElement( $entity );
				}
			}
		}
		return( $coll );
	}

	function finish( $id )
	{

		for ( $i = 0; $i < $this->m_entities->length(); $i ++ )
		{
			$entity = $this->m_entities->getElement( $i );
            if ( $entity->matches( $id ) )
			{
      			$loader = $entity->getLoader( );
				$loader->copyOut( $entity );

					return( true );
			}
		}
		return( false );
	}
	function commit( $id )
	{
		for ( $i = 0; $i < $this->m_entities->length(); $i ++ )
		{
			$entity = $this->m_entities->getElement( $i );
			if ( $entity->matches( $id ) )
			{
				$loader = $entity->getLoader( );
					$loader->commit( $entity );
			}
		}
	}
	function delete( $id )
	{
		for ( $i = 0; $i < $this->m_entities->length(); $i ++ )
		{
			$entity = $this->m_entities->getElement( $i );
			if ( $entity->matches( $id ) )
			{
                //echo "delete ".$id . "|";
				$loader = $entity->getLoader( );
				$loader->remove( $entity );
                $loader->commit( $entity );
                
                // Remove entity
                   $this->m_entities->removeElement( $i );
                return;
			}
		}
	}

	function getId( )
	{
		return( $this->m_uoid ++ );
	}

	function add	( $table, $data )
	{
		// Es werden nur Schlüssel geprüft. Alles
		// andere hat keine Auswirkung
       // echo "add";
        $entity = $this->getEntityByKey( $table , $data );
		if ( $entity != null ){
			$entity->setMarked( true );
            //echo "add: existing entity";
        }
		else
		{
			$id = $this->getId( );
               //$id = $data->getValue( $data->getPKeyName( ) );
			$entity = $this->m_registry->m_factory->createEntByType( $table );
			$entity->setAttributes( $table, $id );
                $loader = $entity->getLoader( );
   
    	      $loader->copyIn    ( $entity, $data );
              $loader->setIdByKey( $id, $data     );
	
		// Fill the entity-ids
				$entity->setMarked    ( true       );

			$this->m_entities->addElement($entity);
		}

	}

	function getEntityByKey( $table, $key )
	{
		for ( $i = 0; $i < $this->m_entities->length(); $i ++ ){
			$entity = $this->m_entities->getElement($i);
			if ( $entity->hasType( $table ) )
				if (  $entity->keyMatches( $key ) )
					return( $entity );
		}

		return( null );
	}

	function create( $table, $key )
	{
		$loader = $this->m_registry->m_factory->getLoader( $table );

		if ( $loader->create( $key ) )
		{
			$setNmb = 0;
			for ( $i = 0; $i < $this->m_entities->length(); $i++ )
			{ 
				$entity = $this->m_entities->getElement($i);
				if ( $entity->isMarked ( ) )
				{
					$entity->setMarked( false );
					if(	 $entity->hasType( $table ))
							$setNmb ++;
				}
			}

			if ( $setNmb != 1 )
			{
				// TODO: Error .. More than one set was found
				return( null );
			}
		
			return( $entity );
		}
		else
			return( null );	
	}

	function saveAll( ){
	
		$success = 0;
		$i       = 0;

		for ( $i = 0; $i < $this->m_entities->length(); $i++ ) {
		
			$entity = $this->m_entities->getElement($i);
			$entity->finish( );
		}

		if ( $success == $this->m_entities->length() )
		{
			for ( $i = 0; $i < $this->m_entities->length(); $i++ ){
				
				$entity = $this->m_entities->getElement($i);
				$entity->commit( );
			}
		}		
	}
}
?>
