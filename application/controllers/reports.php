<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
	public function __construct() {
	   parent::__construct();
	}
	public function index() {
		$data['page_title'] = 'Listado de reportes';
		$data['main_content'] = 'list_reports';
		$data['reports'] = Report::all();
		$data['reports_data'] = Reports_data::all();
		$this->load->view('includes/template', $data);
	}
	public function create() {
		$data['page_title'] = 'Nuevo reporte';
		$data['main_content'] = 'create_report';
		$data['error_url_check'] = '';

		$this->load->view('includes/template', $data);
	}

	public function send_url() {
		$this->form_validation->set_rules('url', 'URL', 'required|prep_url|is_unique[reports.url]|valid_url');
		if ($this->form_validation->run() === FALSE) :
			$data['page_title'] = 'Nuevo reporte';
			$data['main_content'] = 'create_report';
			$data['error_url_check'] = '';
		else :	
			$data['url_title'] = $this->url_check($this->input->post('url'));
			if (!empty($data['url_title'])) :
				$data['reports_types_tree'] = Reports_type::find_all_by_parent(0); 
				$data['page_title'] = 'Completa el reporte';
				$data['url_sent'] = $this->input->post('url');
				$data['main_content'] = 'complete_report';
			else :
				$data['error_url_check'] = 'La URL no responde o no puede ser obtenida';
				$data['page_title'] = 'Nuevo reporte';
				$data['main_content'] = 'create_report';
			endif;
		endif;
		$this->load->view('includes/template', $data);

	}

	public function preview() {
		$data['reporte'] = $this->input->post(NULL, TRUE); 
		foreach ($this->input->post('type_info') as $type_id) :
			$types[$type_id] = Reports_type::find($type_id);
		endforeach;
		foreach ($data['reporte']['urls'] as $index => $url) :
			$data['reporte']['urls'][$index] = base64_encode(serialize($data['reporte']['urls'][$index]));
		endforeach;
		$data['types'] = $types;
		$data['page_title'] = 'Previsualización del reporte';
		$data['main_content'] = 'preview_report';

		$this->load->view('includes/template', $data);
	}

	public function view($slug) {
		if (!empty($slug)) :
			$report = Report::find_by_slug($slug);
			if (!empty($report)) :
				$data['page_title'] = $report->title;
				$data['report'] = $report;
				$data['main_content'] = 'report';
				$this->load->view('includes/template', $data);
			else :
				show_404();
			endif;
		else :
			show_404();
		endif;
	}

	public function save() {
		$post_data = $this->input->post(NULL, TRUE); 
		$report = Report::create(array('user_id' => 1,
								'url' => $post_data['report_url'],
								'slug' => url_title($post_data['report_title'], 'dash', TRUE),
								'title' => $post_data['report_title']));
		var_dump($post_data);
		foreach ($post_data['type_info'] as $index => $type_id) :
			$types[$type_id] = Reports_type::find($type_id);
			$subreports[] = Reports_data::create(array(
													'report_id' => $report->id,
													'type' => $types[$type_id]->parent_type->type,
													'type_info' => $types[$type_id]->type,
													'title' => $post_data['title'][$index],
													'content' => $post_data['content'][$index],
													'urls' => base64_decode($post_data['urls'][$index])
													)); 
		endforeach;
		redirect($this->router->reverseRoute('reports-view', array('slug' => $report->slug)));
	}
	// Esta función habría que pasarla a un helper, aquí no tiene sentido.
	public function url_check($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	$html = curl_exec($ch);
    	curl_close($ch);
    	if (preg_match('/<title>(.*)<\/title>/i', $html, $match)) :
        	return $match[1];
    	endif;
    	return false;
	}
}