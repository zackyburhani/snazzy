<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerDashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
		$username = $this->session->username;
		if($username == null){
			redirect('');
		}
	}

	public function index()
	{	
		$data = [
			'barang' => $this->Model->jumlah('barang'),
			'pelanggan' => $this->Model->jumlah('pelanggan'),
			'pesan' => $this->Model->jumlah('pesan'),
			'retur' => $this->Model->jumlah('retur'),
			'title' => 'Dashboard'
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_dashboard');
		$this->load->view('template/v_footer');
	}
}