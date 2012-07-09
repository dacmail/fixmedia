<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vote extends ActiveRecord\Model { 
   static $validates_uniqueness_of = array(
       array(array('user_id','item_id','vote_type'))
   );
}	