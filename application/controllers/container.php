<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Container extends Base_Controller {

	public function index()
	{
		$this->load->view('container', $this->data);
	}

}

/* End of file container.php */
/* Location: ./application/controllers/container.php */