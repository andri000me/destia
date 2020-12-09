<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('transaksi', 'Transaksi', 'required|in_list[barang_masuk,barang_keluar,barang_rusak,barang_kembali]');
        $this->form_validation->set_rules('tanggal', 'Periode Tanggal', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Laporan Transaksi";
            $this->template->load('templates/dashboard', 'laporan/form', $data);
        } else {
            $input = $this->input->post(null, true);
            $table = $input['transaksi'];
            $tanggal = $input['tanggal'];
            $pecah = explode(' - ', $tanggal);
            $mulai = date('Y-m-d', strtotime($pecah[0]));
            $akhir = date('Y-m-d', strtotime(end($pecah)));

            $query = '';
            if ($table == 'barang_masuk') {
                $query = $this->admin->getBarangMasuk(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            } elseif ($table == 'barang_keluar') {
                $query = $this->admin->getBarangKeluar(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            } elseif ($table == 'barang_rusak') {
                $query = $this->admin->getBarangRusak(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            } else {
                $query = $this->admin->getBarangKembali(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            }

            $this->_cetak($query, $table, $tanggal);
        }
    }

    private function _cetak($data, $table_, $tanggal)
    {
        $this->load->library('CustomPDF');
        $table = $table_ === 'barang_masuk' ? 'Aset': 'Aset' ;

        $pdf = new FPDF();
        $pdf->AddPage('P', 'Letter');
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(190, 7, 'Laporan ' . $table, 0, 1, 'C');
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(190, 4, 'Tanggal : ' . $tanggal, 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 10);
        //LAPORAN ASET MASUK
        if ($table_ == 'barang_masuk') :
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Tgl Masuk', 1, 0, 'C');
            // $pdf->Cell(35, 7, 'ID Transaksi', 1, 0, 'C');
            $pdf->Cell(50, 7, 'Nama Aset', 1, 0, 'C');
            $pdf->Cell(45, 7, 'Pemilik', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Jumlah Masuk', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Keterangan', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(25, 7, $d['tanggal_masuk'], 1, 0, 'C');
                // $pdf->Cell(35, 7, $d['id_barang_masuk'], 1, 0, 'C');
                $pdf->Cell(50, 7, $d['nama_barang'], 1, 0, 'L');
                $pdf->Cell(45, 7, $d['nama_supplier'], 1, 0, 'L');
                $pdf->Cell(30, 7, $d['jumlah_masuk'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['keterangan'], 1, 0, 'C');
                $pdf->Ln();
            //LAPORAN ASET KELUAR 
            } elseif ($table_ == 'barang_keluar') :
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Tgl Dipinjam', 1, 0, 'C');
            $pdf->Cell(80, 7, 'Nama Peminjam', 1, 0, 'C');
            $pdf->Cell(45, 7, 'Nama Aset', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Jumlah Dipinjam', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(25, 7, $d['tanggal_keluar'], 1, 0, 'C');
                $pdf->Cell(80, 7, $d['nama_karyawan'], 1, 0, 'L');
                $pdf->Cell(45, 7, $d['nama_barang'], 1, 0, 'L');
                $pdf->Cell(30, 7, $d['jumlah_keluar'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                $pdf->Ln();
            //LAPORAN ASET RUSAK
            } elseif ($table_ == 'barang_rusak'):
                $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
                $pdf->Cell(25, 7, 'Tgl Rusak', 1, 0, 'C');
                // $pdf->Cell(35, 7, 'ID Transaksi', 1, 0, 'C');
                $pdf->Cell(45, 7, 'Nama Aset', 1, 0, 'C');
                $pdf->Cell(30, 7, 'Jumlah Rusak', 1, 0, 'C');
                $pdf->Cell(85, 7, 'Keterangan', 1, 0, 'C');
                $pdf->Ln();
    
                $no = 1;
                foreach ($data as $d) {
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                    $pdf->Cell(25, 7, $d['tanggal_rusak'], 1, 0, 'C');
                    // $pdf->Cell(35, 7, $d['id_barang_rusak'], 1, 0, 'C');
                    $pdf->Cell(45, 7, $d['nama_barang'], 1, 0, 'L');
                    $pdf->Cell(30, 7, $d['jumlah_rusak'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                    $pdf->Cell(85, 7, $d['keterangan'], 1, 0, 'L');
                    $pdf->Ln();
                } else :
                    $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
                    $pdf->Cell(25, 7, 'Tgl Kembali', 1, 0, 'C');
                    // $pdf->Cell(35, 7, 'ID Transaksi', 1, 0, 'C');
                    $pdf->Cell(40, 7, 'Nama Aset', 1, 0, 'C');
                    $pdf->Cell(45, 7, 'Pemilik', 1, 0, 'C');
                    $pdf->Cell(15, 7, 'Jumlah', 1, 0, 'L');
                    $pdf->Cell(60, 7, 'Nama Peminjam', 1, 0, 'C');
                    $pdf->Ln();
        
                    $no = 1;
                    foreach ($data as $d) {
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                        $pdf->Cell(25, 7, $d['tanggal_masuk'], 1, 0, 'C');
                        // $pdf->Cell(35, 7, $d['id_barang_masuk'], 1, 0, 'C');
                        $pdf->Cell(40, 7, $d['nama_barang'], 1, 0, 'L');
                        $pdf->Cell(45, 7, $d['nama_supplier'], 1, 0, 'L');
                        $pdf->Cell(15, 7, $d['jumlah_masuk'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                        $pdf->Cell(60, 7, $d['nama_karyawan'], 1, 0, 'l');
                        $pdf->Ln();
                    }            
        endif;

        $file_name = $table . ' ' . $tanggal;
        $pdf->Output('I', $file_name);
    }
}


