<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends MY_Controller {
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

      public function fix_vote($user_id, $report_id) {
         $data['result']['valid'] = false;
         try { $user = User::find($user_id); } catch (\ActiveRecord\RecordNotFound $e) {
            $data['result']['error'] = "Usuario no válido";
         }
         if (!$this->logged_in || $user_id!=$this->the_user->id) { $data['result']['error'] = "Usuario no está logueado o no se corresponde"; }
         try { $report = Report::find($report_id); } catch (\ActiveRecord\RecordNotFound $e) {
            $data['result']['error'] = "Envío no válido";
         }
         if (empty($data['result']['error'])) :
            $vote = Vote::create(array(
                                 'user_id' => $user->id,
                                 'item_id' => $report->id,
                                 'vote_type' => 'FIX',
                                 'vote_value' => 1,
                                 'ip' => $this->input->ip_address()
                              ));
            if ($vote->is_valid()) :
               $report->votes_count++;
               $report->save();
               $data['result']['valid'] = true;
               $data['result']['vote'] = $vote;
               $data['result']['total_votes'] = $report->votes_count;
            else :
               $data['result']['error'] = "Se ha producido un error";
            endif;
         endif;
         $this->load->view('services/fix_vote', $data);
      }

      public function report_vote($user_id, $report_data_id, $value) {
         $data['result']['valid'] = false;
         try { $user = User::find($user_id); } catch (\ActiveRecord\RecordNotFound $e) {
            $data['result']['error'] = "Usuario no válido";
         }
         if (!$this->logged_in || $user_id!=$this->the_user->id) { $data['result']['error'] = "Usuario no está logueado o no se corresponde"; }
         try { $report = Reports_data::find($report_data_id); } catch (\ActiveRecord\RecordNotFound $e) {
            $data['result']['error'] = "Envío no válido";
         }
         if (empty($data['result']['error'])) :
            $value = ($value<=0 ? -1 : 1);
            $vote = Vote::create(array(
                                 'user_id' => $user->id,
                                 'item_id' => $report->id,
                                 'vote_type' => 'REPORT',
                                 'vote_value' => $value,
                                 'ip' => $this->input->ip_address()
                              ));
            if ($vote->is_valid()) :
               $report->votes_count=$report->votes_count+$value;
               $report->save();
               $data['result']['valid'] = true;
               $data['result']['vote'] = $vote;
               $data['result']['item_id'] = $report->id;
               $data['result']['total_votes'] = $report->votes_count;
            else :
               $data['result']['error'] = "Se ha producido un error";
            endif;
         endif;
         $this->load->view('services/fix_vote', $data);
      }

}