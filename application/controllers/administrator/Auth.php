<?php 
	class Auth extends CI_Controller
	{
		public function index()
		{
			$this->load->view('administrator/login');
			$this->load->view('templates_administrator/header');
			$this->load->view('templates_administrator/footer');
		}
		public function proses_login()
		{	
			$this->form_validation->set_rules('nim','nim','required');
			$this->form_validation->set_rules('password','password','required');

			if($this->form_validation->run()== FALSE ){
				$this->load->view('administrator/login');
				$this->load->view('templates_administrator/header');
				$this->load->view('templates_administrator/footer');
			}else{
				$nim=$this->input->post('nim');
				$password=$this->input->post('password');

				$nimi = $nim;
				$pass= $password;

				$cek = $this->login_model->cek_login($nimi,$pass);

				if($cek->num_rows() > 0){
					foreach ($cek->result() as $ck ) {
						$sess_data['nim'] = $ck->nim;
						$sess_data['password'] = $ck->password;
						$sess_data['status'] = $ck->status;

						$this->session->set_userdata($sess_data);
						 
					}if($sess_data['status'] == 'mahasiswaa'){
						redirect('administrator/dashboard'); 
					}else{
						$this->session->set_flashdata('pesan','Maaf NIM dan Password salah');
						redirect('administrator/Auth');
					}

				}else{$this->session->set_flashdata('pesan','Maaf NIM dan Password salah');
						redirect('administrator/Auth');}
			}
		}
	}
 ?>