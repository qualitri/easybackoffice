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
        $this->create_model($format);
        $this->create_controller($format);
        $this->create_views($fields, $entity);
    }

    private function create_entity($fields, $entity)
    {
        $this->load->library('string_builder');

        $this->string_builder->append("<?php\n\n");
        $this->string_builder->append('class '.ucfirst($entity['name']));
        $this->string_builder->append("\n{\n");

        foreach($fields as $field)
        {
            $this->string_builder->append("\tvar $".$field['name'].";\n");
        }

        foreach($fields as $field)
        {
            $upper_name = str_replace(' ', '', ucwords(str_replace('_', ' ', $field['name'])));
            $this->string_builder->append("\n");
            $this->string_builder->append("\tpublic function set$upper_name($"."{$field['name']})");
            $this->string_builder->append("\n\t{\n");
            $this->string_builder->append("\t\t".'$this->'.$field['name'].' = '.$field['name'].';');
            $this->string_builder->append("\n\t}\n");

            $this->string_builder->append("\n");
            $this->string_builder->append("\tpublic function get$upper_name()");
            $this->string_builder->append("\n\t{\n");
            $this->string_builder->append("\t\t".'return $this->'.$field['name'].';');
            $this->string_builder->append("\n\t}\n");
        }

        $this->string_builder->append("\n}");

        file_put_contents($this->export_dir_path.'/'.ucfirst($entity['name']).'.php', $this->string_builder->get_string());

    }

    private function create_model($format)
    {

    }

    private function create_controller($format)
    {

    }

    private function create_views($fields, $entity)
    {

    }

}
