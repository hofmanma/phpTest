<?php

if (REG_CLASSES == 1)
   return;

define( REG_CLASSES, 1);

include "EntityMgr.php";
include "Generiert/Factory.php";
include "Generiert/API.php";
include "MySqlMgr.php";

class Registry{

    var $m_EntityMgr = null;
	var $m_factory   = null;
	var $m_api       = null;
	var $m_sqlMgr    = null;

	function initialize( ){

		$this->m_EntityMgr = new EntityMgr ( $this );
		$this->m_factory   = new EntityFactory   ( $this );
		$this->m_api       = new API       ( $this );
		$this->m_sqlMgr    = new MySqlMgr  ( $this );
  
        $this->m_sqlMgr->openConnection(  "localhost", "root", "", "horizonte2" );
	}
}
?>
