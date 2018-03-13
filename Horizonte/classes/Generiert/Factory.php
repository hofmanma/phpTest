<?php

include "Array.php";

class EntityFactory{

	var $m_loader;
	var $m_registry;

	function  EntityFactory( $reg ){
	
		$this->m_loader = new Collection( );
		$this->m_registry = $reg;
	} 
	function  getLoader ( $table ){

		$loader = null; 	
		for ( $i = 0; $i < $this->m_loader->length(); $i ++ ){

			$loader = $this->m_loader->getElement($i);
			if ( $loader->matches( $table ))
				return( $loader );
		}
		

 
		if ( !strcmp( $table , "SONG") )
			$loader = new LoaderSONG( $this->m_registry );
		else if ( ! strcmp( $table , "AUFTRITT") )
			$loader = new LoaderAUFTRITT( $this->m_registry );
		else if ( ! strcmp( $table , "PROGRAM") )
			$loader = new LoaderPROGRAM( $this->m_registry );
		else if ( ! strcmp( $table , "PROBE") )
			$loader = new LoaderPROBE( $this->m_registry );
		else if ( ! strcmp( $table , "PROGRAMPROBE") )
			$loader = new LoaderPROGRAMPROBE( $this->m_registry );
		else if ( ! strcmp( $table , "COMMENT") )
			$loader = new LoaderCOMMENT( $this->m_registry );
		else if ( ! strcmp( $table , "MUSIKER") )
			$loader = new LoaderMUSIKER( $this->m_registry );
		else if ( ! strcmp( $table , "DOKUMENT") )
			$loader = new LoaderDOKUMENT( $this->m_registry );

			$this->m_loader->addElement( $loader );
		return( $loader );
	}

	function createEntByType( $table ){
	
		$entity = null;
	
 
		if ( ! strcmp( $table , "SONG") )
			$entity = new EntitySONG( $this->m_registry );
		else if ( ! strcmp( $table , "AUFTRITT") )
			$entity = new EntityAUFTRITT( $this->m_registry );
		else if ( ! strcmp( $table , "PROGRAM") )
			$entity = new EntityPROGRAM( $this->m_registry );
		else if ( ! strcmp( $table , "PROBE") )
			$entity = new EntityPROBE( $this->m_registry );
		else if ( ! strcmp( $table , "PROGRAMPROBE") )
			$entity = new EntityPROGRAMPROBE( $this->m_registry );
		else if ( ! strcmp( $table , "COMMENT") )
			$entity = new EntityCOMMENT( $this->m_registry );
		else if ( ! strcmp( $table , "MUSIKER") )
			$entity = new EntityMUSIKER( $this->m_registry );
		else if ( ! strcmp( $table , "DOKUMENT") )
			$entity = new EntityDOKUMENT( $this->m_registry );

		return( $entity );
	}

	function  createField     ( $type, $name ){

		$field = new Field( );

		$field->setName ( $name );
		return( $field );
	}
}
?>
