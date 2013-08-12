<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FormBuilder extends CI_Controller {

	public function index()
	{
		$this->load->view('addfields');
	}
	public function field_types()
	{
		$field_list = $this->input->post('field_list');
        $field_list = explode('\n', $field_list);
		$this->load->view('fieldproperties');
	}
}
