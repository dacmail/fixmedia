<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends ActiveRecord\Model {
	static $has_many = array(
		array('data', 'order' => 'votes_count desc, created_at desc', 'class_name' => 'Reports_data'),
		array('votes', 'foreign_key' => 'item_id' ,'conditions' => "vote_type LIKE 'FIX'")
	);
	static $validates_uniqueness_of = array(
		array('url'),
		array('slug')
    );
    static $validates_presence_of = array(
		array('url'),
		array('title'),
		array('slug')
	);
    static $belongs_to = array(
    	array('user', 'class_name' => 'User')
	);
	public function is_voted($user_id=0) {
		if (empty($user_id)) return true;
		return Vote::exists(array('conditions' => array("item_id = ? AND user_id = ? AND vote_type LIKE 'FIX'", $this->id, $user_id)));
	}

	public static function count_all() {
        $array = self::first(array('select' => 'count(*) AS num_rows'))->attributes();
        return $array['num_rows'];
    }

    public function has_subreport($user_id=0) {
		if (empty($user_id)) return Reports_data::exists(array('conditions' => array("report_id = ?", $this->id)));;
		return Reports_data::exists(array('conditions' => array("report_id = ? AND user_id = ?", $this->id, $user_id)));
	}

	public function get_reports_by_site() {
		return count(Reports_data::find_by_sql("SELECT rd.id FROM reports_data rd INNER JOIN reports r ON (r.id=rd.report_id) WHERE r.site LIKE '$this->site'"));
	}

	public function is_solved() {
		$solved=count($this->data); //false if report has no "subreports"
		foreach ($this->data as $subr) :
			$solved = $solved && $subr->is_solved();
		endforeach;
		return $solved;
	}
	public function is_removable($user_id) {
		return ((count($this->votes)==1) && (count($this->data)==0) && ($this->user_id==$user_id));
	}


}
