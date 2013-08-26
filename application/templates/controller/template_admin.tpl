<?php
class {#class_name#}_admin extends Backoffice_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->view_list = '{#view_list_name#}';
        $this->view_form = '{#view_form_name#}';
        $this->data['active'] = '{#active#}';

        $this->load->model('admin/{#model_name#}_model', 'model');
    }

    function _from_form(){
        $id_{#entity_name_lower#} = $this->input->post('id_{#entity_name_lower#}') ?
            $this->input->post('id_{#entity_name_lower#}') : null;

        ${#entity_name_lower#} = $this->model->create_instance(
             $id_{#entity_name_lower#}
            ,{#post_fields#}
        );

        return ${#entity_name_lower#};
    }

    function _set_success_message(${#entity_name_lower#}){
        $this->data['entity_name'] = "{#entity_name#} {${#entity_name_lower#}->getId{#entity_name#}()}";
        $this->data['list_url'] = base_url('{#entity_name_lower#}_admin');
    }

    function _set_confirm_dialog(${#entity_name_lower#}){
        $this->data['entity_name'] = "{#entity_name#} {${#entity_name_lower#}->getId{#entity_name#}()}";
        $this->data['back_url'] = base_url('{#entity_name_lower#}_admin/edit/'.${#entity_name_lower#}->getId{#entity_name#}());
        $this->data['remove_url'] = base_url('{#entity_name_lower#}_admin/remove/'.${#entity_name_lower#}->getId{#entity_name#}());
    }

    function _set_data(){
        $this->data['id_{#entity_name_lower#}'] = $this->input->post('id_{#entity_name_lower#}');
    }

    function _get_rules(){
        $rules_config = array(
            {#rules#}
        );

        return $rules_config;
    }

}