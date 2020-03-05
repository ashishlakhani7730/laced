<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_brand extends CI_Model {
	
	public function add_brand($data)
    {
		
		$this->db->set('created', 'NOW()', FALSE);
		$this->db->insert('auction_brand',$data);

		return true;
    }

    public function get_brand()
    {
    	$this->db->select("*");
		$this->db->from("auction_brand");	
		$this->db->order_by("Brand_Id","desc");
		$query = $this->db->get();

		return $query->result();
    }
    public function delete_brand($Brand_Id) {
        $this->db->where('Brand_Id', $Brand_Id);
        $this->db->delete("auction_brand");

       
    }

    public function update_brand($data,$bid)
    {
    	$this->db->set('modified', 'NOW()', FALSE);
    	$this->db->where("Brand_Id",$bid);
		$this->db->update('auction_brand',$data);

		return true;
    }
    public function edit_data($Brand_Id) {
        $query = $this->db->query("select * from auction_brand where Brand_Id='$Brand_Id'");
        return $query->row_array();
    }
}