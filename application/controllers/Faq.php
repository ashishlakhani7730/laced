<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {
	
	public function __construct() {
        parent::__construct();

        $this->load->model('m_aboutus');
    }
	
	public function index() {
		$this->load->view('faq');
	}
	
	public function faqlist()
	{
		if($this->session->userdata('Admin_Id'))
		{
			$adminid = $this->session->userdata('Admin_Id');
			
			for($i = 0 ; $i < count($this->input->post('quetion')) ; $i++)
			{
				$this->m_aboutus->addqueans($this->input->post('quetion')[$i],$this->input->post('answer')[$i],$adminid);
			}
			
			$this->session->set_flashdata('message_faq', 'FAQ Will be Added Successfully...');
			redirect("faq");
			
		}
		else
		{
			redirect('login');
		}
	}
	
	public function dis_list()
	{
		if($this->session->userdata('Admin_Id'))
		{
			$this->db->select("*");
			$this->db->from('faq');
			$query = $this->db->get(); 
			$data['list'] = $query->result();
			
			//echo "<pre>";print_r($data['list']); exit;
			$this->load->view("faqlist",$data);
		}
		else
		{
			redirect('login');
		}
	}
	
	public function delete_faq()
	{
		if($this->session->userdata('Admin_Id'))
		{
			//print_r($this->uri->segment(3)); exit;
			if($this->uri->segment(3))
			{
				$rdata = $this->m_aboutus->delete_faq($this->uri->segment(3));
		
				if($rdata)
				{
					$this->session->set_flashdata('message_faq_list', 'FAQ Will be Deleted Successfully...');
					$this->dis_list();
				}
				else
				{
					$this->session->set_flashdata('message_fail__faq_list', 'FAQ Deleted Operation Something Wrong Please Try Again!');
					$this->dis_list();
				}
			}
			else
			{
				$this->dis_list();
			}
		}
		else
		{
			redirect('login');
		}
	}
	
	public function update_faq()
	{
		if($this->session->userdata('Admin_Id'))
		{
			if($this->uri->segment(3))
			{
				$this->db->select("*");
				$this->db->from('faq');
				$this->db->where('F_Id',$this->uri->segment(3));
				$query = $this->db->get(); 
				$data['datas'] = $query->result();
			
				//print_r($data['datas']); exit;
				$this->load->view("faqupdate",$data);
			}
			else
			{
				$this->dis_list();
			}
		}
		else
		{
			redirect('login');
		}
	}
	
	public function finally_update_faq()
	{
		if($this->session->userdata('Admin_Id'))
		{
			$data = array(
						'question' => $this->input->post('quetion'),
						'answer' => $this->input->post('answer'),
						'Admin_Id' => $this->session->userdata('Admin_Id')
					);
					
			$rudata = $this->m_aboutus->update_faq($data,$this->input->post('uid'));
		
			if($rudata)
			{
				$this->session->set_flashdata('message_faq_list_1', 'FAQ Will be Updated Successfully...');
				$this->dis_list();
			}
			else
			{
				$this->session->set_flashdata('message_fail__faq_list', 'FAQ Updated Operation Something Wrong Please Try Again!');
				$this->dis_list();
			}
		}
		else
		{
			redirect('login');
		}
	}

}