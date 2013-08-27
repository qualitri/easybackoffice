<?php

class Test
{
	var $id_test;
	var $nombre;
	var $apellido;

	public function setIdTest($id_test)
	{
		$this->id_test = $id_test;
	}

	public function getIdTest()
	{
		return $this->id_test;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function setApellido($apellido)
	{
		$this->apellido = $apellido;
	}

	public function getApellido()
	{
		return $this->apellido;
	}

}