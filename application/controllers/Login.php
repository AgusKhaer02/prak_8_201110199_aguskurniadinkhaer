<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public $user;
	public function index()
	{

		// mengecek session
		$checkSession = $this->etc->check_session();
		if ($checkSession) {
			// jika sessionnya ada
			$user = $this->session->userdata('user');
			$name = $user['name'];
			$this->session->set_flashdata(['code' => 200, 'message' => 'Selamat Datang, '.$name]);

			// langsung pindah ke halaman admin, jadi tidak perlu lagi user input
			redirect(site_url('admin'));
		}


		// jika belum ada data session, muncul halaman login
		$this->load->view('login');
	}

	public function do_login()
	{

		// masukan hasil dari submit form dengan post
		// ini akan mengembalikan nilai associative
		$this->user = $this->input->post();
	
		// panggil function validation
		$this->validation();

		// membuat variabel where dengan array associative
		$where = [
			"email" => $this->user['email'],
			// pada index kedua ini menggunakan md5 untuk melakukan hashing terhadap karakter menjadi kode acak md5 dengan 128 bit
			// teknik hashing ini direkomendasikan untuk masalah autentifikasi guna perketat keamanan password
			"password" => md5($this->user['password'])
		];
		$result = $this->login->login($where);

		if ($result > 0) {

			// set userdata dengan array associative
			$userdata = [
				// membuat 1 object dengan nama user
				"user" => [
					// kemudian ini adalah isi dari object user
					"username" => $result->username,
					"name" => $result->name,
					"email" => $result->email,
					"level" => $result->level,
				]
			];
			// store data session dengan userdata
			$this->session->set_userdata($userdata);

			// ambil data user
			$user = $this->session->userdata('user');
			
			// kemudian ambil nilai name pada variabel $user
			// ini akan digunakan untuk menampilkan nama pada halaman selamat datang 
			$name = $user['name'];
			// Flashdata adalah sebuah bagian dari session yaitu store data untuk satu kali pemakaian
			// hal ini berbeda dengan userdata yang dapat digunakan berkali kali
			// pada kali ini data yang di store adalah array associative dengan isi code dan message
			$this->session->set_flashdata(['code' => 200, 'message' => 'Selamat Datang, '.$name]);

			// pindah ke halaman admin
			redirect(site_url('admin'));
		}

		// jika email dan password salah, berikan code 500 dan message kesalahan
		$this->session->set_flashdata(['code' => 500, 'message' => 'Email dan password salah']);
		// kembali ke halaman login jika salah
		redirect(site_url('login'));
	}

	public function validation()
	{

		// jika email null
		if ($this->user['email'] == null) {
			// maka set pesan email kosong
			$this->session->set_flashdata(['code' => 500, 'message' => 'Email Kosong!']);

			// kembali ke halaman login
			redirect(site_url('login'));
		}
		
		// sama halnya seperti sebelumnya, jika password tidak ada
		if ($this->user['password'] == null) {
			// maka muncul pesan password kosong
			$this->session->set_flashdata(['code' => 500, 'message' => 'Password Kosong!']);
			redirect(site_url('login'));
		}
	}

	public function logout()
	{

		// menghapus seluruh nilai pada session userdata
		$this->session->sess_destroy();
		// tampil pesan logout sukses
		$this->session->set_flashdata(['code' => 200, 'message' => 'Logout Berhasil. Login kembali untuk melanjutkan']);
		// pindah ke halaman login
		redirect(site_url('login'));
	}
}
