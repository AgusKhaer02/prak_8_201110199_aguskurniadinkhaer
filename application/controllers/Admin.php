<?php

class Admin extends CI_Controller
{
	public function index()
	{

		// cek session sebelum tampilkan halaman admin
		$checkSession = $this->etc->check_session();


		// jika sessionnya tidak ada maka 
		if ($checkSession == false) {
			// muncul pesan error kemudian user diminta untuk melakukan login
			$this->session->set_flashdata(['code' => 500, 'message' => "Anda harus login terlebih dahulu"]);
			redirect(site_url('login'));
		}

		// jika user sudah login, ambil data session dengan key user
		$data['user'] = $this->session->userdata('user');
		// kemudian menampilkan halaman admin dengan data user
		$this->load->view('admin', $data);
	}
}


?>
