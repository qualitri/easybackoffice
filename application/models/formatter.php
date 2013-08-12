<?php

class Formatter extends CI_Model
{
    public function define_fields($fields)
    {
        $format = array(
            'fields' => $fields,
            'entity' => array()
        );

        $this->session->set_userdata('format', $format);
    }

    public function detail_fields()
    {

    }

    public function set_entity_info($entity_name)
    {
        $format = $this->session->userdata('format');
        $format['entity']['name'] = $entity_name;

        $this->session->set_userdata('format', $format);
    }

    public function get_format()
    {
        return $this->session->userdata('format');
    }
}
