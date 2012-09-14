<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {

	public function __construct() {
	   parent::__construct();
	   if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
	}
	public function view($page = 'home') {
				
		if (!file_exists('application/views/pages/'.$page.'.php')) { show_404();}
		$data['page_title'] = 'Titulo';
		$data['main_content'] = 'pages/' . $page;
				
		$this->load->view('includes/template', $data);
	}
}