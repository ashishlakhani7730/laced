<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raffle extends CI_Controller {
	
	public function __construct() {
        parent::__construct();

        $this->load->model('m_raffle');
    }

   public function index() {
        if ($this->session->userdata('Admin_Id')) {
            $data['raffle_list'] = $this->m_raffle->get_raffle();
            $this->load->view('raffle_item', $data);
        } else {
            redirect('login');
        }
    }
	
	public function raffle_date()
	{
		 if ($this->session->userdata('Admin_Id')) {
            $this->load->view('raffle_date');
        } else {
            redirect('login');
        }
	}
	
   public function raffle_user() {
        if ($this->session->userdata('Admin_Id')) {
            $data['raffle_list'] = $this->m_raffle->get_raffleUser($this->uri->segment(3));
            $this->load->view('raffle_user', $data);
        } else {
            redirect('login');
        }
    }

    public function raffle_history() {
        if ($this->session->userdata('Admin_Id')) {
            $data['raffle_list'] = $this->m_raffle->get_raffleHistory();
            $this->load->view('raffle_history', $data);
        } else {
            redirect('login');
        }
    }

    public function raffle_winner() {
        if ($this->session->userdata('Admin_Id')) {
            $data['raffle_list'] = $this->m_raffle->get_raffleWinner($this->uri->segment(3));
            $this->load->view('raffle_winner', $data);
        } else {
            redirect('login');
        }
    }

    public function delete_data() {
        if ($this->session->userdata('Admin_Id')) {
            $this->m_raffle->delete_raffle($this->uri->segment(3));
            $this->session->set_flashdata('message', 'Raffle product delete successfully...');


            redirect('Raffle/index');
        } else {
            redirect('login');
        }
    }

    public function raffleWinner() {
        $Admin_Id = $this->session->userdata('Admin_Id');
        $Winner = $this->input->post('Winner');
        $Raffle_Id = $_POST['Raffle_Id'];
        $Raffle_Status = $this->input->post('Raffle_Status');
        

//        $this->db->select("Item_Id");
//        $this->db->from("raffle");
//        $this->db->where('Raffle_Id', $Raffle_Id);

        $this->db->select("raffle.Item_Id,auction_item.*");
        $this->db->from("raffle");
        $this->db->join("auction_item", "raffle.Item_Id = auction_item.Item_Id");
        $this->db->where('raffle.Raffle_Id', $Raffle_Id);
        $query = $this->db->get();
        $data = $query->row_array();
        
         $this->db->select("raffle_user.*");
        $this->db->from("raffle_user");
        $this->db->join("raffle", "raffle.Raffle_Id = raffle_user.Raffle_Id");
        $this->db->where('raffle.Raffle_Id', $Raffle_Id);
        $querys = $this->db->get();
        $datas = $querys->row_array();
        
        $UserRaffle_Id = $datas['UserRaffle_Id'];
        $Seller_Id = $data['User_Id'];
        $User_Id = $datas['User_Id'];
        $Item_Name = $data['Item_Name'];
        $Item_Id = $data['Item_Id'];
        $Item_NormalPrice = $data['Item_NormalPrice'];

        $Order_Status = $this->input->post('Order_Status');
        $this->m_raffle->add_winner($UserRaffle_Id, $Winner);
        $this->m_raffle->add_raffle($Raffle_Id, $Raffle_Status);
        $this->m_raffle->add_order($Seller_Id, $User_Id, $Admin_Id, $Item_Id, $Item_Name, $Item_NormalPrice, $Order_Status);
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

            $update = $this->m_raffle->addraffledate($date, $this->input->post('Raffle_Id'));

            if($update) {
                $notify = array(
                    'Item_Id' => $this->input->post('item_id'),
                    'User_Id' => $this->input->post('user_id'),
                    'Notification_Title' => 'Raffle Release Date',
                    'Notification_Type' => '',
                    'Notification_Message' => 'Your Raffle Stating Date is - ' . $ostartdate . ' And End Date Is - ' . $oenddate
                );

                $this->m_raffle->setnotification($notify);

                $response['code'] = 1;
                $response['message'] = 'Raffle Starting Date And Ending Date Added Successfully';
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
    public function addraffleprice() {
        $response = array();
        
        if ($this->input->post('Raffle_Price') && $this->input->post('Raffle_Price') == '' && $this->input->post('Raffle_Id') && $this->input->post('Raffle_Id') == '') {
            $response['code'] = 0;
            $response['message'] = 'Somthing went to wrong please try again.';
        } else if (!preg_match("/[1-9][0-9]/", $this->input->post('Raffle_Price'))) {
            $response['code'] = 0;
            $response['message'] = 'Please Enter valid Price.';
        } else {
            
            $upmarket = $this->m_raffle->addraffleprice( $this->input->post('Raffle_Id'),$this->input->post('Raffle_Price'));
            
            if ($upmarket) {
               
                $response['code'] = 1;
                $response['message'] = 'Raffle Price Added Successfully';
            } else {
                $response['code'] = 0;
                $response['message'] = 'Somthing went to wrong please try again.';
            }
        }

        echo json_encode($response);
    }

}