<?php

class {#class_name#}_Model extends Base_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = '{#entity_name_lower#}';
        $this->entity_class = '{#entity_name#}';
        $this->id_name = 'id_{#entity_name_lower#}';

        require APPPATH.'entity/{#entity_name#}.php';
    }

    function create_instance(
         $id = null
        ,{#entity_params#}
    ){
        ${#entity_name_lower#} = new {#entity_name#}();
        $id = $id != null ? $id : $this->generate_uniqid('{#entity_prefix#}');
        ${#entity_name_lower#}->setId{#entity_name#}($id);
        {#set_properties#}
        return ${#entity_name_lower#};
    }

}