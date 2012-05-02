<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends ActiveRecord\Model { 

	static $has_many = array(
		array('data', 'class_name' => 'reports_data')
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
}	