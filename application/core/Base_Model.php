<?php
class Base_Model extends CI_Model{

    protected $table;
    protected $id_name;
    protected $entity_class;

    function __construct()
    {
        parent::__construct();
        $this->table = null;
        $this->id_name = null;
        $this->entity_class = null;
    }

    function insert_entry($entry){
        if($this->table != null) {
            return $this->db->insert($this->table, $entry);
        }
    }

    function remove_entry($id){
        if($this->table != null)
            return $this->db->delete($this->table, array($this->id_name => $id));
    }

    function update_entry($entry){
        if($this->table != null) {
            $id_name = $this->id_name;
            return $this->db->update($this->table, $entry, array($id_name => $entry->$id_name));
        }
    }
    
    function get_entry($id, $instances = array()){
        if($this->table != null) {
            $id_name = $this->id_name;
            $entry = array_pop($this->db->get_where($this->table, array("$id_name" => $id))->result($this->entity_class));
            if(method_exists($this, 'set_instances')) $this->set_instances($entry, $instances);
            return $entry;
        }
    }

    function list_entries($instances = array()){
        if($this->table != null) {
            $this->db->order_by('last_modified', 'desc');
            $entries = $this->db->get($this->table)->result($this->entity_class);
            if(method_exists($this, 'set_list_instances')) $this->set_list_instances($entries, $instances);
            return $entries;
        }
    }

    function generate_uniqid($prefix){
        $id = explode('.', uniqid('', true));
        return $prefix.substr($id[1], 4, 4);
    }

    function get_id_name(){
        return $this->id_name;
    }
}