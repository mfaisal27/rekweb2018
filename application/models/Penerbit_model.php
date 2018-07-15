<?php

class Penerbit_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_penerbit($id_penerbit = null, $limit = null, $start = null){
		$this->db->select('*');

		if ($id_penerbit == null) {
			$this->db->order_by('nama_penerbit');
		}else {
			$this->db->where('id_penerbit', $id_penerbit);
		}

		return $this->db->get('penerbit', $limit, $start);
	}

	public function insert($data){
		$this->db->insert("penerbit", $data);
		return TRUE;
	}

	public function update($id, $data){
		$this->db->where("id_penerbit", $id);
		$this->db->update("penerbit", $data);
	}

	public function delete($id){
		$this->db->where("id_penerbit", $id);
		$this->db->delete("penerbit");
	}
}
