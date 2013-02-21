<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		// Load MongoDB library instead of native db driver if required
		$this->config->item('use_mongodb', 'ion_auth') ?
			$this->load->library('mongo_db') :
			$this->load->database();
	}

	//redirect if needed, otherwise display the user list
	function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			$this->data['page_title'] = 'Login';
			$this->data['main_content'] = 'auth/login';
			$this->data['message'] = $this->session->flashdata('message');
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
				'maxlength' => '100',
          		'size' => '30',
          		'class' => 'text'
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'maxlength' => '40',
          		'size' => '30',
          		'class' => 'text'
			);
			$this->load->view('includes/template-landing', $this->data);
		}
		elseif (!$this->ion_auth->is_admin())
		{
			//redirect them to the home page because they must be an administrator to view this
			redirect($this->config->item('base_url'), 'refresh');
		}
		else
		{
			//set the flash data error message if there is one
			$this->data['page_title'] = 'Users';
			$this->data['main_content'] = 'auth/index';
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}


			$this->load->view('includes/template', $this->data);
		}
	}

	//log the user in
	function login() {
		if (!$this->ion_auth->logged_in()) {
			$this->data['page_title'] = "Iniciar sesión";

			//validate form input
			$this->form_validation->set_rules('identity', 'Usuario', 'required');
			$this->form_validation->set_rules('password', 'Contraseña', 'required');
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'maxlength' => '100',
          		'size' => '30',
          		'class' => 'text'
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'maxlength' => '40',
          		'size' => '30',
          		'class' => 'text'
			);
			if (strpos($this->input->server('HTTP_REFERER'), base_url()) === 0) {
			    $this->session->set_userdata('prev_url', $this->input->server('HTTP_REFERER'));
			} else {
			    $this->session->set_userdata('prev_url', base_url());
			}
			if ($this->form_validation->run() == true) { //check to see if the user is logging in
				//check for "remember me"
				$remember = (bool) $this->input->post('remember');

				if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) { //if the login is successful
					//redirect them back to the home page
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect($this->input->post('prev'), 'refresh');
				}
				else { //if the login was un-successful
					//redirect them back to the login page
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					$this->data['message'] = $this->ion_auth->errors();

					$this->data['main_content'] = 'auth/login';
					$this->load->view('includes/template-landing', $this->data);
				}
			}
			else {  //the user is not logging in so display the login page
				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['main_content'] = 'auth/login';
				$this->load->view('includes/template-landing', $this->data);
			}
		}
		else {
			redirect($this->config->item('base_url'), 'refresh');
		}
	}
	//log the user in by provider
	function login_provider($provider = ''){
		if(empty($provider)) redirect();
		try
		{
			// create an instance for Hybridauth with the configuration file
			$this->load->library('HybridAuthLib');

			if ($this->hybridauthlib->serviceEnabled($provider))
			{
				// try to authenticate the selected $provider
				$service = $this->hybridauthlib->authenticate($provider);

				if ($service->isUserConnected())
				{
					// grab the user profile
					$user_profile = $service->getUserProfile();

					$provider_uid = $user_profile->identifier;

					if($this->ion_auth->login_by_provider($provider,$provider_uid))
					{
						redirect(site_url($this->router->reverseRoute('user-edit')));
					}
					else
					{ // if authentication does not exist and email is not in use, then we create a new user
						$username = url_title(convert_accented_characters($user_profile->displayName),'dash',true);
						$password = rand(8, 15);
						$email = empty($email) ?   $username : $user_profile->email;

						$additional_data['profileURL']	= $user_profile->profileURL;
						$additional_data['webSiteURL']	= $user_profile->webSiteURL;
						$additional_data['photoURL']	= $user_profile->photoURL;
						$additional_data['displayName']	= $user_profile->displayName;
						$additional_data['description']	= $user_profile->description;
						$additional_data['firstName']	= $user_profile->firstName;
						$additional_data['lastName']	= $user_profile->lastName;
						$additional_data['gender']		= $user_profile->gender;
						$additional_data['language']	= $user_profile->language;
						$additional_data['age']			= $user_profile->age;
						$additional_data['birthDay']	= $user_profile->birthDay;
						$additional_data['birthMonth']	= $user_profile->birthMonth;
						$additional_data['birthYear']	= $user_profile->birthYear;
						$additional_data['email']		= $email;
						$additional_data['emailVerified']	= $user_profile->emailVerified;
						$additional_data['phone']		= $user_profile->phone;
						$additional_data['address']		= $user_profile->address;
						$additional_data['country']		= $user_profile->country;
						$additional_data['region']		= $user_profile->region;
						$additional_data['city']		= $user_profile->city;
						$additional_data['zip']			= $user_profile->zip;
						if($email != null && $this->ion_auth->register_by_provider($provider, $provider_uid, $username, $password, $email,  $additional_data))
						{ // create new user && creat a new authentication for him

							if($this->ion_auth->login_by_provider($provider,$provider_uid))
					 		{ // log user in :)
								if ($email==$username) : //si el email no se ha podido obtener
									redirect(site_url('member/edit_email'));
								else :
									redirect(site_url($this->router->reverseRoute('user-edit')));
								endif;
							}
							else
							{
								//if the login was un-successful
								//redirect them back to the login page
								$this->data['message'] = 'No se ha podido iniciar sesión';
								$this->data['page_title'] = "Iniciar sesión";

								//validate form input
								$this->form_validation->set_rules('identity', 'Usuario', 'required');
								$this->form_validation->set_rules('password', 'Contraseña', 'required');
								$this->data['identity'] = array('name' => 'identity',
									'id' => 'identity',
									'type' => 'text',
									'maxlength' => '100',
					          		'size' => '30',
					          		'class' => 'text'
								);
								$this->data['password'] = array('name' => 'password',
									'id' => 'password',
									'type' => 'password',
									'maxlength' => '40',
					          		'size' => '30',
					          		'class' => 'text'
								);
								$this->data['main_content'] = 'auth/login';
								$this->load->view('includes/template-landing', $this->data);
							}
						}
						else
						{
							//if the register was un-successful
							//redirect them back to the login page
							$this->data['message'] .= 'No se ha podido registrar el usuario';

							$this->data['page_title'] = "Iniciar sesión";

								//validate form input
								$this->form_validation->set_rules('identity', 'Usuario', 'required');
								$this->form_validation->set_rules('password', 'Contraseña', 'required');
								$this->data['identity'] = array('name' => 'identity',
									'id' => 'identity',
									'type' => 'text',
									'maxlength' => '100',
					          		'size' => '30',
					          		'class' => 'text'
								);
								$this->data['password'] = array('name' => 'password',
									'id' => 'password',
									'type' => 'password',
									'maxlength' => '40',
					          		'size' => '30',
					          		'class' => 'text'
								);
								$this->data['main_content'] = 'auth/login';
								$this->load->view('includes/template-landing', $this->data);
						}
					}
				}
				else // Cannot authenticate user
				{
					$this->data['message'] = 'No se ha podido conectar con el proveedor';

					$this->data['page_title'] = "Iniciar sesión";

					//validate form input
					$this->form_validation->set_rules('identity', 'Usuario', 'required');
					$this->form_validation->set_rules('password', 'Contraseña', 'required');
					$this->data['identity'] = array('name' => 'identity',
						'id' => 'identity',
						'type' => 'text',
						'maxlength' => '100',
		          		'size' => '30',
		          		'class' => 'text'
					);
					$this->data['password'] = array('name' => 'password',
						'id' => 'password',
						'type' => 'password',
						'maxlength' => '40',
		          		'size' => '30',
		          		'class' => 'text'
					);
					$this->data['main_content'] = 'auth/login';
					$this->load->view('includes/template-landing', $this->data);
				}
			}
			else // This service is not enabled.
			{
				show_404($_SERVER['REQUEST_URI']);
			}
		}
		catch(Exception $e)
		{
			// Display the recived error
			$error = 'Unexpected error';
			switch($e->getCode())
			{
				case 0 : $error = 'Unspecified error.'; break;
				case 1 : $error = 'Hybriauth configuration error.'; break;
				case 2 : $error = 'Provider not properly configured.'; break;
				case 3 : $error = 'Unknown or disabled provider.'; break;
				case 4 : $error = 'Missing provider application credentials.'; break;
				case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				         if (isset($service))
				         {
				         	log_message('debug', 'controllers.HAuth.login: logging out from service.');
				         	$service->logout();
				         }
				         show_error('User has cancelled the authentication or the provider refused the connection.');
				         break;
				case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				         break;
				case 7 : $error = 'User not connected to the provider.';
				         break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			// well, basically your should not display this to the end user, just give him a hint and move on..
			$this->data['message'] = $error;

			$this->data['page_title'] = "Iniciar sesión";

			//validate form input
			$this->form_validation->set_rules('identity', 'Usuario', 'required');
			$this->form_validation->set_rules('password', 'Contraseña', 'required');
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'maxlength' => '100',
          		'size' => '30',
          		'class' => 'text'
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'maxlength' => '40',
          		'size' => '30',
          		'class' => 'text'
			);
			$this->data['main_content'] = 'auth/login';
			$this->load->view('includes/template-landing', $this->data);
		}
	}

	// important for HybridIgniter library..
	public function provider_endpoint()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			$_GET = $_REQUEST;
		}
		require_once APPPATH.'/third_party/hybridauth/index.php';
	}
	//log the user out
	function logout()
	{
		$this->data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them back to the page they came from
		redirect('auth', 'refresh');
	}

	//change password
	function change_password()
	{
		$this->form_validation->set_rules('old', 'Old password', 'required');
		$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{ //display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
				'class' => 'text'
			);
			$this->data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				'class' => 'text'
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				'class' => 'text'
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			//render

			$this->data['page_title'] = 'Cambiar contraseña';
			$this->data['main_content'] = 'auth/change_password';

			$this->load->view('includes/template', $this->data);
		}
		else
		{
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{ //if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
	}

	//forgot password
	function forgot_password()
	{
		$this->form_validation->set_rules('email', 'Correo electrónico', 'required');
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$this->data['page_title'] = "Recuperar contraseña";
			$this->data['email'] = array(
				'name' => 'email',
				'id' => 'email',
				'class' => 'text'
			);
			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['main_content'] = 'auth/forgot_password';
			$this->load->view('includes/template-landing', $this->data);
		}
		else
		{
			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));
			if ($forgotten)
			{ //if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->data['page_title'] = "Recuperar contraseña";
				$this->data['message'] = $this->ion_auth->errors();
				//setup the input
				$this->data['email'] = array(
					'name' => 'email',
					'id' => 'email',
					'class' => 'text'
				);
				$this->data['main_content'] = 'auth/forgot_password';
				$this->load->view('includes/template-landing', $this->data);
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{  //if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

			if ($this->form_validation->run() == false)
			{//display the form
				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
				'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
					'class' => 'text'
				);
				$this->data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id'   => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
					'class' => 'text'
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				//render
				$this->data['page_title'] = "Cambia tu contraseña";
				$this->data['main_content'] = 'auth/reset_password';
				$this->load->view('includes/template-landing', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

					//something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_404();

				} else {
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{ //if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->logout();
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{ //if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}


	//activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
			$activation = $this->ion_auth->activate($id, $code);
		else if ($this->ion_auth->is_admin())
			$activation = $this->ion_auth->activate($id);

		if ($activation) {
			//Login automático
			$user = User::first($id);
			$session_data = array(
				    'identity'             => $user->{$this->config->item('identity', 'ion_auth')},
				    'username'             => $user->username,
				    'email'                => $user->email,
				    'user_id'              => $user->id, //everyone likes to overwrite id so we'll use user_id
				    'old_last_login'       => $user->last_login
				);
			$identity = $user->{$this->config->item('identity', 'ion_auth')};
			$this->ion_auth->update_last_login($user->id);

			$this->ion_auth->clear_login_attempts($identity);

			$this->session->set_userdata($session_data);

			if ($this->config->item('remember_users', 'ion_auth')) {
				$this->ion_auth->remember_user($user->id);
			}
			redirect(site_url($this->router->reverseRoute('user-edit')));
			//redirect them to the auth page
			//$this->session->set_flashdata('message', $this->ion_auth->messages());
			//redirect("auth", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		$id = $this->config->item('use_mongodb', 'ion_auth') ? (string) $id : (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', 'confirmation', 'required');
		$this->form_validation->set_rules('id', 'user ID', 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->load->view('auth/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_404();
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	//create a new user
	function create_user() {
		$this->data['page_title'] = "Registro de usuario";

		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$this->form_validation->set_rules('username', 'Usuario', 'required|is_unique[users.username]|alpha_numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');


		if ($this->form_validation->run() == true) {
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
		}

		if ($this->form_validation->run() == true  && $this->ion_auth->register($username, $password, $email)) { //check to see if we are creating the user
			//redirect them back to the admin page
			$user = User::find_by_username($username);
			$user->name = $username;
			$user->save();
			$this->session->set_flashdata('message', "<p>Enhorabuena, ya has completado tu registro.</p> <p>Para iniciar sesión debes revisar tu email, te habrá llegado un enlace de activación.</p><p><strong>No olvides comprobar la carpeta de SPAM/correo no deseado.</strong></p>");
			redirect("auth", 'refresh');
		} else { //display the create user form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			$this->data['username'] = array(
				'name' => 'username',
				'id' => 'username',
				'type' => 'text',
				'value' => $this->form_validation->set_value('username'),
				'class' => 'text'
			);
			$this->data['email'] = array(
				'name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'value' => $this->form_validation->set_value('email'),
				'class' => 'text'
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password'),
				'class' => 'text'
			);

			$this->data['main_content'] = 'auth/create_user';
			$this->load->view('includes/template-landing', $this->data);
		}
	}

	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
				$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}
