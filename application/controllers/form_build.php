<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_build extends Base_Controller {

	public function index()
	{
		$this->add_fields();
	}

    public function add_fields()
    {
        $this->load->model('formatter');
        $field_labels = $this->formatter->get_field_labels();
        $this->data['field_list'] = !empty($field_labels) ? implode("\n", $field_labels) : '';
        $this->load->view('add_fields', $this->data);
    }

    public function save_fields()
    {
        $field_list = $this->input->post('field_list');
        $field_list = explode("\n", $field_list);
        $data['field_list'] = $field_list;

        $this->load->model('formatter');

        $this->formatter->define_fields($field_list); 
        redirect(base_url('form_build/add_fields'));
    }

    public function field_properties()
    {
        $this->load->model('formatter');
        $fields = $this->formatter->get_fields();//die(print_r($fields));
        $this->data['fields'] = !empty($fields) ? $fields : array();
        $this->load->view('field_properties', $this->data);
    }

    public function save_properties()
    {
        $this->load->model('formatter');
        $fields = $this->formatter->get_fields();

        foreach($fields as $key => $field)
        {
            $fields[$key]['type'] = $this->input->post('type'.$key);
            $fields[$key]['required'] = $this->input->post('required'.$key) ? 1 : 0;
            $fields[$key]['options'] =
                $this->input->post('options'.$key) ? explode('\n', $this->input->post('options'.$key)) : null;
        }

        $this->formatter->detail_fields($fields);
        redirect(base_url('form_build/field_properties'));
    }

    public function entity_info()
    {


        $this->load->view('entity_info', $this->data);
    }

    public function save_entity_info()
    {
        $entity_name = $this->input->post('entity_name');

        $this->load->model('formatter');
        $this->formatter->set_entity_info($entity_name);

        redirect(base_url('export'));
    }
}

/* End of file form_builder.php */
/* Location: ./application/controllers/form_builder.php */