<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SuratMasuk_model');
    }

    // public function surat_masuk()
    // {
    //     // Ambil semua data surat keputusan dari database
    //     $surat_masuk = $this->SuratMasuk_model->get_surat_masuk();

    //     // Kelompokkan data surat keputusan berdasarkan agenda
    //     $surat_masuk_by_agenda = array();
    //     foreach ($surat_masuk as $row) {
    //         $id_masuk = $row['agenda']; // Ubah ini dengan kolom yang sesuai dalam tabel surat keputusan
    //         $surat_masuk_by_agenda[$id_masuk][] = $row;
    //     }

    //     // Kirim data ke view
    //     $data['surat_masuk_by_agenda'] = $surat_masuk_by_agenda;
    //     $this->load->view('templates/navbar');
    //     $this->load->view('adminor/surat_masuk', $data); // Ubah nama view dengan halaman user Anda
    //     $this->load->view('templates/footer');
    // }

    // surat masuk admin
    public function surat()
    {

        $data['title'] = 'Surat Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat_masuk'] = $this->SuratMasuk_model->get_surat_masuk();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/adminor/surat_masuk', $data);
        $this->load->view('templates/footer');
    }


    // public function tambah_surat()
    // {
    //     $this->load->library('upload');

    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|pdf|pptx|gif|docx';
    //     $config['max_size'] = 999999999; // ukuran dalam KB, sesuaikan dengan kebutuhan

    //     $this->upload->initialize($config);

    //     $data = array(
    //         'agenda' => $this->input->post('agenda'),
    //         'file_path' => ''
    //     );

    //     // Memeriksa apakah ada file yang dipilih untuk diunggah
    //     if (!empty($_FILES['file_path']['name'])) {
    //         // Jika ada file yang dipilih, lakukan unggah
    //         if ($this->upload->do_upload('file_path')) {
    //             $upload_data = $this->upload->data();
    //             $data['file_path'] = $upload_data['file_name'];
    //         } else {
    //             // Tampilkan pesan error jika unggah gagal
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file: ' . $error);
    //             redirect('adminor/surat');
    //         }
    //     }

    //     // Memeriksa apakah nama_surat diisi dalam form
    //     if (!empty($this->input->post('nama_surat'))) {
    //         // Jika diisi, gunakan nilai dari form
    //         $data['nama_surat'] = $this->input->post('nama_surat');
    //     } else {
    //         // Jika tidak diisi, berikan nilai default
    //         $data['nama_surat'] = 'Belum ada nama surat';
    //     }

    //     // Pastikan data agenda tidak kosong sebelum menyisipkan ke dalam database
    //     if (!empty($data['agenda'])) {
    //         $result = $this->SuratMasuk_model->tambah_surat($data);

    //         if ($result) {
    //             // Redirect ke halaman surat_masuk
    //             $this->session->set_flashdata('success', 'Berhasil Menambahkan Data.');
    //             redirect('adminor/surat/');
    //         } else {
    //             // Tampilkan pesan error
    //             $this->session->set_flashdata('error', 'Gagal menambahkan surat. Silakan coba lagi.');
    //         }
    //     } else {
    //         // Tampilkan pesan error bahwa data tidak lengkap
    //         $this->session->set_flashdata('error', 'Semua field harus diisi.');
    //     }

    //     // Load view setelah proses selesai
    //     $this->load->view('templates/head');
    //     $this->load->view('templates/admin_sidebar');
    //     $this->load->view('templates/admin_navbar');
    //     $this->load->view('admin/tambah_surat_masuk');
    //     $this->load->view('templates/admin_footer');
    // }


    // public function tambah_surat_masuk_agenda()
    // {
    //     $this->load->library('upload');

    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|pdf|pptx|gif|docx';
    //     $config['max_size'] = 999999999; // ukuran dalam KB, sesuaikan dengan kebutuhan

    //     $this->upload->initialize($config);

    //     $data = array(
    //         'agenda' => $this->input->post('agenda'), // Menyimpan ID agenda
    //         'nama_surat' => $this->input->post('nama_surat'),
    //         'file_path' => ''
    //     );

    //     // Periksa apakah sebuah file dipilih untuk diunggah
    //     if (!empty($_FILES['file_path']['name'])) {
    //         // Lakukan unggah jika ada file yang dipilih
    //         if ($this->upload->do_upload('file_path')) {
    //             $upload_data = $this->upload->data();
    //             $data['file_path'] = $upload_data['file_name'];
    //         } else {
    //             // Tampilkan pesan error jika unggah gagal
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file: ' . $error);
    //             redirect('adminor/surat');
    //         }
    //     }

    //     // Pastikan data agenda dan nama_surat tidak kosong sebelum menyisipkan ke dalam database
    //     if (!empty($data['agenda']) && !empty($data['nama_surat'])) {
    //         $result = $this->SuratMasuk_model->tambah_surat($data);

    //         if ($result) {
    //             // Redirect ke halaman surat_masuk
    //             $this->session->set_flashdata('success', 'Berhasil Menambahkan Data.');
    //             redirect('adminor/surat');
    //         } else {
    //             // Tampilkan pesan error
    //             $this->session->set_flashdata('error', 'Gagal menambahkan surat. Silakan coba lagi.');
    //         }
    //     } else {
    //         // Tampilkan pesan error bahwa data tidak lengkap
    //         $this->session->set_flashdata('error', 'Semua field harus diisi.');
    //     }

    //     // Load view setelah proses selesai
    //     $agenda_list = $this->SuratMasuk_model->get_agenda_list_surat_masuk(); // Ambil data agenda dari model
    //     $this->load->view('templates/head');
    //     $this->load->view('templates/admin_sidebar');
    //     $this->load->view('templates/admin_navbar', ['agenda_list' => $agenda_list]); // Kirim data agenda ke view
    //     $this->load->view('admin/tambah_surat_masuk_agenda', ['agenda_list' => $agenda_list]); // Kirim data agenda ke view
    //     $this->load->view('templates/admin_footer');
    // }





    // public function edit_data_surat_masuk($id_masuk)
    // {

    //     date_default_timezone_set('Asia/Jakarta');

    //     // Memuat library upload
    //     $this->load->library('upload');

    //     // Ambil data surat masuk berdasarkan ID
    //     $surat_masuk = $this->SuratMasuk_model->get_data_by_id($id_masuk);

    //     if (!$surat_masuk) {
    //         // Tampilkan pesan jika surat masuk tidak ditemukan
    //         show_error('Surat Masuk tidak ditemukan!');
    //     }

    //     // Proses pengiriman form
    //     if ($this->input->post()) {

    //         $current_datetime = date('Y-m-d H:i:s');


    //         // Konfigurasi library upload
    //         $config['upload_path'] = './uploads/';
    //         $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|pptx';
    //         $config['max_size'] = 999999999; // 2MB
    //         $config['encrypt_name'] = TRUE;

    //         // Inisialisasi library upload dengan konfigurasi
    //         $this->upload->initialize($config);

    //         // Periksa apakah sebuah file dipilih untuk diunggah
    //         if (!empty($_FILES['gambarBerita']['name'])) {
    //             // Lakukan unggah jika ada file yang dipilih
    //             if ($this->upload->do_upload('gambarBerita')) {
    //                 // Ambil data dari form
    //                 $data = array(
    //                     'agenda' => $this->input->post('agenda'),
    //                     'nama_surat' => $this->input->post('nama_surat'),
    //                     'tanggal' =>  $current_datetime // Perbarui tanggal dengan waktu saat ini
    //                 );

    //                 // Perbarui data surat masuk
    //                 $this->SuratMasuk_model->edit_data_surat_masuk($id_masuk, $data);

    //                 // Ambil informasi file yang diunggah
    //                 $upload_data = $this->upload->data();
    //                 $file_path = $upload_data['full_path'];

    //                 // Perbarui path file avatar
    //                 $this->SuratMasuk_model->update_file_path($id_masuk, $file_path, $surat_masuk['file_path']);

    //                 // Hapus gambar lama jika ada
    //                 if (!empty($surat_masuk['file_path'])) {
    //                     unlink('./uploads/' . $surat_masuk['file_path']);
    //                 }

    //                 $this->session->set_flashdata('success', 'Berhasil Mengedit Data.');
    //                 // Redirect ke halaman yang sesuai
    //                 redirect('adminor/surat/' . $id_masuk);
    //             } else {
    //                 // Tampilkan pesan error jika unggah gagal
    //                 $error = $this->upload->display_errors();
    //                 echo $error;
    //             }
    //         } else {
    //             // Jika tidak ada file yang dipilih untuk diunggah, update hanya data teks tanpa mengubah gambar
    //             $data = array(
    //                 'agenda' => $this->input->post('agenda'),
    //                 'nama_surat' => $this->input->post('nama_surat'),
    //                 'tanggal' => $current_datetime // Perbarui tanggal dengan waktu saat ini
    //             );

    //             // Perbarui data surat masuk
    //             $this->SuratMasuk_model->edit_data_surat_masuk($id_masuk, $data);


    //             $this->session->set_flashdata('success', 'Berhasil Mengedit Data.');

    //             // Redirect ke halaman yang sesuai
    //             redirect('adminor/surat/' . $id_masuk);
    //         }
    //     } else {
    //         // Load view untuk form edit surat masuk
    //         $data['surat_masuk'] = $surat_masuk;
    //         $this->load->view('templates/head');
    //         $this->load->view('templates/admin_sidebar');
    //         $this->load->view('templates/admin_navbar');
    //         $this->load->view('admin/edit_surat_masuk', $data);
    //         $this->load->view('templates/admin_footer');
    //     }
    // }

    // // HAPUS DATA SURAT MASUK
    // public function hapus_data($id_masuk)
    // {
    //     // Pastikan ID tidak kosong dan merupakan angka
    //     if (!empty($id_masuk) && is_numeric($id_masuk)) {
    //         // Panggil model atau lapisan lain yang berhubungan dengan manipulasi database
    //         $this->load->model('SuratMasuk_model'); // Gantilah 'nama_model' sesuai dengan nama model Anda

    //         // Panggil fungsi dalam model untuk menghapus data berdasarkan ID
    //         $result = $this->SuratMasuk_model->hapus_data($id_masuk);

    //         if ($result) {
    //             // Redirect atau tampilkan pesan sukses jika data berhasil dihapus
    //             redirect('adminor/surat'); // Gantilah 'daftar_surat_masuk' dengan nama fungsi atau halaman yang sesuai
    //         } else {
    //             // Tampilkan pesan error jika data tidak dapat dihapus
    //             echo "Gagal menghapus data.";
    //         }
    //     } else {
    //         // Tampilkan pesan error jika parameter ID tidak valid
    //         echo "ID tidak valid.";
    //     }
    // }

    // // END HAPUS DATA


    // // START SURAT KELUAR 
    // public function surat_keluar()
    // {
    //     // Ambil semua data surat keputusan dari database
    //     $surat_keluar = $this->SuratMasuk_model->get_surat_keluar();

    //     // Kelompokkan data surat keputusan berdasarkan agenda
    //     $surat_keluar_by_agenda = array();
    //     foreach ($surat_keluar as $row) {
    //         $id_keluar = $row['agenda']; // Ubah ini dengan kolom yang sesuai dalam tabel surat keputusan
    //         $surat_keluar_by_agenda[$id_keluar][] = $row;
    //     }

    //     // Kirim data ke view
    //     $data['surat_keluar_by_agenda'] = $surat_keluar_by_agenda;
    //     $this->load->view('templates/navbar');
    //     $this->load->view('adminor/surat_keluar', $data); // Ubah nama view dengan halaman user Anda
    //     $this->load->view('templates/footer');

    // }

    public function surat_kel()
    {

        $data['title'] = 'Surat Keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat_keluar'] = $this->SuratMasuk_model->get_surat_keluar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/adminor/surat_keluar', $data);
        $this->load->view('templates/footer');
    }

    // public function tambah_surat_keluar()
    // {
    //     $this->load->library('upload');

    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|pdf|pptx|gif|docx';
    //     $config['max_size'] = 9999999999; // ukuran dalam KB, sesuaikan dengan kebutuhan
    //     $config['encrypt_name'] = TRUE;

    //     $this->upload->initialize($config);

    //     $upload_failed = false;
    //     $file_path_surat = '';
    //     $file_path_undangan = '';
    //     $file_path_photo = '';

    //     // Upload file surat
    //     if (isset($_FILES['file_path_surat']) && $_FILES['file_path_surat']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_surat')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file surat: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_surat = $upload_data['file_name'];
    //         }
    //     }

    //     // Upload file undangan
    //     if (isset($_FILES['file_path_undangan']) && $_FILES['file_path_undangan']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_undangan')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file undangan: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_undangan = $upload_data['file_name'];
    //         }
    //     }

    //     // Upload file photo
    //     if (isset($_FILES['file_path_photo']) && $_FILES['file_path_photo']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_photo')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file photo: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_photo = $upload_data['file_name'];
    //         }
    //     }

    //     if (!$upload_failed) {
    //         $data = array(
    //             'agenda' => $this->input->post('agenda'),
    //             'nama_surat' => $this->input->post('nama_surat'),
    //             'file_path_surat' => $file_path_surat,
    //             'file_path_undangan' => $file_path_undangan,
    //             'file_path_photo' => $file_path_photo
    //         );

    //         if (!empty($data['agenda']) && !empty($data['nama_surat'])) {
    //             $result = $this->SuratMasuk_model->tambah_surat_keluar($data);
    //             if ($result) {
    //                 $this->session->set_flashdata('success', 'Berhasil Menambahkan Data.');
    //                 redirect('adminor/surat_kel');
    //             } else {
    //                 $this->session->set_flashdata('error', 'Gagal menambahkan surat. Silakan coba lagi.');
    //             }
    //         }
    //     }

    //     // Load view setelah proses selesai
    //     $this->load->view('templates/head');
    //     $this->load->view('templates/admin_sidebar');
    //     $this->load->view('templates/admin_navbar');
    //     $this->load->view('admin/tambah_surat_keluar');
    //     $this->load->view('templates/admin_footer');
    // }


    // public function tambah_surat_keluar_agenda()
    // {
    //     $this->load->library('upload');

    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|pdf|pptx|gif|docx';
    //     $config['max_size'] = 9999999999; // ukuran dalam KB, sesuaikan dengan kebutuhan
    //     $config['encrypt_name'] = TRUE;

    //     $this->upload->initialize($config);

    //     $upload_failed = false;
    //     $file_path_surat = '';
    //     $file_path_undangan = '';
    //     $file_path_photo = '';

    //     // Upload file surat
    //     if (isset($_FILES['file_path_surat']) && $_FILES['file_path_surat']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_surat')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file surat: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_surat = $upload_data['file_name'];
    //         }
    //     }

    //     // Upload file undangan
    //     if (isset($_FILES['file_path_undangan']) && $_FILES['file_path_undangan']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_undangan')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file undangan: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_undangan = $upload_data['file_name'];
    //         }
    //     }

    //     // Upload file photo
    //     if (isset($_FILES['file_path_photo']) && $_FILES['file_path_photo']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_photo')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file photo: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_photo = $upload_data['file_name'];
    //         }
    //     }

    //     if (!$upload_failed) {
    //         $data = array(
    //             'agenda' => $this->input->post('agenda'),
    //             'nama_surat' => $this->input->post('nama_surat'),
    //             'file_path_surat' => $file_path_surat,
    //             'file_path_undangan' => $file_path_undangan,
    //             'file_path_photo' => $file_path_photo
    //         );

    //         if (!empty($data['agenda']) && !empty($data['nama_surat'])) {
    //             $result = $this->SuratMasuk_model->tambah_surat_keluar($data);
    //             if ($result) {
    //                 $this->session->set_flashdata('success', 'Berhasil Menambahkan Data.');
    //                 redirect('adminor/surat_kel');
    //             } else {
    //                 $this->session->set_flashdata('error', 'Gagal menambahkan surat. Silakan coba lagi.');
    //             }
    //         }
    //     }

    //     // Load view setelah proses selesai
    //     $agenda_list = $this->SuratMasuk_model->get_agenda_list_surat_keluar(); // Ambil data agenda dari model
    //     $this->load->view('templates/head');
    //     $this->load->view('templates/admin_sidebar');
    //     $this->load->view('templates/admin_navbar', ['agenda_list' => $agenda_list]); // Kirim data agenda ke view
    //     $this->load->view('admin/tambah_surat_keluar_agenda', ['agenda_list' => $agenda_list]); // Kirim data agenda ke view
    //     $this->load->view('templates/admin_footer');
    // }

    // // UNTUK FORMULIR EDIT DATA SURAT Keluar
    // public function edit_data_keluar($id_keluar)
    // {
    //     date_default_timezone_set('Asia/Jakarta');

    //     // Memuat library upload
    //     $this->load->library('upload');

    //     // Ambil data surat masuk berdasarkan ID
    //     $surat_keluar = $this->SuratMasuk_model->data_out_by_id($id_keluar);

    //     if (!$surat_keluar) {
    //         // Tampilkan pesan jika surat masuk tidak ditemukan
    //         show_error('Surat Masuk tidak ditemukan!');
    //     }

    //     // Proses pengiriman form
    //     if ($this->input->post()) {

    //         $current_datetime = date('Y-m-d H:i:s');

    //         // Konfigurasi library upload
    //         $config['upload_path'] = './uploads/';
    //         $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|pptx';
    //         $config['max_size'] = 99999999; // 2MB
    //         $config['encrypt_name'] = TRUE;

    //         // Inisialisasi library upload dengan konfigurasi
    //         $this->upload->initialize($config);

    //         // Periksa apakah sebuah file dipilih untuk diunggah (Surat)
    //         if (!empty($_FILES['file_path_surat']['name'])) {
    //             // Lakukan unggah jika ada file yang dipilih
    //             if ($this->upload->do_upload('file_path_surat')) {
    //                 $upload_data = $this->upload->data();
    //                 $file_path_surat = $upload_data['file_name'];
    //             } else {
    //                 // Tampilkan pesan error jika unggah gagal
    //                 $error = $this->upload->display_errors();
    //                 echo $error;
    //                 return; // Stop eksekusi jika ada kesalahan
    //             }
    //         }

    //         // Periksa apakah sebuah file dipilih untuk diunggah (Undangan)
    //         if (!empty($_FILES['file_path_undangan']['name'])) {
    //             // Lakukan unggah jika ada file yang dipilih
    //             if ($this->upload->do_upload('file_path_undangan')) {
    //                 $upload_data = $this->upload->data();
    //                 $file_path_undangan = $upload_data['file_name'];
    //             } else {
    //                 // Tampilkan pesan error jika unggah gagal
    //                 $error = $this->upload->display_errors();
    //                 echo $error;
    //                 return; // Stop eksekusi jika ada kesalahan
    //             }
    //         }

    //         // Periksa apakah sebuah file dipilih untuk diunggah (Photo)
    //         if (!empty($_FILES['file_path_photo']['name'])) {
    //             // Lakukan unggah jika ada file yang dipilih
    //             if ($this->upload->do_upload('file_path_photo')) {
    //                 $upload_data = $this->upload->data();
    //                 $file_path_photo = $upload_data['file_name'];
    //             } else {
    //                 // Tampilkan pesan error jika unggah gagal
    //                 $error = $this->upload->display_errors();
    //                 echo $error;
    //                 return; // Stop eksekusi jika ada kesalahan
    //             }
    //         }

    //         // Ambil data dari form
    //         $data = array(
    //             'agenda' => $this->input->post('agenda'),
    //             'nama_surat' => $this->input->post('nama_surat'),
    //             'tanggal' =>  $current_datetime // Perbarui tanggal dengan waktu saat ini
    //         );

    //         // Jika file surat diunggah, update path-nya
    //         if (!empty($file_path_surat)) {
    //             $data['file_path_surat'] = $file_path_surat;
    //         }

    //         // Jika file undangan diunggah, update path-nya
    //         if (!empty($file_path_undangan)) {
    //             $data['file_path_undangan'] = $file_path_undangan;
    //         }

    //         // Jika file photo diunggah, update path-nya
    //         if (!empty($file_path_photo)) {
    //             $data['file_path_photo'] = $file_path_photo;
    //         }

    //         // Perbarui data surat masuk
    //         $this->SuratMasuk_model->edit_data_surat_keluar($id_keluar, $data);


    //         $this->session->set_flashdata('success', 'Berhasil Mengedit Data.');

    //         // Redirect ke halaman yang sesuai
    //         redirect('adminor/surat_kel/' . $id_keluar);
    //     } else {
    //         // Load view untuk form edit surat masuk
    //         $data['surat_keluar'] = $surat_keluar;
    //         $this->load->view('templates/head');
    //         $this->load->view('templates/admin_sidebar');
    //         $this->load->view('templates/admin_navbar');
    //         $this->load->view('admin/edit_surat_keluar', $data);
    //         $this->load->view('templates/admin_footer');
    //     }
    // }

    // public function hapus_data_keluar($id_keluar)
    // {
    //     // Pastikan ID tidak kosong dan merupakan angka
    //     if (!empty($id_keluar) && is_numeric($id_keluar)) {
    //         // Panggil model atau lapisan lain yang berhubungan dengan manipulasi database
    //         $this->load->model('SuratMasuk_model'); // Gantilah 'nama_model' sesuai dengan nama model Anda

    //         // Panggil fungsi dalam model untuk menghapus data berdasarkan ID
    //         $result = $this->SuratMasuk_model->hapus_data_keluar($id_keluar);

    //         if ($result) {
    //             // Redirect atau tampilkan pesan sukses jika data berhasil dihapus
    //             redirect('adminor/surat_kel'); // Gantilah 'daftar_surat_masuk' dengan nama fungsi atau halaman yang sesuai
    //         } else {
    //             // Tampilkan pesan error jika data tidak dapat dihapus
    //             echo "Gagal menghapus data.";
    //         }
    //     } else {
    //         // Tampilkan pesan error jika parameter ID tidak valid
    //         echo "ID tidak valid.";
    //     }
    // }
    // // END SURAT KELUAR


    // // START SURAT KEPUTUSAN
    // public function surat_keputusan()
    // {
    //     // Ambil semua data surat keputusan dari database
    //     $surat_keputusan = $this->SuratMasuk_model->get_surat_keputusan();

    //     // Kelompokkan data surat keputusan berdasarkan agenda
    //     $surat_keputusan_by_agenda = array();
    //     foreach ($surat_keputusan as $row) {
    //         $id_keputusan = $row['agenda']; // Ubah ini dengan kolom yang sesuai dalam tabel surat keputusan
    //         $surat_keputusan_by_agenda[$id_keputusan][] = $row;
    //     }

    //     // Kirim data ke view
    //     $data['surat_keputusan_by_agenda'] = $surat_keputusan_by_agenda;
    //     $this->load->view('templates/navbar');
    //     $this->load->view('adminor/surat_keputusan', $data); // Ubah nama view dengan halaman user Anda
    //     $this->load->view('templates/footer');
    // }

    //SURAT KEP UNTUK ADMIN
    public function surat_kep()
    {
        $data['title'] = 'Surat Keputusan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat_keputusan'] = $this->SuratMasuk_model->get_surat_keputusan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/adminor/surat_keputusan', $data);
        $this->load->view('templates/footer');
    }

    // public function tambah_surat_keputusan()
    // {
    //     $this->load->library('upload');

    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|pdf|pptx|gif|docx';
    //     $config['max_size'] = 999999999; // ukuran dalam KB, sesuaikan dengan kebutuhan

    //     $this->upload->initialize($config);

    //     $data = array(
    //         'agenda' => $this->input->post('agenda'),
    //         'nama_surat' => $this->input->post('nama_surat'),
    //         'file_path' => ''
    //     );


    //     // Periksa apakah sebuah file dipilih untuk diunggah
    //     if (!empty($_FILES['file_path']['name'])) {
    //         // Lakukan unggah jika ada file yang dipilih
    //         if ($this->upload->do_upload('file_path')) {
    //             $upload_data = $this->upload->data();
    //             $data['file_path'] = $upload_data['file_name'];
    //         } else {
    //             // Tampilkan pesan error jika unggah gagal
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file: ' . $error);
    //             redirect('adminor/surat_kep/');
    //         }
    //     }

    //     // Pastikan data nama_surat_wakaf dan nama_masjid tidak kosong sebelum menyisipkan ke dalam database
    //     if (!empty($data['agenda']) && !empty($data['nama_surat'])) {
    //         $result = $this->SuratMasuk_model->tambah_surat_keputusan($data);

    //         if ($result) {
    //             // Redirect ke halaman surat_masuk
    //             $this->session->set_flashdata('success', 'Berhasil Menambahkan Data.');
    //             redirect('adminor/surat_kep/');
    //         } else {
    //             // Tampilkan pesan error
    //             $this->session->set_flashdata('error', 'Gagal menambahkan surat. Silakan coba lagi.');
    //         }
    //     } else {
    //         // Tampilkan pesan error bahwa data tidak lengkap
    //         $this->session->set_flashdata('error', 'Semua field harus diisi.');
    //     }

    //     // Load view setelah proses selesai
    //     $this->load->view('templates/head');
    //     $this->load->view('templates/admin_sidebar');
    //     $this->load->view('templates/admin_navbar');
    //     $this->load->view('admin/tambah_surat_keputusan');
    //     $this->load->view('templates/admin_footer');
    // }






    // public function tambah_surat_keputusan_agenda()
    // {
    //     $this->load->library('upload');

    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|pdf|pptx|gif|docx';
    //     $config['max_size'] = 999999999; // ukuran dalam KB, sesuaikan dengan kebutuhan

    //     $this->upload->initialize($config);

    //     $data = array(
    //         'agenda' => $this->input->post('agenda'), // Menyimpan ID agenda
    //         'nama_surat' => $this->input->post('nama_surat'),
    //         'file_path' => ''
    //     );

    //     // Periksa apakah sebuah file dipilih untuk diunggah
    //     if (!empty($_FILES['file_path']['name'])) {
    //         // Lakukan unggah jika ada file yang dipilih
    //         if ($this->upload->do_upload('file_path')) {
    //             $upload_data = $this->upload->data();
    //             $data['file_path'] = $upload_data['file_name'];
    //         } else {
    //             // Tampilkan pesan error jika unggah gagal
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file: ' . $error);
    //             redirect('adminor/surat_kep/');
    //         }
    //     }

    //     // Pastikan data agenda dan nama_surat tidak kosong sebelum menyisipkan ke dalam database
    //     if (!empty($data['agenda']) && !empty($data['nama_surat'])) {
    //         $result = $this->SuratMasuk_model->tambah_surat_keputusan($data);

    //         if ($result) {
    //             // Redirect ke halaman surat_masuk
    //             $this->session->set_flashdata('success', 'Berhasil Menambahkan Data.');
    //             redirect('adminor/surat_kep/');
    //         } else {
    //             // Tampilkan pesan error
    //             $this->session->set_flashdata('error', 'Gagal menambahkan surat. Silakan coba lagi.');
    //         }
    //     } else {
    //         // Tampilkan pesan error bahwa data tidak lengkap
    //         $this->session->set_flashdata('error', 'Semua field harus diisi.');
    //     }

    //     // Load view setelah proses selesai
    //     $agenda_list = $this->SuratMasuk_model->get_agenda_list(); // Ambil data agenda dari model
    //     $this->load->view('templates/head');
    //     $this->load->view('templates/admin_sidebar');
    //     $this->load->view('templates/admin_navbar', ['agenda_list' => $agenda_list]); // Kirim data agenda ke view
    //     $this->load->view('admin/tambah_surat_keputusan_agenda', ['agenda_list' => $agenda_list]); // Kirim data agenda ke view
    //     $this->load->view('templates/admin_footer');
    // }








    // public function edit_data_keputusan($id_keputusan)
    // {

    //     date_default_timezone_set('Asia/Jakarta');

    //     // Memuat library upload
    //     $this->load->library('upload');

    //     // Ambil data surat masuk berdasarkan ID
    //     $surat_keputusan = $this->SuratMasuk_model->data_by_id($id_keputusan);

    //     if (!$surat_keputusan) {
    //         // Tampilkan pesan jika surat masuk tidak ditemukan
    //         show_error('Surat Masuk tidak ditemukan!');
    //     }

    //     // Proses pengiriman form
    //     if ($this->input->post()) {

    //         $current_datetime = date('Y-m-d H:i:s');


    //         // Konfigurasi library upload
    //         $config['upload_path'] = './uploads/';
    //         $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|pptx';
    //         $config['max_size'] = 999999999; // 2MB
    //         $config['encrypt_name'] = TRUE;

    //         // Inisialisasi library upload dengan konfigurasi
    //         $this->upload->initialize($config);

    //         // Periksa apakah sebuah file dipilih untuk diunggah
    //         if (!empty($_FILES['gambarBerita']['name'])) {
    //             // Lakukan unggah jika ada file yang dipilih
    //             if ($this->upload->do_upload('gambarBerita')) {
    //                 // Ambil data dari form
    //                 $data = array(
    //                     'agenda' => $this->input->post('agenda'),
    //                     'nama_surat' => $this->input->post('nama_surat'),
    //                     'tanggal' =>  $current_datetime // Perbarui tanggal dengan waktu saat ini
    //                 );

    //                 // Perbarui data surat masuk
    //                 $this->SuratMasuk_model->edit_data_keputusan($id_keputusan, $data);

    //                 // Ambil informasi file yang diunggah
    //                 $upload_data = $this->upload->data();
    //                 $file_path = $upload_data['full_path'];

    //                 // Perbarui path file avatar
    //                 $this->SuratMasuk_model->update_file_path_keputusan($id_keputusan, $file_path, $surat_keputusan['file_path']);

    //                 // Hapus gambar lama jika ada
    //                 if (!empty($surat_keputusan['file_path'])) {
    //                     unlink('./uploads/' . $surat_keputusan['file_path']);
    //                 }

    //                 $this->session->set_flashdata('success', 'Berhasil Mengedit Data.');
    //                 // Redirect ke halaman yang sesuai
    //                 redirect('adminor/surat_kep/' . $id_keputusan);
    //             } else {
    //                 // Tampilkan pesan error jika unggah gagal
    //                 $error = $this->upload->display_errors();
    //                 echo $error;
    //             }
    //         } else {
    //             // Jika tidak ada file yang dipilih untuk diunggah, update hanya data teks tanpa mengubah gambar
    //             $data = array(
    //                 'agenda' => $this->input->post('agenda'),
    //                 'nama_surat' => $this->input->post('nama_surat'),
    //                 'tanggal' => $current_datetime // Perbarui tanggal dengan waktu saat ini
    //             );

    //             // Perbarui data surat masuk
    //             $this->SuratMasuk_model->edit_data_keputusan($id_keputusan, $data);


    //             $this->session->set_flashdata('success', 'Berhasil Mengedit Data.');

    //             // Redirect ke halaman yang sesuai
    //             redirect('adminor/surat_kep/' . $id_keputusan);
    //         }
    //     } else {
    //         // Load view untuk form edit surat masuk
    //         $data['surat_keputusan'] = $surat_keputusan;
    //         $this->load->view('templates/head');
    //         $this->load->view('templates/admin_sidebar');
    //         $this->load->view('templates/admin_navbar');
    //         $this->load->view('admin/edit_surat_keputusan', $data);
    //         $this->load->view('templates/admin_footer');
    //     }
    // }

    // // HAPUS DATA SURAT MASUK
    // public function hapus_data_keputusan($id_keputusan)
    // {
    //     // Pastikan ID tidak kosong dan merupakan angka
    //     if (!empty($id_keputusan) && is_numeric($id_keputusan)) {
    //         // Panggil model atau lapisan lain yang berhubungan dengan manipulasi database
    //         $this->load->model('SuratMasuk_model'); // Gantilah 'nama_model' sesuai dengan nama model Anda

    //         // Panggil fungsi dalam model untuk menghapus data berdasarkan ID
    //         $result = $this->SuratMasuk_model->hapus_data_keputusan($id_keputusan);

    //         if ($result) {
    //             // Redirect atau tampilkan pesan sukses jika data berhasil dihapus
    //             redirect('adminor/surat_kep'); // Gantilah 'daftar_surat_masuk' dengan nama fungsi atau halaman yang sesuai
    //         } else {
    //             // Tampilkan pesan error jika data tidak dapat dihapus
    //             echo "Gagal menghapus data.";
    //         }
    //     } else {
    //         // Tampilkan pesan error jika parameter ID tidak valid
    //         echo "ID tidak valid.";
    //     }
    // }
    // // END SURAT KEPUTUSAN

    // // START NOTULENSI
    // public function notulen()
    // {


    //     // Ambil semua data surat keputusan dari database
    //     $notulensi = $this->SuratMasuk_model->get_surat_notulensi();

    //     // Kelompokkan data surat keputusan berdasarkan agenda
    //     $surat_notulensi_by_agenda = array();
    //     foreach ($notulensi as $row) {
    //         $id_notulensi = $row['agenda']; // Ubah ini dengan kolom yang sesuai dalam tabel surat keputusan
    //         $surat_notulensi_by_agenda[$id_notulensi][] = $row;
    //     }

    //     // Kirim data ke view
    //     $data['surat_notulensi_by_agenda'] = $surat_notulensi_by_agenda;
    //     $this->load->view('templates/navbar');
    //     $this->load->view('adminor/notulensi', $data); // Ubah nama view dengan halaman user Anda
    //     $this->load->view('templates/footer');
    // }

    //UNTUK ADMIN
    public function notulensi()
    {

        $data['title'] = 'Notulensi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['notulensi'] = $this->SuratMasuk_model->get_surat_notulensi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/adminor/notulensi', $data);
        $this->load->view('templates/footer');
    }

    // public function tambah_surat_notulensi()
    // {
    //     $this->load->library('upload');

    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|pdf|pptx|gif|docx';
    //     $config['max_size'] = 9999999999; // ukuran dalam KB, sesuaikan dengan kebutuhan
    //     $config['encrypt_name'] = TRUE;

    //     $this->upload->initialize($config);

    //     $upload_failed = false;
    //     $file_path_undangan = '';
    //     $file_path_notulensi = '';

    //     // Upload file undangan
    //     if (isset($_FILES['file_path_undangan']) && $_FILES['file_path_undangan']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_undangan')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file undangan: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_undangan = $upload_data['file_name'];
    //         }
    //     }

    //     // Upload file photo
    //     if (isset($_FILES['file_path_notulensi']) && $_FILES['file_path_notulensi']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_notulensi')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file photo: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_notulensi = $upload_data['file_name'];
    //         }
    //     }

    //     if (!$upload_failed) {
    //         $data = array(
    //             'agenda' => $this->input->post('agenda'),
    //             'nama_surat' => $this->input->post('nama_surat'),
    //             'file_path_undangan' => $file_path_undangan,
    //             'file_path_notulensi' => $file_path_notulensi
    //         );

    //         if (!empty($data['agenda']) && !empty($data['nama_surat'])) {
    //             $result = $this->SuratMasuk_model->tambah_surat_notulensi($data);
    //             if ($result) {
    //                 $this->session->set_flashdata('success', 'Berhasil Menambahkan Data.');
    //                 redirect('adminor/notulensi');
    //             } else {
    //                 $this->session->set_flashdata('error', 'Gagal menambahkan surat. Silakan coba lagi.');
    //             }
    //         }
    //     }

    //     // Load view setelah proses selesai
    //     $this->load->view('templates/head');
    //     $this->load->view('templates/admin_sidebar');
    //     $this->load->view('templates/admin_navbar');
    //     $this->load->view('admin/tambah_surat_notulensi');
    //     $this->load->view('templates/admin_footer');
    // }


    // public function tambah_surat_notulensi_agenda()
    // {
    //     $this->load->library('upload');

    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|pdf|pptx|gif|docx';
    //     $config['max_size'] = 9999999999; // ukuran dalam KB, sesuaikan dengan kebutuhan
    //     $config['encrypt_name'] = TRUE;

    //     $this->upload->initialize($config);

    //     $upload_failed = false;
    //     $file_path_undangan = '';
    //     $file_path_notulensi = '';

    //     // Upload file undangan
    //     if (isset($_FILES['file_path_undangan']) && $_FILES['file_path_undangan']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_undangan')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file undangan: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_undangan = $upload_data['file_name'];
    //         }
    //     }

    //     // Upload file photo
    //     if (isset($_FILES['file_path_notulensi']) && $_FILES['file_path_notulensi']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_notulensi')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file photo: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_notulensi = $upload_data['file_name'];
    //         }
    //     }

    //     if (!$upload_failed) {
    //         $data = array(
    //             'agenda' => $this->input->post('agenda'),
    //             'nama_surat' => $this->input->post('nama_surat'),
    //             'file_path_undangan' => $file_path_undangan,
    //             'file_path_notulensi' => $file_path_notulensi
    //         );

    //         if (!empty($data['agenda']) && !empty($data['nama_surat'])) {
    //             $result = $this->SuratMasuk_model->tambah_surat_notulensi($data);
    //             if ($result) {
    //                 $this->session->set_flashdata('success', 'Berhasil Menambahkan Data.');
    //                 redirect('adminor/notulensi');
    //             } else {
    //                 $this->session->set_flashdata('error', 'Gagal menambahkan surat. Silakan coba lagi.');
    //             }
    //         }
    //     }

    //     // Load view setelah proses selesai
    //     $agenda_list = $this->SuratMasuk_model->get_agenda_list_surat_notulensi(); // Ambil data agenda dari model
    //     $this->load->view('templates/head');
    //     $this->load->view('templates/admin_sidebar');
    //     $this->load->view('templates/admin_navbar', ['agenda_list' => $agenda_list]); // Kirim data agenda ke view
    //     $this->load->view('admin/tambah_surat_notulensi_agenda', ['agenda_list' => $agenda_list]); // Kirim data agenda ke view
    //     $this->load->view('templates/admin_footer');
    // }






    // public function edit_data_notulensi($id_notulensi)
    // {
    //     date_default_timezone_set('Asia/Jakarta');

    //     // Memuat library upload
    //     $this->load->library('upload');

    //     // Ambil data notulensi berdasarkan ID
    //     $notulensi = $this->SuratMasuk_model->data_notulensi_by_id($id_notulensi);

    //     if (!$notulensi) {
    //         // Tampilkan pesan jika surat masuk tidak ditemukan
    //         show_error('Surat Masuk tidak ditemukan!');
    //     }

    //     // Proses pengiriman form
    //     if ($this->input->post()) {

    //         $current_datetime = date('Y-m-d H:i:s');

    //         // Konfigurasi library upload
    //         $config['upload_path'] = './uploads/';
    //         $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|pptx';
    //         $config['max_size'] = 99999999; // 2MB
    //         $config['encrypt_name'] = TRUE;

    //         // Inisialisasi library upload dengan konfigurasi
    //         $this->upload->initialize($config);

    //         // Periksa apakah sebuah file dipilih untuk diunggah (Undangan)
    //         if (!empty($_FILES['file_path_undangan']['name'])) {
    //             // Lakukan unggah jika ada file yang dipilih
    //             if ($this->upload->do_upload('file_path_undangan')) {
    //                 $upload_data = $this->upload->data();
    //                 $file_path_undangan = $upload_data['file_name'];
    //             } else {
    //                 // Tampilkan pesan error jika unggah gagal
    //                 $error = $this->upload->display_errors();
    //                 echo $error;
    //                 return; // Stop eksekusi jika ada kesalahan
    //             }
    //         }

    //         // Periksa apakah sebuah file dipilih untuk diunggah (Photo)
    //         if (!empty($_FILES['file_path_notulensi']['name'])) {
    //             // Lakukan unggah jika ada file yang dipilih
    //             if ($this->upload->do_upload('file_path_notulensi')) {
    //                 $upload_data = $this->upload->data();
    //                 $file_path_notulensi = $upload_data['file_name'];
    //             } else {
    //                 // Tampilkan pesan error jika unggah gagal
    //                 $error = $this->upload->display_errors();
    //                 echo $error;
    //                 return; // Stop eksekusi jika ada kesalahan
    //             }
    //         }

    //         // Ambil data dari form
    //         $data = array(
    //             'agenda' => $this->input->post('agenda'),
    //             'nama_surat' => $this->input->post('nama_surat'),
    //             'tanggal' =>  $current_datetime // Perbarui tanggal dengan waktu saat ini
    //         );

    //         // Jika file undangan diunggah, update path-nya
    //         if (!empty($file_path_undangan)) {
    //             $data['file_path_undangan'] = $file_path_undangan;
    //         }

    //         // Jika file photo diunggah, update path-nya
    //         if (!empty($file_path_notulensi)) {
    //             $data['file_path_notulensi'] = $file_path_notulensi;
    //         }

    //         // Perbarui data surat masuk
    //         $this->SuratMasuk_model->edit_data_surat_notulensi($id_notulensi, $data);


    //         $this->session->set_flashdata('success', 'Berhasil Mengedit Data.');

    //         // Redirect ke halaman yang sesuai
    //         redirect('adminor/notulensi/' . $id_notulensi);
    //     } else {
    //         // Load view untuk form edit surat masuk
    //         $data['notulensi'] = $notulensi;
    //         $this->load->view('templates/head');
    //         $this->load->view('templates/admin_sidebar');
    //         $this->load->view('templates/admin_navbar');
    //         $this->load->view('admin/edit_surat_notulensi', $data);
    //         $this->load->view('templates/admin_footer');
    //     }
    // }


    // public function hapus_data_notulensi($id_notulensi)
    // {
    //     // Pastikan ID tidak kosong dan merupakan angka
    //     if (!empty($id_notulensi) && is_numeric($id_notulensi)) {
    //         // Panggil model atau lapisan lain yang berhubungan dengan manipulasi database
    //         $this->load->model('SuratMasuk_model'); // Gantilah 'nama_model' sesuai dengan nama model Anda

    //         // Panggil fungsi dalam model untuk menghapus data berdasarkan ID
    //         $result = $this->SuratMasuk_model->hapus_data_notulensi($id_notulensi);

    //         if ($result) {
    //             // Redirect atau tampilkan pesan sukses jika data berhasil dihapus
    //             redirect('adminor/notulensi'); // Gantilah 'daftar_surat_masuk' dengan nama fungsi atau halaman yang sesuai
    //         } else {
    //             // Tampilkan pesan error jika data tidak dapat dihapus
    //             echo "Gagal menghapus data.";
    //         }
    //     } else {
    //         // Tampilkan pesan error jika parameter ID tidak valid
    //         echo "ID tidak valid.";
    //     }
    // }
    // // END NOTULENSI



    // START DAFTAR DAN SERTIFIKAT WAKAF
    public function daftar_sertifikat_wakaf()
    {
        // Load data surat_masuk from the backend
        $data['sertifikat_wakaf'] = $this->SuratMasuk_model->get_surat_wakaf(); // Gantilah dengan fungsi sesuai kebutuhan
        $this->load->view('templates/navbar');
        $this->load->view('adminor/daftar_sertifikat_wakaf', $data);
        $this->load->view('templates/footer');
    }

    //UNTUK ADMIN
    public function wakaf()
    {

        $data['title'] = 'Wakaf Sertifikat Wakaf';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['sertifikat_wakaf'] = $this->SuratMasuk_model->get_surat_wakaf();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/adminor/daftar_sertifikat_wakaf', $data);
        $this->load->view('templates/footer');
    }


    // public function tambah_surat_wakaf()
    // {
    //     $this->load->library('upload');

    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|pdf|pptx|gif|docx';
    //     $config['max_size'] = 999999999; // ukuran dalam KB, sesuaikan dengan kebutuhan

    //     $this->upload->initialize($config);

    //     $data = array(
    //         'nama_surat_wakaf' => $this->input->post('nama_surat_wakaf'),
    //         'nama_masjid' => $this->input->post('nama_masjid'),
    //         'file_path_sertifikat_wakaf' => ''
    //     );

    //     // Periksa apakah sebuah file dipilih untuk diunggah
    //     if (!empty($_FILES['file_path_sertifikat_wakaf']['name'])) {
    //         // Lakukan unggah jika ada file yang dipilih
    //         if ($this->upload->do_upload('file_path_sertifikat_wakaf')) {
    //             $upload_data = $this->upload->data();
    //             $data['file_path_sertifikat_wakaf'] = $upload_data['file_name'];
    //         } else {
    //             // Tampilkan pesan error jika unggah gagal
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file: ' . $error);
    //             redirect('adminor/wakaf');
    //         }
    //     }

    //     // Pastikan data nama_surat_wakaf dan nama_masjid tidak kosong sebelum menyisipkan ke dalam database
    //     if (!empty($data['nama_surat_wakaf']) && !empty($data['nama_masjid'])) {
    //         $result = $this->SuratMasuk_model->tambah_surat_wakaf($data);

    //         if ($result) {
    //             // Redirect ke halaman surat_masuk
    //             $this->session->set_flashdata('success', 'Berhasil Menambahkan Data.');
    //             redirect('adminor/wakaf/');
    //         } else {
    //             // Tampilkan pesan error
    //             $this->session->set_flashdata('error', 'Gagal menambahkan surat. Silakan coba lagi.');
    //         }
    //     } else {
    //         // Tampilkan pesan error bahwa data tidak lengkap
    //         $this->session->set_flashdata('error', 'Semua field harus diisi.');
    //     }

    //     // Load view setelah proses selesai
    //     $this->load->view('templates/head');
    //     $this->load->view('templates/admin_sidebar');
    //     $this->load->view('templates/admin_navbar');
    //     $this->load->view('admin/tambah_surat_wakaf');
    //     $this->load->view('templates/admin_footer');
    // }







    // public function edit_data_wakaf($id_wakaf)
    // {

    //     date_default_timezone_set('Asia/Jakarta');

    //     // Memuat library upload
    //     $this->load->library('upload');

    //     // Ambil data surat masuk berdasarkan ID
    //     $sertifikat_wakaf = $this->SuratMasuk_model->data_wakaf_by_id($id_wakaf);

    //     if (!$sertifikat_wakaf) {
    //         // Tampilkan pesan jika surat masuk tidak ditemukan
    //         show_error('Surat Masuk tidak ditemukan!');
    //     }

    //     // Proses pengiriman form
    //     if ($this->input->post()) {

    //         $current_datetime = date('Y-m-d H:i:s');


    //         // Konfigurasi library upload
    //         $config['upload_path'] = './uploads/';
    //         $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|pptx';
    //         $config['max_size'] = 999999999; // 2MB
    //         $config['encrypt_name'] = TRUE;

    //         // Inisialisasi library upload dengan konfigurasi
    //         $this->upload->initialize($config);

    //         // Periksa apakah sebuah file dipilih untuk diunggah
    //         if (!empty($_FILES['gambarBerita']['name'])) {
    //             // Lakukan unggah jika ada file yang dipilih
    //             if ($this->upload->do_upload('gambarBerita')) {
    //                 // Ambil data dari form
    //                 $data = array(
    //                     'nama_surat_wakaf' => $this->input->post('nama_surat_wakaf'),
    //                     'nama_masjid' => $this->input->post('nama_masjid'),
    //                     'tanggal' =>  $current_datetime // Perbarui tanggal dengan waktu saat ini
    //                 );

    //                 // Perbarui data surat masuk
    //                 $this->SuratMasuk_model->edit_data_wakaf($id_wakaf, $data);

    //                 // Ambil informasi file yang diunggah
    //                 $upload_data = $this->upload->data();
    //                 $file_path_sertifikat_wakaf = $upload_data['full_path'];

    //                 // Perbarui path file avatar
    //                 $this->SuratMasuk_model->update_file_path_wakaf($id_wakaf, $file_path_sertifikat_wakaf, $sertifikat_wakaf['file_path_sertifikat_wakaf']);

    //                 // Hapus gambar lama jika ada
    //                 if (!empty($sertifikat_wakaf['file_path_sertifikat_wakaf'])) {
    //                     unlink('./uploads/' . $sertifikat_wakaf['file_path_sertifikat_wakaf']);
    //                 }

    //                 $this->session->set_flashdata('success', 'Berhasil Mengedit Data.');
    //                 // Redirect ke halaman yang sesuai
    //                 redirect('adminor/wakaf/' . $id_wakaf);
    //             } else {
    //                 // Tampilkan pesan error jika unggah gagal
    //                 $error = $this->upload->display_errors();
    //                 echo $error;
    //             }
    //         } else {
    //             // Jika tidak ada file yang dipilih untuk diunggah, update hanya data teks tanpa mengubah gambar
    //             $data = array(
    //                 'nama_surat_wakaf' => $this->input->post('nama_surat_wakaf'),
    //                 'nama_masjid' => $this->input->post('nama_masjid'),
    //                 'tanggal' => $current_datetime // Perbarui tanggal dengan waktu saat ini
    //             );

    //             // Perbarui data surat masuk
    //             $this->SuratMasuk_model->edit_data_wakaf($id_wakaf, $data);


    //             $this->session->set_flashdata('success', 'Berhasil Mengedit Data.');

    //             // Redirect ke halaman yang sesuai
    //             redirect('adminor/wakaf/' . $id_wakaf);
    //         }
    //     } else {
    //         // Load view untuk form edit surat masuk
    //         $data['sertifikat_wakaf'] = $sertifikat_wakaf;
    //         $this->load->view('templates/head');
    //         $this->load->view('templates/admin_sidebar');
    //         $this->load->view('templates/admin_navbar');
    //         $this->load->view('admin/edit_surat_wakaf', $data);
    //         $this->load->view('templates/admin_footer');
    //     }
    // }
    // // END UPDATE DATA


    // // HAPUS DATA SURAT MASUK
    // public function hapus_data_wakaf($id_wakaf)
    // {
    //     // Pastikan ID tidak kosong dan merupakan angka
    //     if (!empty($id_wakaf) && is_numeric($id_wakaf)) {
    //         // Panggil model atau lapisan lain yang berhubungan dengan manipulasi database
    //         $this->load->model('SuratMasuk_model'); // Gantilah 'nama_model' sesuai dengan nama model Anda

    //         // Panggil fungsi dalam model untuk menghapus data berdasarkan ID
    //         $result = $this->SuratMasuk_model->hapus_data_wakaf($id_wakaf);

    //         if ($result) {
    //             // Redirect atau tampilkan pesan sukses jika data berhasil dihapus
    //             redirect('adminor/wakaf'); // Gantilah 'daftar_surat_masuk' dengan nama fungsi atau halaman yang sesuai
    //         } else {
    //             // Tampilkan pesan error jika data tidak dapat dihapus
    //             echo "Gagal menghapus data.";
    //         }
    //     } else {
    //         // Tampilkan pesan error jika parameter ID tidak valid
    //         echo "ID tidak valid.";
    //     }
    // }
    // // END DAFTAR $ SERTIFIKAT WAKAF




    // // START SURAT AKTIF ORGANISASI
    // public function surat_aktif_org()
    // {
    //     $this->load->library('upload');

    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|pdf|pptx|gif|docx';
    //     $config['max_size'] = 9999999999; // ukuran dalam KB, sesuaikan dengan kebutuhan
    //     $config['encrypt_name'] = TRUE;

    //     $this->upload->initialize($config);

    //     $upload_failed = false;
    //     $file_path_kartu_tanda_anggota = '';
    //     $file_path_bukti_keaktifan = '';

    //     // Upload file undangan
    //     if (isset($_FILES['file_path_kartu_tanda_anggota']) && $_FILES['file_path_kartu_tanda_anggota']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_kartu_tanda_anggota')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file undangan: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_kartu_tanda_anggota = $upload_data['file_name'];
    //         }
    //     }

    //     // Upload file photo
    //     if (isset($_FILES['file_path_bukti_keaktifan']) && $_FILES['file_path_bukti_keaktifan']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_bukti_keaktifan')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file photo: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_bukti_keaktifan = $upload_data['file_name'];
    //         }
    //     }

    //     if (!$upload_failed) {
    //         $data = array(
    //             'email' => $this->input->post('email'),
    //             'nama_lengkap' => $this->input->post('nama_lengkap'),
    //             'tanggal_lahir' => $this->input->post('tanggal_lahir'),
    //             'alamat_tinggal' => $this->input->post('alamat_tinggal'),
    //             'no_hp' => $this->input->post('no_hp'),
    //             'instansi_kerja' => $this->input->post('instansi_kerja'),
    //             'alamat_instansi_kerja' => $this->input->post('alamat_instansi_kerja'),
    //             'telepon_kantor_kerja' => $this->input->post('telepon_kantor_kerja'),
    //             'file_path_kartu_tanda_anggota' => $file_path_kartu_tanda_anggota,
    //             'file_path_bukti_keaktifan' => $file_path_bukti_keaktifan,
    //             'tempat_lahir' => $this->input->post('tempat_lahir'),
    //         );

    //         if (!empty($data['email']) && !empty($data['nama_lengkap']) && !empty($data['tanggal_lahir']) && !empty($data['alamat_tinggal']) && !empty($data['no_hp']) && !empty($data['instansi_kerja']) && !empty($data['alamat_instansi_kerja']) && !empty($data['telepon_kantor_kerja']) && !empty($data['tempat_lahir'])) {
    //             $result = $this->SuratMasuk_model->tambah_surat_aktif_organisasi($data);
    //             if ($result) {
    //                 echo '<div class="alert alert-success" role="alert">Berhasil Menambahkan Data.</div>';
    //                 redirect('adminor/surat_aktif_org');
    //             } else {
    //                 echo '<div class="alert alert-danger" role="alert">Gagal menambahkan surat. Silakan coba lagi.</div>';
    //             }
    //         }
    //     }
    //     // Load data surat_masuk from the backend
    //     // $data['surat_keputusan'] = $this->SuratMasuk_model->get_surat_keputusan(); // Gantilah dengan fungsi sesuai kebutuhan
    //     $this->load->view('templates/navbar');
    //     $this->load->view('adminor/surat_aktif_org');
    //     $this->load->view('templates/footer');
    // }

    //UNTUK BAGIAN ADMIN
    public function surat_aktif_organisasi()
    {

        $data['title'] = 'Surat Aktif Organisasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat_aktif_organisasi'] = $this->SuratMasuk_model->get_surat_aktif_organisasi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/adminor/surat_aktif_org', $data);
        $this->load->view('templates/footer');
        // Load data surat_masuk from the backend

    }

    // public function tambah_surat_aktif_organisasi()
    // {
    //     $this->load->library('upload');

    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|pdf|pptx|gif|docx';
    //     $config['max_size'] = 9999999999; // ukuran dalam KB, sesuaikan dengan kebutuhan
    //     $config['encrypt_name'] = TRUE;

    //     $this->upload->initialize($config);

    //     $upload_failed = false;
    //     $file_path_kartu_tanda_anggota = '';
    //     $file_path_bukti_keaktifan = '';

    //     // Upload file undangan
    //     if (isset($_FILES['file_path_kartu_tanda_anggota']) && $_FILES['file_path_kartu_tanda_anggota']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_kartu_tanda_anggota')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file undangan: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_kartu_tanda_anggota = $upload_data['file_name'];
    //         }
    //     }

    //     // Upload file photo
    //     if (isset($_FILES['file_path_bukti_keaktifan']) && $_FILES['file_path_bukti_keaktifan']['size'] > 0) {
    //         if (!$this->upload->do_upload('file_path_bukti_keaktifan')) {
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('error', 'Gagal mengunggah file photo: ' . $error);
    //             $upload_failed = true;
    //         } else {
    //             $upload_data = $this->upload->data();
    //             $file_path_bukti_keaktifan = $upload_data['file_name'];
    //         }
    //     }

    //     if (!$upload_failed) {
    //         $data = array(
    //             'email' => $this->input->post('email'),
    //             'nama_lengkap' => $this->input->post('nama_lengkap'),
    //             'tanggal_lahir' => $this->input->post('tanggal_lahir'),
    //             'alamat_tinggal' => $this->input->post('alamat_tinggal'),
    //             'no_hp' => $this->input->post('no_hp'),
    //             'instansi_kerja' => $this->input->post('instansi_kerja'),
    //             'alamat_instansi_kerja' => $this->input->post('alamat_instansi_kerja'),
    //             'telepon_kantor_kerja' => $this->input->post('telepon_kantor_kerja'),
    //             'file_path_kartu_tanda_anggota' => $file_path_kartu_tanda_anggota,
    //             'file_path_bukti_keaktifan' => $file_path_bukti_keaktifan,
    //             'tempat_lahir' => $this->input->post('tempat_lahir'),
    //         );

    //         if (!empty($data['email']) && !empty($data['nama_lengkap']) && !empty($data['tanggal_lahir']) && !empty($data['alamat_tinggal']) && !empty($data['no_hp']) && !empty($data['instansi_kerja']) && !empty($data['alamat_instansi_kerja']) && !empty($data['telepon_kantor_kerja']) && !empty($data['tempat_lahir'])) {
    //             $result = $this->SuratMasuk_model->tambah_surat_aktif_organisasi($data);
    //             if ($result) {
    //                 $this->session->set_flashdata('success', 'Berhasil Menambahkan Data.');
    //                 redirect('adminor/surat_aktif_organisasi');
    //             } else {
    //                 $this->session->set_flashdata('error', 'Gagal menambahkan surat. Silakan coba lagi.');
    //             }
    //         }
    //     }

    //     // Load view setelah proses selesai
    //     $this->load->view('templates/head');
    //     $this->load->view('templates/admin_sidebar');
    //     $this->load->view('templates/admin_navbar');
    //     $this->load->view('admin/tambah_surat_aktif_organisasi');
    //     $this->load->view('templates/admin_footer');
    // }


    // public function lihat_data_anggota_organisasi($id)
    // {
    //     $data['surat_aktif_organisasi'] = $this->SuratMasuk_model->data_aktif_organisasi_by_id($id);
    //     $this->load->view('templates/head');
    //     $this->load->view('templates/admin_sidebar');
    //     $this->load->view('templates/admin_navbar');
    //     $this->load->view('admin/lihat_data_anggota_organisasi', $data);
    //     $this->load->view('templates/admin_footer');
    // }

    // public function hapus_data_surat_organisasi($id_aktif)
    // {
    //     // Pastikan ID tidak kosong dan merupakan angka
    //     if (!empty($id_aktif) && is_numeric($id_aktif)) {
    //         // Panggil model atau lapisan lain yang berhubungan dengan manipulasi database
    //         $this->load->model('SuratMasuk_model'); // Gantilah 'nama_model' sesuai dengan nama model Anda

    //         // Panggil fungsi dalam model untuk menghapus data berdasarkan ID
    //         $result = $this->SuratMasuk_model->hapus_data_surat_organisasi($id_aktif);

    //         if ($result) {
    //             // Redirect atau tampilkan pesan sukses jika data berhasil dihapus
    //             redirect('adminor/surat_aktif_organisasi'); // Gantilah 'daftar_surat_masuk' dengan nama fungsi atau halaman yang sesuai
    //         } else {
    //             // Tampilkan pesan error jika data tidak dapat dihapus
    //             echo "Gagal menghapus data.";
    //         }
    //     } else {
    //         // Tampilkan pesan error jika parameter ID tidak valid
    //         echo "ID tidak valid.";
    //     }
    // }


    // END SURAT AKTIF ORGANISASI
}
