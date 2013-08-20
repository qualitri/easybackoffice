<?php

class Test_Model extends CI_Model
{
	private $table;
	private $id_name;
	private $entity_class;

	function __construct()
	{
		parent::__construct();
		$this->table = 'test';
		$this->id_name = 'id_test';
		$this->entity_name = 'Test';

		require APPPATH.'entity/Test.php';
	}

	function create_instance
	(
		 $id = null
		,$hola = null
		,$chau = null
	)
	{
		$test = new Test();
		$id = $id != null ? $id : uniqid('TST');
		$test->setIdTest($id);
		$test->setHola($hola);
		$test->setChau($chau);
		return $test;
	}

        function insert_entry($entry)
        {
            if($this->table != null)
            {
                return $this->db->insert($this->table, $entry);
            }
        }

        function remove_entry($id)
        {
            if($this->table != null)
                return $this->db->delete($this->table, array($this->id_name => $id));
        }

        function update_entry($entry)
        {
            if($this->table != null)
            {
                $id_name = $this->id_name;
                return $this->db->update($this->table, $entry, array($id_name => $entry->$id_name));
            }
        }

        function get_entry($id)
        {
            if($this->table != null)
            {
                $id_name = $this->id_name;
                $entry = array_pop($this->db->get_where($this->table, array("$id_name" => $id))->result($this->entity_class));
                return $entry;
            }
        }

        function list_entries()
        {
            if($this->table != null)
            {
                $this->db->order_by('last_modified', 'desc');
                $entries = $this->db->get($this->table)->result($this->entity_class);
                return $entries;
            }
        }

}