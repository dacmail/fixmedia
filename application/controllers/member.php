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

}