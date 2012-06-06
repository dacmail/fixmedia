<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller {
	public function __construct() {
	   parent::__construct();
	}
   	public function get_subtypes_select($parent_id, $count) {
        $data['reports_types'] = Reports_type::find_all_by_parent($parent_id);
   		if (empty($data['reports_types'])) :
   			show_404();
   		else :
            $data['count'] = $count-1;
            $data['type'] = $parent_id;
   			$this->load->view('services/get_subtypes_select', $data);
      	endif;
   	}
   	public function get_more_data($count=1)	{
   		$data['reports_types_tree'] = Reports_type::find_all_by_parent(0); 
   		if (empty($data['reports_types_tree'])) : 
   			show_404();
   		else:
   			$data['count'] = $count+1;
   			$this->load->view('services/get_more_data', $data);
   		endif;
   	}

}