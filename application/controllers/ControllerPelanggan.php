<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerPelanggan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Model');
		$username = $this->session->username;
		if($username == null){
			redirect('');
		}
	}
	
	function index()
	{	
		$data = [
			'title'=> 'Pelanggan',
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_pelanggan');
		$this->load->view('template/v_footer');
	}

	function data_pelanggan()
	{
		$data = $this->Model->getPelanggan();
		echo json_encode($data);
	}

	function get_pelanggan()
	{
		$kd_pelanggan = $this->input->get('id_plg');
		$data = $this->Model->getById('pelanggan','id_plg',$kd_pelanggan);
		echo json_encode($data);
	}

	function hapus()
	{
		$kd_pelanggan = $this->input->post('kd_pelanggan');
		$data = $this->Model->hapus('id_plg',$kd_pelanggan,'pelanggan');
		echo json_encode($data);
	}

	function ubah()
	{
		$kd_pelanggan = $this->input->post('id_plg');
		$nm_pelanggan = $this->input->post('nm_plg');
		$no_telp = $this->input->post('no_telp');
		$alamat = $this->input->post('alamat');

		$data = [
			'nm_plg' => $nm_pelanggan,
			'no_telp' => $no_telp,
			'alamat' => $alamat
		];

		$result = $this->Model->update('id_plg',$kd_pelanggan,$data,'pelanggan');

		echo json_encode($result);
	}

}