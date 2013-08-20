<?php

class Carlos
{
	var $id_carlos;
	var $qwdwqdwdq;
	var $qwdwqdwqd;
	var $wdwqdwqd;
	var $wqdwqdwq;

	public function setQwdwqdwdq($qwdwqdwdq)
	{
		$this->qwdwqdwdq = $qwdwqdwdq;
	}

	public function getQwdwqdwdq()
	{
		return $this->qwdwqdwdq;
	}

	public function setQwdwqdwqd($qwdwqdwqd)
	{
		$this->qwdwqdwqd = $qwdwqdwqd;
	}

	public function getQwdwqdwqd()
	{
		return $this->qwdwqdwqd;
	}

	public function setWdwqdwqd($wdwqdwqd)
	{
		$this->wdwqdwqd = $wdwqdwqd;
	}

	public function getWdwqdwqd()
	{
		return $this->wdwqdwqd;
	}

	public function setWqdwqdwq($wqdwqdwq)
	{
		$this->wqdwqdwq = $wqdwqdwq;
	}

	public function getWqdwqdwq()
	{
		return $this->wqdwqdwq;
	}

}<?php

class Carlos_Model extends CI_Model
{
	private $table;
	private $id_name;
	private $entity_class;

	function __construct()
	{
		parent::__construct();		$this->table = 'carlos';
		$this->id_name = ' id_carlos';
		$this->entity_name = 'Carlos';

		require APPPATH.'Carlos.php';
	}

	function create_instance(
		$id = null
		,$qwdwqdwdq = null
		,$qwdwqdwqd = null
		,$wdwqdwqd = null
		,$wqdwqdwq = null
	)
	{
		$carlos;
	}

<form method='post' action='' id=carlos> 
