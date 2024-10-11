<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ibrah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('Ibrah_Model');
	}

	public function index()
	{
		// Load data surat_masuk from the backend
		$data['ibrah'] = $this->Ibrah_Model->get_ibrah(); // Gantilah dengan fungsi sesuai kebutuhan
		$data['latepost_photos'] = array();
		foreach ($data['ibrah'] as $ibrah) {
			// Misalnya, URL avatar foto ibrah disimpan dalam indeks 'avatar'
			$latepost_photo = array(
				'url' => base_url('./uploads/' . $ibrah['avatar'])
			);
			$data['latepost_photos'][] = $latepost_photo;
		}
		$this->load->view('templates/navbar');
		$this->load->view('ibrah', $data);
		$this->load->view('templates/footer');
	}
	// surat masuk admin
	public function ibrah()
	{
		$data['ibrah'] = $this->Ibrah_Model->get_ibrah();
		$this->load->view('templates/head');
		$this->load->view('templates/admin_sidebar');
		$this->load->view('templates/admin_navbar');
		$this->load->view('ibrah/ibrah', $data);
		$this->load->view('templates/admin_footer');
	}

	public function tambah_data_ibrah()
	{
		$this->load->library('upload');

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf|pptx|gif|docx';
		$config['max_size'] = 999999999; // ukuran dalam KB, sesuaikan dengan kebutuhan

		$this->upload->initialize($config);

		$data = array(
			'judul_berita' => $this->input->post('judul_berita'),
			'isi_content' => $this->input->post('isi_content'),
			'avatar' => ''
		);


		// Periksa apakah sebuah file dipilih untuk diunggah
		if (!empty($_FILES['avatar']['name'])) {
			// Lakukan unggah jika ada file yang dipilih
			if ($this->upload->do_upload('avatar')) {
				$upload_data = $this->upload->data();
				$data['avatar'] = $upload_data['file_name'];
			} else {
				// Tampilkan pesan error jika unggah gagal
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', 'Gagal mengunggah file: ' . $error);
				redirect('ibrah/ibrah');
			}
		}


		if (!empty($data['judul_berita']) && !empty($data['isi_content'])) {
			$result = $this->Ibrah_Model->tambah_data_ibrah($data);

			if ($result) {
				// Redirect ke halaman surat_masuk
				$this->session->set_flashdata('success', 'Berhasil Menambahkan Data.');
				redirect('ibrah/ibrah/');
			} else {
				// Tampilkan pesan error
				$this->session->set_flashdata('error', 'Gagal menambahkan surat. Silakan coba lagi.');
			}
		} else {
			// Tampilkan pesan error bahwa data tidak lengkap
			$this->session->set_flashdata('error', 'Semua field harus diisi.');
		}

		// Load view setelah proses selesai
		$this->load->view('templates/head');
		$this->load->view('templates/admin_sidebar');
		$this->load->view('templates/admin_navbar');
		$this->load->view('ibrah/tambah_data_ibrah');
		$this->load->view('templates/admin_footer');
	}

	public function edit_data_ibrah($id_ibrah)
	{

		date_default_timezone_set('Asia/Jakarta');

		// Memuat library upload
		$this->load->library('upload');

		// Ambil data surat masuk berdasarkan ID
		$ibrah = $this->Ibrah_Model->get_ibrah_by_id($id_ibrah);

		if (!$ibrah) {
			// Tampilkan pesan jika surat masuk tidak ditemukan
			show_error('Surat Masuk tidak ditemukan!');
		}

		// Proses pengiriman form
		if ($this->input->post()) {

			$current_datetime = date('Y-m-d H:i:s');

			// Konfigurasi library upload
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|pptx';
			$config['max_size'] = 999999999; // 2MB
			$config['encrypt_name'] = TRUE;

			// Inisialisasi library upload dengan konfigurasi
			$this->upload->initialize($config);

			// Periksa apakah sebuah file dipilih untuk diunggah
			if (!empty($_FILES['avatar']['name'])) {
				// Lakukan unggah jika ada file yang dipilih
				if ($this->upload->do_upload('avatar')) {
					// Ambil data dari form
					$data = array(
						'judul_berita' => $this->input->post('judul_berita'),
						'isi_content' => $this->input->post('isi_content'),
						'tanggal_upload' =>  $current_datetime // Perbarui tanggal dengan waktu saat ini
					);

					// Perbarui data surat masuk
					$this->Ibrah_Model->edit_data_ibrah($id_ibrah, $data);

					// Ambil informasi file yang diunggah
					$upload_data = $this->upload->data();
					$avatar = $upload_data['full_path'];

					// Perbarui path file avatar
					$this->Ibrah_Model->update_file_path_ibrah($id_ibrah, $avatar, $ibrah['avatar']);

					// Hapus gambar lama jika ada
					if (!empty($ibrah['avatar'])) {
						unlink('./uploads/' . $ibrah['avatar']);
					}

					$this->session->set_flashdata('success', 'Berhasil Mengedit Data.');
					// Redirect ke halaman yang sesuai
					redirect('ibrah/ibrah/' . $id_ibrah);
				} else {
					// Tampilkan pesan error jika unggah gagal
					$error = $this->upload->display_errors();
					echo $error;
				}
			} else {
				// Jika tidak ada file yang dipilih untuk diunggah, update hanya data teks tanpa mengubah gambar
				$data = array(
					'judul_berita' => $this->input->post('judul_berita'),
					'isi_content' => $this->input->post('isi_content'),
					'tanggal_upload' => $current_datetime // Perbarui tanggal dengan waktu saat ini
				);

				// Perbarui data surat masuk
				$this->Ibrah_Model->edit_data_ibrah($id_ibrah, $data);


				$this->session->set_flashdata('success', 'Berhasil Mengedit Data.');

				// Redirect ke halaman yang sesuai
				redirect('ibrah/ibrah/' . $id_ibrah);
			}
		} else {
			// Load view untuk form edit surat masuk
			$data['ibrah'] = $ibrah;
			$this->load->view('templates/head');
			$this->load->view('templates/admin_sidebar');
			$this->load->view('templates/admin_navbar');
			$this->load->view('ibrah/edit_data_ibrah', $data);
			$this->load->view('templates/admin_footer');
		}
	}

	public function hapus_data_ibrah($id_ibrah)
	{
		// Pastikan ID tidak kosong dan merupakan angka
		if (!empty($id_ibrah) && is_numeric($id_ibrah)) {
			// Panggil model atau lapisan lain yang berhubungan dengan manipulasi database
			$this->load->model('Ibrah_Model'); // Gantilah 'nama_model' sesuai dengan nama model Anda

			// Panggil fungsi dalam model untuk menghapus data berdasarkan ID
			$result = $this->Ibrah_Model->hapus_data_ibrah($id_ibrah);

			if ($result) {
				// Redirect atau tampilkan pesan sukses jika data berhasil dihapus
				redirect('ibrah/ibrah'); // Gantilah 'daftar_surat_masuk' dengan nama fungsi atau halaman yang sesuai
			} else {
				// Tampilkan pesan error jika data tidak dapat dihapus
				echo "Gagal menghapus data.";
			}
		} else {
			// Tampilkan pesan error jika parameter ID tidak valid
			echo "ID tidak valid.";
		}
	}
}
