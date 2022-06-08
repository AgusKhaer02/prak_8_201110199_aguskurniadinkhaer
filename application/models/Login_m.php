<?php



class Login_m extends CI_Model
{
	

	public function login($where)
	{

		// menampilkan data pada tabel user dengan kolom username, name, email, dan level berdasarkan clausa where yang sudah ditentukan pada controller Login
		$this->db->select('username, name, email, level');
		$this->db->from('user');
		$this->db->where($where);
		$query = $this->db->get();

		// kemudian return array associative
		return $query->row();
	}
}

?>
