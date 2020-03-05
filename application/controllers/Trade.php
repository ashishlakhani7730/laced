<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trade extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		$this->db->select("t.*,au.User_FullName as Request_send,auu.User_FullName as Requested_user,ai.Item_Name as have_item");
		$this->db->from("trade t");
		$this->db->join("auction_user au","t.User_id = au.User_Id");
		$this->db->join("auction_user auu","t.Receiver_Id = auu.User_Id");
		$this->db->join("auction_item ai","t.have_Item_Id = ai.Item_Id");
		$que = $this->db->get();
		
		$data['request_data'] = $que->result();
		//echo "<pre>";print_r($data);exit;
		$this->load->view("trade",$data);
	}
	
	public function getitems()
	{
		$id = $this->input->post("item_id");
		$this->db->select("*");
		$this->db->from("auction_item");
		$this->db->where('Item_Id in('.$id.')');
		$que = $this->db->get();
		$results = $que->result();
		//echo $this->db->last_query();
		echo json_encode($results);
	}
}