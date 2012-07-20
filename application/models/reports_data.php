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

    static $validates_presence_of = array(
		array('type'),
		array('type_info'),
		array('title')
	);

	public function is_voted($user_id=0) {
		if (empty($user_id)) return true;
		return Vote::exists(array('conditions' => array("item_id = ? AND user_id = ? AND vote_type LIKE 'REPORT'", $this->id, $user_id)));
	}
}	