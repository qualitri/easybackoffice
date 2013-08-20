<?php

class Carlos
{
	var $id_carlos;
	var $wefe4wft44t;
	var $34t;
	var $4t43;
	var $t34t43;

	public function setWefe4wft44t($wefe4wft44t)
	{
		$this->wefe4wft44t = $wefe4wft44t;
	}

	public function getWefe4wft44t()
	{
		return $this->wefe4wft44t;
	}

	public function set34t($34t)
	{
		$this->34t = $34t;
	}

	public function get34t()
	{
		return $this->34t;
	}

	public function set4t43($4t43)
	{
		$this->4t43 = $4t43;
	}

	public function get4t43()
	{
		return $this->4t43;
	}

	public function setT34t43($t34t43)
	{
		$this->t34t43 = $t34t43;
	}

	public function getT34t43()
	{
		return $this->t34t43;
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
		,$wefe4wft44t = null
		,$34t = null
		,$4t43 = null
		,$t34t43 = null
	)
	{
		$carlos;
	}

