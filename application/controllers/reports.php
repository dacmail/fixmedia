<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MY_Controller {

	public function __construct() {
	   parent::__construct();
	}
	public function index($page=1) {
		$this->load->library('pagination');
		$config['base_url'] = site_url('pagina/');
		$config['total_rows'] = Report::count_all();
		$config['first_url'] = site_url();
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		$data['page_title'] = 'Portada - Más urgentes';
		$data['title'] = "Más urgentes";
		$data['description'] = "Noticias para arreglar con más repercusión en este momento. Fixmedia es la herramienta que te permite mejorar las noticias, pidiendo que alguien las arregle, añadiendo más y mejor información o corrigiendo la existente.";
		$data['subtitle'] = "Noticias para arreglar con más repercusión en este momento";
		$data['main_content'] = 'reports/list_reports';
		$data['reports'] = Report::all(array(
									'select' => '*, (karma*karma_value) as value',
									'limit' => $this->pagination->per_page,
									'offset' => $this->pagination->per_page*($page-1),
									'order' => 'value desc, karma desc, created_at desc, votes_count desc'));
		$data = get_sidebars_blocks($data);
		$data['reports_data'] = Reports_data::all();
		$this->load->view('includes/template', $data);
	}
	public function recents($page=1) {
		$this->load->library('pagination');
		$config['base_url'] = site_url('recientes/pagina/');
		$config['total_rows'] = Report::count_all();
		$config['first_url'] = site_url();
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		$data['page_title'] = 'Portada - Recientes';
		$data['description'] = "Últimas noticias enviadas. Fixmedia es la herramienta que te permite mejorar las noticias, pidiendo que alguien las arregle, añadiendo más y mejor información o corrigiendo la existente.";
		$data['title'] = "Recientes";
		$data['subtitle'] = "Últimas noticias enviadas";
		$data['main_content'] = 'reports/list_reports';
		$data['reports'] = Report::all(array(
									'select' => '*, (karma*karma_value) as value',
									'limit' => $this->pagination->per_page,
									'offset' => $this->pagination->per_page*($page-1),
									'order' => 'created_at desc, value desc, karma desc, votes_count desc'));
		$data = get_sidebars_blocks($data);
		$data['reports_data'] = Reports_data::all();
		$this->load->view('includes/template', $data);
	}
	public function pendings($page=1) {
		$this->load->library('pagination');
		$config['base_url'] = site_url('pendientes/pagina/');
		$config['total_rows'] = Report::count_all();
		$config['first_url'] = site_url();
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		$data['page_title'] = 'Portada - Pendientes';
		$data['description'] = "Noticias enviadas que todavía tienen pocos o ningún reporte. Fixmedia es la herramienta que te permite mejorar las noticias, pidiendo que alguien las arregle, añadiendo más y mejor información o corrigiendo la existente.";
		$data['main_content'] = 'reports/list_reports';
		$data['title'] = "Pendientes";
		$data['subtitle'] = "Noticias enviadas que todavía tienen pocos o ningún reporte";
		$per_page = $this->pagination->per_page;
		$offset = $this->pagination->per_page*($page-1);
		$data['reports'] = Report::find_by_sql("SELECT r.*, (r.karma*r.karma_value) as value, count(rd.id) as subs
												FROM reports r LEFT JOIN reports_data rd
												ON (r.id=rd.report_id) GROUP BY r.id
												ORDER BY subs ASC, value desc, r.karma desc,
												r.created_at desc, r.votes_count desc
												LIMIT $offset,$per_page");
		$data = get_sidebars_blocks($data);
		$data['reports_data'] = Reports_data::all();
		$this->load->view('includes/template', $data);
	}

	public function create() {
		if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
		$this->form_validation->set_rules('url', 'URL', 'required|prep_url|valid_url');
		if ($this->form_validation->run() === FALSE) :
			$data['page_title'] = 'Envía una noticia';
			$data['url'] = $this->input->get('url');
			$data['main_content'] = 'reports/create_report';
			$data['error_url_check'] = '';
		else :
			$this->load->helper('url_validation');
			$url_data = get_url_data($this->input->post('url'));
			if ($url_data['valid']) :
				$report = Report::find_by_url($url_data['url']);
				if (empty($report)) : //Si la URL no existe, la creamos en la BD
					$report = Report::create(array('user_id' => $this->the_user->id,
							'url' => $url_data['url'],
							'slug' => url_title(convert_accented_characters($url_data['title']),'dash',true),
							'title' => $url_data['title'],
							'site' => str_replace('www.', '', $url_data['host']),
							'votes_count' => 1,
							'karma' => $this->the_user->karma));
					$vote = Vote::create(array(
							'user_id' => $this->the_user->id,
							'item_id' => $report->id,
							'vote_type' => 'FIX',
							'vote_value' => 1,
							'ip' => $this->input->ip_address()));
					$data['report'] = $report;
					$data['page_title'] = 'Noticia enviada';
					$data['main_content'] = 'reports/sent_url_report';
				else : // Si existe, hacemos fix y redirigimos a la página del reporte
					$vote = Vote::create(array(
                                 'user_id' => $this->the_user->id,
                                 'item_id' => $report->id,
                                 'vote_type' => 'FIX',
                                 'vote_value' => 1,
                                 'ip' => $this->input->ip_address()
                              ));
		            if ($vote->is_valid()) :
		               $report->votes_count++;
		               $report->karma = $report->karma + $this->the_user->karma;
		               $report->save();
		            endif;
					redirect($this->router->reverseRoute('reports-view', array('slug' => $report->slug)));
				endif;
			else :
				$data['error_url_check'] = 'La URL no responde o no puede ser obtenida';
				$data['page_title'] = 'Envía una noticia';
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
				$data['report_sent'] = $report;
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
			//$this->form_validation->set_rules('content['.$i.']', 'contenido', 'required');
			$this->form_validation->set_rules('title['.$i.']', 'título', 'required');
		}
		foreach ($this->input->post('urls') as $i => $urls) {
			foreach ($urls as $k => $url) {
				$this->form_validation->set_rules('urls['.$i.']['.$k.']', 'URL', 'valid_url|prep_url');
			}
		}
		if ($this->form_validation->run() === FALSE) :
			$data['reports_types_tree'] = Reports_type::find_all_by_parent(0);
			$data['report_sent'] = Report::find($this->input->post('report_id', TRUE));
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
			$data['report_sent'] = Report::find($this->input->post('report_id', TRUE));

			$data['page_title'] = 'Previsualización del reporte';
			$data['main_content'] = 'reports/preview_report';
		endif;
			$this->load->view('includes/template', $data);

	}

	public function view($slug, $share=null, $doreport = null) {
		if (!empty($slug)) :
			$report = Report::find_by_slug($slug);
			if (!empty($report)) :
				$data['page_title'] = $report->title;
				$data['description'] = "Noticia enviada a fixmedia: $report->title. $report->votes_count personas quieren que se mejore o arregle esta noticia";
				$data['report'] = $report;
				$data['main_content'] = 'reports/report';
				if (isset($share)) :
					$data['autoshare'] = true;
				endif;
				if (isset($doreport)) :
					$data['doreport'] = true;
				endif;
				$this->load->view('includes/template', $data);
			else :
				show_404();
			endif;
		else :
			show_404();
		endif;
	}
	public function activity($slug, $share=null, $doreport = null) {
		if (!empty($slug)) :
			$report = Report::find_by_slug($slug);
			if (!empty($report)) :
				$data['page_title'] = 'Actividad de "' . $report->title . '"';
				$data['description'] = "Actividad de la noticia enviada a fixmedia: $report->title. $report->votes_count personas quieren que se mejore o arregle esta noticia";
				$data['report'] = $report;
				$data['main_content'] = 'reports/activity';
				// usuarios que han reportado
				$data['reporting_users'] = User::find_by_sql("SELECT distinct(u.id), u.* FROM users u INNER JOIN reports_data rd
								ON (u.id=rd.user_id) WHERE rd.report_id=" . $report->id);

				//usuarios que han votado un reporte positivamente

				$data['reporting_votes_users'] = User::find_by_sql("SELECT distinct(u.id), u.* FROM users u INNER JOIN votes v  ON (u.id=v.user_id)
									INNER JOIN reports_data rd ON (v.item_id=rd.id)  WHERE  v.vote_type = 'REPORT' AND rd.report_id=" . $report->id . "
									 AND u.id NOT IN (SELECT user_id FROM reports_data rd1 WHERE rd1.report_id=" . $report->id .")");

				$data['only_fixes_users'] = User::find_by_sql("SELECT distinct(u.id), u.* FROM users u INNER JOIN votes v  ON (u.id=v.user_id)
									WHERE  v.vote_type = 'FIX' AND v.item_id=" . $report->id . " AND u.id NOT IN (SELECT user_id FROM votes v2 WHERE  v2.vote_type='REPORT' AND v2.item_id IN (SELECT id FROM reports_data rd WHERE rd.report_id=" . $report->id . "))");
				if (isset($share)) :
					$data['autoshare'] = true;
				endif;
				if (isset($doreport)) :
					$data['doreport'] = true;
				endif;
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
			foreach ($post_data['type_info'] as $index => $type_id) :
				if ($type_id) :
					$types[$index] = Reports_type::find($type_id);
				else :
					$types[$index] = Reports_type::find($post_data['type'][$index]);
				endif;
				$subreports[] = $last = Reports_data::create(array(
														'report_id' => $report->id,
														'type' => $types[$index]->parent_type ? $types[$index]->parent_type->type : $types[$index]->type,
														'type_info' => $types[$index]->type,
														'title' => $post_data['title'][$index],
														'content' => $post_data['content'][$index],
														'urls' => base64_decode($post_data['urls'][$index]),
														'user_id' => $this->the_user->id,
														'votes_count' => 1
														));
				$report->save();
				$vote = Vote::create(array(
							'user_id' => $this->the_user->id,
							'item_id' => $last->id,
							'vote_type' => 'REPORT',
							'vote_value' => 1,
							'ip' => $this->input->ip_address()));
			endforeach;

			redirect($this->router->reverseRoute('reports-view-share-doreport', array('slug' => $report->slug, 'share' => 'share', 'report' => 'do')));
		else :
			show_404();
		endif;
	}
}