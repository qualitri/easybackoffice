<?php

class CI_Exporter extends Exporter
{
    private $entity_file;
    private $model_file;
    private $controller_file;
    private $views_files;

    public function __construct()
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
        $this->export_dir_path = BASEPATH.$this->export_dir_name;
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

    protected function create_entity($fields, $entity)
    {
        $this->load->library('StringBuilder');

        $this->StringBuilder->append("<?php\n\n");
        $this->StringBuilder->append('class '.ucfirst($entity['name']));
        $this->StringBuilder->append("\n{\n");

        foreach($fields as $field)
        {
            $this->StringBuilder->append("\tvar $".$field['name'].";\n");
        }

        foreach($fields as $field)
        {
            $upper_name = str_replace(' ', '', ucwords(str_replace('_', ' ', $field['name'])));
            $this->StringBuilder->append("\n");
            $this->StringBuilder->append("public function set$upper_name($"."{$field['name']})");
            $this->StringBuilder->append("\n{\n");
            $this->StringBuilder->append("\t".'$this->'.$field['name'].' = '.$field['name'].';');
            $this->StringBuilder->append("\n}\n");

            $this->StringBuilder->append("\n");
            $this->StringBuilder->append("public function get$upper_name()");
            $this->StringBuilder->append("\n{\n");
            $this->StringBuilder->append("\t".'return $this->'.$field['name'].';');
            $this->StringBuilder->append("\n}\n");
        }

        file_put_contents($this->export_dir_path.ucfirst($entity['name']).'.php', $this->StringBuilder->get_string());

    }

    protected function create_model($format)
    {

    }

    protected function create_controller($format)
    {

    }

    protected function create_views($fields, $entity)
    {

    }

}
