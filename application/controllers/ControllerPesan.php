<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerPesan extends CI_Controller
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
            'title' => 'Pesan Barang',
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_pesan');
		$this->load->view('template/v_footer');
	}

    function tambah_pesan()
    {   
        $data = [
            'title' => 'Tambah Pesan Barang',
            'barang' => $this->Model->getAll('barang')
        ];
        $this->destroy();
        $this->load->view('template/v_header',$data);
        $this->load->view('template/v_sidebar');
        $this->load->view('v_tambah_pesan');
        $this->load->view('template/v_footer');
    }

    function cekCart()
    {   
        if($this->cart->contents() == null){
            $data_cart = false;
        } else {
            $data_cart = true;
        }
        echo json_encode($data_cart);
    }

	function getKode()
	{
		$kode = $this->Model->getKodePesan();
		$data = [
			'id_pesan' => $kode
		];
		echo json_encode($data); die();
	}

	function add_to_cart(){ //fungsi Add To Cart

		$id_brg = $this->input->post('id_brg');

		$barang = $this->Model->getByID('barang','id_brg',$id_brg);

		$data = [
	        'id' => $barang->id_brg, 
	        'name' => $barang->nm_brg, 
	        'price' => $barang->harga, 
	        'qty' => $this->input->post('qty'), 
	    ];

        $tes = $this->cart->insert($data);
        echo $this->show_cart(); //tampilkan cart setelah added
    }
 
    function show_cart(){ //Fungsi untuk menampilkan Cart
        $output = '';
        $no = 0;
        foreach ($this->cart->contents() as $items) {

            $no++;
            $output .='
                <tr>
                	<td align="center">'.$no.".".'</td>
                    <td align="center">'.$items['id'].'</td>
                    <td>'.$items['name'].'</td>
                    <td align="center">'.number_format($items['price'],0,',','.').'</td>
                    <td align="center">'.$items['qty'].'</td> 
                    <td align="right">'.number_format($items['subtotal'],0,',','.').'</td>
                    <td align="center"><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-md"><i class="glyphicon glyphicon-trash"></i></button></td>
                </tr>
            ';
        }
        $output .= '
            <tr>
                <th colspan="4"><center>TOTAL</center></th>
                <th colspan="2"> <div class="text-right">'.'Rp '.number_format($this->cart->total(),0,',','.').'</div></th>
                <th></th>
            </tr>
        ';
        return $output;
    }
 
    function load_cart(){ //load data cart
        echo $this->show_cart();
    }

    function load_detail(){ 
        foreach ($this->cart->contents() as $items) {
            $data[] = [
            	'id'=> $items['id'],
            	'name' =>$items['name'],
            	'price' =>$items['subtotal'],
            	'qty' =>$items['qty']
            ];      
        }
        echo json_encode($data);
    }
 
    function hapus_cart(){ //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('row_id'), 
            'qty' => 0, 
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }

    function simpan()
	{  
        $id_pesan = $this->input->post('id_pesan');
		$tgl_bayar = date('Y-m-d');
		$diskon = $this->input->post('diskon');
		$id_plg = $this->Model->getKodePlg();
        $nm_plg = $this->input->post('nm_plg');
        $no_telp = $this->input->post('no_telp');
        $alamat = $this->input->post('alamat');

        if($diskon == null){
            $diskon = 0;
        } else {
            $diskon = 20000;
        }

        if($nm_plg != null){
            $data_pelanggan = [
                'id_plg' => $id_plg,
                'nm_plg' => ucwords($nm_plg),
                'no_telp' => $no_telp,
                'alamat' => $alamat
            ];
            $result_plg = $this->Model->simpan('pelanggan',$data_pelanggan);
        }

        $id_pelanggan = $this->Model->getByID('pelanggan','id_plg',$id_plg);

        if($id_pelanggan == null){
            $id_plg = null;
        } else {
            $id_plg = $id_pelanggan->id_plg;
        }

		$data_pesan = [
			'id_pesan' => $id_pesan,
            'tgl_bayar' => $tgl_bayar,
            'diskon' => $diskon,
            'id_plg' => $id_plg,
		];

        $result = $this->Model->simpan('pesan',$data_pesan);

        $data_nota = [
            'no_nota' => $this->Model->getNomorNota(),
            'tgl_nota' => date('Y-m-d'),
            'id_pesan' => $id_pesan
        ];

        $result_nota = $this->Model->simpan('nota',$data_nota);

		echo json_encode($result);
	}

    function data_pesan()
    {
        $orders = $this->Model->getNota();

        foreach ($orders as $key) {
            $order[] = [
                'no_nota' => $key->no_nota,
                'tgl_nota' => shortdate_indo($key->tgl_nota),
                'id_pesan' => $key->id_pesan,
            ];
        }       

        echo json_encode($order);
    }

	function simpan_detail()
	{
		$id_brg = $this->input->post('id_brg');
		$id_pesan = $this->input->post('id_pesan');
		$qty = $this->input->post('qty');
		$jml_bayar = $this->input->post('jml_bayar');

		$data = [
			'id_brg' => $id_brg,
			'id_pesan' => $id_pesan,
			'qty' => $qty,
			'jml_bayar' => $jml_bayar,
		];

        $stok_sekarang = $this->Model->getByID('barang','id_brg',$id_brg);
        $stok = $stok_sekarang->stok-$qty;

        $data_update = [
            'stok' => $stok,
        ];

        $update = $this->Model->update('id_brg',$id_brg,$data_update,'barang');
		$result = $this->Model->simpan('detail_pesan',$data);

		echo json_encode($result);
	}

	function destroy()
	{	
		$output = $this->input->post('output');
		$data = $this->cart->destroy();
        $output .= '
            <tr>
                <th colspan="4"><center>TOTAL</center></th>
                <th colspan="2"> <div class="text-right">'.'Rp '.'</div></th>
                <th></th>
            </tr>
        ';
        return $output;
	}

	function get_pesan()
	{
		$no_nota = $this->input->get('no_nota');
		$data = $this->Model->getJoinPesan_ID($no_nota);

        foreach($data as $key){
            $detail[] = [
                'id_plg' => $key->id_plg, 
                'nm_plg' => $key->nm_plg,
                'no_telp' => $key->no_telp,
                'alamat' => $key->alamat,
                'id_pesan' => $key->id_pesan,
                'tgl_bayar' => shortdate_indo($key->tgl_bayar),
                'tgl_nota' => shortdate_indo($key->tgl_nota),
                'no_nota' => $key->no_nota,
                'diskon' => number_format($key->diskon,0,',','.'),
            ];
        }

		echo json_encode($detail);
	}

	function get_jasa()
	{
		$kd_jasa = $this->input->get('kd_jasa');
		$kd_order = $this->input->get('kd_order');
		$data = $this->Model->getJoinJasa_ID($kd_jasa,$kd_order);
		echo json_encode($data);
	}

	function get_detail_pesan()
	{
		$no_nota = $this->input->get('no_nota');
		$data = $this->Model->getJoinDetail_ID($no_nota);

        if(empty($data)){
            echo json_encode(false);
        } else {
            foreach ($data as $key) {
                $kalkulasi = $key->total-$key->diskon;
                $cetak[] = [
                    'id_plg' => $key->id_plg,
                    'nm_plg' => $key->nm_plg,
                    'no_telp' => $key->no_telp,
                    'alamat' => $key->alamat,
                    'id_pesan' => $key->id_pesan,
                    'tgl_bayar' => shortdate_indo($key->tgl_bayar),
                    'diskon' => number_format($key->diskon,0,',','.'),
                    'no_nota' => $key->no_nota,
                    'tgl_nota' => shortdate_indo($key->tgl_nota),
                    'id_brg' => $key->id_brg,
                    'nm_brg' => $key->nm_brg,
                    'id_artikel' => $key->artikel,
                    'size' => $key->size,
                    'stok' => $key->stok,
                    'qty' => $key->qty,
                    'harga' => number_format($key->harga,0,',','.'),
                    'jml_bayar' => number_format($key->jml_bayar,0,',','.'),
                    'total' => number_format($kalkulasi,0,',','.'),
                ];
            }
            echo json_encode($cetak);
        }
	}

	function get_detail_order_ver2()
	{
		$kd_order = $this->input->get('kd_order');
		$data = $this->Model->getJoinDetail_ID_ver2($kd_order);	
		echo json_encode($data);
	}

	function proses($kd_order)
	{   
        $this->destroy();
		$data = [
            'title' => 'Proses Order Cucian',
			'barang' => $this->Model->getAll('barang'),
			'kd_order' => $kd_order
		];
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_proses');
		$this->load->view('template/v_footer');
	}

	public function cetak($no_nota)
    {
        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        //cetak gambar
        $image1 = "assets/img/LOGO.png";
        $pdf->Cell(1, 0, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 35), 0, 0, 'L', false );
        // mencetak string
        $pdf->Cell(186,10,'SNAZZY ESSENTIALS',0,1,'C');
        $pdf->Cell(9,1,'',0,1);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(186,7,'PERUMAHAN PURI PERMAI BLOK A2/03',0,1,'C');
        $pdf->Cell(186,3,' Kec. Tigakarsa - Kab. Tangerang - Banten ',0,1,'C');
        $pdf->Cell(186,5,'',0,1,'C');
        $pdf->Cell(186,5,'',0,1,'C');

        $pdf->Line(10, 42, 210-11, 42); 
        $pdf->SetLineWidth(0.5); 
        $pdf->Line(10, 42, 210-11, 42);
        $pdf->SetLineWidth(0);     
            
        $pdf->ln(6);        
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(190,10,'NOTA',0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $kwitansi = $this->Model->getKwitansi($no_nota);

        $kwitansi_fetch = $this->Model->getKwitansi_fetch($no_nota);

        $pdf->SetFont('Arial','',9);

        $pdf->Cell(25,6,'Nomor Nota',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(40,6,''.$kwitansi_fetch->no_nota,0,0,'L');
        
        $pdf->Cell(65,6,'',0,0,'C');
        $pdf->Cell(30,6,'Tanggal Nota',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(20,6,''.shortdate_indo($kwitansi_fetch->tgl_nota),0,1,'L');

        $pdf->Cell(25,6,'Pelanggan',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        if($kwitansi_fetch->nm_plg == null){
            $pdf->Cell(40,6,'-',0,0,'L');
        } else {
            $pdf->Cell(40,6,''.$kwitansi_fetch->nm_plg,0,0,'L');
        }
        
        $pdf->Cell(65,6,'',0,0,'C');
        $pdf->Cell(30,6,'',0,0,'L');
        $pdf->Cell(5,6,'',0,0,'C');
        $pdf->Cell(20,6,'',0,1,'L');

		$pdf->Cell(25,6,'Telepon',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        if($kwitansi_fetch->no_telp == null){
            $pdf->Cell(40,6,'-',0,1,'L');
        } else {
            $pdf->Cell(40,6,''.$kwitansi_fetch->no_telp,0,1,'L');
        }


        $pdf->Cell(25,6,'Alamat',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        if($kwitansi_fetch->alamat == null){
            $pdf->Cell(40,6,'-',0,1,'L');
        } else {
            $pdf->Cell(40,6,''.$kwitansi_fetch->alamat,0,1,'L');
        }

        $pdf->Cell(190,5,' ',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(30,6,'ID Barang',1,0,'C');
        $pdf->Cell(50,6,'Nama Barang',1,0,'C');
        $pdf->Cell(20,6,'Size',1,0,'C');
        $pdf->Cell(20,6,'Harga',1,0,'C');
        $pdf->Cell(20,6,'QTY',1,0,'C');
        $pdf->Cell(40,6,'Jumlah Harga',1,1,'C');
        $pdf->SetFont('Arial','',8);

        $tampung = array();
        $no = 1;
        foreach ($kwitansi as $row)
        {
            $pdf->Cell(10,6,$no++.".",1,0,'C');
            $pdf->Cell(30,6,$row->id_brg,1,0,'C');
            $pdf->Cell(50,6,ucwords($row->nm_brg),1,0,'C');
            $pdf->Cell(20,6,$row->size,1,0,'C');
            $pdf->Cell(20,6,number_format($row->harga,0,',','.'),1,0,'C');
            $pdf->Cell(20,6,$row->qty,1,0,'C');
            $pdf->Cell(40,6,number_format($row->jml_bayar,0,',','.'),1,1,'C');   
        	$tampung[] = $row->jml_bayar;
            $diskon = $row->diskon;
        }

        $grand_total = array_sum($tampung)-$diskon;
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(150,6,'Diskon',1,0,'C');

        if($diskon == '0'){
            $pdf->Cell(40,6,'-',1,1,'C');
        } else {
            $pdf->Cell(40,6,'Rp. '.number_format($diskon,0,',','.'),1,1,'C');
        }
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(150,6,'Total Harga',1,0,'C');
        $pdf->Cell(40,6,'Rp. '.number_format($grand_total,0,',','.'),1,1,'C');
        $pdf->SetFont('Arial','',8);
        
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,5,'Tangerang, '.date_indo(date("Y-m-d")),0,1,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(64,6,'Hormat Kami',0,1,'C');

        $pdf->Cell(10,20,'',0,1);

        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(63,6,'',0,0,'C');
        $pdf->Cell(64,6,'( '.ucwords($this->session->nm_petugas).' )',0,0,'C');
        
        if($kwitansi_fetch->nm_plg == null){
            $fileName = $no_nota.'.pdf';
        } else {
            $fileName = $no_nota.'_'.$kwitansi_fetch->nm_plg.'.pdf';
        }

        $pdf->Output('D',$fileName); 
    }

    function cekStok()
    {
        $id_brg = $this->input->post('id_brg');
        $stok = $this->Model->getByID('barang','id_brg',$id_brg);
        echo $stok->stok;
    }

    function cekStok_2()
    {
        foreach ($this->cart->contents() as $items) {
            $data = $items['qty'];
        }

        echo json_encode($data);   
    }

	function validasi_ambil()
	{
		$kd_order = $this->input->post('kd_order');
		$status1 = $this->Model->getJoinDetail_ID_validasi($kd_order);
		$status0 = $this->Model->getJoinDetail_ID($kd_order);
		
		if(count($status0) == count($status1)){
			echo json_encode("sama");
		} else {
			echo json_encode("tidak");
		}
	}

	function ambil()
	{
		$kd_order = $this->input->post('kd_order');
		$data = [
			'status' => '1'
		];
		$result2 = $this->Model->update('kd_order',$kd_order,$data,'order_pesanan');

		echo json_encode($result2);
	}

}