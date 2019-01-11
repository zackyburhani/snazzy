<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerRetur extends CI_Controller
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
            'title' => 'Retur Barang',
			'retur' => $this->Model->getAll('retur')
		];
        $this->destroy();
		$this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_retur');
		$this->load->view('template/v_footer');
	}

    function tambah_retur()
    {   
        $data = [
            'title' => 'Tambah Retur Barang',
            'retur' => $this->Model->getAll('retur'),
            'barang' => $this->Model->getBarang_pesan(),
        ];
        $this->destroy();
        $this->load->view('template/v_header',$data);
        $this->load->view('template/v_sidebar');
        $this->load->view('v_tambah_retur');
        $this->load->view('template/v_footer');
    }

    function get_barang()
    {
        $barang = $this->Model->getAll('barang');
    
        if(empty($barang)){
            echo json_encode(null);
        } else {
            foreach ($barang as $nota) {
                $print[] = [
                    'id_brg' => $nota->id_brg,
                    'nm_brg' => $nota->nm_brg,
                    'artikel' => $nota->artikel,
                    'stok' => $nota->stok,
                    'size' => $nota->size,
                    'harga' => number_format($nota->harga,0,',','.'),
                ];
            }
         echo json_encode($print);
        }
    }

    function get_nota()
    {
        $no_nota = $this->input->get('no_nota');

        $data = $this->Model->getNotaRetur($no_nota);

        $validasi = $this->Model->getNotaReturValidasi($no_nota);

        if($validasi == null){
            if($data == null){
                echo json_encode(null);
            } else {
                foreach ($data as $nota) {
                $print[] = [
                    'id_pesan' => $nota->id_pesan,
                    'id_copy' => $nota->id_copy,
                    'tgl_bayar' => shortdate_indo($nota->tgl_bayar),
                    'diskon' => $nota->diskon,
                    'id_plg' => $nota->id_plg,
                    'no_nota' => $nota->no_nota,
                    'tgl_nota' => shortdate_indo($nota->tgl_nota),
                    'id_brg' => $nota->id_brg,
                    'nm_brg' => $nota->nm_brg,
                    'harga' => number_format($nota->harga,0,',','.'),
                    'sizes' => $nota->size,
                    'qty' => $nota->qty,
                    'jml_bayar' => number_format($nota->jml_bayar,0,',','.'),
                ];
            }
            echo json_encode($print);
            }
        } else {
            echo json_encode(null);
        }

        return $no_nota;
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
		$kode = $this->Model->getKodeRetur();
		$data = [
			'id_retur' => $kode
		];
		echo json_encode($data); die();
	}

	function add_to_cart(){ //fungsi Add To Cart

		$id_brg = $this->input->post('id_brg');

		$barang = $this->Model->getCopyBarangID($id_brg);

		$data = [
	        'id' => $barang->id_copy, 
	        'name' => $barang->nm_brg, 
	        'price' => $barang->harga, 
            'size' => $barang->size,
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
                    <td>'.$items['name'].'</td>
                    <td align="center">'.$items['size'].'</td>
                    <td align="center">'.$items['qty'].'</td>
                    <td align="center">'.number_format($items['price'],0,',','.').'</td> 
                    <td align="right">'.number_format($items['subtotal'],0,',','.').'</td>
                    <td align="center"><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-md"><i class="glyphicon glyphicon-trash"></i></button></td>
                </tr>
            ';
        }
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
        $id_retur = $this->input->post('id_retur');
        $no_nota = $this->input->post('no_nota');
        $id_pesan = $this->input->post('id_pesan');

        $data = [
            'id_retur' => $id_retur,
            'tgl_retur' => date('Y-m-d'),
            'no_nota' => $no_nota,
        ];
        
		$result = $this->Model->simpan('retur',$data);

		echo json_encode($result);
	}

    function data_retur()
    {
        $orders = $this->Model->getRetur();

        foreach ($orders as $key) {
            $order[] = [
                'no_nota' => $key->no_nota,
                'tgl_retur' => shortdate_indo($key->tgl_retur),
                'id_retur' => $key->id_retur,
            ];
        }       

        echo json_encode($order);
    }

	function simpan_detail()
	{
		$id_brg = $this->input->post('id_brg');
		$id_retur = $this->input->post('id_retur');
		$qty = $this->input->post('qty');
		$jml_bayar = $this->input->post('jml_bayar');

		$data = [
			'id_copy' => $id_brg,
			'id_retur' => $id_retur,
			'qty' => $qty,
			'jml_harga' => $jml_bayar,
		];

        $stok_sekarang = $this->Model->getByID('copy_barang','id_copy',$id_brg);
        $stok = $stok_sekarang->stok-$qty;

        $data_update = [
            'stok' => $stok,
        ];

        $update = $this->Model->update('id_copy',$id_brg,$data_update,'copy_barang');
		$result = $this->Model->simpan('detail_retur',$data);

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

	function get_retur()
	{
		$no_nota = $this->input->get('no_nota');
		$key = $this->Model->getJoinRetur_ID($no_nota);

        $detail = [
            'id_plg' => $key->id_plg, 
            'nm_plg' => $key->nm_plg,
            'no_telp' => $key->no_telp,
            'alamat' => $key->alamat,
            'no_nota' => $key->no_nota,
            'id_retur' => $key->id_retur,
            'tgl_retur' => shortdate_indo($key->tgl_retur),
        ];

		echo json_encode($detail);
	}

	function get_detail_retur()
	{
		$no_nota = $this->input->get('no_nota');
		$data = $this->Model->getJoinReturDetail_ID($no_nota);	
        foreach ($data as $key) {
            $print[] = [
                'id_brg' => $key->id_brg,
                'nm_brg' => $key->nm_brg,
                'harga' => number_format($key->harga,0,',','.'),
                'qty' => $key->qty,
                'sizes' => $key->size,
                'jml_harga' => number_format($key->jml_harga,0,',','.'),
            ];
        }
		echo json_encode($print);
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
        $pdf->Cell(190,10,'Kwitansi Retur',0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $kwitansi = $this->Model->getKwitansiRetur($no_nota);

        $kwitansi_fetch = $this->Model->getKwitansiRetur_fetch($no_nota);

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
        $pdf->Cell(30,6,'Nomor Retur',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(20,6,''.$kwitansi_fetch->id_retur,0,1,'L');

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
            $pdf->Cell(30,6,$row->id_barang,1,0,'C');
            $pdf->Cell(50,6,ucwords($row->nm_brg),1,0,'C');
            $pdf->Cell(20,6,$row->size,1,0,'C');
            $pdf->Cell(20,6,number_format($row->harga,0,',','.'),1,0,'C');
            $pdf->Cell(20,6,$row->qty,1,0,'C');
            $pdf->Cell(40,6,number_format($row->jml_harga,0,',','.'),1,1,'C');   
        }
        
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
            $fileName = $kwitansi_fetch->id_retur.'.pdf';
        } else {
            $fileName = $kwitansi_fetch->id_retur.'_'.$kwitansi_fetch->nm_plg.'.pdf';
        }

        $pdf->Output('D',$fileName); 
    }

    function cekStok()
    {
        $id_brg = $this->input->post('id_brg');
        $stok = $this->Model->getByID('copy_barang','id_copy',$id_brg);
        echo $stok->stok;
    }

    function cekStok_2()
    {
        foreach ($this->cart->contents() as $items) {
            $data = $items['qty'];
        }

        echo json_encode($data);   
    }

}