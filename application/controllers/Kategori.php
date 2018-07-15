<?php

class Kategori extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kategori_model');
		$this->load->library('pagination');
	}

	public function index()
	{
		//konfigurasi pagination
		$config['base_url'] = site_url('kategori/index'); //site url
		$config['total_rows'] = $this->db->count_all('kategori'); //total row
		$config['per_page'] = 3;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

		// Membuat Style pagination untuk BootStrap v4
		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close'] = '</span></li>';

		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';

		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close'] = '</span>Next</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';

		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';

		$this->pagination->initialize($config);

		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['kategori'] = $this->Kategori_model->get_kategori(NULL, $config["per_page"], $data['page'])->result();
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = 'Dashboard Kategori';
		$this->load->view('kategori/kategori_list', $data);
	}

	public function add()
	{
		$data['title'] = 'Insert Kategori';
		$this->load->view('kategori/insert_data_kategori', $data);
	}

	public function insert()
	{
		$data = array(
			'nama_kategori' => $this->input->post('kategori')
		);

		$res = $this->Kategori_model->insert($data);
		if ($res > 0) {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-info\">
			<div class=\"container-fluid\">
					<div class=\"alert-icon\">
						<i class=\"material-icons\">check</i>
					</div>
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">
						<span aria-hidden=\"true\"><i class=\"material-icons\"></i>X</span>
					</button>
					<b>Success : </b> Data berhasil ditambahkan
				</div>
			</div>");
			redirect("Kategori");
		}else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\">
			<div class=\"container-fluid\">
					<div class=\"alert-icon\">
						<i class=\"material-icons\">error_outline</i>
					</div>
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">
						<span aria-hidden=\"true\"><i class=\"material-icons\"></i>X</span>
					</button>
					<b>Error : </b> Data gagal ditambahkan
				</div>
			</div>");
			redirect("Kategori");
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Update Kategori';
		$data['kategori'] = $this->Kategori_model->get_kategori($id, NULL, NULL)->row();
		$this->load->view('kategori/update_data_kategori', $data);
	}

	public function update()
	{
		$id_kategori = $this->input->post('id_kategori');
		$data = array(
			'nama_kategori' => $this->input->post('kategori')
		);
		$res = $this->Kategori_model->update($id_kategori, $data);
		if ($res >= 0) {
			$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data Berhasil diubah !!</div></div>");
			redirect('Kategori');
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal diubah !!</div></div>");
			redirect('');
		}
	}

	public function delete($id)
	{
		$res = $this->Kategori_model->delete($id);
		if ($res >= 0) {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-info\">
			<div class=\"container-fluid\">
					<div class=\"alert-icon\">
						<i class=\"material-icons\">check</i>
					</div>
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">
						<span aria-hidden=\"true\"><i class=\"material-icons\"></i>X</span>
					</button>
					<b>Success : </b> Data Berhasil dihapus
				</div>
			</div>");
			redirect("Kategori");
		}else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\">
			<div class=\"container-fluid\">
					<div class=\"alert-icon\">
						<i class=\"material-icons\">error_outline</i>
					</div>
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">
						<span aria-hidden=\"true\"><i class=\"material-icons\"></i>X</span>
					</button>
					<b>Error : </b> Data gagal dihapus
				</div>
			</div>");
			redirect("Kategori");
		}
	}
}
