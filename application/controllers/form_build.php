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
        
        $field_list = $this->input->post('field_list'); //step 1 textarea

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
        $this->save_field_values(); //save step 2 textarea options

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
        $this->load->model('formatter');
        $entity_info = $this->formatter->get_entity_info();

        $this->data['entity_info'] = !empty($entity_info) ? $entity_info : null;
        $this->load->view('entity_info', $this->data);
    }

    public function save_entity_info()
    {
        $entity_name = $this->input->post('entity_name');

        $this->load->model('formatter');
        $this->formatter->set_entity_info($entity_name);

        redirect(base_url('export'));
    }

    public function save_field_values()
    {   
        $value_list = $this->input->post('special_list'); //step 1 textarea

        $value_list = explode("\n", $value_list);
        $data['value_list'] = $value_list;

        $this->load->model('formatter');

        $this->formatter->set_field_values($value_list);
        /*var_dump($this->formatter->get_format());*/

        /*redirect(base_url('form_build/field_properties'));*/
    }

    public function field_values()
    {
        $this->load->model('formatter');
        $entity_info = $this->formatter->get_field_values();

        $this->data['field_values'] = !empty($field_values) ? $field_values : null;
        $this->load->view('field-properties', $this->data);
    }
}

/* End of file form_builder.php */
/* Location: ./application/controllers/form_builder.php */