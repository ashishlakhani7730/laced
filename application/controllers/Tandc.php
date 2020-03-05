<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tandc extends CI_Controller {
	
	public function __construct() {
        parent::__construct();

        $this->load->model('m_aboutus');
    }
	
	public function index() {
		if($this->session->userdata('Admin_Id'))
		{
			$data['terms'] = $this->m_aboutus->get_trems($this->session->userdata('Admin_Id'));
			//print_r($data); exit;
			$this->load->view('tandc',$data);
		}
		else
		{
			redirect('login');
		}
    }
	
	public function addtermscondition() {
		
		if($this->session->userdata('Admin_Id'))
		{
			$add = $this->m_aboutus->insert_datatrems($this->session->userdata('Admin_Id'),$this->input->post('texteditor'),$this->input->post('exitsornot'));
			
			if($add)
			{
				$this->session->set_flashdata('message_tanc', 'Terms and Condition Will be Added Successfully...');
				redirect("tandc");
			}
			else
			{
				$this->session->set_flashdata('message_fail_tandc', 'Something Wrong Please Try Again...');
				redirect("tandc");
			}
		}
		else
		{
			redirect('login');
		}
	}

}