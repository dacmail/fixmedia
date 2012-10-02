<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {

	public function __construct() {
	   parent::__construct();
	}
	public function index($page=1) {
		$data['term'] = $term = $this->input->get('q');
		$this->load->library('pagination');
		$config['query_string_segment'] = 'pagina';
		$config['page_query_string']  = true;
		$config['base_url'] = "?q=$term";
		$config['first_url'] = site_url($this->router->reverseRoute('search')) . "?q=$term";
		$results = Report::all(array('select' => 'id', 'conditions' => "title like '%" . $term . "%'"));
		$config['total_rows'] = count($results);
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		$data['page_title'] = "Resultados de búsqueda: $term";
		$data['title'] = "Resultados de búsqueda";
		$data['subtitle'] = "Resultados de búsqueda para el término: $term";
		$data['main_content'] = 'reports/list_reports';
		$data['reports'] = Report::all(array(
									'select' => '*, (karma*karma_value) as value',
									'conditions' => "title like '%" . $term . "%'",
									'limit' => $this->pagination->per_page,
									'offset' => $this->pagination->per_page*($page-1),
									'order' => 'value desc, karma desc, created_at desc, votes_count desc'));
		$data = get_sidebars_blocks($data);
		$data['reports_data'] = Reports_data::all();
		$this->load->view('includes/template', $data);
	}
}