<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rateus extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('m_aboutus');
    }

    public function index() {
        if ($this->session->userdata('Admin_Id')) {
            $data['rating'] = $this->m_aboutus->get_rating();
            //echo "<pre>";print_r($data); exit;
            $this->load->view('rateus', $data);
        } else {
            redirect('login');
        }
    }

    public function delete_data() {
        if ($this->session->userdata('Admin_Id')) {
            $rate = $this->m_aboutus->delete_rate($this->uri->segment(3));
            $this->session->set_flashdata('message', 'Rate Delete Successfully...');
            redirect("Rateus/index");
        } else {
            redirect('login');
        }
    }

}
