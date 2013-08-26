<?php
class Test_admin extends Backoffice_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->view_list = 'test_list';
        $this->view_form = 'test_form';
        $this->data['active'] = 'test';

        $this->load->model('admin/test_model', 'model');
    }

    function _from_form(){
        $id_test = $this->input->post('id_test') ?
            $this->input->post('id_test') : null;

        $test = $this->model->create_instance(
             $id_test
            ,$this->input->post('hola')
		,$this->input->post('chau')
        );

        return $test;
    }

    function _set_success_message($test){
        $this->data['entity_name'] = "Test {$test->getIdTest()}";
        $this->data['list_url'] = base_url('test_admin');
    }

    function _set_confirm_dialog($test){
        $this->data['entity_name'] = "Test {$test->getIdTest()}";
        $this->data['back_url'] = base_url('test_admin/edit/'.$test->getIdTest());
        $this->data['remove_url'] = base_url('test_admin/remove/'.$test->getIdTest());
    }

    function _set_data(){
        $this->data['id_test'] = $this->input->post('id_test');
    }

    function _get_rules(){
        $rules_config = array(
            array('field' => 'hola', 'label' => 'hola', 'rules' => 'trim|xss_clean')
		,array('field' => 'chau', 'label' => 'chau', 'rules' => 'trim|xss_clean')
        );

        return $rules_config;
    }

}