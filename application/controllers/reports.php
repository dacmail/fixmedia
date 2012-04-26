<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
	public function index() {
		$data['page_title'] = 'Listado de reportes';
		$data['main_content'] = 'list_reports';

		$reports = $this->db->get('reports');
		$data['reports'] = $reports->result();

		
		$this->load->view('includes/template', $data);
	}
	public function create() {
		$data['page_title'] = 'Nuevo reporte';
		$data['main_content'] = 'create_report';


		$this->load->view('includes/template', $data);
	}

	public function send_url() {
		$this->form_validation->set_rules('url', 'URL', 'required|prep_url|is_unique[reports.url]|valid_url');
		if ($this->form_validation->run() === FALSE) :
			$data['page_title'] = 'Nuevo reporte';
			$data['main_content'] = 'create_report';
		else :	
			$data['url_title'] = $this->url_check($this->input->post('url'));
			if (!empty($data['url_title'])) :
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