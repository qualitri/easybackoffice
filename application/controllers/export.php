<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('CI', 'Code Igniter');
define('PS', 'Prestashop');
define('DRUPAL', 'Drupal');

class Export extends CI_Controller {

	public function index()
	{
		$this->export_types();
	}

    public function export_types()
    {
        $this->load->view('export_types');
    }

    public function generate()
    {
        $type = CI;//$this->input->post('export_type');

        switch($type)
        {
            case CI: $this->load->model('ci_exporter', 'exporter'); break;
            case PS: $this->load->model('ps_exporter', 'exporter'); break;
            case DRUPAL: $this->load->model('drupal_exporter', 'exporter'); break;
        }

        $this->load->model('formatter');
        $format = $this->formatter->get_format();

        $this->exporter->generate_files($format);

        $this->load->view('export_types');

    }

    public function download()
    {
        $type = CI;//$this->input->post('export_type');

        switch($type)
        {
            case CI: $this->load->model('ci_exporter', 'exporter'); break;
            case PS: $this->load->model('ps_exporter', 'exporter'); break;
            case DRUPAL: $this->load->model('drupal_exporter', 'exporter'); break;
        }

        $this->load->model('formatter');
        $format = $this->formatter->get_format();

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