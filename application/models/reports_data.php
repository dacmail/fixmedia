<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_data extends ActiveRecord\Model {
	static $table_name = 'reports_data';

	public function get_urls() {
		return unserialize($this->read_attribute('urls'));
	}

	static $belongs_to = array(
    	array('report', 'class_name' => 'Report'),
    	array('user', 'class_name' => 'User')
	);
	static $has_many = array(
		array('votes', 'foreign_key' => 'item_id' ,'conditions' => "vote_type LIKE 'REPORT'"),
		array('comments', 'class_name' => 'Comment'),
		array('parent_comments', 'class_name' => 'Comment', 'conditions' => "parent = 0")
	);
    static $validates_presence_of = array(
		array('type'),
		array('type_info'),
		array('title')
	);

	static $after_create = array('write_activity');

   	public function write_activity() {
   		Activity::create(array(
   						'sender_id' => $this->user_id,
   						'receiver_id' => $this->report->user_id,
   						'notificable_id' => $this->id,
   						'notification_type' => 'REPORT',
   						'read' => 0));
   	}

	public function is_voted($user_id=0, $type='REPORT') {
		if (empty($user_id)) return true;
		return Vote::exists(array('conditions' => array("item_id = ? AND user_id = ? AND vote_type LIKE ?", $this->id, $user_id, $type)));
	}

	public function solved_votes() {
		return count(Vote::find_by_sql("SELECT id FROM votes WHERE item_id = " . $this->id  . " AND vote_type LIKE 'SOLVED'"));
	}
	public function solved_value() {
		$solved = Vote::find_by_sql("SELECT sum(vote_value) as total FROM votes WHERE item_id = " . $this->id  . " AND vote_type LIKE 'SOLVED'");
		return $solved[0]->total;
	}
	public function is_solved() {
		return ($this->solved_value()>=SOLVED_MIN);
	}
	public function is_removable($user_id) {
		return (($this->solved_votes()==0) && (count($this->votes)==1) && ($this->user_id==$user_id));
	}

}