<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('m_aboutus');
    }

    public function index() {
        if ($this->session->userdata('Admin_Id')) {
            $data['feedback'] = $this->m_aboutus->get_feedback();
            //echo "<pre>";print_r($data); exit;
            $this->load->view('feedback', $data);
        } else {
            redirect('login');
        }
    }

    public function delete_data() {

        $feedback = $this->m_aboutus->delete_feedback($this->uri->segment(3));
        $this->session->set_flashdata('message', 'Feedback Delete Successfully...');
        redirect("Feedback/index");
    }

}
