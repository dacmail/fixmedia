<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends ActiveRecord\Model {
	static $belongs_to = array(
    	array('sender', 'class_name' => 'User', 'foreign_key' => 'sender_id')
	);
}