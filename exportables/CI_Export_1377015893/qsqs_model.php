<?php

class Qsqs
{
	var $id_qsqs;
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

class Qsqs_Model extends CI_Model
{
	private $table;
	private $id_name;
	private $entity_class;

	function __construct()
	{
		parent::__construct();		$this->table = 'qsqs';
		$this->id_name = ' id_qsqs';
		$this->entity_name = 'Qsqs';

		require APPPATH.'Qsqs.php';
	}

	function create_instance(
		$id = null
		,$wedfewdfewf = null
		,$efwfwf = null
	)
	{
		$qsqs;
	}

