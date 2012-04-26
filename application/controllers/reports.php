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
}