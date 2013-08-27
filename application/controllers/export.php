<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('CI', 'Code Igniter');
define('PS', 'Prestashop');
define('DRUPAL', 'Drupal');

class Export extends Base_Controller {

    function __construct()
    {
        parent::__construct();
    }

	function index()
	{
		if($_SERVER['REMOTE_ADDR'] == $_SERVER['SERVER_ADDR'])
        {
            //YOU ARE IN LOCALHOST
            $this->export_local();
        }
        else
        {
            //YOU ARE NOT
            $this->export_download();
        }
        $this->load->model('formatter');
        $format = $this->formatter->get_format();
        print_r($format);
	}

    function export_local()
    {
        $this->load->view('export_local', $this->data);
    }

    function export_download()
    {
        $this->load->view('export_download', $this->data);
    }

    function generate()
    {
        $this->load->model('formatter');
        $format = $this->formatter->get_format();

        /*$type = $this->input->post('export_type');

        switch($type)
        {
            case CI: $this->load->model('ci_exporter', 'exporter'); break;
            case PS: $this->load->model('ps_exporter', 'exporter'); break;
            case DRUPAL: $this->load->model('drupal_exporter', 'exporter'); break;
        }*/

        $this->load->model('ci_exporter', 'exporter');
        $this->exporter->generate_files($format);

        //$this->load->view('export_local', $this->data);

    }

    function download()
    {
        $this->load->model('formatter');
        $format = $this->formatter->get_format();


        /*$type = $this->input->post('export_type');

        switch($type)
        {
            case CI: $this->load->model('ci_exporter', 'exporter'); break;
            case PS: $this->load->model('ps_exporter', 'exporter'); break;
            case DRUPAL: $this->load->model('drupal_exporter', 'exporter'); break;
        }*/

        $this->load->model('ci_exporter', 'exporter');
        $this->exporter->generate_files($format);

        //$this->exporter->set_compress_method('.zip');
        $this->exporter->compress();

        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=".$this->exporter->get_compressed_file_name());
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Description: File Transfer");
        header("Content-Length: ".filesize($this->exporter->get_compressed_file_path()));
        ob_clean();
        flush();
        readfile($this->exporter->get_compressed_file_path());
        exit;

    }

}

/* End of file form_builder.php */
/* Location: ./application/controllers/form_builder.php */