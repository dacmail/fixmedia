<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index($username) {
		$user = User::find_by_username($username);
		if (!empty($user)) :
			$data['page_title'] = $user->username;
			$data['user'] = $user;
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
		$this->form_validation->set_rules('url', 'URL', 'required|prep_url|valid_url');
		if ($this->form_validation->run() === FALSE) :
			$data['user'] = $user;
			$data['page_title'] = 'Editar perfil';
			$data['main_content'] = 'user/edit';
			$this->load->view('includes/template', $data);
		else :
			$user->name = empty($post_data['name']) ? $user->username : $post_data['name'];
			$user->bio = $post_data['bio'];
			$user->url = $post_data['url'];
			$user->twitter = $post_data['twitter'];
			$user->save();
			redirect($this->router->reverseRoute('user-profile', array('username' => $user->username)));
		endif;
	}

}