<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_build extends CI_Controller {

	public function index()
	{
		$this->add_fields();
	}

    public function add_fields()
    {
        $this->load->view('add_fields');
    }

    public function field_properties()
    {
        $field_list = $this->input->post('field_list');
        $field_list = explode('\n', $field_list);

        $this->load->model('formatter');
        $this->formatter->define_fields($field_list);

        $this->load->view('field_properties', $field_list);
    }

    public function entity_info()
    {

        $this->load->view('entity_info');
    }

    public function go_to_export()
    {

    }
}

/* End of file form_builder.php */
/* Location: ./application/controllers/form_builder.php */