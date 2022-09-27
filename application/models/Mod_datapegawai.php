<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_datapegawai extends CI_Model
{
	var $table = 'tbl_data_pegawai';
    var $column_order = array('id_pegawai','nrpnip','nama','jabatan','masa_kerja','unit_kerja','image');
    var $column_search = array('nrpnip','nama','jabatan','masa_kerja','unit_kerja'); 
    var $order = array('id_pegawai' => 'desc'); // default order 
	
    function __construct()
	{
		parent::__construct();
        $this->load->database();
	}

	private function _get_datatables_query()
    {
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
        
        $this->db->from('tbl_data_pegawai');
        return $this->db->count_all_results();
    }

    function view($id)
    {   
        $this->db->where('id_pegawai',$id);
        return $this->db->get('tbl_data_pegawai');
    }

    function getAll()
    {
        return $this->db->get("tbl_data_pegawai");
    }

    function getdataAll()
    {
        $pegawai = $this->db->get('tbl_data_pegawai')->result();
        return $pegawai;
    }

    // function cekNipNrp($nrpnip)
    // {
    //     $this->db->where("nrpnip",$nrpnip);
    //     return $this->db->get("tbl_data_pegawai");
    // }

    function insert($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function getdatapegawai($id)
    {   
        $this->db->where("id_pegawai", $id);
        return $this->db->get("tbl_data_pegawai")->row();
    }

    function update($id, $data)
    {
        $this->db->where('id_pegawai', $id);
		$this->db->update('tbl_data_pegawai', $data);
    }

    function delete($id, $table)
    {
        $this->db->where('id_pegawai', $id);
        $this->db->delete($table);
    }

    // function deleteakses($id, $tbl_data_pegawai){
    //     $this->db->where('id_pegawai', $id);
    //     $this->db->delete($tbl_data_pegawai);
    // }

    function getImage($id)
    {
        $this->db->select('image');
        $this->db->from('tbl_data_pegawai');
        $this->db->where('id_pegawai', $id);
        return $this->db->get();
    }
}
