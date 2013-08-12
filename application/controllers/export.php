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

    public function download()
    {
        $type = $this->input->post('export_type');

        switch($type)
        {
            case CI: $this->load->model('ci_exporter', 'exporter'); break;
            case PS: $this->load->model('ps_exporter', 'exporter'); break;
            case DRUPAL: $this->load->model('drupal_exporter', 'exporter'); break;
        }

        $format = $this->session->userdata('format');
    }

}

/* End of file form_builder.php */
/* Location: ./application/controllers/form_builder.php */