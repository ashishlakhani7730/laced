<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fpolicy extends CI_Controller {
	public function __construct() {
        parent::__construct();

        $this->load->model('m_aboutus');
    }
	
	public function index() {
		if($this->session->userdata('Admin_Id'))
		{
			$data['fpolicy'] = $this->m_aboutus->get_fpolicy($this->session->userdata('Admin_Id'));
			//print_r($data); exit;
			$this->load->view('fpolicy',$data);
		}
		else
		{
			redirect('login');
		}
    }
	
	public function addfpolicy() {
		
		if($this->session->userdata('Admin_Id'))
		{
			$add = $this->m_aboutus->insert_datafpolicy($this->session->userdata('Admin_Id'),$this->input->post('texteditor'),$this->input->post('exitsornot'));
			
			if($add)
			{
				$this->session->set_flashdata('message_fpolicy', 'Fees Policy Will be Added Successfully...');
				redirect("fpolicy");
			}
			else
			{
				$this->session->set_flashdata('message_fail_fpolicy', 'Something Wrong Please Try Again...');
				redirect("fpolicy");
			}
		}
		else
		{
			redirect('login');
		}
	}
}