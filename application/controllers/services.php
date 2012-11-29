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
      public function get_more_data($count=1)   {
         $data['reports_types_tree'] = Reports_type::find_all_by_parent(0);
         if (empty($data['reports_types_tree'])) :
            show_404();
         else:
            $data['count'] = $count+1;
            $this->load->view('services/get_more_data', $data);
         endif;
      }

      public function fix_vote($report_id) {
         if (!$this->logged_in) :
            redirect('auth', 'refresh');
         endif;
         $data['result']['valid'] = false;
         if (!$this->logged_in) { $data['result']['error'] = "Usuario no está logueado o no se corresponde"; }
         try { $report = Report::find($report_id); } catch (\ActiveRecord\RecordNotFound $e) {
            $data['result']['error'] = "Envío no válido";
         }
         if (empty($data['result']['error'])) :
            $vote = Vote::create(array(
                                 'user_id' => $this->the_user->id,
                                 'item_id' => $report->id,
                                 'vote_type' => 'FIX',
                                 'vote_value' => 1,
                                 'ip' => $this->input->ip_address()
                              ));
            if ($vote->is_valid()) :
               $report->votes_count++;
               $report->karma = $report->karma + $this->the_user->karma;
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
               $report->karma = ($value<=0 ? $report->karma - $this->the_user->karma : $report->karma + $this->the_user->karma);
               $report->report->karma = ($value<=0 ? $report->report->karma - ($this->the_user->karma/3) : $report->report->karma + ($this->the_user->karma/2));
               $report->save();
               $report->report->save();
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


      public function report_solved($user_id, $report_data_id) {
         $data['result']['valid'] = false;
         try { $user = User::find($user_id); } catch (\ActiveRecord\RecordNotFound $e) {
            $data['result']['error'] = "Usuario no válido";
         }
         if (!$this->logged_in || $user_id!=$this->the_user->id) { $data['result']['error'] = "Usuario no está logueado o no se corresponde"; }
         try { $report = Reports_data::find($report_data_id); } catch (\ActiveRecord\RecordNotFound $e) {
            $data['result']['error'] = "Envío no válido";
         }
         if (empty($data['result']['error'])) :
            $vote = Vote::create(array(
                                 'user_id' => $user->id,
                                 'item_id' => $report->id,
                                 'vote_type' => 'SOLVED',
                                 'vote_value' => $this->the_user->karma,
                                 'ip' => $this->input->ip_address()
                              ));
            if ($vote->is_valid()) :
               $data['result']['valid'] = true;
               $data['result']['vote'] = $vote;
               $data['result']['item_id'] = $report->id;
               $data['result']['total_votes'] = $report->solved_votes();
               $data['result']['total_value'] = $report->solved_value();
               $data['result']['is_solved'] = $report->is_solved();
            else :
               $data['result']['error'] = "Se ha producido un error";
            endif;
         endif;
         $this->load->view('services/fix_vote', $data);
      }

      public function share($slug, $fix=0) {
         if (!empty($slug)) :
            $report = Report::find_by_slug($slug);
            if ($report) :
               if ($fix) :
                  $data['title'] = "¡Acabas de mejorar esta noticia!";
                  $data['content'] = "Enséñaselo a tus amigos para que valoren positivamente tu reporte";
               else :
                  $data['title'] = "¡Compártela!";
                  $data['content'] = "Cuanta más gente conozca esta noticia y haga FIX en ella, más posibilidades de arreglarla entre todos";
               endif;
               $data['report_title'] = $report->title;
               $data['url'] = site_url($this->router->reverseRoute('reports-view' , array('slug' => $slug)));
               $this->load->view('services/share', $data);
            endif;
         else :
            show_404();
         endif;
      }


      public function karma_users() {
         if ($this->input->is_cli_request() ) :
            $this->load->helper('karma');

            //media de fixes por noticia
            $this->db->select('AVG(votes_count) as avg');
            $query = $this->db->get('reports');
            $row=$query->row();
            $avg_votes=$row->avg-1;

            $users = User::find_all_by_active(1);
            $output = 'Comienzo del proceso: ' . time();
            foreach ($users as $user) :
               $output .= calculate_karma_users($user, $avg_votes);
            endforeach;
            $output .= 'Final del proceso: ' . time();
            mail('dacmail@gmail.com', 'Ejecución cálculo karma usuarios', $output, "MIME-Version: 1.0" . "\r\n Content-type: text/html; charset=UTF-8" . "\r\n");
         else :
            show_404();
         endif;
      }

      public function karma_value() {
         if ($this->input->is_cli_request() ) :
            $this->load->helper('karma');
            calculate_karma_reports();
         else :
            show_404();
         endif;
      }

      public function fixit() {
         $data['url'] = $this->input->get('url', TRUE);
         if (!empty($data['url'])) :
            $data['votes'] = 0;
            $report = Report::find_by_url($data['url']);
            $data['voted'] = false;
            if ($report) :
               $data['report'] = $report;
               $data['votes'] = $report->votes_count;
               $data['voted'] = ($this->logged_in && $report->is_voted($this->the_user->id));
            endif;
            $style = $this->input->get('style', TRUE);
            $data['style'] = empty($style) ? 'std' : 'gray';
            $text = $this->input->get('text', TRUE);
            $data['text'] = empty($text) ? 'fix' : $text;
            $this->load->view('services/fixit', $data);
         endif;
      }

      public function bookmarklet() {
         $data['url'] = $this->input->get('url', TRUE);
         if (!empty($data['url'])) :
            $data['votes'] = 0;
            $report = Report::find_by_url($data['url']);
            $data['voted'] = false;
            if ($report) :
               $data['report'] = $report;
               $data['votes'] = $report->votes_count;
               $data['voted'] = ($this->logged_in && $report->is_voted($this->the_user->id));
            endif;
            $this->load->view('services/bookmarklet', $data);
         endif;
      }

      public function set_images() {
         if ($this->input->is_cli_request() ) {
            $this->db->select('id, url, screenshot');
            $this->db->where("screenshot IS NULL OR screenshot LIKE ''");
            $query = $this->db->get('reports');

            $path = getcwd() . '/images/sources/';
            echo "RUTA PARA IMAGENES: $path </br>";
            $update_data = array();
            $this->load->library('image_lib');
            foreach ($query->result() as $report) :
               $thumb = $path . 'thumb-' . $report->id . ".png";
               $thumb_report = $path . 'thumb-report-' . $report->id . ".png";
               $thumb_home = $path . 'thumb-home-' . $report->id . ".png";
               $cmd = '/usr/local/bin/phantomjs ' . getcwd() . '/js/rasterize.js';

               if (!file_exists($thumb)) :
                  system("$cmd $report->url $thumb");
               endif;

               if (file_exists($thumb)) :

                  if (!file_exists($thumb_report)) :
                     $config['image_library'] = 'gd2';
                     $config['source_image'] = $thumb;
                     $config['create_thumb'] = FALSE;
                     $config['new_image'] = $thumb_report;
                     $config['maintain_ratio'] = FALSE;
                     $config['width']   = 180;
                     $config['height'] = 180;

                     $this->image_lib->initialize($config);
                     if ( ! $this->image_lib->resize()) {
                         echo $this->image_lib->display_errors();
                     }
                  endif;
                  if (!file_exists($thumb_home) && file_exists($thumb_report)) :
                     $config['image_library'] = 'gd2';
                     $config['source_image'] = $thumb_report;
                     $config['create_thumb'] = FALSE;
                     $config['new_image'] = $thumb_home;
                     $config['maintain_ratio'] = FALSE;
                     $config['width']   = 150;
                     $config['height'] = 100;

                     $this->image_lib->initialize($config);
                     if ( ! $this->image_lib->crop()) {
                         echo $this->image_lib->display_errors();
                     }
                  endif;

                  echo "<br/> *** Creada miniatura: $thumb </br>";
                  $screenshot = "thumb-$report->id.png";
               else :
                  $screenshot = "ERROR";
               endif;
               $update_data[] = array('id' => $report->id, 'screenshot' => $screenshot);
            endforeach;

            $this->db->select('id, url, screenshot');
            $this->db->where("screenshot IS NULL OR screenshot LIKE ''");
            $query = $this->db->get('reports');
            if (!empty($update_data)) { $this->db->update_batch('reports', $update_data, 'id'); }
         } else {
            show_404();
         }
      }

}