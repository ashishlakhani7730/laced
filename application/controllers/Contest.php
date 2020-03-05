<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contest extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('m_contest');
    }

    public function index() {
        if ($this->session->userdata('Admin_Id')) {
            $data['contest_list'] = $this->m_contest->get_contest();
            $this->load->view('contest_item', $data);
        } else {
            redirect('login');
        }
    }
	
	public function contest_date()
	{
		if ($this->session->userdata('Admin_Id')) {
            $this->load->view('contest_date');
        } else {
            redirect('login');
        }
	}

    public function contest_user() {
        if ($this->session->userdata('Admin_Id')) {
            $data['contest_list'] = $this->m_contest->get_contestUser($this->uri->segment(3));
            $this->load->view('contest_user', $data);
        } else {
            redirect('login');
        }
    }

    public function contest_history() {
        if ($this->session->userdata('Admin_Id')) {
            $data['contest_list'] = $this->m_contest->get_contestHistory();
            $this->load->view('contest_history', $data);
        } else {
            redirect('login');
        }
    }

    public function contest_winner() {
        if ($this->session->userdata('Admin_Id')) {
            $data['contest_list'] = $this->m_contest->get_contestWinner($this->uri->segment(3));
            $this->load->view('contest_winner', $data);
        } else {
            redirect('login');
        }
    }

    public function delete_data() {
        if ($this->session->userdata('Admin_Id')) {
            $this->m_contest->delete_contest($this->uri->segment(3));
            $this->session->set_flashdata('message', 'Contect product delete successfully...');


            redirect('Contest/index');
        } else {
            redirect('login');
        }
    }

    public function contestWinner() {
        $Admin_Id = $this->session->userdata('Admin_Id');
        $Winner = $this->input->post('Winner');
        $Contest_Id = $_POST['Contest_Id'];
        $Contest_Status = $this->input->post('Contest_Status');
        

//        $this->db->select("Item_Id");
//        $this->db->from("contest");
//        $this->db->where('Contest_Id', $Contest_Id);

        $this->db->select("contest.Item_Id,auction_item.*");
        $this->db->from("contest");
        $this->db->join("auction_item", "contest.Item_Id = auction_item.Item_Id");
        $this->db->where('contest.Contest_Id', $Contest_Id);
        $query = $this->db->get();
        $data = $query->row_array();


        $this->db->select("contest_user.*");
        $this->db->from("contest_user");
        $this->db->join("contest", "contest.Contest_Id = contest_user.Contest_Id");
        $this->db->where('contest.Contest_Id', $Contest_Id);
        $querys = $this->db->get();
        $datas = $querys->row_array();
        
        $UserContest_Id = $datas['UserContest_Id'];
        $Seller_Id = $data['User_Id'];
        $User_Id=$datas['User_Id'];
        $Item_Name = $data['Item_Name'];
        $Item_Id = $data['Item_Id'];
        $Item_NormalPrice = $data['Item_NormalPrice'];

        $Order_Status = $this->input->post('Order_Status');
        $this->m_contest->add_winner($UserContest_Id, $Winner);
        $this->m_contest->add_contest($Contest_Id, $Contest_Status);
        $this->m_contest->add_order($Seller_Id, $User_Id, $Admin_Id, $Item_Id, $Item_Name, $Item_NormalPrice, $Order_Status);
    }

    public function moredetails() {
        if ($this->session->userdata('Admin_Id')) {
            $response = array();

            $this->db->select("ai.*,ab.Brand_Name");
            $this->db->from("auction_item ai");
            $this->db->join("auction_brand ab", "ai.Brand_Id = ab.Brand_Id");
            $this->db->where('Item_Id', $this->input->post('item_id'));

            $query = $this->db->get();
            $data = $query->result();

            $this->db->select("User_ProfilePic");
            $this->db->from("auction_user");
            $this->db->where('User_Id', $this->input->post('buyerid'));

            $query2 = $this->db->get();
            $data['buyerimg'] = $query2->row_array();

            $this->db->select("User_ProfilePic");
            $this->db->from("auction_user");
            $this->db->where('User_Id', $this->input->post('sellerid'));

            $query2 = $this->db->get();
            $data['sellerimg'] = $query2->row_array();

            //echo "<pre>"; print_r($data);

            if ($data) {
                $response['code'] = 1;
                $response['data'] = $data;
            } else {
                $response['code'] = 0;
                $response['message'] = "Please Try Again!";
            }



            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            redirect('login');
        }
    }

    public function setdate() {
        if ($this->session->userdata('Admin_Id')) {
            $response = array();

            $startdate = date("Y-m-d H:i:s", strtotime($this->input->post('sdate')));
            $enddate = date("Y-m-d H:i:s", strtotime("-90 minutes", strtotime($this->input->post('edate'))));

            //used for just information display in app.
            //this is orizinal date admin set
            $ostartdate = date("Y-m-d h:i A", strtotime($startdate));

            //this is -90 minute from ending date.
            $oenddate = date("Y-m-d h:i A", strtotime($enddate));

            $date = array(
                'sdate' => $startdate,
                'edate' => $enddate,
                'sdateampm' => $ostartdate,
                'edateampm' => $oenddate,
            );

            //echo $startdate."-".$enddate."<br>"; 
            //echo $oenddate;
            //exit;

            $update = $this->m_contest->addcontestdate($date, $this->input->post('Contest_Id'));

            if($update) {
                $notify = array(
                    'Item_Id' => $this->input->post('item_id'),
                    'User_Id' => $this->input->post('user_id'),
                    'Notification_Title' => 'Contest Release Date',
                    'Notification_Type' => '',
                    'Notification_Message' => 'Your Contest Stating Date is - ' . $ostartdate . ' And End Date Is - ' . $oenddate
                );

                $this->m_contest->setnotification($notify);

                $response['code'] = 1;
                $response['message'] = 'Contest Starting Date And Ending Date Added Successfully';
            } else {
                $response['code'] = 0;
                $response['message'] = 'Something Went to Wrong Please Try Again';
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            redirect('login');
        }
    }

}
