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
        $this->create_entity($format);
        $this->create_model($format);
        $this->create_controller($format);
        $this->create_views($format);
    }

    protected function create_entity($format)
    {

    }

    protected function create_model($format)
    {

    }

    protected function create_controller($format)
    {

    }

    protected function create_views($format)
    {

    }

}
