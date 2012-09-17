<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
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
			
			$data['page_title'] = 'Perfil de ' . $user->name;
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
		$data['user'] = $this->the_user;
		$data['users_ranking'] = User::all(array('limit' => 5));
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