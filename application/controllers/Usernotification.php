<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usernotification extends CI_Controller {
	
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
			$this->db->where("Admin_Id","0");
			$this->db->order_by("Notification_Id","desc");

			$query =  $this->db->get();
			$data['noti_list'] = $query->result();


			$this->load->view('usernotification',$data);
		}
	}
	public function delete_data() {
		$this->load->model("m_aboutus");
        if ($this->session->userdata('Admin_Id')) {
            $feedback = $this->m_aboutus->delete_notification($this->uri->segment(3));
            $this->session->set_flashdata('message', 'Notification Delete Successfully...');
            redirect("Usernotification/index");
        }
    }
}