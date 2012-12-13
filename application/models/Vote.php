<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vote extends ActiveRecord\Model {
   	static $belongs_to = array(
 		array('report', 'class_name' => 'Report', 'foreign_key' => 'item_id'),
 		array('subreport', 'class_name' => 'Reports_data', 'foreign_key' => 'item_id'),
    	array('user', 'class_name' => 'User')
	);

   	static $validates_uniqueness_of = array(
    	array(array('user_id','item_id','vote_type'))
   	);

   	static $after_save = array('write_activity');

   	public function write_activity() {
   		switch ($this->vote_type) {
   			case 'FIX':
   				$receiver = $this->report->user_id;
   				$type = 'FIX';
   				break;
   			case 'REPORT':
   				$receiver = $this->subreport->user_id;
   				$type = 'VOTE';
   				break;
			case 'SOLVED':
				$receiver = $this->subreport->user_id;
				$type = 'SOLVED';
				break;
   		}
   		Activity::create(array(
   						'sender_id' => $this->user_id,
   						'receiver_id' => $receiver,
   						'notificable_id' => $this->item_id,
   						'notification_type' => $type,
   						'read' => 0));
   	}
}