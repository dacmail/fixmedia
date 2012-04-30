<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends ActiveRecord\Model { 

	static $has_many = array(
		array('data', 'class_name' => 'reports_data')
	);

}	