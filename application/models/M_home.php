<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {

	public function get_totaluser()
	{
		$this->db->select("count(User_Id)");
		//$this->db->from("auction_item");
		$query = $this->db->get("auction_user");
		$cnt = $query->row_array();
		return $cnt['count(User_Id)'];
	}

	public function get_activeuser()
	{
		$this->db->select("count(User_Status)");
		$this->db->from("auction_user");
		$this->db->where("User_Status","1");
		$query = $this->db->get();
		$cnt = $query->row_array();
		return $cnt['count(User_Status)'];
	}

	public function get_usernot()
	{
		$this->db->select("count(Admin_Id)");
		$this->db->from("notification");
		$this->db->where("Admin_Id","0");
		$query = $this->db->get();
		$cnt = $query->row_array();
		return $cnt['count(Admin_Id)'];
	}

	public function get_adminnot()
	{
		$this->db->select("count(Admin_Id)");
		$this->db->from("notification");
		$this->db->where("Admin_Id","1");
		$query = $this->db->get();
		$cnt = $query->row_array();
		return $cnt['count(Admin_Id)'];
	}

    public function get_totalproduct()
    {
    	$this->db->select("count(Item_Id)");
		//$this->db->from("auction_item");
		$query = $this->db->get("auction_item");
		$cnt = $query->row_array();
		return $cnt['count(Item_Id)'];
    }

    public function get_instabuyproduct()
    {
    	$this->db->select("count(Item_Type)");
		$this->db->from("auction_item");
		$this->db->where("Item_Type","1");
		$query = $this->db->get();
		$cnt = $query->row_array();
		return $cnt['count(Item_Type)'];
    }

    public function get_tradeproduct()
    {
    	$this->db->select("count(Item_Type)");
		$this->db->from("auction_item");
		$this->db->where("Item_Type","2");
		$query = $this->db->get();
		$cnt = $query->row_array();
		return $cnt['count(Item_Type)'];
    }

    public function get_auctionproduct()
    {
    	$this->db->select("count(Item_Type)");
		$this->db->from("auction_item");
		$this->db->where("Item_Type","3");
		$query = $this->db->get();
		$cnt = $query->row_array();
		return $cnt['count(Item_Type)'];
    }

    public function get_approved()
    {
    	$this->db->select("count(Item_Status)");
		$this->db->from("auction_item");
		$this->db->where("Item_Status","1");
		$query = $this->db->get();
		$cnt = $query->row_array();
		return $cnt['count(Item_Status)'];
    }

    public function get_pending_for_approved()
    {
    	$this->db->select("count(Item_Status)");
		$this->db->from("auction_item");
		$this->db->where("Item_Status","0");
		$query = $this->db->get();
		$cnt = $query->row_array();
		return $cnt['count(Item_Status)'];
    }

    public function get_totalorder()
    {
    	$this->db->select("count(Order_Id)");
		$this->db->from("auction_user_order");
		$query = $this->db->get();
		$cnt = $query->row_array();
		return $cnt['count(Order_Id)'];
    }


    public function get_ratingratio()
    {
    	$this->db->select("sum(ratingnumber),count(ratingnumber)");
		$this->db->from("rateus");
		$query = $this->db->get();
		$cnt = $query->row_array();
		
		return ($cnt['count(ratingnumber)'] != '0' ?($cnt['sum(ratingnumber)'] / $cnt['count(ratingnumber)']):0);
    }

    public function get_referaluser()
    {
    	$this->db->select("count(R_Id)");
		$this->db->from("referrals");
		$this->db->where("usedcode","1");
		$query = $this->db->get();
		$cnt = $query->row_array();
		return $cnt['count(R_Id)'];
    }
}