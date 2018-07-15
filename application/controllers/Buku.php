<?php

class Buku extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Buku_model');
		$this->load->model('Kategori_model');
		$this->load->model('Penerbit_model');
		$this->load->library('pagination');
	}

	public function index()
	{
		//konfigurasi pagination
		$config['base_url'] = site_url('buku/index'); //site url
		$config['total_rows'] = $this->db->count_all('buku'); //total row
		$config['per_page'] = 3;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

		// Membuat Style pagination untuk BootStrap v4
		$config['full_tag_open']    = '<nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav>';

		$config['first_link']       = 'First';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';

		$config['last_link']        = 'Last';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$config['next_link']        = 'Next';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';

		$config['prev_link']        = 'Prev';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';

		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';

		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';

		$this->pagination->initialize($config);

		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['buku'] = $this->Buku_model->get_buku(NULL, $config["per_page"], $data['page'])->result();
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = 'Dashboard Buku';
		$this->load->view('buku/dashboard', $data);
	}

	public function add()
	{
		$data['kategori'] = $this->Kategori_model->get_kategori(NULL, NULL, NULL)->result();
		$data['penerbit'] = $this->Penerbit_model->get_penerbit(NULL)->result();
		$data['title'] = 'Insert Buku';
		$this->load->view('buku/insert_data_buku', $data);
	}

	public function insert()
	{
		$this->load->library('upload');
		$nmfile = "file_" . time();
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['max_size'] = '3072';
		$config['max_width'] = '5000';
		$config['max_height'] = '5000';
		$config['file_name'] = $nmfile;

		$this->upload->initialize($config);

		if ($_FILES['filefoto']['name']) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				$data = array(
					'cover' => $gbr['file_name'],
					'judul_buku' => $this->input->post('judul'),
					'penulis' => $this->input->post('penulis'),
					'kategori' => $this->input->post('kategori'),
					'penerbit' => $this->input->post('penerbit'),
					'isbn' => $this->input->post('isbn'),
					'tahun_terbit' => $this->input->post('tahun')
				);

				$this->Buku_model->insert($data);

				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $this->upload->upload_path . $this->upload->file_name;
				$config2['new_image'] = './assets/hasil_resize/';
				$config2['maintain_ratio'] = TRUE;
				$config2['width'] = 100;
				$config2['height'] = 100;
				$this->load->library('image_lib', $config2);

				if (!$this->image_lib->resize()) {
					$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));
				}
				$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data Berhasil ditambahkan !!</div></div>");
				redirect('buku');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal ditambahkan !!</div></div>");
				redirect('buku/add');
			}
		}
	}

	public function edit($id)
	{
		$data['buku'] = $this->Buku_model->get_buku($id)->row();
		$data['kategori'] = $this->Kategori_model->get_kategori(NULL, NULL, NULL)->result();
		$data['penerbit'] = $this->Penerbit_model->get_penerbit(NULL)->result();
		$data['title'] = 'Update Buku';
		$this->load->view('buku/update_data_buku', $data);
	}

	public function update()
	{
		$data = array(
			'judul_buku' => $this->input->post('judul'),
			'penulis' => $this->input->post('penulis'),
			'kategori' => $this->input->post('kategori'),
			'penerbit' => $this->input->post('penerbit'),
			'isbn' => $this->input->post('isbn'),
			'tahun_terbit' => $this->input->post('tahun')
		);
		$id = $this->input->post('id_buku');
		$result = $this->Buku_model->update($id, $data);
		$row = $this->Buku_model->get_by_id($id);

		$this->load->library('upload');
		$nmfile = "file_" . time();
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['max_size'] = '3072';
		$config['max_width'] = '5000';
		$config['max_height'] = '5000';
		$config['file_name'] = $nmfile;

		$this->upload->initialize($config);

		if ($_FILES['filefoto']['name']) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				$data['cover'] = $gbr['file_name'];
				$path = './assets/img/'. $row->cover;
				unlink($path);
				$path2 = './assets/hasil_resize/'. $row->cover;
				unlink($path2);
				$this->Buku_model->update($id, $data);

				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $this->upload->upload_path . $this->upload->file_name;
				$config2['new_image'] = './assets/hasil_resize/';
				$config2['maintain_ratio'] = TRUE;
				$config2['width'] = 100;
				$config2['height'] = 100;
				$this->load->library('image_lib', $config2);

				if (!$this->image_lib->resize()) {
					$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));
				}
				$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data Berhasil diubah !!</div></div>");
				redirect('buku');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Data Gagal diubah !!</div></div>");
				redirect('');
			}
		}
		if ($result >= 0) {
			$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-info\" id=\"alert\">Data Berhasil Diubah !!</div></div>");
			redirect('buku');
		}else {
			$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Data Gagal Diubah !!</div></div>");
			redirect('');
		}
	}

	public function delete($id){
		$row = $this->Buku_model->get_by_id($id);
		$path = './assets/img/'. $row->cover;
		unlink($path);
		$res = $this->Buku_model->delete($id);
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
			redirect("buku");
		} else {
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
			redirect("buku");
		}
	}
}
