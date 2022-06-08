<?php

class Etc_m extends CI_Model
{
	public function check_session()
	{
		if ($this->session->userdata('user') != null) {
			return true;
		}

		return false;		
	}
}

?>
