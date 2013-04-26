<?php
require(APPPATH . 'libraries/REST_Controller.php');
class v1 extends REST_Controller {
	function get_reports_get() {
		if ($this->input->get('url')) :
			$news = Report::find_by_url($this->input->get('url'));
		elseif ($this->get('id')) :
			$news = Report::find_by_id($this->get('id'));
		else :
			$data = array(
				'error' => 1,
				'description' => _('No se ha especificado ninguna URL o ID'),
				'url' => $this->input->get('url'),
				'id' => $this->get('id')
				);
			$this->response($data);
		endif;
		if (count($news)) :
			$data  = array(
				'error' => 0,
				'news_id' => $news->id,
				'news_url' => $news->url,
				'user_name' => $news->user->name,
				'user_id' => $news->user->id,
				'news_created' => $news->created_at->format('atom'),
				'news_site' => $news->site,
				'news_votes' => $news->votes_count,
				'fixmedia_url' => site_url($this->router->reverseRoute('reports-view', array('slug' => $news->slug))),
				'reports_count' => count($news->data),
				'reports' => array(),
			);
			foreach ($news->data as $report) :
				$data['reports'][] = array(
						'report_id' => $report->id,
						'report_type' => $report->type,
						'report_type_info' => $report->type_info,
						'report_title' => $report->title,
						'report_content' => $report->content,
						'report_urls' => $report->urls,
						'report_votes' => $report->votes_count,
						'report_date' => $report->created_at->format('atom'),
					);
			endforeach;
			$this->response($data);
		else :
			$data = array(
				'error' => 1,
				'description' => _('La noticia no se encuentra en Fixmedia'),
				'url' => $this->input->get('url'),
				'id' => $this->get('id')
				);
			$this->response($data);
		endif;
    }
    function get_user_get() {
		if ($this->get('username')) :
			$user = User::find_by_username($this->get('username'));
		elseif ($this->get('id')) :
			$user = User::find_by_id($this->get('id'));
		else :
			$data = array(
				'error' => 1,
				'description' => _('No se ha especificado ningún nombre de usuario o ID'),
				'url' => $this->get('username'),
				'id' => $this->get('id')
				);
			$this->response($data);
		endif;
		if (count($user)) :
			preg_match('/src="([^"]*)"/', get_avatar( $user, 150), $avatar);
			$data  = array(
				'error' => 0,
				'user_id' => $user->id,
				'user_url' => $user->url,
				'username' => $user->username,
				'user_avatar' => $avatar[1],
				'name' => $user->name,
				'user_twitter' => $user->twitter,
				'user_created_at' => date("Y-m-d\TH:i:s\Z",$user->created_on),
				'fixmedia_url' => site_url($this->router->reverseRoute('user-profile', array('username' => $user->username))),
			);
			$this->response($data);
		else :
			$data = array(
				'error' => 1,
				'description' => _('El usuario no se encuentra en Fixmedia'),
				'url' => $this->input->get('url'),
				'id' => $this->get('id')
				);
			$this->response($data);
		endif;
    }
    function get_source_info_get() {
    	$news = Report::find_all_by_site($this->get('site'));
    	if ($news) :
    		$data['site'] = $site = $this->get('site');
    		$data['fixmedia_site_url'] = site_url($this->router->reverseRoute('source-profile', array('sitename' => $site)));

			$reports_by_month = Reports_data::find_by_sql("SELECT count(rd.id) AS reports, month(rd.created_at) AS mes, year(rd.created_at) AS anio FROM
														 reports_data rd INNER JOIN reports r
														 ON (r.id=rd.report_id)
														 WHERE r.site LIKE '" . $site . "' GROUP BY mes");

			$fixes_by_month = Vote::find_by_sql("SELECT count(id) AS fixes, month(created_at) AS mes, year(created_at) AS anio FROM reports
												WHERE site LIKE '" . $site . "' GROUP BY mes");

			$total_fixes = Vote::find_by_sql("SELECT SUM(votes_count) as total FROM reports
												WHERE site LIKE '" . $site . "'");
			$data['total_news'] = count($news);
			$data['total_fixes'] = intval($total_fixes[0]->total);
			$data['total_reports'] =  count(Report::all(array(
										'joins' => array('data'),
										'conditions' => "reports.site LIKE '$site'")));

			$actions_by_month = array();

			foreach ($reports_by_month as $rep) :
				$actions_by_month[$rep->mes . $rep->anio]['reports'] = intval($rep->reports);
			endforeach;
			foreach ($fixes_by_month as $fix) :
				$actions_by_month[$fix->mes . $fix->anio]['fixes'] = intval($fix->fixes);
			endforeach;

			$report_types = Reports_data::find_by_sql("SELECT DISTINCT(rd.type) AS class, COUNT(rd.id) AS cont
														FROM reports_data rd INNER JOIN reports r
														ON (rd.report_id=r.id)
														WHERE r.site LIKE '" . $site . "' GROUP BY class
														ORDER BY cont DESC");
			$data['reports_types'] = array();
			foreach ($report_types as $rtype) {
				$data['reports_types'][$rtype->class] = intval($rtype->cont);
			}


			$sites_ranking = Reports_data::find_by_sql("SELECT DISTINCT(r.site) AS site, COUNT(rd.id) AS cont
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

			$data["sites_ranking_position"] = $position+1;
 			$data['actions_by_month'] = $actions_by_month;

    	else :
    		$data = array(
				'error' => 1,
				'description' => _('Esta fuente no se encuentra en Fixmedia'),
				'url' => $this->get('site')
				);
    	endif;
    	$this->response($data);
    }
}
?>