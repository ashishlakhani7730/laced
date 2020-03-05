<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Viewnotifications extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		if($this->session->userdata('Admin_Id'))
		{
			$this->db->select("no.*,us.*");
			$this->db->from("notification no");
			$this->db->join("auction_user us","us.User_Id = no.User_Id");
			$this->db->where("Admin_Id","1");
			$this->db->order_by("Notification_Id","desc");

			$query =  $this->db->get();
			$data['noti_list'] = $query->result();


			$this->load->view('viewnotification',$data);
		}
	}
}