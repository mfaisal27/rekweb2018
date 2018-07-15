<?php

class Kategori_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_kategori($id_kategori = null, $limit = null, $start = null){
		$this->db->select('*');

		if ($id_kategori == null) {
			$this->db->order_by('nama_kategori');
		}else {
			$this->db->where('id_kategori', $id_kategori);
		}

		return $this->db->get('kategori', $limit, $start);
	}

	public function insert($data){
		$this->db->insert("kategori", $data);
		return TRUE;
	}

	public function update($id, $data){
		$this->db->where("id_kategori", $id);
		$this->db->update("kategori", $data);
	}

	public function delete($id){
		$this->db->where("id_kategori", $id);
		$this->db->delete("kategori");
	}
}
