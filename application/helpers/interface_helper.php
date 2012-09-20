<?
	function is_cur_page($obj, $controller, $method) {
		return ($controller==$obj->router->class && $method==$obj->router->method);
	}

	function get_sidebars_blocks($data) {
		$data['sites_most_fixes'] = Report::find_by_sql('
									SELECT site, SUM(votes_count) as votes
									FROM reports GROUP BY site
									ORDER BY votes DESC LIMIT 0,5');
		$data['sites_most_reported'] = Report::find_by_sql('
									SELECT site, COUNT(reports_data.id) as reports
									FROM reports INNER JOIN reports_data
									ON reports.id = reports_data.report_id GROUP BY site
									ORDER BY reports DESC LIMIT 0,5');
		$data['top_users'] = User::find_by_sql('
									SELECT name, username, karma
									FROM users 
									ORDER BY karma DESC LIMIT 0,5');
		return $data;
	}
?>