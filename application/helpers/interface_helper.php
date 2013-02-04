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
	function karma_graphic($user_karma=1, $show_level=true) {
		$k = round($user_karma,0);
		switch ($k) {
			case 1:
			case 2:
			case 3:
			case 4:
			case 5:
				$level = 'Amateur';
				break;
			case 6:
			case 7:
			case 8:
			case 9:
			case 10:
				$level = 'Corrector';
				break;
			case 11:
			case 12:
			case 13:
			case 14:
			case 15:
				$level = 'Editor';
				break;
			case 16:
			case 17:
			case 18:
			case 19:
			case 20:
				$level = 'Fact-checker';
				break;
		}
		$return = "<div class='karma_graphic'>";
		$return .= $show_level ? "<span class='level ". strtolower($level) ."'>". $level ."</span>" : "";
		$return .= "<span title='Reputación nivel ". $k ."' class='karma_bar karma-". $k ."' style='background-position:left " . ((($k-1)*31)*-1) ."px;'> Nivel ". $k ."</span>";
		$return .= "</div>";
		return $return;
	}
	function avg_fixes() {
         $avg = Vote::find_by_sql('SELECT avg(votes_count) as average FROM reports');
         return (count($avg) ? round($avg[0]->average,1) : 0);
    }
    function avg_votes() {
         $avg = Vote::find_by_sql('SELECT avg(votes_count) as average FROM reports_data');
         return (count($avg) ? round($avg[0]->average,1) : 0);
    }

    function get_activity_text($activity, $el, $title=true) {
		switch ($activity->notification_type) {
   			case 'FIX':
   				$item = Report::find($activity->notificable_id);
   				$text = "hizo fix a la noticia ";
   				$text .= !$title ? "" : "<a href='". site_url($el->router->reverseRoute('reports-view', array('slug' => $item->slug))) . "'>$item->title</a> ";
   				$text .= "que tú descubriste";
   				break;
   			case 'VOTE':
   				$item = Reports_data::find($activity->notificable_id);
   				$text = "valoró tu reporte ";
   				$text .= !$title ? "" : "<a href='". site_url($el->router->reverseRoute('reports-view', array('slug' => $item->report->slug))) . "#report-$item->id'>$item->title</a>";
   				break;
			case 'SOLVED':
				$item = Reports_data::find($activity->notificable_id);
   				$text = "dijo que tu reporte ";
   				$text .= !$title ? "" : "<a href='". site_url($el->router->reverseRoute('reports-view', array('slug' => $item->report->slug))) . "#report-$item->id'>$item->title</a> ";
   				$text .= "está corregido";
				break;
			case 'SOLVED':
				$item = Reports_data::find($activity->notificable_id);
   				$text = "dijo que tu reporte ";
   				$text .= !$title ? "" : "<a href='". site_url($el->router->reverseRoute('reports-view', array('slug' => $item->report->slug))) . "#report-$item->id'>$item->title</a> ";
   				$text .= "está corregido";
			case 'REPORT':
				$item = Reports_data::find($activity->notificable_id);
   				$text = "reportó en la noticia ";
   				$text .= !$title ? "" : "<a href='". site_url($el->router->reverseRoute('reports-view', array('slug' => $item->report->slug))) . "'>$item->title</a> ";
   				$text .= "que tú descubriste";
				break;
   		}
   		return $text;
	}

	function send_email_notifications($activity) {
		$ci =& get_instance();
		if ($activity->sender_id!=$activity->receiver_id && $ci->ion_auth->in_group('admin',$activity->receiver_id) && $activity->receiver->notifications==1 && $activity->receiver->notification_active($activity->notification_type)) :
			$data['title'] = $activity->sender->name . ' ' . get_activity_text($activity, $ci, false);
			$data['content'] = $activity->sender->name . ' ' . get_activity_text($activity, $ci);
			$message = $ci->load->view('emails/template', $data, true);
			$ci->email->clear();
			$ci->email->from($ci->config->item('admin_email', 'ion_auth'), $ci->config->item('site_title', 'ion_auth'));
			$ci->email->to($activity->receiver->email);
			$ci->email->subject($data['title']);
			$ci->email->message($message);

			$ci->email->send();

			log_message('debug', $message);
		endif;
	}
