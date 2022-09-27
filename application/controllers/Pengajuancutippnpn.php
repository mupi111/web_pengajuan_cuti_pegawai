<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pengajuancutippnpn extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_pengajuancutippnpn'));
    }

    public function index()
    {
        $this->template->load('layoutbackend', 'subbag/pengajuancuti_ppnpn');
    }

    public function ajax_list()
    {
        ini_set('memory_limit', '512M');
        set_time_limit(3600);
        $list = $this->Mod_pengajuancutippnpn->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cuti) {
            $form = "
                <form action=".site_url('pengajuancutippnpn/status')." method='post'>
                    <input type='hidden' name ='id_ppnpn' value =".$cuti->id_ppnpn.">
                    <select name='change' class='form-control pilih-status'>
                        <option ".($cuti->status == "Belum Dikonfirmasi" ? "selected" : "")." value='Belum Dikonfirmasi'>Belum Dikonfirmasi</option>
                        <option ".($cuti->status == "Disetujui" ? "selected" : "")." value='Disetujui'>Disetujui</option>
                        <option ".($cuti->status == "Perubahan" ? "selected" : "")." value='Perubahan'>Perubahan</option>
                        <option ".($cuti->status == "Ditangguhkan" ? "selected" : "")." value='Ditangguhkan'>Ditangguhkan</option>
                        <option ".($cuti->status == "Tidak Disetujui" ? "selected" : "")." value='Tidak Disetujui'>Tidak Disetujui</option>
                    </select>
                    <button type='submit' class='btn btn-primary d-none ubah-status'>Konfirmasi</button>
                </form>";
            $no++;
            $row = array();
            $row[] = $cuti->nrpnip;
            $row[] = $cuti->nama;
            $row[] = $cuti->unit_kerja;
            $row[] = $cuti->keperluan;
            $row[] = $cuti->tgl_awal;
            $row[] = $cuti->tgl_akhir;
            $row[] = $form;
            $row[] = $cuti->id_ppnpn;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_pengajuancutippnpn->count_all(),
            "recordsFiltered" => $this->Mod_pengajuancutippnpn->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function status()
    {
         // 
         $this->db->update("tbl_pengajuan_ppnpn",[
            'status' => $this->input->post('change')
        ],[
            'id_ppnpn' => $this->input->post('id_ppnpn')
        ]);

        redirect(base_url("pengajuancutippnpn"));
    }

    // public function insert()
    // {
    //     $this->_validate();
    //     $save  = array(
    //         'nrpnip'     => $this->input->post('nrpnip'),
    //         'nama'        => $this->input->post('nama'),
    //         'jabatan'     => $this->input->post('jabatan'),
    //         'masa_kerja'  => $this->input->post('masa_kerja'),
    //         'unit_kerja'  => $this->input->post('unit_kerja'),
    //         'jenis_cuti'  => $this->input->post('jenis_cuti'),
    //         'alasan'      => $this->input->post('alasan'),
    //         'tgl_awal'    => $this->input->post('tgl_awal'),
    //         'tgl_akhir'   => $this->input->post('tgl_akhir'),
    //         'jmlh_cuti'   => $this->input->post('jmlh_cuti'),
    //         'sisa_cuti'   => $this->input->post('sisa_cuti'),
    //         'alamat_cuti' => $this->input->post('alamat_cuti'),
    //         'telp'        => $this->input->post('telp')
    //         // 'status'         => $this->input->post('status')
    //     );
    //     $this->Mod_pengajuancutippnpn->insert("tbl_pengajuan_pelaksana", $save);
    //     echo json_encode(array("status" => TRUE));
    // }

    public function view()
    {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $data['table'] = $table;
        $data['data_field'] = $this->db->field_data($table);
        $data['data_table'] = $this->Mod_pengajuancutippnpn->view($id)->result_array();
        $this->load->view('subbag/view', $data);
    }

    // public function edit($id)
    // {
    //     $data = $this->Mod_pengajuancutippnpn->get_pengajuancutippnpn($id);
    //     echo json_encode($data);
    // }

    public function update()
    {
        $this->_validate();
        $id        = $this->input->post('id');
        $save  = array(
            'nrpnip'      => $this->input->post('nrpnip'),
            'nama'        => $this->input->post('nama'),
            'unit_kerja'  => $this->input->post('unit_kerja'),
            'alasan'      => $this->input->post('keperluan'),
            'tgl_awal'    => $this->input->post('tgl_awal'),
            'tgl_akhir'   => $this->input->post('tgl_akhir'),
            'status'      => $this->input->post('status')
        );
        $this->Mod_pengajuancutippnpn->update($id, $save);
        echo json_encode(array("status" => TRUE));
    }

    // public function add()
    // {
    //     $this->load->view('pengajuancutippnpn/add');
    // }
   
    // public function delete()
    // {
    //     $id = $this->input->post('id');
    //     $this->Mod_pengajuancutippnpn->delete($id, 'tbl_pengajuan_pelaksana');
    //     echo json_encode(array("status" => TRUE));
    // }

    public function excel()
    {

        $this->load->model('Mod_pengajuancutippnpn');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIP/NRP');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Unit Kerja');
        $sheet->setCellValue('E1', 'Keperluan');
        $sheet->setCellValue('F1', 'Tgl Awal');
        $sheet->setCellValue('G1', 'Tgl Akhir');
        $sheet->setCellValue('H1', 'Status');

        $menu = $this->Mod_pengajuancutippnpn->getdataAll();
        $no = 1;
        $x = 2;
        foreach ($menu as $row) {
            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row->nrpnip);
            $sheet->setCellValue('C' . $x, $row->nama);
            $sheet->setCellValue('D' . $x, $row->unit_kerja);
            $sheet->setCellValue('E' . $x, $row->keperluan);
            $sheet->setCellValue('F' . $x, $row->tgl_awal);
            $sheet->setCellValue('G' . $x, $row->tgl_akhir);
            $sheet->setCellValue('H' . $x, $row->status);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan Pengajuan Cuti PPNPN';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function pdf()
    {
        // $menu = $this->Mod_pengajuancutippnpn->getAll()->result();
        // $this->load->view('ppnpn/pdfppnpn', $menu);
        if(isset($_GET['id']) ){
            $data['pegawai'] = $this->db->get_where("tbl_pengajuan_ppnpn",['id_ppnpn'=>$this->input->get('id')])->row_array();
            $this->load->view('subbag/pdfppnpn', $data);
        }else{
            $data['pegawai'] = $this->Mod_pengajuancutippnpn->getAll()->result();
            $this->load->view('subbag/pdfpegawaippnpn', $data);
        }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nrpnip') == '')
        {
            $data['inputerror'][] = 'nap_nrp';
            $data['error_string'][] = 'NIP/NRP Tidak Boleh Kosong';
            $data['minlength'] = '2';
            $data['status'] = FALSE;
        }

        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama Tidak Boleh Kosong';
            $data['minlength'] = '2';
            $data['status'] = FALSE;
        }

        if($this->input->post('unit_kerja') == '')
        {
            $data['inputerror'][] = 'unit_kerja';
            $data['error_string'][] = 'Unit Kerja Tidak Boleh Kosong';
            $data['minlength'] = '2';
            $data['status'] = FALSE;
        }

        if($this->input->post('keperluan') == '')
        {
            $data['inputerror'][] = 'keperluan';
            $data['error_string'][] = 'Keperluan Tidak Boleh Kosong';
            $data['minlength'] = '2';
            $data['status'] = FALSE;
        }
    
        if($this->input->post('tgl_awal') == '')
        {
            $data['inputerror'][] = 'tgl_awal';
            $data['error_string'][] = 'Isi Tanggal Awal Cuti';
            $data['minlength'] = '2';
            $data['status'] = FALSE;
        }

        if($this->input->post('tgl_akhir') == '')
        {
            $data['inputerror'][] = 'tgl_akhir';
            $data['error_string'][] = 'Isi Tanggal Akhir Cuti';
            $data['minlength'] = '2';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}