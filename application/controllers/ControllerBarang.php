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

	function copy_barang()
	{	
		$data = [
			'title'=> 'Copy Barang',
			'barang' => $this->Model->getAll('barang')
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_copy_barang');
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
		$data = $this->Model->getBarang();
		
		foreach ($data as $key) {
			$print[] = [
				'id_brg' => $key->id_barang,
				'nm_brg' => ucwords($key->nm_brg),
				'artikel' => $key->artikel,
				'harga' => $key->harga,
				'total' => $key->total,
				'stok' => $key->stok,
			];
		}

		if(empty($data)){
			echo json_encode($data);
		} else {
			echo json_encode($print);
		}
	}

	function stok_copy()
	{
		$kd_barang = $this->input->get('kd_barang');
		$key = $this->Model->getBarang_Copy($kd_barang);

		foreach ($key as $data) {
			$print[] = [
				'stok' => $data->stok,
				'sizes' => $data->size,
			];
		}

		if($key == null){
			echo json_encode(null);
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
			'harga' => $key->harga,
		];

		echo json_encode($print);
	}

	function simpan()
	{	
		$kd_barang = $this->input->post('kd_barang');
		$nm_barang = $this->input->post('nm_barang');
		$harga = $this->input->post('harga');
		$artikel = $this->input->post('artikel');

		$data = [
			'id_brg' => $kd_barang,
			'nm_brg' => $nm_barang,
			'artikel' => $artikel,
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
		$artikel = $this->input->post('artikel');

		$data = [
			'nm_brg' => $nm_barang,
			'artikel' => $artikel,
			'harga' => $harga,
		];

		$result = $this->Model->update('id_brg',$kd_barang,$data,'barang');

		echo json_encode($result);
	}

	function getKode_copy()
	{
		$kode = $this->Model->getKodeBarangCopy();
		$data = [
			'kd_barang' => $kode
		];
		echo json_encode($data);
	}

	function data_barang_copy()
	{
		$data = $this->Model->barangCopy();
		
		foreach ($data as $key) {
			$print[] = [
				'id_copy' => $key->id_copy,
				'id_brg' => $key->id_brg,
				'nm_brg' => ucwords($key->nm_brg),
				'artikel' => $key->artikel,
				'harga' => $key->harga,
				'sizes' => $key->size,
				'stok' => $key->stok,
			];
		}

		if(empty($data)){
			echo json_encode($data);
		} else {
			echo json_encode($print);
		}
	}

	function get_barang_copy()
	{
		$kd_barang = $this->input->get('id_copy');
		$key = $this->Model->getById('copy_barang','id_copy',$kd_barang);

		$print = [
			'id_brg' => $key->id_brg,
			'id_copy' => $key->id_copy,
			'sizes' => $key->size,
			'stok' => $key->stok,
		];

		echo json_encode($print);
	}

	function simpan_copy()
	{	
		$id_brg = $this->input->post('id_brg');
		$id_copy = $this->input->post('id_copy');
		$stok = $this->input->post('stok');
		$size = $this->input->post('size');

		$data = [
			'id_brg' => $id_brg,
			'id_copy' => $id_copy,
			'stok' => $stok,
			'size' => $size,
		];

		$result = $this->Model->simpan('copy_barang',$data);

		echo json_encode($result);
	}

	function hapus_copy()
	{
		$kd_barang = $this->input->post('kd_barang');
		$data = $this->Model->hapus('id_copy',$kd_barang,'copy_barang');
		echo json_encode($data);
	}

	function ubah_copy()
	{
		$id_brg = $this->input->post('id_brg');
		$id_copy = $this->input->post('id_copy');
		$stok = $this->input->post('stok');
		$size = $this->input->post('size');

		$data = [
			'id_brg' => $id_brg,
			'stok' => $stok,
			'size' => $size,
		];

		$result = $this->Model->update('id_copy',$id_copy,$data,'copy_barang');
		
		echo json_encode($result);
	}

}