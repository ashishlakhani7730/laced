<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller 
{
    public function __construct() {
        parent::__construct();

        $this->load->model("m_profile");
    }

    public function index() {
		if($this->session->userdata('Admin_Id'))
		{
			$Admin_Id = $this->session->userdata('Admin_Id');

			$data['update_data'] = $this->m_profile->edit_data($Admin_Id);
			$data['update_profile'] = $this->m_profile->edit_data($Admin_Id);
			$data['admin_list'] = $this->m_profile->get_admin();
			$this->load->view('update_profile', $data);
		}
		else
		{
			redirect('login');
		}
    }

    public function editp() {
		if($this->session->userdata('Admin_Id'))
		{
			date_default_timezone_set("Asia/Kolkata");
			$modified = date("Y-m-d H:i:s");
			
			$this->m_profile->update_data($_POST['Admin_Id'], $_POST['Admin_UserName'], $_POST['Admin_Email'], $_POST['Admin_Phone'], $_POST['Admin_Address'], $modified);

			$this->session->set_flashdata('message1', 'Admin edit Successfully..');
			redirect("profile/index");
		}
		else
		{
			redirect('login');
		}
    }

    public function edit_data() {
		if($this->session->userdata('Admin_Id'))
		{
			$Admin_Id = $this->session->userdata('Admin_Id');
			$data['update_profile'] = $this->m_profile->edit_profile($Admin_Id);

			$data['update_data'] = $this->m_profile->edit_data($Admin_Id);



			$data['admin_list'] = $this->m_profile->get_admin();
			$this->load->view('update_profile', $data);
		}
		else
		{
			redirect('login');
		}
    }
    public function change_profile() {
        if ($this->session->userdata('Admin_Id')) {
            /* $imageName = md5(date('YmdHis')) . uniqid();
              $fileType = $_FILES['upload']['type'];
              $getExt = explode('/', $fileType);
              $newFileName = $imageName . '.' . $getExt[1]; */
            $Admin_ProfilePic = $this->input->post('Admin_ProfilePic');
            $Admin_Id = $this->input->post('Admin_Id');

            if (empty($_FILES['upload']['name'])) {
                $added_Profile = array(
                    'Admin_ProfilePic' => $Admin_ProfilePic
                );

                $data = $this->m_profile->update_profile($added_Profile, $this->input->post('Admin_Id'));


                redirect('profile');
            } else {

                $test = uniqFileNameGenerator($_FILES['upload']);
                $destinationPath = FCPATH . 'Items/' . $test;
                move_uploaded_file($_FILES['upload']['tmp_name'], $destinationPath);
                $config['file_name']=$test;
                $config['upload_path'] = './Items/';
                $config['allowed_types'] = 'gif|jpg|png|docx';
                $config['remove_spaces'] = TRUE;
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                $added_Profile = array(
                            'Admin_ProfilePic' =>  $config['file_name']
                        );
                $data=$this->m_profile->update_profile($added_Profile, $this->input->post('Admin_Id'));

//                    $this->session->set_flashdata('message', 'Admin edit Successfully..');
                redirect("profile/index");
            }
        } else {
            redirect('login');
        }
    }
}
