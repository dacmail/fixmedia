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
				$level =  _('Amateur');
				break;
			case 6:
			case 7:
			case 8:
			case 9:
			case 10:
				$level =  _('Corrector');
				break;
			case 11:
			case 12:
			case 13:
			case 14:
			case 15:
				$level =  _('Editor');
				break;
			case 16:
			case 17:
			case 18:
			case 19:
			case 20:
				$level =  _('Fact-checker');
				break;
		}
		$return = "<div class='karma_graphic'>";
		$return .= $show_level ? "<span class='level ". strtolower($level) ."'>". $level ."</span>" : "";
		$return .= "<span title='" . sprintf( _('Reputación del nivel %s'), $k) . "' class='karma_bar karma-". $k ."' style='background-position:left " . ((($k-1)*31)*-1) ."px;'>" . sprintf(_('Nivel %s'),$k) . "</span>";
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
   				$var = !$title ? "" : "<a href='". site_url($el->router->reverseRoute('reports-view', array('slug' => $item->slug))) . "'>$item->title</a> ";
   				$text = sprintf( _('hizo fix a la noticia %s que tú descubriste'), $var);
   				break;
   			case 'VOTE':
   				$item = Reports_data::find($activity->notificable_id);
   				$var = !$title ? "" : "<a href='". site_url($el->router->reverseRoute('reports-view', array('slug' => $item->report->slug))) . "#report-$item->id'>$item->title</a>";
   				$text =  sprintf(_("valoró tu reporte %"), $var);
   				break;
			case 'SOLVED':
				$item = Reports_data::find($activity->notificable_id);
   				$var = !$title ? "" : "<a href='". site_url($el->router->reverseRoute('reports-view', array('slug' => $item->report->slug))) . "#report-$item->id'>$item->title</a> ";
   				$text =  sprintf(_("dijo que tu reporte %s está corregido"), $var);
				break;
			case 'REPORT':
				$item = Reports_data::find($activity->notificable_id);
   				$var = !$title ? "" : "<a href='". site_url($el->router->reverseRoute('reports-view', array('slug' => $item->report->slug))) . "'>$item->title</a> ";
   				$text =  sprintf(_("reportó en la noticia %s que tú descubriste"), $var);
				break;
   		}
   		return $text;
	}

	function send_email_notifications($activity) {
		$ci =& get_instance();
		if ($activity->sender_id!=$activity->receiver_id  && $activity->receiver->notifications==1 && $activity->receiver->notification_active($activity->notification_type)) :
			$data['title'] = '<p>' . sprintf( _('¡Hola, %s!'), $activity->receiver->name) . '</p>';
			$data['content'] = '<p>' . $activity->sender->name . ' ' . get_activity_text($activity, $ci) . '</p>';
			$data['content'] .= '<p><a href="' . site_url('usuario/actividad') . '">' .  _('Ver notificaciones') . '</a></p>';
			$message = $ci->load->view('emails/template', $data, true);
			$ci->email->clear();
			$ci->email->from($ci->config->item('admin_email', 'ion_auth'), $ci->config->item('site_title', 'ion_auth'));
			$ci->email->to($activity->receiver->email);
			$ci->email->subject($activity->sender->name . ' ' . get_activity_text($activity, $ci, false));
			$ci->email->message($message);

			$ci->email->send();

			log_message('debug', $message);
		endif;
	}

	function send_daily_notifications($user) {
		$types = unserialize($user->notifications_types);
		$t = array();
		foreach ($types as $type => $val) :
			if ($val) { $t[] = "'" . $type . "'"; }
		endforeach;
		$t = implode(',', $t);
		$activities = Activity::all(array('conditions' => array('sender_id<>receiver_id AND receiver_id = ' . $user->id . ' AND created_at > date_sub(now(), interval 1 day) AND notification_type IN (' . $t . ')'), 'limit' => 6));
		if (count($activities)) :
			$ci =& get_instance();
			$data['content']="<p>" .  _('Tus notificaciones de hoy') . "</p><ul style='font-size:14px; color:#7F7F7F; line-height:21px;'>";
			$i=1;
			foreach ($activities as $activity) :
				$data['content'] .=  '<li>' . $activity->sender->name . ' ' . get_activity_text($activity, $ci) . '</li>';
				if ($i==5) {
					$data['content'] .= '<li>...</li>';
					break;
				}
			$i++; endforeach;
			$data['title'] = '<p>' . sprintf( _('¡Hola, %s!'), $user->name) . '</p>';
			$data['content'] .= '</ul><p><a href="' . site_url('usuario/actividad') . '">' .  _('Consúltalas todas en la web') . '</a></p>';
			$message = $ci->load->view('emails/template', $data, true);
			$ci->email->clear();
			$ci->email->from($ci->config->item('admin_email', 'ion_auth'), $ci->config->item('site_title', 'ion_auth'));
			$ci->email->to($user->email);
			$ci->email->subject( _('Tu actividad diaria en Fixmedia'));
			$ci->email->message($message);

			$ci->email->send();
			log_message('debug', $message);
		endif;
	}

	function get_avatar($user, $size=40, $alt=false) {
		if (!$alt) { $alt= sprintf( _("Reputación: %s"), $user->karma); }
		if (count($user->auth)) :
			return "<img src='" . str_replace('_normal', '_bigger', $user->auth->photourl) . "' width='" . $size . "' alt='" . $alt . "' />";
		else :
			return gravatar($user->email, $size, true, base_url('static/avatar-user-' . $size . '.jpg'), 'x', array('alt' => $alt) );
		endif;
	}
	function _e($string) {echo gettext($string);}
