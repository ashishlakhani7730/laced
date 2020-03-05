<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('m_admin');
    }

    public function index() {
        if ($this->session->userdata('Admin_Id')) {
            $this->load->view('add_admin');
        } else {
            redirect('login');
        }
    }
    public function admin_list(){
     if ($this->session->userdata('Admin_Id')) {
            $data['admin_list'] = $this->m_admin->adminlist();
            $this->load->view('show_admin', $data);
        } else {
            redirect('login');
        }   
    }
    public function add_admin(){
        if ($this->session->userdata('Admin_Id')) {
            
            $Admin_Name=$this->input->post('Admin_Name');
            $Admin_Email=$this->input->post('Admin_Email');
            $Admin_UserName=$this->input->post('Admin_UserName');
            $Admin_Phone=$this->input->post('Admin_Phone');
            $Admin_Address=$this->input->post('Admin_Address');
            $Admin_Password=$this->input->post('Admin_Password');
            $Permission = $this->input->post('Admin_Role') ? implode(',', $this->input->post('Admin_Role')) : '';
            
//            $Admin_Name=$this->input->post('Admin_Name');
            date_default_timezone_set("Asia/Kolkata");
            $created = date("Y-m-d H:i:s");
            $this->m_admin->add_admin($Admin_Name,$Admin_UserName, $Admin_Email,$Admin_Phone,$Admin_Address,$Admin_Password,$Permission,$created);
            $this->session->set_flashdata('success', 'child Admin Added Successfully!');
            redirect('admin/index');
        } else {
            redirect('login');
        }   
    }        
    public function delete_data() {
        if ($this->session->userdata('Admin_Id')) {
            $feedback = $this->m_admin->delete_data($this->uri->segment(3));
            $this->session->set_flashdata('success', 'Child Admin delete successfully...');
            redirect("admin/admin_list");
        }else {
            redirect('login');
        } 
    }
    
    public function update_data($Admin_Id) {
        if ($this->session->userdata('Admin_Id')) {
             
            $data['update_datas'] = $this->m_admin->edit_data($Admin_Id);
//            echo "<pre>";
//            print_R($data['update_datas']);
//            die;
            $this->load->view('update_permission',$data );
        } else {
            redirect('login');
        }
    }
    public function update_permision() {
        if ($this->session->userdata('Admin_Id')) {
            $Admin_Id = $this->input->post('Admin_Id');
           $Permission = $this->input->post('Admin_Role') ? implode(',', $this->input->post('Admin_Role')) : '';
            date_default_timezone_set("Asia/Kolkata");
            $modified = date("Y-m-d H:i:s");
            $notification = $this->m_admin->update_permision($Admin_Id, $Permission, $modified);
            $this->session->set_flashdata('success', 'Permission Update Successfully!');
            redirect('Admin/admin_list');
        } else {
            redirect('login');
        }
    }
    
}
