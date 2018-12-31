<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerBarang extends CI_Controller
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
			'title'=> 'Barang',
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_barang');
		$this->load->view('template/v_footer');
	}

	function getKode()
	{
		$kode = $this->Model->getKodeBarang();
		$data = [
			'kd_barang' => $kode
		];
		echo json_encode($data);
	}

	function data_barang()
	{
		$data = $this->Model->getAll('barang');
		
		foreach ($data as $key) {
			$print[] = [
				'id_brg' => $key->id_brg,
				'nm_brg' => ucwords($key->nm_brg),
				'artikel' => $key->artikel,
				'size' => $key->size,
				'stok' => $key->stok,
				'harga' => $key->harga,
			];
		}

		if(empty($data)){
			echo json_encode($data);
		} else {
			echo json_encode($print);
		}
	}

	function get_barang()
	{
		$kd_barang = $this->input->get('kd_barang');
		$key = $this->Model->getById('barang','id_brg',$kd_barang);

		$print = [
			'id_brg' => $key->id_brg,
			'nm_brg' => ucwords($key->nm_brg),
			'artikel' => $key->artikel,
			'sizes' => $key->size,
			'stok' => $key->stok,
			'harga' => $key->harga,
		];

		echo json_encode($print);
	}

	function simpan()
	{	
		$kd_barang = $this->input->post('kd_barang');
		$nm_barang = $this->input->post('nm_barang');
		$harga = $this->input->post('harga');
		$stok = $this->input->post('stok');
		$artikel = $this->input->post('artikel');
		$size = $this->input->post('size');

		$data = [
			'id_brg' => $kd_barang,
			'nm_brg' => $nm_barang,
			'artikel' => $artikel,
			'size' => $size,
			'stok' => $stok,
			'harga' => $harga,
		];

		$result = $this->Model->simpan('barang',$data);

		echo json_encode($result);
	}

	function hapus()
	{
		$kd_barang = $this->input->post('kd_barang');
		$data = $this->Model->hapus('id_brg',$kd_barang,'barang');
		echo json_encode($data);
	}

	function ubah()
	{
		$kd_barang = $this->input->post('id_brg');
		$nm_barang = $this->input->post('nm_brg');
		$harga = $this->input->post('harga');
		$stok = $this->input->post('stok');
		$artikel = $this->input->post('artikel');
		$size = $this->input->post('size');

		$data = [
			'nm_brg' => $nm_barang,
			'artikel' => $artikel,
			'size' => $size,
			'stok' => $stok,
			'harga' => $harga,
		];

		$result = $this->Model->update('id_brg',$kd_barang,$data,'barang');

		echo json_encode($result);
	}

}