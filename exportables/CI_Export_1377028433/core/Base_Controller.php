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

        $this->config->load('project');

        $this->load->library(array('form_validation'));

        $this->load->helper('url');
        $this->load->helper('misc');

        date_default_timezone_set('Europe/Paris');

        $this->data = array();
        $this->data['data_controller'] = '';
        $this->data['data_action'] = '';

        $this->data['base_url'] = base_url();
        $this->data['img_path'] = base_url('www/img');
        $this->data['css_path'] = base_url('www/css');
        $this->data['js_path']  = base_url('www/js');

        $public = $this->config->item('public');
        $this->data['public'] = base_url('public').'/';
        $this->data['public_img'] = base_url($public['images']).'/';
        $this->data['public_files'] = base_url($public['files']).'/';

        require APPPATH.'entities/Article.php';
        require APPPATH.'entities/Tag.php';
        require APPPATH.'entities/ArticleTag.php';
        require APPPATH.'entities/BlockAd.php';
        require APPPATH.'entities/Event.php';
        require APPPATH.'entities/Place.php';
        require APPPATH.'entities/Shipping.php';
    }

    /*set context variables (mag,lang,params and load lang files according to session variables and url params
        args[n-1] = lang
        args[n] = magazine
     */
    function setContext($args = array())
    {
        if (count($args) >= 1)
        {
            $this->session->set_userdata('method_url_params', '');
            $this->session->set_userdata('method_list_params', array());

            $langs = array('fr', 'en');

            if (count($args) >= 2)
            {
                $magazines = array('quiltmania', 'simply_vintage', 'carnet_de_scrap', 'current', 'subscription', 'hors_series', 'livres', 'modeles');

                $magazine = $args[count($args)-1];

                if(in_array($magazine, $magazines))
                {
                    $this->data['magazine'] = $args[count($args)-1];

                    if($this->data['magazine'] == 'current') {
                        $this->data['magazine'] = $this->session->userdata('magazine');
                    }
                    else {
                        $this->session->set_userdata('magazine', $this->data['magazine']);
                    }

                    $this->data['lang'] = $args[count($args)-2];
                    $this->session->set_userdata('lang', $this->data['lang']);

                    $params = array();
                    for($i = 0; $i<count($args)-2; $i++) {
                        $params[] = $args[$i];
                    }
                }
                else
                {
                    $lang = $args[count($args)-1];

                    if(in_array($lang, $langs)) {
                        $this->data['lang'] = $args[count($args)-1];
                        $this->session->set_userdata('lang', $this->data['lang']);

                        $params = array();
                        for($i = 0; $i<count($args)-1; $i++) {
                            $params[] = $args[$i];
                        }
                    }
                    else {
                        $params = array();
                        for($i = 0; $i<count($args); $i++) {
                            $params[] = $args[$i];
                        }
                    }
                }

                $this->data['method_list_params'] = $params;
                $this->session->set_userdata('method_list_params', $params);

                $params = implode('/', $params);
                $this->data['method_url_params'] = $params;
                $this->session->set_userdata('method_url_params', $params);
            }
            else {
                $lang = $args[0];

                if(in_array($lang, $langs)) {
                    $this->data['lang'] = $args[0];
                    $this->session->set_userdata('lang', $this->data['lang']);
                }
                else {
                    $this->data['method_list_params'] = $args;
                    $this->session->set_userdata('method_list_params', $args);

                    $this->data['method_url_params'] = $args[0];
                    $this->session->set_userdata('method_url_params', $args[0]);
                }
            }
        }
    }

    /** remove the current magazine data*/
    function removeMagazineContext(){
        return $this->session->set_userdata('magazine', false);
    }
    
}
