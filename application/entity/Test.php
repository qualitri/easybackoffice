<?php

class Test
{
	var $id_test;
	var $name;
	var $last;

	public function setIdTest($id_test)
	{
		$this->id_test = $id_test;
	}

	public function getIdTest()
	{
		return $this->id_test;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setLast($last)
	{
		$this->last = $last;
	}

	public function getLast()
	{
		return $this->last;
	}

}