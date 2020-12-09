<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangkembali extends CI_Controller
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
        $data['title'] = "Aset Kembali";
        $data['barangkembali'] = $this->admin->getBarangKembali();
        $this->template->load('templates/dashboard', 'barang_kembali/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('karyawan_id', 'Karyawan', 'required');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Aset Kembali";
            $data['supplier'] = $this->admin->get('supplier');
            $data['barang'] = $this->admin->get('barang');
            $data['karyawan'] = $this->admin->get('karyawan');


            // Mendapatkan dan men-generate kode transaksi barang masuk
            $kode = 'T-BB-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('barang_kembali', 'id_barang_kembali', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_barang_kembali'] = $kode . $number;

            $this->template->load('templates/dashboard', 'barang_kembali/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('barang_kembali', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('barangkembali');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('barangkembali/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('barang_kembali', 'id_barang_kembali', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('barangkembali');
    }
}
