<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_pengajuancutipelaksana extends CI_Model {

    var $table = 'tbl_pengajuan_pns';
    // var $tabledata = 'tbl_data_pegawai';
    var $column_order = array(
        'nrpnip','nama','jabatan','masa_kerja','unit_kerja',
        'jenis_cuti','alasan','tgl_awal','tgl_akhir',
        'jmlh_cuti','sisa_cuti','alamat_cuti','telp','status'
    );
    var $column_search = array(
        'nrpnip','nama','jabatan','unit_kerja','jenis_cuti',
        'alamat_cuti','telp','status'
    ); 
    var $order = array('id_pns' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    private function _get_datatables_query()
    {
        // $this->db->select('a.*,b.nama,b.jabatan,b.masa_kerja,b.unit_kerja');
        // $this->db->from('tbl_pengajuan_pns as a');
        // $this->db->join('tbl_data_pegawai as b','a.id_pegawai=b.id_pegawai');
        $this->db->from($this->table);
        $i = 0;
    
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        
        // $this->db->from('tbl_pengajuan_pns as a');
        // $this->db->join('tbl_data_pegawai as b','a.id_pegawai=b.id_pegawai');
        $this->db->from('tbl_pengajuan_pns');
        return $this->db->count_all_results();
    }

    function getAll()
    {
        // $this->db->select('a.*,b.nama,b.jabatan,b.masa_kerja,b.unit_kerja');
        // $this->db->join('tbl_data_pegawai b','a.id_pegawai=b.id_pegawai');
       return $this->db->get('tbl_pengajuan_pns');
    }

    function view($id)
    {	
    	$this->db->where('id_pns',$id);
    	return $this->db->get('tbl_pengajuan_pns');
    }

    // function get_namapengajuancutipelaksana($nama){
    //     $this->db->from($this->table);
    //     $this->db->where('nama',$nama);
    //     $query = $this->db->get();

    //     return $query->row();
    // }

    function get_pengajuancutipelaksana($id)
    {   
        $this->db->where('id_pns',$id);
        return $this->db->get('tbl_pengajuan_pns')->row();
    }

    function edit($id)
    {	
    	$this->db->where('id_pns',$id);
    	return $this->db->get('tbl_pengajuan_pns');
    }

    function insert($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    // function insert_aksespengajuancutipelaksana($tbl_pengajuan_pns, $data)
    // {
    //     $insert = $this->db->insert($tbl_pengajuan_pns, $data);
    //     return $insert;
    // }

    function update($id, $data)
    {
        $this->db->where('id_pns', $id);
        $this->db->update('tbl_pengajuan_pns', $data);
    }

    //DELETE
    // function delete($id, $table)
    // {
    //     $this->db->where('id', $id);
    //     $this->db->delete($table);
    // }

    // function delete_aksespengajuancutipelaksana($id, $tbl_pengajuan_pns){
    //     $this->db->where('id', $id);
    //     $this->db->delete($tbl_pengajuan_pns);
    // }
}
