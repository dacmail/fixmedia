<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
	public function __construct() {
	   parent::__construct();
	}
	public function index() {
		$data['page_title'] = 'Listado de reportes';
		$data['main_content'] = 'reports/list_reports';
		$data['reports'] = Report::all();
		$data['reports_data'] = Reports_data::all();
		$data['user'] = $this->ion_auth->user()->row();
		$this->load->view('includes/template', $data);
	}
	public function create() {
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		$this->form_validation->set_rules('url', 'URL', 'required|prep_url|valid_url');
		if ($this->form_validation->run() === FALSE) :
			$data['page_title'] = 'Nuevo reporte';
			$data['main_content'] = 'reports/create_report';
			$data['error_url_check'] = '';
		else :
			$this->load->helper('url_validation');
			$url_data = get_url_data($this->input->post('url'));
			if ($url_data['valid']) :
				$report = Report::find_by_url($url_data['url']);
				if (empty($report)) : //Si la URL no existe, la creamos en la BD 
					$user = $this->ion_auth->user()->row();
					$report = Report::create(array('user_id' => $user->id,
							'url' => $url_data['url'],
							'slug' => preg_replace('/[^a-z0-9]+/i','-',$url_data['title']),
							'title' => $url_data['title'],
							'site' => $url_data['host']));
					$data['report'] = $report;
					$data['page_title'] = 'Noticia enviada';
					$data['main_content'] = 'reports/sent_url_report';
				else : // Si existe, redirigimos a la página del reporte
					redirect($this->router->reverseRoute('reports-view', array('slug' => $report->slug)));
				endif;
			else :
				$data['error_url_check'] = 'La URL no responde o no puede ser obtenida';
				$data['page_title'] = 'Nuevo reporte';
				$data['main_content'] = 'reports/create_report';
			endif;
		endif; 
		$this->load->view('includes/template', $data);
	}

	public function send($id) {
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		$report = Report::find($id);
		if (!empty($report)) :
	 		$edit_draf = $this->input->post('edit_draft');
			if (!$edit_draf) : //si es un envío nuevo
				$data['report'] = $report;
				$data['reports_types_tree'] = Reports_type::find_all_by_parent(0); 
				$data['page_title'] = 'Completa el reporte';
				$data['main_content'] = 'reports/complete_report';
			else : // si se va a editar el envío
				$data['page_title'] = 'Modificar reporte';
				$data['main_content'] = 'reports/edit_report';
				$data['reports_types_tree'] = Reports_type::find_all_by_parent(0); 
				$data['report'] = $this->input->post(NULL, TRUE);
				foreach ($data['report']['type_info'] as $index => $type_id) :
					$data['report']['urls'][$index] = unserialize(base64_decode($data['report']['urls'][$index]));
				endforeach;
			endif;
			$this->load->view('includes/template', $data);
		else :
			show_404();
		endif;
	}

	public function preview() {
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		foreach ($this->input->post('type') as $i => $value) {
			$this->form_validation->set_rules('content['.$i.']', 'contenido', 'required');
			$this->form_validation->set_rules('title['.$i.']', 'título', 'required');
		}
		foreach ($this->input->post('urls') as $i => $urls) {
			foreach ($urls as $k => $url) {
				$this->form_validation->set_rules('urls['.$i.']['.$k.']', 'URL', 'valid_url|prep_url');
			}		
		} 
		if ($this->form_validation->run() === FALSE) :
			$data['reports_types_tree'] = Reports_type::find_all_by_parent(0); 
			$data['report'] = $this->input->post(NULL, TRUE); 
			$data['page_title'] = 'Corrige el reporte';
			$data['main_content'] = 'reports/error_report';
		else :
			$data['report'] = $this->input->post(NULL, TRUE);
			$types = array();
			foreach ($this->input->post('type_info') as $index => $type_id) :
				if ($type_id) :
					$types[$index] = Reports_type::find($type_id);
				else :
					$types[$index] = Reports_type::find($data['report']['type'][$index]);
				endif;
			endforeach;
			foreach ($data['report']['urls'] as $index => $url) :
				$data['report']['urls'][$index] = base64_encode(serialize($data['report']['urls'][$index]));
			endforeach;
			foreach ($data['report']['type_info'] as $index => $type_id) :
				$data['report']['urls_decode'][$index] = unserialize(base64_decode($data['report']['urls'][$index]));
			endforeach;
			$data['types'] = $types;
			$data['page_title'] = 'Previsualización del reporte';
			$data['main_content'] = 'reports/preview_report';
		endif; 
			$this->load->view('includes/template', $data);

	}

	public function view($slug) {
		$data['user'] = $this->ion_auth->user()->row();

		if (!empty($slug)) :
			$report = Report::find_by_slug($slug);
			if (!empty($report)) :
				$data['page_title'] = $report->title;
				$data['report'] = $report;
				$data['main_content'] = 'reports/report';
				$this->load->view('includes/template', $data);
			else :
				show_404();
			endif;
		else :
			show_404();
		endif;
	}

	public function save() {
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		$post_data = $this->input->post(NULL, TRUE); 
		// buscar en la tabla report si el ID del reporte principal existe.
		$report = Report::find($post_data['report_id']);
		if (!empty($report)) :
			$user = $this->ion_auth->user()->row();
			foreach ($post_data['type_info'] as $index => $type_id) :
				if ($type_id) :
					$types[$index] = Reports_type::find($type_id);
				else :
					$types[$index] = Reports_type::find($post_data['type'][$index]);
				endif;
				$subreports[] = Reports_data::create(array(
														'report_id' => $report->id,
														'type' => $types[$index]->parent_type ? $types[$index]->parent_type->type : $types[$index]->type,
														'type_info' => $types[$index]->type,
														'title' => $post_data['title'][$index],
														'content' => $post_data['content'][$index],
														'urls' => base64_decode($post_data['urls'][$index]),
														'user_id' => $user->id
														)); 
			endforeach;
			redirect($this->router->reverseRoute('reports-view', array('slug' => $report->slug)));
		else :
			show_404();
		endif;
	}
}