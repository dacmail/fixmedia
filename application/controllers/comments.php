<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends MY_Controller {

	public function __construct() {
	   parent::__construct();
	}
	public function create() {
		if (!$this->ion_auth->logged_in()) { redirect_back(); }

		$this->form_validation->set_rules('content',  _('Comentario'), 'required|xss_clean|strip_tags');
		$comment = $this->input->post(NULL, TRUE);

		$report = Reports_data::find($comment['reports_data_id']);
		if (empty($report)) { redirect_back(); }

		if ($this->form_validation->run() === FALSE) { redirect($this->router->reverseRoute('reports-view', array('slug' => $report->report->slug)) . '#report-' . $report->id); }

		//comprobar si es una respuesta y que el comentario y reporte coinciden y no hay mas de 2 niveles
		if (!empty($comment['parent'])) :
			$parent = Comment::find($comment['parent']);
			if (empty($parent) || $parent->report->id!=$comment['reports_data_id'] || !empty($parent->parent)) { redirect($this->router->reverseRoute('reports-view', array('slug' => $report->report->slug)) . '#report-' . $report->id); }
		endif;

		$new_comment = Comment::create(array(
										'user_id' => $this->the_user->id,
										'reports_data_id' => $report->id,
										'content' => $comment['content'],
										'parent' => $comment['parent'],
										'IP' => $this->input->ip_address()
										));
		$new_comment->save();
		redirect($this->router->reverseRoute('reports-view', array('slug' => $report->report->slug)) . '#comment-' . $new_comment->id);
	}
}