<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ppolicy extends CI_Controller {
	public function __construct() {
        parent::__construct();

        $this->load->model('m_aboutus');
    }
	
	public function index() {
		if($this->session->userdata('Admin_Id'))
		{
			$data['policy'] = $this->m_aboutus->get_ppolicy($this->session->userdata('Admin_Id'));
			//print_r($data); exit;
			$this->load->view('ppolicy',$data);
		}
		else
		{
			redirect('login');
		}
    }
	
	public function addppolicy() {
		
		if($this->session->userdata('Admin_Id'))
		{
			$add = $this->m_aboutus->insert_datappolicy($this->session->userdata('Admin_Id'),$this->input->post('texteditor'),$this->input->post('exitsornot'));
			
			if($add)
			{
				$this->session->set_flashdata('message_ppolicy', 'Privacy Policy Will be Added Successfully...');
				redirect("ppolicy");
			}
			else
			{
				$this->session->set_flashdata('message_fail_ppolicy', 'Something Wrong Please Try Again...');
				redirect("ppolicy");
			}
		}
		else
		{
			redirect('login');
		}
	}
}