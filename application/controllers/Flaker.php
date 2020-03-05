<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Flaker extends CI_Controller {
	
	public function __construct() {
        parent::__construct();

        $this->load->model('m_flaker');
    }
	
	public function index() {
		if($this->session->userdata('Admin_Id'))
		{
			$data['fcid'] = $this->m_flaker->getflakercharge();
			$data['flaker_list'] = $this->m_flaker->getflakerchargeslist();
			//echo "<pre>"; print_r($data['flaker_list']); exit;
			
			
			$this->load->view('flaker',$data);
			
		}
		else
		{
			redirect('login');
		}
    }

	public function addflaker()
	{
		if($this->session->userdata('Admin_Id'))
		{
			$this->form_validation->set_rules('flackerfees', 'Flaker Fees', 'required|regex_match[/^[1-9][0-9]*$/]',array('regex_match'=>'Enter Only Number In Flaker Fees In Percentage Also Not Allow 0 value!'));
			$this->form_validation->set_rules('Fc_Id', 'Fc_Id', 'required|regex_match[/[0-9]/]',array('regex_match'=>'Something Went to Wrong!'));
			
			if($this->form_validation->run() == FALSE) 
			{
				$data['fcid'] = $this->m_flaker->getflakercharge();
				$this->load->view('flaker',$data);
			}
			else
			{
				if($this->input->post('Fc_Id'))
				{
					$data = array(
									'flate_fee' => $this->input->post('flackerfees'),
									'Fc_ID' => $this->input->post('Fc_Id'),
									'Admin_Id' => $this->session->userdata('Admin_Id')
							);
							
					$add = $this->m_flaker->updateflakercharge($data);
					
					if($add)
					{
						$this->session->set_flashdata('message_flaker', 'Your Flaker Charge Updated Successfully!');
						redirect('flaker');
					}
					else
					{
						$this->session->set_flashdata('fail_message_flaker', 'Something Went to Wrong Please Try Again!');
						redirect('flaker');
					}
				}
				else
				{
					$data = array(
									'flate_fee' => $this->input->post('flackerfees'),
									'Fc_Id' => $this->input->post('Fc_Id'),
									'Admin_Id' => $this->session->userdata('Admin_Id')
							);
							
					$add = $this->m_flaker->addflakercharge($data);
					
					if($add)
					{
						$this->session->set_flashdata('message_flaker', 'Your Flaker Charge Added Successfully!');
						redirect('flaker');
					}
					else
					{
						$this->session->set_flashdata('fail_message_flaker', 'Something Went to Wrong Please Try Again!');
						redirect('flaker');
					}
				}
			}
		}
		else
		{
			redirect('login');
		}
	}
}