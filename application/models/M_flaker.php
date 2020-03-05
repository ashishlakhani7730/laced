<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_flaker extends CI_Model {

	public function addflakercharge($data)
	{
		$this->db->set('created', 'NOW()', FALSE);
		$this->db->insert('flakercharge',$data);
		
		return true;
	}
	
	public function updateflakercharge($data)
	{
		$this->db->set('modified', 'NOW()', FALSE);
		$this->db->where('Fc_ID',$data['Fc_ID']);
		$this->db->update('flakercharge',$data);
		
		return true;
	}
	
	public function getflakercharge()
	{
		$this->db->select("*");
		$this->db->from("flakercharge");
		
		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return $row;
		}
	}

	public function getflakerchargeslist()
	{
		$this->db->select("au.User_Name,ff.product_price,ff.percentage,ff.fees,ff.cutfees,ai.Item_Name,ai.Item_FrontPicture");
		$this->db->from("flakerfees ff");
		$this->db->join("auction_item ai","ff.Item_Id = ai.Item_Id");
		$this->db->join("auction_user au","ff.User_Id = au.User_Id");

		$query = $this->db->get();

		return $query->result();
	}
}