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
}	