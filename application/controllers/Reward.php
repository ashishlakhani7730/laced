<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward extends CI_Controller {
	
	public function __construct() {
        parent::__construct();

        $this->load->model('m_reward');
    }

   public function index() {
        if ($this->session->userdata('Admin_Id')) {
            $data['reward_list'] = $this->m_reward->get_reward();
            $this->load->view('show_reward', $data);
        } else {
            redirect('login');
        }
    }
   public function add() {
        if ($this->session->userdata('Admin_Id')) {
            
            $this->load->view('add_reward');
        } else {
            redirect('login');
        }
    }
    public function delete_data() {
        if ($this->session->userdata('Admin_Id')) {
            $this->m_reward->delete_reward($this->uri->segment(3));
            $this->session->set_flashdata('message', 'Reward Delete Successfully...');

            
                redirect('reward/index');
            
        } else {
            redirect('login');
        }
    }
    public function add_reward() {
        if ($this->session->userdata('Admin_Id')) {
            $Reward_Name=$this->input->post('Reward_Name');
            $Reward_Code=$this->input->post('Reward_Code');
            $Price=$this->input->post('Price');
            $Minimum_Price=$this->input->post('Minimum_Price');
            $Start_Date = date("Y-m-d H:i:s", strtotime($this->input->post('Start_Date')));
            $End_Date = date("Y-m-d H:i:s", strtotime("-90 minutes", strtotime($this->input->post('End_Date'))));
            $No_Of_Use=$this->input->post('No_Of_Use');
            $Price_Type=$this->input->post('Price_Type');
            $Condition=$this->input->post('Condition');
            $this->m_reward->insert_data($Reward_Name,$Reward_Code,$Price,$Price_Type,$Minimum_Price,$Start_Date,$End_Date,$No_Of_Use,$Condition);
            $this->session->set_flashdata('message', 'Reward Added Successfully...');

            
                redirect('reward/index');
            
        } else {
            redirect('login');
        }
    }
   
    public function moredetails()
    {
        if($this->session->userdata('Admin_Id'))
        {
            $response = array();

            $this->db->select("ai.*,ab.Brand_Name");
            $this->db->from("auction_item ai");
            $this->db->join("auction_brand ab","ai.Brand_Id = ab.Brand_Id");
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

            if($data)
            {
                $response['code'] = 1;
                $response['data'] = $data;
            }
            else
            {
                $response['code'] = 0;
                $response['message'] = "Please Try Again!";
            }
            
            
            
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else
        {
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

            $update = $this->m_reward->addrewarddate($date, $this->input->post('Reward_Id'));

            if ($update) {
                $notify = array(
                    'Reward_Id' => $this->input->post('Reward_Id'),
                    
                    'Notification_Title' => 'Auction Release Date',
                    'Notification_Type' => '',
                    'Notification_Message' => 'Your Auction Stating Date is - ' . $ostartdate . ' And End Date Is - ' . $oenddate
                );

                $this->m_reward->setnotification($notify);

                $response['code'] = 1;
                $response['message'] = 'Reward Starting Date And Ending Date Added Successfully';
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