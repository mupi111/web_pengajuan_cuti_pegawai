<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Datapegawai extends MY_Controller
{
	function __construct()
    {
		parent::__construct();
		$this->load->model('Mod_datapegawai');
        $this->load->helper('url');
	}

	public function index()
    {
        $data['pegawai'] = $this->Mod_datapegawai->getAll();
		$this->template->load('layoutbackend', 'subbag/data_pegawai', $data);
	}

	    public function ajax_list()
    {
        ini_set('memory_limit','512M');
        set_time_limit(3600);
        $list = $this->Mod_datapegawai->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pegawai) {
            $no++;
            $row = array();
            $row[] = $pegawai->image;
            $row[] = $pegawai->nrpnip;
            $row[] = $pegawai->nama;
            $row[] = $pegawai->jabatan;
            $row[] = $pegawai->masa_kerja;
            $row[] = $pegawai->unit_kerja;
            $row[] = $pegawai->id_pegawai;
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mod_datapegawai->count_all(),
                        "recordsFiltered" => $this->Mod_datapegawai->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function insert()
    {
        $this->_validate();
            $nama = slug($this->input->post('nrpnip'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '1000';
            $config['max_width']     = '2000';
            $config['max_height']    = '1024';
            $config['file_name']     = $nama; 
            
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('imagefile')){
            $gambar = $this->upload->data();

			$save  = array(
                'nrpnip' => $this->input->post('nrpnip'),
                'nama' => $this->input->post('nama'),
                'jabatan' => $this->input->post('jabatan'),
                'masa_kerja' => $this->input->post('masa_kerja'),
                'unit_kerja' => $this->input->post('unit_kerja'),
                'image' => $gambar['file_name']
            );

            $this->Mod_datapegawai->insert("tbl_data_pegawai", $save);
            echo json_encode(array("status" => TRUE));
            }
            else{//Apabila tidak ada gambar yang di upload
                $save = array(
                'nrpnip'    => $this->input->post('nrpnip'),
                'nama'       => $this->input->post('nama'),
                'jabatan'    => $this->input->post('jabatan'),
                'masa_kerja' => $this->input->post('masa_kerja'),
                'unit_kerja' => $this->input->post('unit_kerja'),
                'image'     => $this->input->post(null),
            );
  
            $this->Mod_datapegawai->insert("tbl_data_pegawai", $save);
            echo json_encode(array("status" => TRUE));
            }
    }

    public function view()
    {
			$id = $this->input->post('id');
            $table = $this->input->post('table');
            $data['table'] = $table;
            $data['data_field'] = $this->db->field_data($table);
            $data['data_table'] = $this->Mod_datapegawai->view($id)->result_array();
            $this->load->view('subbag/view', $data);	
    }

    public function edit($id)
    {
            $data = $this->Mod_datapegawai->getdatapegawai($id);
            echo json_encode($data);
    }

        public function update()
    {
        if(!empty($_FILES['imagefile']['name'])) {
        // $this->_validate();
        $id = $this->input->post('id_pegawai');
        
        $nama = slug($this->input->post('nrpnip'));
        $config['upload_path']   = './assets/foto/user/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']      = '1000';
        $config['max_width']     = '2000';
        $config['max_height']    = '1024';
        $config['file_name']     = $nama; 
        
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('imagefile')){
            $gambar = $this->upload->data();
            $save  = array(
                'nrpnip' => $this->input->post('nrpnip'),
                'nama' => $this->input->post('nama'),
                'jabatan'  => $this->input->post('jabatan'),
                'masa_kerja' => $this->input->post('masa_kerja'),
                'unit_kerja' => $this->input->post('unit_kerja'),
                'image'  => $gambar['file_name']
            );
            
            $g = $this->Mod_datapegawai->getImage($id)->row_array();

            if ($g != null) {
                //hapus gambar yg ada diserver
                unlink('assets/foto/user/'.$g['image']);
            }
           
            $this->Mod_datapegawai->update($id, $save);
            echo json_encode(array("status" => TRUE));
            }else{//Apabila tidak ada gambar yang di upload
                $save  = array(
                'nrpnip' => $this->input->post('nrpnip'),
                'nama' => $this->input->post('nama'),
                'jabatan'  => $this->input->post('jabatan'),
                'masa_kerja' => $this->input->post('masa_kerja'),
                'unit_kerja' => $this->input->post('unit_kerja')
            );
                $this->Mod_datapegawai->update($id, $save);
                echo json_encode(array("status" => TRUE));
            }
        }else{
            // $this->_validate();
            $id_pegawai = $this->input->post('id_pegawai');
            $save  = array(
                'nrpnip' => $this->input->post('nrpnip'),
                'nama' => $this->input->post('nama'),
                'jabatan'  => $this->input->post('jabatan'),
                'masa_kerja' => $this->input->post('masa_kerja'),
                'unit_kerja' => $this->input->post('unit_kerja')
            );
            $this->Mod_datapegawai->update($id_pegawai, $save);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function delete(){
        $id = $this->input->post('id');
        $g = $this->Mod_datapegawai->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/'.$g['image']);
        }
        $this->Mod_datapegawai->delete($id, 'tbl_data_pegawai');
        $data['status'] = TRUE;
        echo json_encode($data);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nrpnip') == '')
        {
            $data['inputerror'][] = 'nrpnip';
            $data['error_string'][] = 'NIP/NRP Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('jabatan') == '')
        {
            $data['inputerror'][] = 'jabatan';
            $data['error_string'][] = 'Jabatan Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('masa_kerja') == '')
        {
            $data['inputerror'][] = 'masa_kerja';
            $data['error_string'][] = 'Masa Kerja Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('unit_kerja') == '')
        {
            $data['inputerror'][] = 'unit_kerja';
            $data['error_string'][] = 'Unit Kerja Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function pdf()
    {
        // $menu = $this->Mod_datapegawai->getAll()->result();
        // $this->load->view('subbag/pdfdatapegawai', $menu);
        $data['pegawai'] = $this->Mod_datapegawai->getAll()->result();
        $this->load->view('subbag/pdfpegawai', $data);
    }


     public function excel()
        {  
            $this->load->model('Mod_datapegawai');
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'NIP/NRP');
            $sheet->setCellValue('C1', 'Nama');
            $sheet->setCellValue('D1', 'Jabatan');
            $sheet->setCellValue('E1', 'Masa Kerja');
            $sheet->setCellValue('F1', 'Unit Kerja');
            // $sheet->setCellValue('G1', 'Foto');
            
            $menu = $this->Mod_datapegawai->getdataAll();
            $no = 1;
            $x = 2;
            foreach($menu as $row){
                $sheet->setCellValue('A' . $x, $no++);
                $sheet->setCellValue('B' . $x, $row->nrpnip);
                $sheet->setCellValue('C' . $x, $row->nama);
                $sheet->setCellValue('D' . $x, $row->jabatan);
                $sheet->setCellValue('E' . $x, $row->masa_kerja);
                $sheet->setCellValue('F' . $x, $row->unit_kerja);
                // $sheet->setCellValue('G' . $x, $row->image);
                $x++;
            }
            $writer = new Xlsx($spreadsheet);
            $filename = 'Laporan Data Pegawai';
            
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
            header('Cache-Control: max-age=0');
    
            $writer->save('php://output');
        }
}