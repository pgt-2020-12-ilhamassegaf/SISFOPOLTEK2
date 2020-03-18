<?php
class Login_model extends CI_Model{

	public function cek_login($nim,$password){
		$this-> db ->where("nim", $nim);
		$this-> db ->where("password", $password);
		return $this->db->get('mahasiswa');
	}
	public function getLoginData($nimi , $pass){
		$n = $nimi; 
		$p = $pass;

		$query_cekLogin = $this->db->get_where('mahasiswa', array('nim'=> $n, 'password' => $p));

		if(count ($query_cekLogin->result()) > 0){
			foreach ($query_cekLogin->result() as $qck) {
				foreach ($query_cekLogin->result() as $ck) {
					$sess_data ['logged_in'] = true;
					$sess_data ['nim'] = $ck->nim;
					$sess_data ['password'] = $ck->password;
					$sess_data ['status'] = $ck->status;
					$this ->session ->set_userdata($sess_data);
				}
				redirect('administrator/dashboard');
			}
		}else{
			$this->session->set_flashdata('pesan','Usernam pw salah');
			redirect('administrator/Auth');
		}
	}
}