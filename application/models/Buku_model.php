<?php

class Buku_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_buku($id_buku = NULL, $limit = NULL, $start = NULL)
	{
		$this->db->select('b.id_buku, b.cover, b.judul_buku, b.penulis, b.penerbit, b.isbn, b.tahun_terbit, k.nama_kategori as kategori, p.nama_penerbit as penerbit');
		$this->db->join('kategori k', 'b.kategori = k.id_kategori');
		$this->db->join('penerbit p', 'b.penerbit = p.id_penerbit');

		if ($id_buku == null) {
			$this->db->order_by('b.judul_buku');
		} else {
			$this->db->where('id_buku', $id_buku);
		}

		return $this->db->get('buku b', $limit, $start);
	}

	public function insert($data)
	{
		$this->db->insert('buku', $data);
		return TRUE;
	}

	public function update($id, $data)
	{
		$this->db->where('id_buku', $id);
		$this->db->update('buku', $data);
	}

	public function delete($id)
	{
		$this->db->where('id_buku', $id);
		$this->db->delete('buku');
	}

	public function get_by_id($id)
	{
		$this->db->where('id_buku', $id);
		return $this->db->get('buku')->row();
	}
}
