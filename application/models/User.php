<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends ActiveRecord\Model {
	static $has_many = array(
		array('reports', 'class_name' => 'Report'),
		array('subreports', 'class_name' => 'Reports_data'),
		array('fixes', 'class_name' => 'Vote', 'foreign_key' => 'user_id' ,'conditions' => "vote_type LIKE 'FIX'" )
	);

	public function get_name() {
		$name = $this->read_attribute('name');
	   	return (empty($name) ? $this->username : $name);
	}

	public function fixes_accumulated() {
		$accu_fixes = User::find_by_sql("SELECT r.user_id, count(v.id) as acu_fixes FROM reports r INNER JOIN votes v
							ON (v.item_id=r.id) WHERE v.vote_type='FIX' AND r.user_id=$this->id GROUP BY r.user_id");
		return (count($accu_fixes) ? $accu_fixes[0]->acu_fixes : 0);
	}

	public function send_fixes() {
		return count(Report::find_all_by_user_id($this->id));
	}

	public function received_reports() {
		$received_reports = User::find_by_sql("SELECT r.user_id, count(rd.id) as received_reports FROM reports r INNER JOIN reports_data rd
							ON (rd.report_id=r.id) WHERE rd.user_id<>$this->id AND r.user_id=$this->id GROUP BY r.user_id");
		return (count($received_reports) ? $received_reports[0]->received_reports : 0);
	}

	public function votes_avg() {
		$votes = Vote::find_by_sql("SELECT r.user_id, SUM(v.vote_value) as votes FROM reports_data r INNER JOIN votes v
							ON (v.item_id=r.id) WHERE v.vote_type='REPORT' AND r.user_id=$this->id GROUP BY r.user_id");
	}
}