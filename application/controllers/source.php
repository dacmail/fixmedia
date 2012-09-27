<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Source extends MY_Controller {

	public function __construct() {
	   parent::__construct();
	   if (!$this->ion_auth->logged_in()) { redirect('auth/login', 'refresh'); }
	}


	public function index($site,$page=1) {
		$this->output->cache(5);
		$reports = Report::find_all_by_site($site);
		if (!empty($reports)) :
			$data['site'] = $site;
			$data['all_reports'] = $reports;

			$this->load->library('pagination');
			$config['base_url'] = site_url($this->router->reverseRoute('source-profile', array('sitename' => $site)) . '/page/');
			$config['total_rows'] = count($reports);
			$config['first_url'] = site_url($this->router->reverseRoute('source-profile', array('sitename' => $site)));
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$data['pagination_links'] = $this->pagination->create_links();

			$data['reports'] = Report::all(array(
											'conditions' => "site LIKE '$site'",
											'limit' => $this->pagination->per_page,
											'offset' => $this->pagination->per_page*($page-1),
											'order' => 'created_at desc'
											));

			$reports_by_month = Reports_data::find_by_sql("SELECT count(rd.id) AS reports, month(rd.created_at) AS mes FROM
														 reports_data rd INNER JOIN reports r
														 ON (r.id=rd.report_id)
														 WHERE r.site LIKE '" . $site . "' GROUP BY mes");

			$fixes_by_month = Vote::find_by_sql("SELECT count(id) AS fixes, month(created_at) AS mes FROM reports
												WHERE site LIKE '" . $site . "' GROUP BY mes");

			$data['total_fixes'] = Vote::find_by_sql("SELECT SUM(votes_count) as total FROM reports
												WHERE site LIKE '" . $site . "'");
			$actions_by_month = array();

			foreach ($reports_by_month as $rep) :
				$actions_by_month[$rep->mes]['reports'] = $rep->reports;
			endforeach;
			foreach ($fixes_by_month as $fix) :
				$actions_by_month[$fix->mes]['fixes'] = $fix->fixes;
			endforeach;

			$data["report_types"] = Reports_data::find_by_sql("SELECT DISTINCT(rd.type) AS class, COUNT(rd.id) AS cont
														FROM reports_data rd INNER JOIN reports r
														ON (rd.report_id=r.id)
														WHERE r.site LIKE '" . $site . "' GROUP BY class
														ORDER BY cont DESC");


			$data["sites_ranking"] = $sites_ranking = Reports_data::find_by_sql("SELECT DISTINCT(r.site) AS site, COUNT(rd.id) AS cont
														FROM reports_data rd INNER JOIN reports r
														ON (rd.report_id=r.id)
														GROUP BY site
														ORDER BY cont DESC");

			$position=0;
			foreach ($sites_ranking as $site_rank) :
				if ($site_rank->site == $site ) :
					break;
				endif;
				$position++;
			endforeach;

			$data["sites_ranking_position"] = $position = ($position==0) ? $position : (($position==1) ? $position-1 : $position-2); //muestra las dos fuentes que están por delante
			$data["sites_ranking"] = array_slice($sites_ranking, $position, 5);
 			$data['actions_by_month'] = $actions_by_month;

 			$this->load->helper('url_validation');
 			$data['url_data'] = get_url_data('http://' . $site);

			$data['subreports'] =  Report::all(array(
										'joins' => array('data'),
										'conditions' => "reports.site LIKE '$site'"
									));

			$data['page_title'] = 'Perfil de ' . $site;
			$data['page'] = $page;
			$data['main_content'] = 'source/profile';
			$this->load->view('includes/template', $data);
		else :
			show_404();
		endif;

	}


}