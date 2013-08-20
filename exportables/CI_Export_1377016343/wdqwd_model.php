<?php

class Wdqwd
{
	var $id_wdqwd;
	var $wedfewdfewf;
	var $efwfwf;

	public function setWedfewdfewf($wedfewdfewf)
	{
		$this->wedfewdfewf = $wedfewdfewf;
	}

	public function getWedfewdfewf()
	{
		return $this->wedfewdfewf;
	}

	public function setEfwfwf($efwfwf)
	{
		$this->efwfwf = $efwfwf;
	}

	public function getEfwfwf()
	{
		return $this->efwfwf;
	}

}<?php

class Wdqwd_Model extends CI_Model
{
	private $table;
	private $id_name;
	private $entity_class;

	function __construct()
	{
		parent::__construct();		$this->table = 'wdqwd';
		$this->id_name = ' id_wdqwd';
		$this->entity_name = 'Wdqwd';

		require APPPATH.'Wdqwd.php';
	}

	function create_instance(
		$id = null
		,$wedfewdfewf = null
		,$efwfwf = null
	)
	{
		$wdqwd;
	}

