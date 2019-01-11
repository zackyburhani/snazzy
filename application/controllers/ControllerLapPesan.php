<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class ControllerLapPesan extends CI_Controller
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
        $data =[
            'title' => 'Laporan Pesan',
        ];
        $this->load->view('template/v_header',$data);
		$this->load->view('template/v_sidebar');
		$this->load->view('v_lapPesan');
		$this->load->view('template/v_footer');
	}

	public function cetak()
    {
    	$awal = $this->input->post('awal');
    	$akhir = $this->input->post('akhir');

        if($akhir < $awal){
            $this->session->set_flashdata('pesanGagal','Tanggal Tidak Valid');
            redirect('laporan_pesan');
        } 

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
        $pdf->Cell(10,1,'',0,1);
        $pdf->Cell(190,10,'LAPORAN PESAN TANGGAL '.shortdate_indo($awal). ' SAMPAI '.shortdate_indo($akhir),0,1,'C');
        
        $pdf->Cell(10,-1,'',0,1);

        $pesan = $this->Model->lapPesan($awal,$akhir);

        if($pesan == null) {
            $this->session->set_flashdata('pesanGagal','Data Tidak Ditemukan');
        	redirect('laporan_pesan');
        }

        $pdf->Cell(190,5,' ',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(25,6,'Nomor Nota',1,0,'C');
        $pdf->Cell(55,6,'Nama Pelanggan',1,0,'C');
        $pdf->Cell(25,6,'ID Barang',1,0,'C');
        $pdf->Cell(45,6,'Barang',1,0,'C');
        $pdf->Cell(15,6,'Size',1,0,'C');
        $pdf->Cell(15,6,'QTY',1,1,'C');
        $pdf->SetFont('Arial','',8);

        $no = 1;
        foreach ($pesan as $row)
        {
            $pdf->Cell(10,6,$no++.".",1,0,'C');
            $pdf->Cell(25,6,$row->no_nota,1,0,'C');
            if($row->nm_plg == null){
                $pdf->Cell(55,6,'-',1,0,'C');
            } else {
                $pdf->Cell(55,6,ucwords($row->nm_plg),1,0,'C');
            }

            $pdf->Cell(25,6,$row->id_brg,1,0,'C');
            $pdf->Cell(45,6,ucwords($row->nm_brg),1,0,'C');
            $pdf->Cell(15,6,$row->size,1,0,'C');
            $pdf->Cell(15,6,$row->qty,1,1,'C');
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

        $fileName = 'LAPORAN_PESAN_'.shortdate_indo($awal).'_SAMPAI_'.shortdate_indo($akhir).'.pdf';
        $pdf->Output('D',$fileName); 
    }
}
