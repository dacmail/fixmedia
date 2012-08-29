<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index($username,$page=1) {
		$user = User::find_by_username($username);
		if (!empty($user)) :
			$data['page_title'] = $user->name;
			$data['user'] = $user;
			$data['actions'] = $user->subreports;
			
			$this->load->library('pagination');
			$config['base_url'] = site_url($this->router->reverseRoute('user-profile', array('username' => $user->username)) . '/page/');
			$config['total_rows'] = count($user->fixes);
			$config['first_url'] = site_url($this->router->reverseRoute('user-profile', array('username' => $user->username)));
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config); 
			$data['pagination_links'] = $this->pagination->create_links();
			$data['page_title'] = 'Listado de reportes';
			$data['main_content'] = 'reports/list_reports';
			$data['page'] = $page;
			$data['votes'] = Vote::all(array(
											'conditions' => "vote_type LIKE 'FIX' AND user_id = $user->id",
											'limit' => $this->pagination->per_page, 
											'offset' => $this->pagination->per_page*($page-1)
											));
			$data['users_ranking'] = User::all(array('limit' => 5));
			$data['main_content'] = 'user/user';
			$this->load->view('includes/template', $data);
		else :
			show_404();
		endif;
	}

	public function edit() {
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		$data['user'] = $this->the_user;
		$data['page_title'] = 'Editar perfil';
		$data['main_content'] = 'user/edit';
		$this->load->view('includes/template', $data);
	}

	public function save() {
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		$user = $this->the_user;
		$post_data = $this->input->post(NULL, TRUE); 
		$this->form_validation->set_rules('url', 'URL', 'prep_url|valid_url');
		if ($this->form_validation->run() === FALSE) :
			$data['user'] = $user;
			$data['page_title'] = 'Editar perfil';
			$data['main_content'] = 'user/edit';
			$this->load->view('includes/template', $data);
		else :
			$user->name = empty($post_data['name']) ? $user->username : $post_data['name'];
			$user->bio = $post_data['bio'];
			$user->url = $post_data['url'];
			$user->twitter = str_replace("@", "", $post_data['twitter']); ;
			$user->save();
			redirect($this->router->reverseRoute('user-profile', array('username' => $user->username)));
		endif;
	}

}