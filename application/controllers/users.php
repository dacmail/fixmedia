<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function login() {
		/*$username = 'edipotrebol@gmail.com';
		$password = '12345678';
		$email = 'benedmunds';
		$this->ion_auth->register($username, $password, $email);*/
		$data['page_title'] = 'Login form';
		$data['main_content'] = 'users/login_form';
		$this->load->view('includes/template', $data);
	}

	public function do_login() {
		if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'))) echo "Logueado!";
		else echo "No logueado";
	}

}