<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pengajuancutikontrak extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_pengajuancutikontrak'));
    }

    public function index()
    {
        $this->template->load('layoutbackend', 'kontrak/pengajuancuti_kontrak');
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_pengajuancutikontrak->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cuti) {
            $no++;
            $row = array();
            $row[] = $cuti->nrpnip;
            $row[] = $cuti->nama;
            $row[] = $cuti->unit_kerja;
            $row[] = $cuti->keperluan;
            $row[] = $cuti->tgl_awal;
            $row[] = $cuti->tgl_akhir;
            $row[] = $cuti->status;
            $row[] = $cuti->id_ppnpn;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_pengajuancutikontrak->count_all(),
            "recordsFiltered" => $this->Mod_pengajuancutikontrak->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
    public function insert()
    {
        $this->_validate();
        $save  = array(
            'nrpnip'        => $this->input->post('nrpnip'),
            'nama'          => $this->input->post('nama'),
            'unit_kerja'    => $this->input->post('unit_kerja'),
            'keperluan'     => $this->input->post('keperluan'),
            'tanggal_awal'  => $this->input->post('tgl_awal'),
            'tanggal_akhir' => $this->input->post('tgl_akhir')
        );
        $this->Mod_pengajuancutikontrak->insert("tbl_pengajuan_kontrak", $save);
        echo json_encode(array("status" => TRUE));
    }

    public function view()
    {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $data['table'] = $table;
        $data['data_field'] = $this->db->field_data($table);
        $data['data_table'] = $this->Mod_pengajuancutikontrak->view($id)->result_array();
        $this->load->view('kontrak/view', $data);
    }

    public function edit($id)
    {
        $data = $this->Mod_pengajuancutikontrak->get_pengajuancutikontrak($id);
        echo json_encode($data);
    }

    public function update()
    {
        $this->_validate();
        $id        = $this->input->post('id');
        $save  = array(
            'nrpnip'       => $this->input->post('nrpnip'),
            'nama'         => $this->input->post('nama'),
            'unit_kerja'   => $this->input->post('unit_kerja'),
            'keperluan'    => $this->input->post('keperluan'),
            'tgl_awal'     => $this->input->post('tgl_awal'),
            'tgl_akhir'    => $this->input->post('tgl_akhir')
        );
        $this->Mod_pengajuancutikontrak->update($id, $save);
        echo json_encode(array("status" => TRUE));
    }

    //===KHUSUS PEGAWAI===//
    public function add()
    {
        $this->load->view('pengajuancuti_kontrak/add');
    }

    // public function delete()
    // {
    //     $id = $this->input->post('id');
    //     $this->Mod_pengajuancutikontrak->delete($id, 'tbl_pengajuan_kontrak');
    //     echo json_encode(array("status" => TRUE));
    // }

    //===end khusus pegawai===//

    public function excel()
    {

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nomor');
        $sheet->setCellValue('C1', 'NIP/NRP');
        $sheet->setCellValue('D1', 'Nama');
        $sheet->setCellValue('E1', 'Jenis Cuti');
        $sheet->setCellValue('F1', 'Tanggal');
        $sheet->setCellValue('G1', 'Alasan');
        $sheet->setCellValue('H1', 'Tgl Awal');
        $sheet->setCellValue('I1', 'Tgl Akhir');
        $sheet->setCellValue('J1', 'Jumlah Cuti');
        $sheet->setCellValue('K1', 'Catatan Cuti');
        $sheet->setCellValue('L1', 'Alamat Selama Cuti');
        $sheet->setCellValue('M1', 'No Telepon');
        $sheet->setCellValue('N1', 'Status');

        $menu = $this->Mod_pengajuancutikontrak->getAll()->result();
        $no = 1;
        $x = 2;
        foreach ($menu as $row) {
            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row->nomor);
            $sheet->setCellValue('C' . $x, $row->nrpnip);
            $sheet->setCellValue('D' . $x, $row->nama);
            $sheet->setCellValue('E' . $x, $row->jenis_cuti);
            $sheet->setCellValue('F' . $x, $row->tgl);
            $sheet->setCellValue('G' . $x, $row->alasan);
            $sheet->setCellValue('H' . $x, $row->tgl_awal);
            $sheet->setCellValue('I' . $x, $row->tgl_akhir);
            $sheet->setCellValue('J' . $x, $row->jmlh_cuti);
            $sheet->setCellValue('K' . $x, $row->ctnn_cuti);
            $sheet->setCellValue('L' . $x, $row->alamat_cuti);
            $sheet->setCellValue('M' . $x, $row->telp);
            $sheet->setCellValue('N' . $x, $row->status);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan Pengajuan Cuti Pegawai Kontrak';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function pdf()
    {
        $menu = $this->Mod_pengajuancutikontrak->getAll()->result();
        $this->load->view('kontrak/pdfkontrak', $menu);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nrpnip') == '') {
            $data['inputerror'][] = 'nrpnip';
            $data['error_string'][] = 'NRP/NIP Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nama') == '') {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('unit_kerja') == '') {
            $data['inputerror'][] = 'unit_kerja';
            $data['error_string'][] = 'Unit Kerja Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('keperluan') == '') {
            $data['inputerror'][] = 'keperluan';
            $data['error_string'][] = 'Keperluan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tgl_awal') == '') {
            $data['inputerror'][] = 'tanggal_awal';
            $data['error_string'][] = 'Isi Tanggal Awal Cuti';
            $data['status'] = FALSE;
        }

        if ($this->input->post('tgl_akhir') == '') {
            $data['inputerror'][] = 'tanggal_akhir';
            $data['error_string'][] = 'Isi Tanggal Akhir Cuti';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
