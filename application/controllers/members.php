<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends MY_Controller {

	public function __construct() {
	   parent::__construct();
	}
	public function index($page=1) {
		$this->load->library('pagination');
		$config['base_url'] = site_url($this->router->reverseRoute('users')) . '/pagina/';
		$config['first_url'] = site_url($this->router->reverseRoute('users'));
		$config['uri_segment'] = 3;
		$results = User::all(array('select' => 'id'));
		$config['total_rows'] = count($results);
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		$data['page_title'] =  _("Top ranking de usuarios");
		$data['subtitle'] =  _("Usuarios con más actividad global (fixes, reportes y noticias descubiertas) en Fixmedia");
		$data['title'] =  _("Top usuarios");
		$data['description'] =  _("Listados de usuarios registrados en Fixmedia");
		$data['main_content'] = 'users/list_users';
		$data['page'] = $page;
		$data['users'] = User::all(array(
									'select' => '*',
									'limit' => $this->pagination->per_page,
									'offset' => $this->pagination->per_page*($page-1),
									'order' => 'karma DESC, created_on DESC'));
		$data = get_sidebars_blocks($data);
		$this->load->view('includes/template', $data);
	}
	public function reports($page=1) {
		$this->load->library('pagination');
		$config['base_url'] = site_url($this->router->reverseRoute('users-reports')) . '/pagina/';
		$config['first_url'] = site_url($this->router->reverseRoute('users-reports'));
		$config['uri_segment'] = 4;
		$results = User::all(array('select' => 'id'));
		$config['total_rows'] = count($results);
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		$data['page_title'] =  _("Top ranking de usuarios por reportes");
		$data['subtitle'] =  _("Usuarios que más reportes han aportado");
		$data['title'] =  _("Top usuarios por reportes");
		$data['description'] =  _("Listados de usuarios registrados en Fixmedia ordenados por número de reportes");
		$data['main_content'] = 'users/list_users';
		$data['page'] = $page;
		$data['users'] = User::find_by_sql('SELECT u.*, count(rd.id) as reportes FROM users u LEFT JOIN reports_data rd
											ON (u.id=rd.user_id) GROUP BY u.id ORDER BY reportes DESC
											LIMIT ' .  $this->pagination->per_page*($page-1) . ',' . $this->pagination->per_page);
		$data = get_sidebars_blocks($data);
		$this->load->view('includes/template', $data);
	}

	public function fixes($page=1) {
		$this->load->library('pagination');
		$config['base_url'] = site_url($this->router->reverseRoute('users-fixes')) . '/pagina/';
		$config['first_url'] = site_url($this->router->reverseRoute('users-fixes'));
		$config['uri_segment'] = 4;
		$results = User::all(array('select' => 'id'));
		$config['total_rows'] = count($results);
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		$data['page_title'] =  _("Top ranking de usuarios por fixes");
		$data['subtitle'] =  _("Usuarios que más fixes han recibido en sus envíos");
		$data['title'] =  _("Top usuarios por fixes");
		$data['description'] =  _("Listados de usuarios registrados en Fixmedia ordenados por número de fixes");
		$data['main_content'] = 'users/list_users';
		$data['page'] = $page;
		$data['users'] = User::find_by_sql("SELECT u.*, rv.acu_fixes FROM users u LEFT JOIN (SELECT r.user_id, count(v.id) as acu_fixes
												FROM reports r INNER JOIN votes v ON (v.item_id=r.id) WHERE v.vote_type='FIX'
												GROUP BY r.user_id) as rv
												ON (u.id=rv.user_id) ORDER BY rv.acu_fixes DESC
												LIMIT " .  $this->pagination->per_page*($page-1) . "," . $this->pagination->per_page);
		$data = get_sidebars_blocks($data);
		$this->load->view('includes/template', $data);
	}

	public function news($page=1) {
		$this->load->library('pagination');
		$config['base_url'] = site_url($this->router->reverseRoute('users-news')) . '/pagina/';
		$config['first_url'] = site_url($this->router->reverseRoute('users-news'));
		$config['uri_segment'] = 4;
		$results = User::all(array('select' => 'id'));
		$config['total_rows'] = count($results);
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		$data['page_title'] =  _("Top ranking de usuarios por descubrimientos");
		$data['subtitle'] =  _("Usuarios que han hecho el primer fix al mayor número de noticias");
		$data['title'] =  _("Top usuarios por descubrimientos");
		$data['description'] =  _("Listados de usuarios registrados en Fixmedia ordenados por número de descubrimientos");
		$data['main_content'] = 'users/list_users';
		$data['page'] = $page;
		$data['users'] = User::find_by_sql('SELECT u.*, count(r.id) as news FROM users u LEFT JOIN reports r
											ON (u.id=r.user_id) GROUP BY u.id ORDER BY news DESC
											LIMIT ' .  $this->pagination->per_page*($page-1) . ',' . $this->pagination->per_page);
		$data = get_sidebars_blocks($data);
		$this->load->view('includes/template', $data);
	}

}