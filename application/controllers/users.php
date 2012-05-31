<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function login() {
		if (!$this->ion_auth->logged_in()) {
			$data['page_title'] = 'Login form';
			$data['main_content'] = 'users/login_form';
			$this->load->view('includes/template', $data);
		} else {
			$user = $this->ion_auth->user()->row();
			echo gravatar($user->email, 300);
			echo '<a href="'.base_url().'">Volver</a>';
		}
	}

	public function do_login() {
		if (!$this->ion_auth->logged_in()) {
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password', 'password', 'callback_user_login['.$this->input->post('username').']');
			if ($this->form_validation->run() != FALSE) {
				$user = $this->ion_auth->user()->row();
				echo gravatar($user->email, 300);
				echo '<a href="'.base_url().'">Volver</a>';
			} else {
				$data['page_title'] = 'Login form';
				$data['main_content'] = 'users/login_form';
				$this->load->view('includes/template', $data);
			}
		}
	}

	public function logout() {
		if ($this->ion_auth->logged_in()) {
			$this->ion_auth->logout();
			redirect(base_url());
		} else {
			redirect(base_url());
		}
	}

	public function user_login($pass, $user) {
		if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $this->input->post('remember'))) {
			return TRUE;
		} else {
			$this->form_validation->set_message('user_login', 'El password es incorrecto para el usuario '.$user);
			return FALSE;
		}
	}

	public function register() {
		/*$username = 'pablo';
		$password = 'pablo';
		$email = 'pablo@gmail.com';
		$this->ion_auth->register($username, $password, $email);*/
		if (!$this->ion_auth->logged_in()) {
			$data['page_title'] = 'Register form';
			$data['main_content'] = 'users/register_form';
			$this->load->view('includes/template', $data);
		} else {
			$user = $this->ion_auth->user()->row();
			echo gravatar($user->email, 300);
			echo '<a href="'.base_url().'">Volver</a>';
		}
	}

	public function do_register() {
		if (!$this->ion_auth->logged_in()) {
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
			$this->form_validation->set_rules('repassword', 'Repite Password', 'required');
			if ($this->form_validation->run() != FALSE) {
				if ($this->ion_auth->register($this->input->post('username'), $this->input->post('password'), $this->input->post('email'))) {
					//echo $this->ion_auth->messages();
				} else {
					//echo $this->ion_auth->errors();
				}
				redirect(base_url());
			} else {
				$data['page_title'] = 'Register form';
				$data['main_content'] = 'users/register_form';
				$this->load->view('includes/template', $data);
			}
		}
	}

}