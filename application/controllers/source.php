<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Source extends MY_Controller {

	public function __construct() {
	   parent::__construct();
	}


	public function index($site,$page=1) {
		$reports = Report::find_all_by_site($site);
		if (!empty($reports)) :
			$data['site'] = $site;
			$data['reports'] = $reports;

			$this->load->library('pagination');
			$config['base_url'] = site_url($this->router->reverseRoute('source-profile', array('sitename' => $site)) . '/page/');
			$config['total_rows'] = count($reports);
			$config['first_url'] = site_url($this->router->reverseRoute('source-profile', array('sitename' => $site)));
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config); 
			$data['pagination_links'] = $this->pagination->create_links();

			$data['reports'] = Report::all(array(
											'conditions' => "site LIKE '$site'",
											'limit' => $this->pagination->per_page, 
											'offset' => $this->pagination->per_page*($page-1),
											'order' => 'created_at desc'
											));

			$data['page_title'] = 'Perfil de ' . $site;
			$data['page'] = $page;
			$data['main_content'] = 'source/profile';
			$this->load->view('includes/template', $data);
		else :
			show_404();
		endif;
		
	}


}