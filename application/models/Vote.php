<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vote extends ActiveRecord\Model { 
   	static $belongs_to = array(
 		array('report', 'class_name' => 'Report', 'foreign_key' => 'item_id'),
    	array('user', 'class_name' => 'User')
	);

   	static $validates_uniqueness_of = array(
    	array(array('user_id','item_id','vote_type'))
   	);
}	