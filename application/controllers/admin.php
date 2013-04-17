<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct() {
	   parent::__construct();
	   if (!$this->ion_auth->is_admin()) { redirect('auth/login', 'refresh'); }
	}

	function index() {

	}
	function comments() {
		$this->session->keep_flashdata('admin_message');
		$data['comments'] = Comment::find('all', array('order' => 'created_at desc'));
		$this->load->view('admin/comments', $data);
	}
	function delete_comment($id) {

		if (!is_numeric($id)) { $this->session->set_flashdata('admin_message', "El comentario no existe"); redirect(site_url('admin/comments'));}
		$comment = Comment::find($id);
		if (!empty($comment)) {
			if (count($comment->children)) { $this->session->set_flashdata('admin_message', "El comentario tiene respuestas y no puede eliminarse");  redirect(site_url('admin/comments')); }
			$activity = Activity::find('first', array('conditions' => "notificable_id = $id AND notification_type LIKE 'COMMENT'"));
			if (!empty($activity)) {$activity->delete();}
			$comment->delete();
			$this->session->set_flashdata('admin_message', "Comentario eliminado correctamente");
			redirect(site_url('admin/comments'));
		}
		$this->session->set_flashdata('admin_message', "Se ha producido un error y no se ha podido eliminar el comentario");
		redirect(site_url('admin/comments'));
	}
}