<?php

class CI_Exporter extends Exporter
{
    private $entity_file;
    private $model_file;
    private $controller_file;
    private $views_files;

    function __construct()
    {
        parent::__construct();
        $this->entity_file = NULL;
        $this->model_file = NULL;
        $this->controller_file = NULL;
        $this->views_files = NULL;
    }

    protected function create_dir()
    {
        $this->export_dir_name = 'CI_Export_'.time();
        $this->export_dir_path = $this->export_dir_path.$this->export_dir_name;
        mkdir($this->export_dir_path);
    }

    protected function process_format($format)
    {
        $fields = $format['fields'];
        $entity = $format['entity'];

        $this->create_entity($fields, $entity);
        $this->create_model($fields, $entity);
        $this->create_controller($fields, $entity);
        $this->create_views($fields, $entity);
    }

    private function create_entity($fields, $entity)
    {
        $this->load->library('string_builder');

        $this->string_builder->append("<?php\n\n");

        //Class declaration
        $this->string_builder->append('class '.joined_ucwords($entity['name']));
        $this->string_builder->append("\n{\n");

        //Entity properties
        $this->string_builder->append("\tvar $".'id_'.joined_to_lower($entity['name']).";\n");
        foreach($fields as $field)
        {
            $this->string_builder->append("\tvar $".underlined_to_lower($field['name']).";\n");
        }

        //Setters and Getters
        foreach($fields as $field)
        {
            $upper_name = joined_ucwords($field['name']);
            $underlined_lower = underlined_to_lower($field['name']);
            $this->string_builder->append("\n");
            $this->string_builder->append("\tpublic function set$upper_name($".$underlined_lower.")");
            $this->string_builder->append("\n\t{\n");
            $this->string_builder->append("\t\t".'$this->'.$underlined_lower.' = $'.$underlined_lower.';');
            $this->string_builder->append("\n\t}\n");

            $this->string_builder->append("\n");
            $this->string_builder->append("\tpublic function get$upper_name()");
            $this->string_builder->append("\n\t{\n");
            $this->string_builder->append("\t\t".'return $this->'.$underlined_lower.';');
            $this->string_builder->append("\n\t}\n");
        }

        $this->string_builder->append("\n}");

        //Entity File Creation
        file_put_contents($this->get_export_dir_path().'/'.joined_ucwords($entity['name']).'.php', $this->string_builder->get_string());

    }

    private function create_model($fields, $entity)
    {
        $this->load->library('string_builder');

        $this->string_builder->append("<?php\n\n");

        //Class declaration
        $this->string_builder->append('class '.joined_ucfirst($entity['name']).'_Model extends CI_Model');
        $this->string_builder->append("\n{\n");

        //Properties
        $this->string_builder->append("\tprivate ".'$table;'."\n");
        $this->string_builder->append("\tprivate ".'$id_name;'."\n");
        $this->string_builder->append("\tprivate ".'$entity_class;'."\n\n");

        //Construct
        $this->string_builder->append("\tfunction __construct()\n");
        $this->string_builder->append("\t{\n");
        $this->string_builder->append("\t\tparent::__construct();");
        $this->string_builder->append("\t\t".'$this->table = \''.underlined_to_lower($entity['name'])."';\n");
        $this->string_builder->append("\t\t".'$this->id_name = \' id_'.underlined_to_lower($entity['name'])."';\n");
        $this->string_builder->append("\t\t".'$this->entity_name = \''.joined_ucwords($entity['name'])."';\n\n");
        $this->string_builder->append("\t\trequire APPPATH.'".joined_ucwords($entity['name']).".php';\n");
        $this->string_builder->append("\t}\n\n");

        //Create instance
        $this->string_builder->append("\tfunction create_instance(\n");
        $this->string_builder->append("\t\t$".'id = null'."\n");
        foreach($fields as $field)
        {
            $underlined_lower = underlined_to_lower($field['name']);
            $this->string_builder->append("\t\t,$".$underlined_lower.' = null'."\n");
        }
        $this->string_builder->append("\t)\n");

        $this->string_builder->append("\t{\n");
        $this->string_builder->append("\t\t$".underlined_to_lower($entity['name']).";\n");
        $this->string_builder->append("\t}\n\n");

        //Insert


        //Model File Creation
        file_put_contents($this->get_export_dir_path().'/'.joined_to_lower($entity['name']).'_model.php', $this->string_builder->get_string());

    }

    private function create_controller($fields, $entity)
    {

    }

    private function create_views($fields, $entity)
    {
        $this->load->library('string_builder');
        $this->string_builder->append("<form method='post' action='' id=".$entity['name']."> \n");
        /*foreach ($fields as $field) {
            $this->string_builder->append("<form method='post' action='' class=''> \n");
        }*/
        
        //View File Creation
        file_put_contents($this->get_export_dir_path().'/'.joined_to_lower($entity['name']).'_view.php', $this->string_builder->get_string());
    }

}
