<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerJasa extends CI_Controller
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
			'title'=> 'Jasa',
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_jasa');
		$this->load->view('template/v_footer');
	}

	function getKode()
	{
		$kode = $this->Model->getKodeJasa();
		$data = [
			'kd_jasa' => $kode
		];
		echo json_encode($data);
	}

	function data_jasa()
	{
		$data = $this->Model->getAll('jasa');
		echo json_encode($data);
	}

	function get_jasa()
	{
		$kd_jasa = $this->input->get('kd_jasa');
		$data = $this->Model->getById('jasa','kd_jasa',$kd_jasa);
		echo json_encode($data);
	}

	function simpan()
	{
		$kd_jasa = $this->input->post('kd_jasa');
		$nm_jasa = $this->input->post('nm_jasa');
		$harga = $this->input->post('harga');

		$data = [
			'kd_jasa' => $kd_jasa,
			'nm_jasa' => $nm_jasa,
			'harga' => $harga,
		];

		$result = $this->Model->simpan('jasa',$data);

		echo json_encode($result);
	}

	function hapus()
	{
		$kd_jasa = $this->input->post('kd_jasa');
		$data = $this->Model->hapus('kd_jasa',$kd_jasa,'jasa');
		echo json_encode($data);
	}

	function ubah()
	{
		$kd_jasa = $this->input->post('kd_jasa');
		$nm_jasa = $this->input->post('nm_jasa');
		$harga = $this->input->post('harga');

		$data = [
			'kd_jasa' => $kd_jasa,
			'nm_jasa' => $nm_jasa,
			'harga' => $harga
		];

		$result = $this->Model->update('kd_jasa',$kd_jasa,$data,'jasa');

		echo json_encode($result);
	}

}