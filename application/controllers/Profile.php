<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_Model');
	}

	// surat masuk admin

	public function index()
	{
		// Load data surat_masuk from the backend
		$data['profile'] = $this->Profile_Model->get_profile(); // Gantilah dengan fungsi sesuai kebutuhan
		$this->load->view('templates/navbar');
		$this->load->view('profile', $data);
		$this->load->view('templates/footer');
	}
	

	public function profile()
	{
		$data['profile'] = $this->Profile_Model->get_profile();
		$this->load->view('templates/head');
		$this->load->view('templates/admin_sidebar');
		$this->load->view('templates/admin_navbar');
		$this->load->view('profile/profile', $data);
		$this->load->view('templates/admin_footer');
	}

	public function proses_upload()
	{
		// Validasi form
		$this->form_validation->set_rules('tahunJabatan', 'Tahun Jabatan', 'required');

		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, tampilkan kembali form unggah data dengan pesan error
			$this->session->set_flashdata('error', validation_errors());
			redirect('profile/profile');
		} else {
			// Konfigurasi untuk proses unggah gambar
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 2048; // 2MB

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('gambar')) {
				// Jika unggah berhasil, ambil data dari form
				$tahunJabatan = $this->input->post('tahunJabatan');
				$nama_pejabat = $this->input->post('nama_pejabat');
				$gambar = $this->upload->data('file_name');

				// Simpan data ke dalam database
				$data = array(
					'tahun_jabatan' => $tahunJabatan,
					'nama_pejabat' => $nama_pejabat,
					'avatar' => $gambar

				);
				$this->Profile_Model->upload_profile($data);

				// Set notifikasi berhasil
				$this->session->set_flashdata('success', 'Data berhasil diunggah.');

				// Redirect ke halaman profile
				redirect('profile/profile');
			} else {
				// Jika unggah gagal, tampilkan pesan error
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', $error);
				redirect('profile/profile');
			}
		}
	}

}
