<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_data extends ActiveRecord\Model { 
	static $table_name = 'reports_data';

	public function get_urls() {
		return unserialize($this->read_attribute('urls'));
	}

	static $belongs_to = array(
    	array('report', 'class_name' => 'Report')
	);

    static $validates_presence_of = array(
		array('type'),
		array('type_info'),
		array('title')
	);
}	