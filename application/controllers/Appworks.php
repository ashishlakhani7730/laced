<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Appworks extends CI_Controller {
	
	public function __construct() {
        parent::__construct();

        $this->load->model('m_aboutus');
    }
	
	public function index() {
		if($this->session->userdata('Admin_Id'))
		{
			$data['steps'] = $this->m_aboutus->get_step($this->session->userdata('Admin_Id'));
			//print_r($data); exit;
			$this->load->view('appworks',$data);
		}
		else
		{
			redirect('login');
		}
    }
	
	public function addstep() {
		
		if($this->session->userdata('Admin_Id'))
		{
			$add = $this->m_aboutus->insert_data($this->session->userdata('Admin_Id'),$this->input->post('texteditor'),$this->input->post('exitsornot'));
			
			if($add)
			{
				$this->session->set_flashdata('message_work', 'How To Work Will be Added Successfully...');
				redirect("appworks");
			}
			else
			{
				$this->session->set_flashdata('message_fail_work', 'Somthing Wrong Please Try Agian...');
				redirect("appworks");
			}
		}
		else
		{
			redirect('login');
		}
	}	
}