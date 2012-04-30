<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_type extends ActiveRecord\Model { 

	public function get_items($parent=null) {
		if (!is_null($parent)) :
			$this->db->where('parent',$parent);
		endif;
		$query = $this->db->get('reports_types');
		return $query->result();
	}

	/*
		Obtiene un arbol con los tipos de reporte, solo de 1 nivel.
		TODO: Prepararlo para varios niveles
	*/
	public function get_tree() {
		$this->db->where('parent',0);
		$query = $this->db->get('reports_types');
		foreach ($query->result() as $type) :
			$this->db->where('parent',$type->report_type_id);
			$query = $this->db->get('reports_types');
			$type->childrens = $query->result();
			$result[$type->report_type_id] = $type;
		endforeach;
		return $result;
	}

}	