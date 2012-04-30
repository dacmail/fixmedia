<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_type extends ActiveRecord\Model { 

	static $belongs_to = array(array('parent_type', 'class_name' => 'Reports_type', 'foreign_key'=>'parent'));
	static $has_many = array(array('childrens', 'class_name' => 'Reports_type', 'foreign_key'=>'parent'));


}	