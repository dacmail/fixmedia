<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends ActiveRecord\Model {
	static $belongs_to = array(
    	array('sender', 'class_name' => 'User', 'foreign_key' => 'sender_id'),
    	array('receiver', 'class_name' => 'User', 'foreign_key' => 'receiver_id')

	);

	static $after_save = array('send_notifications');

	public function send_notifications() {
		send_email_notifications($this);
	}
}