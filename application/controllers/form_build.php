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
        $field_list = explode("\n", $field_list);
        $data['field_list'] = $field_list; 
        $this->load->model('formatter');
        $this->formatter->define_fields($field_list);

        $this->load->view('field_properties', $this->formatter->get_format());
    }

    public function entity_info()
    {
        $format = $this->formatter->get_format();
        $fields = $format['fields'];

        foreach($fields as $key => $field)
        {
            $fields[$key]['type'] = $this->input->post('type'.$key);
            $fields[$key]['required'] = $this->input->post('required'.$key) ? 1 : 0;
            $fields[$key]['options'] =
                $this->input->post('options'.$key) ? explode('\n', $this->input->post('options'.$key)) : null;
        }

        $this->load->model('formatter');
        $this->formatter->detail_fields($fields);

        $this->load->view('entity_info');
    }

    public function go_to_export()
    {
        $entity_name = $this->input->post('entity_name');

        $this->load->model('formatter');
        $this->formatter->set_entity_info($entity_name);

        redirect('export');
    }
}

/* End of file form_builder.php */
/* Location: ./application/controllers/form_builder.php */