<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends ActiveRecord\Model { 
	static $has_many = array(
		array('data', 'class_name' => 'Reports_data'),
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

	public function is_voted($user_id=0) {
		if (empty($user_id)) return true;
		return Vote::exists(array('conditions' => array("item_id = ? AND user_id = ? AND vote_type LIKE 'FIX'", $this->id, $user_id)));
	}
}	