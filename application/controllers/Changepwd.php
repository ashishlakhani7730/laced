<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Changepwd extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('m_changepwd');
    }

    public function index() 
	{
		if($this->session->userdata('Admin_Id'))
		{
			$this->load->view('update_profile');
		}
		else
		{
			redirect('login');
		}
    }

    public function change_pass() 
	{
		if($this->session->userdata('Admin_Id'))
		{	
			$this->form_validation->set_rules('oldpassword', 'Old Password', 'required');
			$this->form_validation->set_rules('newpassword', 'New Password', 'required');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required');

			if($this->form_validation->run() == FALSE) 
			{
				$this->session->set_flashdata('fail_message', 'All Fildes Is Required');
				redirect("profile/index");
			}
			else
			{
				$oldpassword = $this->input->post('oldpassword');
				$newpassword = $this->input->post('newpassword');
				$cpassword = $this->input->post('cpassword');
				$Admin_Email=$this->input->post('Admin_Email');
				$Admin_Password = $this->session->userdata('Admin_Password');
				$Admin_Id=$this->session->userdata('Admin_Id');
				
				$check = $this->m_changepwd->check_name($Admin_Id,$oldpassword);
				if ($newpassword==$cpassword) {

					if(isset($Admin_Id))
					{
						if ($Admin_Password == md5($oldpassword)) {
                            $data = $this->m_changepwd->changepass($Admin_Id, md5($newpassword));
                            $this->session->set_flashdata('message', 'Password is changed Successfully');
                            redirect("changepwd/index");
                        } else {
                            $this->session->set_flashdata('fail_message', 'Old Password is Wrong');
                            redirect("changepwd/index");
                        }
					}
					else{
						$this->session->set_flashdata('fail_message', 'Password is Not Changed');
						redirect("changepwd/index");
					}
				
				}
				else
				{
					$this->session->set_flashdata('fail_message', 'Newpassword and Confirmpassword is Not same');
					redirect("changepwd/index");
				}
			}
		}
		else
		{
			redirect('login');
		}
    }
}