<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_commission extends CI_Controller {
	
	public function __construct() {
        parent::__construct();

        $this->load->model('m_product_commission');
    }
	
	public function index() {
		if($this->session->userdata('Admin_Id'))
		{
			$data['charge'] = $this->m_product_commission->getcommcharge();
			$data['comlist'] = $this->m_product_commission->getproductcommissionlist();
			//echo "<pre>";print_r($data['comlist']); exit;
			
			
			$this->load->view('product_commission',$data);
			
		}
		else
		{
			redirect('login');
		}
    }

	public function addcommission()
	{
		if($this->session->userdata('Admin_Id'))
		{
			$this->form_validation->set_rules('procommission', 'Product Commission', 'required|regex_match[/^[1-9][0-9]*$/]',array('regex_match'=>'Enter Only Number In Product Commission In Percentage Also Not Allow 0 value!'));
			
			
			if($this->form_validation->run() == FALSE) 
			{
				$data['charge'] = $this->m_product_commission->getcommcharge();
				$this->load->view('product_commission',$data);
			}
			else
			{
				if($this->input->post('Pcc_Id'))
				{
					$data = array(
									'comm_charge' => $this->input->post('procommission'),
									'Pcc_Id' => $this->input->post('Pcc_Id')
							);
							
					$add = $this->m_product_commission->updateprocomm($data);
					
					if($add)
					{
						$this->session->set_flashdata('message_com', 'Your Product Commission Updated Successfully!');
						redirect('product_commission');
					}
					else
					{
						$this->session->set_flashdata('fail_message_com', 'Something Went to Wrong Please Try Again!');
						redirect('product_commission');
					}
				}
				else
				{
					
						$data = array(
									'comm_charge' => $this->input->post('procommission'),
									'Pcc_Id' => $this->input->post('Pcc_Id')
							);
							
						$add = $this->m_product_commission->addprocomm($data);
						
						if($add)
						{
							$this->session->set_flashdata('message_com', 'Your Product Commission Added Successfully!');
							redirect('product_commission');
						}
						else
						{
							$this->session->set_flashdata('fail_message_com', 'Something Went to Wrong Please Try Again!');
							redirect('product_commission');
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