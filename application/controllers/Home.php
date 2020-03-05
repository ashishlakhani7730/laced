<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
         $this->load->model('m_home');
    }

    public function index() {
		if($this->session->userdata('Admin_Id'))
		{
			$data['totaluser'] = $this->m_home->get_totaluser();
			$data['activeuser'] = $this->m_home->get_activeuser();
			$data['usernoti'] = $this->m_home->get_usernot();
			$data['adminnoti'] = $this->m_home->get_adminnot();
			$data['totalproduct'] = $this->m_home->get_totalproduct();
			$data['instabuyproduct'] = $this->m_home->get_instabuyproduct();
			$data['tradeproduct'] = $this->m_home->get_tradeproduct();
			$data['auctionproduct'] = $this->m_home->get_auctionproduct();
			$data['approveproduct'] = $this->m_home->get_approved();
			$data['pendingapproveproduct'] = $this->m_home->get_pending_for_approved();
			$data['totalorder'] = $this->m_home->get_totalorder();
			$data['rating'] = $this->m_home->get_ratingratio();
			$data['referal'] = $this->m_home->get_referaluser();
			$data['map'] = 1;
			$this->load->view('deshboard',$data);
			//$this->load->view('footer_include',$data);
		}
		else
		{
			redirect('login');
		}
    }
}
