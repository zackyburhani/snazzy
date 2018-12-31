<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerLogin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model');	
	}

	public function index()
	{
		$username = $this->session->username;
		if($username != null){
			redirect('dashboard');
		} else {
			$this->load->view('template/v_login');
		}
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
	
		if($username != "admin" && $password != "admin"){
			$this->session->set_flashdata('pesanGagal','Kesalahan');
			redirect('');

		}else{

			$newdata = array(
				'username' => $username,
				'nm_petugas' => "Administrator",
			  );
			//set seassion
			$this->session->set_userdata($newdata);
			redirect('dashboard');
		}
	}

	public function not_found()
	{
		$this->load->view('template/404');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}
}