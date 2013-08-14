<?php

class Formatter extends CI_Model
{
    public function define_fields($fields)
    {
        foreach($fields as $key => $field)
        {
            if($field != '')
            {
                $label = trim($field);
                $name = $label; //clean_string($field);
                $fields[$name] = array('label' => $label, 'name' => $name);
                unset($fields[$key]);
            }
        }

        $format = array(
            'fields' => $fields,
            'entity' => array()
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
        }

        $this->set_format($format);
    }

    public function set_entity_info($entity_name)
    {
        $format = $this->get_format();
        $format['entity']['name'] = $entity_name;

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
            case 'radio': return 'rdo';
            case 'checkbox': return 'chk';
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

}
