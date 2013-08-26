<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/* Form Class for Admin */
class Base_Controller extends CI_Controller
{
    protected $data;
    protected static $CI;

    function __construct()
    {
        parent::__construct();
        self::$CI = &get_instance();

        $this->load->library(array('database','form_validation'));

        $this->load->helper('url');
        $this->load->helper('form');

        $this->data = array();
        $this->data['data_controller'] = '';
        $this->data['data_action'] = '';

        $this->data['base_url'] = base_url();
        $this->data['img_path'] = base_url('www/img');
        $this->data['css_path'] = base_url('www/css');
        $this->data['js_path']  = base_url('www/js');

        /*$public = $this->config->item('public');
        $this->data['public'] = base_url('public').'/';
        $this->data['public_img'] = base_url($public['images']).'/';
        $this->data['public_files'] = base_url($public['files']).'/';*/

    }

}
