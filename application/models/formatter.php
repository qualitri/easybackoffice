<?php

class Formatter extends CI_Model
{
    public function define_fields($field_list)
    {
        $fields = array();
        foreach($field_list as $field)
        {
            if(trim($field) != '')
            {
                $label = trim($field);
                $name = clean_string($field);
                $fields[$name] = array('label' => $label, 'name' => $name);
            }
        }

        $format = array(
            'fields' => $fields,
            'entity' => array(),
            'values' => array() //textarea special fields values
        );

        $this->set_format($format);
    }

    public function detail_fields($fields)
    {
        $format = $this->get_format();

        foreach($fields as $key => $field)
        {
            $format['fields'][$key]['type'] = $field['type'];
            $format['fields'][$key]['required'] = $field['required'];
            $format['fields'][$key]['id'] = $this->get_prefix($field['type']);

            $options = array();
            if($field['options'] != null)
            {
                foreach($field['options'] as $option)
                {
                    $option = trim($option);
                    if($option != '')
                    {
                        $option = explode('|', $option);
                        $options[$option[1]] = $option[0];
                    }
                }
            }

            $format['fields'][$key]['options'] = $options;
            $format['fields'][$key]['options_raw'] = $field['options'];
        }

        $this->set_format($format);
    }

    public function set_entity_info($entity_name, $entity_prefix)
    {
        $format = $this->get_format();
        $format['entity']['name'] = $entity_name;
        $format['entity']['prefix'] = $entity_prefix;

        $this->set_format($format);
    }

    public function get_format()
    {
        return $this->session->userdata('format');
    }

    public function set_format($format)
    {
        $this->session->set_userdata('format', $format);
    }

    public function get_prefix($type)
    {
        switch($type)
        {
            case 'text': return 'txt';
            case 'select': return 'sel';
            case 'checkbox': return 'chk';
            case 'radio': return 'rdo';
            case 'checkbox_group': return 'chkgr';
            case 'textarea': return 'txtar';
        }
    }

    public function get_field_labels()
    {
        $format = $this->get_format();
        $fields = $format['fields'];
        
        $field_labels = array();
        if($fields != null)
        foreach($fields as $field)
        {
            if (isset($field['label']))
                $field_labels[] = $field['label'];
        }   

        return $field_labels;
    }

    public function get_fields()
    {
        $format = $this->get_format();
        $fields = $format['fields'];
        return $fields;
    }

    public function get_entity_info()
    {
        $format = $this->get_format();
        $entity_info = $format['entity'];
        return $entity_info;
    }

}
