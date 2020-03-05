<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('m_setting');
    }

    public function index() {
        if ($this->session->userdata('Admin_Id')) {
            $data['settings'] = $this->m_setting->get_setting();
            //echo "<pre>";print_r($data); exit;
            $this->load->view('show_setting', $data);
        } else {
            redirect('login');
        }
    }

    public function delete_data() {

        $setting = $this->m_setting->delete_setting($this->uri->segment(3));
        $this->session->set_flashdata('message', 'Setting delete successfully...');
        redirect("Setting/index");
    }

}
