<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends ActiveRecord\Model {

	static $belongs_to = array(
    	array('user', 'class_name' => 'User')
	);

   	static $after_save = array('complete_data');

   	public function complete_data() {
         switch ($this->provider) {
         	case 'Twitter':
         		$this->user->url = $this->websiteurl;
         		$this->user->name = $this->firstName;
         		$this->user->twitter = $this->displayname;
         		$this->user->bio = $this->description;
         		$this->user->save();
         		break;
         }
   	}


}