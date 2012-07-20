<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends ActiveRecord\Model { 
	static $has_many = array(
		array('reports', 'class_name' => 'Report'),
		array('subreports', 'class_name' => 'Reports_data')
	);
}	