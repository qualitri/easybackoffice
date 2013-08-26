<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_admin extends Base_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->config->load('project');
	}

	function login($process = false)
	{
        if($process) {
            $this->form_validation->set_rules('password','Password','required|callback_check_password');

            if($this->form_validation->run()){
                $password = $this->input->post('password');
                if($password == $this->config->item('admin_password'))
                {
                    $this->session->set_userdata(array('logged_in' => TRUE));
                    redirect($this->session->flashdata('admin_url'));
                }
            }
        }

        $this->session->set_flashdata('admin_url', $this->session->flashdata('admin_url'));
        $this->data['logout'] = true;
        $this->load->view('admin/common/header_view',$this->data);
        $this->load->view('admin/login_form',$this->data);
        $this->load->view('admin/common/footer_view',$this->data);
	}

	function logout()
	{
		$this->session->set_userdata(array('logged_in' => FALSE));
		redirect(base_url('admin/auth_admin/login'));
	}

    function check_password($password){
        if($password != $this->config->item('admin_password')){
            $this->form_validation->set_message('check_password', 'Incorrect password');
            return false;
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/index.php */