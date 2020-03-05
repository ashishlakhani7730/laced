<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_product_commission extends CI_Model {

	public function addprocomm($data)
	{
		$this->db->set('created', 'NOW()', FALSE);
		$this->db->insert('product_commission_charge',$data);
		
		return true;
	}
	
	public function updateprocomm($data)
	{
		$this->db->set('modified', 'NOW()', FALSE);
		$this->db->where('Pcc_Id',$data['Pcc_Id']);
		$this->db->update('product_commission_charge',$data);
		
		return true;
	}
	
	public function getcommcharge()
	{
		$this->db->select("*");
		$this->db->from("product_commission_charge");
		
		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return $row;
		}
	}
	
	public function getproductcommissionlist()
	{
		$this->db->select("au.User_Name,pc.product_price,pc.product_commission_rate,pc.product_commission,ai.Item_Name,ai.Item_FrontPicture");
		$this->db->from("product_commission pc");
		$this->db->join("auction_item ai","pc.Item_Id = ai.Item_Id");
		$this->db->join("auction_user au","pc.User_Id = au.User_Id");

		$query = $this->db->get();

		return $query->result();
	}
}