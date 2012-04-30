<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller {
	public function __construct() {
	   parent::__construct();
	}
   	public function get_subtypes_select($parent_id) {
        $data['reports_types'] = Reports_type::find_all_by_parent($parent_id);
		if (empty($data['reports_types'])) :
			show_404();
		else :
			$this->load->view('services/get_subtypes_select', $data);
   		endif;
   	}

}