<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index($username,$page=1) {
		$user = User::find_by_username($username);
		if (!empty($user)) :
			$data['user'] = $user;

			$this->load->library('pagination');
			$config['base_url'] = site_url($this->router->reverseRoute('user-profile', array('username' => $user->username)) . '/page/');
			$config['total_rows'] = count($user->fixes);
			$config['first_url'] = site_url($this->router->reverseRoute('user-profile', array('username' => $user->username)));
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$data['pagination_links'] = $this->pagination->create_links();

			$data['votes'] = Vote::all(array(
											'conditions' => "vote_type LIKE 'FIX' AND user_id = $user->id",
											'limit' => $this->pagination->per_page,
											'offset' => $this->pagination->per_page*($page-1),
											'order' => 'created_at desc'
											));

			$data["users_ranking"] = $users_ranking = User::find_by_sql("SELECT id, name,username, karma
														FROM users ORDER BY karma DESC");

			$position=0;
			foreach ($users_ranking as $user_rank) :
				if ($user_rank->id == $user->id ) :
					break;
				endif;
				$position++;
			endforeach;

			$data["users_ranking_position"] = $position = ($position==0) ? $position : (($position==1) ? $position-1 : $position-2); //muestra las dos fuentes que están por delante
			$data["users_ranking"] = array_slice($users_ranking, $position, 5);



			//TODO: Limitar consultas solo a los últimos 6 meses
			$reports_by_month = Reports_data::find_by_sql("select count(id) as reports, month(created_at) as mes from reports_data where user_id=" . $user->id . " group by mes");
			$fixes_by_month = Vote::find_by_sql("select count(id) as fixes, month(created_at) as mes from votes where user_id=" . $user->id . " AND vote_type LIKE '%FIX%' group by mes");
			$actions_by_month = array();
			foreach ($reports_by_month as $rep) :
				$actions_by_month[$rep->mes]['reports'] = $rep->reports;
			endforeach;
			foreach ($fixes_by_month as $fix) :
				$actions_by_month[$fix->mes]['fixes'] = $fix->fixes;
			endforeach;
			$data['actions_by_month'] = $actions_by_month;

			$data['fixes_by_sites'] = Vote::find_by_sql("select count(votes.id) as fixes, site from votes inner join reports on (votes.item_id=reports.id) where votes.user_id=" . $user->id . " AND vote_type LIKE '%FIX%' group by site order by fixes desc limit 5");

			$data['page_title'] = sprintf( _('Perfil de %s'), $user->name);
			$data['main_content'] = 'reports/list_reports';
			$data['page'] = $page;
			$data['main_content'] = 'user/user';
			$this->load->view('includes/template', $data);
		else :
			show_404();
		endif;
	}

	public function edit() {
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		$data['user'] = $user = $this->the_user;
		$data["users_ranking"] = $users_ranking = User::find_by_sql("SELECT id, name,username, karma
														FROM users ORDER BY karma DESC");

		$position=0;
		foreach ($users_ranking as $user_rank) :
			if ($user_rank->id == $user->id ) :
				break;
			endif;
			$position++;
		endforeach;
		$data['ntypes'] = unserialize($user->notifications_types);
		$data["users_ranking_position"] = $position = ($position==0) ? $position : (($position==1) ? $position-1 : $position-2); //muestra las dos fuentes que están por delante
		$data["users_ranking"] = array_slice($users_ranking, $position, 5);
		$data['page_title'] =  _('Editar perfil');
		$data['main_content'] = 'user/edit';
		$this->load->view('includes/template', $data);
	}

	public function edit_email() {
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		$data['user'] = $user = $this->the_user;
		$data['page_title'] =  _('Completa tu registro');
		$data['main_content'] = 'user/edit_email';
		$this->load->view('includes/template-landing', $data);
	}

	public function save() {
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		$user = $this->the_user;
		$post_data = $this->input->post(NULL, TRUE);
		$this->form_validation->set_rules('url', 'URL', 'prep_url|valid_url');
		if ($this->form_validation->run() === FALSE) :
			$data['user'] = $user;
			$data['page_title'] =  _('Editar perfil');
			$data['main_content'] = 'user/edit';
			$this->load->view('includes/template', $data);
		else :
			$user->name = empty($post_data['name']) ? $user->username : $post_data['name'];
			$user->bio = $post_data['bio'];
			$user->url = $post_data['url'];
			$user->allow_mention_twitter = isset($post_data['allow_mention_twitter']);
			$user->twitter = str_replace("@", "", $post_data['twitter']);
			$user->notifications = $post_data['notifications'];
			$ntype['FIX'] = isset($post_data['notifications_types']['FIX']);
			$ntype['VOTE'] = isset($post_data['notifications_types']['VOTE']);
			$ntype['REPORT'] = isset($post_data['notifications_types']['REPORT']);
			$ntype['SOLVED'] = isset($post_data['notifications_types']['SOLVED']);
			$ntype['COMMENT'] = isset($post_data['notifications_types']['COMMENT']);
			$user->notifications_types =  serialize($ntype);
			$user->save();
			redirect($this->router->reverseRoute('user-profile', array('username' => $user->username)));
		endif;
	}

	public function save_email() {
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		$user = $this->the_user;
		$post_data = $this->input->post(NULL, TRUE);
		$this->form_validation->set_rules('email',  _('Correo electrónico'), 'required|is_unique[users.email]|valid_email');
		if ($this->form_validation->run() === FALSE) :
			$data['user'] = $user;
			$data['page_title'] =  _('Editar perfil');
			$data['main_content'] = 'user/edit_email';
			$this->load->view('includes/template', $data);
		else :
			$user->email = $post_data['email'];
			$user->save();
			redirect($this->router->reverseRoute('user-edit'));
		endif;
	}

	public function activity($page=1) {
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		$data['user'] = $user = $this->the_user;

		$this->load->library('pagination');
		$config['base_url'] = site_url($this->router->reverseRoute('user-activity', array('username' => $user->username)) . '/pagina/');
		$config['total_rows'] = count($user->activity);
		$config['first_url'] = site_url($this->router->reverseRoute('user-activity', array('username' => $user->username)));
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();

		// TODO: Codigo duplicado en index, unificar.
		$data["users_ranking"] = $users_ranking = User::find_by_sql("SELECT id, name,username, karma
														FROM users ORDER BY karma DESC");
		$position=0;
		foreach ($users_ranking as $user_rank) :
			if ($user_rank->id == $user->id ) :
				break;
			endif;
			$position++;
		endforeach;

		$data["users_ranking_position"] = $position = ($position==0) ? $position : (($position==1) ? $position-1 : $position-2); //muestra las dos fuentes que están por delante
		$data["users_ranking"] = array_slice($users_ranking, $position, 5);
		$data['activity'] = $user->activity;
		$data['activity'] = array_slice($user->activity,$this->pagination->per_page*($page-1), $this->pagination->per_page);
		Activity::query("UPDATE activities SET `read`=1, read_at=now() WHERE receiver_id = $user->id");
		$data['page'] = $page;
		$data['page_title'] = sprintf( _('Actividad de %s'), $user->name);
		$data['main_content'] = 'user/activity';
		$this->load->view('includes/template', $data);
	}

}