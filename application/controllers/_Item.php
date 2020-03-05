<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Item extends CI_Controller {



    public function __construct() {

        parent::__construct();



        $this->load->model('m_item');

    }



    public function index() {

        if ($this->session->userdata('Admin_Id')) {

            $data['item_list'] = $this->m_item->get_item();

            $this->load->view('show_item', $data);

        } else {

            redirect('login');

        }

    }



    public function instabuyitem() {

        if ($this->session->userdata('Admin_Id')) {

            $data['item_list'] = $this->m_item->get_instabuy();

            $this->load->view('instabuy_item', $data);

        } else {

            redirect('login');

        }

    }



    public function auctionitem() {


        if ($this->session->userdata('Admin_Id')) {

            $data['item_list'] = $this->m_item->get_auction();

            $this->load->view('auction_item', $data);

        } else {

            redirect('login');

        }

    }



    public function tradeitem() {

        if ($this->session->userdata('Admin_Id')) {

            $data['item_list'] = $this->m_item->get_trade();

            $this->load->view('trade_item', $data);

        } else {

            redirect('login');

        }

    }



    public function raffle_data($Item_Id) {

        if ($this->session->userdata('Admin_Id')) {

            $Raffle_Price = $this->input->post('Raffle_Price');

            $this->m_item->add_raffle($Item_Id, $Raffle_Price);

            $this->m_item->raffle_data($Item_Id);

            $this->session->set_flashdata('message', 'Raffle Added successfully...');

            if ($this->uri->segment(4) == 'instabuy') {

                redirect('item/instabuyitem');

            } else if ($this->uri->segment(4) == 'auction') {

                redirect('item/auctionitem');

            } else if ($this->uri->segment(4) == 'trade') {

                redirect('item/tradeitem');

            } else if ($this->uri->segment(4) == 'allitem') {

                redirect('item');

            }

        } else {

            redirect('login');

        }

    }



    public function contest_data($Item_Id) {

        if ($this->session->userdata('Admin_Id')) {



            $this->m_item->add_contest($Item_Id);

            $this->m_item->contest_data($Item_Id);

            $this->session->set_flashdata('message', 'Contest Added successfully...');

            if ($this->uri->segment(4) == 'instabuy') {

                redirect('item/instabuyitem');

            } else if ($this->uri->segment(4) == 'auction') {

                redirect('item/auctionitem');

            } else if ($this->uri->segment(4) == 'trade') {

                redirect('item/tradeitem');

            } else if ($this->uri->segment(4) == 'allitem') {

                redirect('item');

            }

        } else {

            redirect('login');

        }

    }



    public function show_raffle() {

        if ($this->session->userdata('Admin_Id')) {

            $Item_Id = $this->input->post('Item_Id');

            $data['raffle_list'] = $this->m_item->get_raffle($Item_Id);

            //$data['raffle_user_list'] = $this->m_item->get_raffle_user();



            $this->load->view('show_raffle', $data);

        } else {

            redirect('login');

        }

    }



    public function show_raffleuser($Item_Id) {



        if ($this->session->userdata('Admin_Id')) {

            $data['raffle_user_list'] = $this->m_item->get_raffle_user($Item_Id);



            $this->load->view('show_raffle_user', $data);

        } else {

            redirect('login');

        }

    }



    public function add_item_raffle() {

        if ($this->session->userdata('Admin_Id')) {

            $Raffle_Price = $this->input->post('Raffle_Price');

            date_default_timezone_set("Asia/Kolkata");

            $created = date("Y-m-d H:i:s");

            $data['item_list'] = $this->m_item->get_item();

            $this->m_item->insert_data($_POST['Item_Id'], $Raffle_Price, $created);



            redirect("item/index");

        } else {

            redirect('login');

        }

    }



    public function delete_data() {

        if ($this->session->userdata('Admin_Id')) {

            $this->m_item->delete_data($this->uri->segment(3));

            $this->session->set_flashdata('message', 'product delete successfully...');



            if ($this->uri->segment(4) == 'instabuy') {

                redirect('item/instabuyitem');

            } else if ($this->uri->segment(4) == 'auction') {

                redirect('item/auctionitem');

            } else if ($this->uri->segment(4) == 'trade') {

                redirect('item/tradeitem');

            } else if ($this->uri->segment(4) == 'allitem') {

                redirect('item');

            } else {

                $this->session->set_flashdata('fail_message', 'Something Wrong Please Try Again!');

            }

        } else {

            redirect('login');

        }

    }



    public function app_disapp() {

        if ($this->session->userdata('Admin_Id')) {

            if ($this->uri->segment(5) == '1') {

                // add product commission.

                $query = $this->db->query("SELECT Item_NormalPrice,Item_Name FROM auction_item WHERE Item_Id=" . $this->uri->segment(3));

                $item_price = $query->row_array();
               

                //print_r($item_price['Item_NormalPrice']); exit;



                $charge = $this->db->query("SELECT comm_charge FROM product_commission_charge");



                $comcharge = $charge->row_array();

                //print_r($comcharge['comm_charge']); exit;



                $finalcomm = (($item_price['Item_NormalPrice'] * $comcharge['comm_charge']) / 100);



                $commission = array(

                    'User_Id' => $this->uri->segment(4),

                    'Item_Id' => $this->uri->segment(3),

                    'product_price' => $item_price['Item_NormalPrice'],

                    'product_commission_rate' => $comcharge['comm_charge'],

                    'product_commission' => $finalcomm,

                );



                $this->db->set('created', 'NOW()', FALSE);

                $this->db->insert('product_commission', $commission);

                $insert_id = $this->db->insert_id();



                if ($insert_id) {

                    $app_disapp = array(

                        'Item_Id' => $this->uri->segment(3),

                        'User_Id' => $this->uri->segment(4),

                        'Notification_Title' => 'product approved',

                        'Notification_Type' => '',

                        'stuatus' => $this->uri->segment(5), // for used auction_item.

                        'Notification_Message' => 'Your Added Item Accepted Successfully we get charge $' . $finalcomm . ' when your product is sell Successfully.'

                    );

                    $getItemUser = $this->db->query("SELECT * FROM auction_user WHERE User_Id='$app_disapp[User_Id]'");
                    $userData = $getItemUser->row_array();
                    $userDeviceToken = $userData['User_DeviceToken'];
                    $userDeviceType = $userData['User_DeviceType'];                    
                    $message = 'Your '.$item_price['Item_Name'].' Product is Approved.';                  
                    sendPushNotificationFromAndroidOrIos($userDeviceToken,'Product Approvel',$message,'',$userDeviceType);                   

                }

            } else if ($this->uri->segment(5) == '0') {

                $app_disapp = array(

                    'Item_Id' => $this->uri->segment(3),

                    'User_Id' => $this->uri->segment(4),

                    'Notification_Title' => 'product disapproved',

                    'Notification_Type' => '',

                    'stuatus' => $this->uri->segment(5), // for used auction_item.

                    'Notification_Message' => 'Your Item Not Accepted.'

                );
          
                
            $getItemUser = $this->db->query("SELECT * FROM auction_user WHERE User_Id='$app_disapp[User_Id]'");
            $userData = $getItemUser->row_array();
            $userDeviceToken = $userData['User_DeviceToken'];
            $userDeviceType = $userData['User_DeviceType'];                    
            $message = 'Your Product is DisApproved.';                  
            sendPushNotificationFromAndroidOrIos($userDeviceToken,'Product Disapprovel',$message,'',$userDeviceType);


            } else {

                $this->session->set_flashdata('message', 'Something went to Wrong');

                $data['item_list'] = $this->m_item->get_item();

                $this->load->view('show_item', $data);

            }



            $query1 = $this->db->query("SELECT Item_MarketPrice FROM auction_item WHERE Item_Id=" . $this->uri->segment(3));

            $item_marketprice = $query1->row_array();
        
            
            if ($item_marketprice['Item_MarketPrice'] == '' ||  $item_marketprice['Item_MarketPrice'] == '0' ) {

                $this->session->set_flashdata('message', 'Frist Enter Market Price..!');

                 if ($this->uri->segment(6) == 'instabuy') {

                        redirect('item/instabuyitem');

                    } else if ($this->uri->segment(6) == 'auction') {

                        redirect('item/auctionitem');

                    } else if ($this->uri->segment(6) == 'trade') {

                        redirect('item/tradeitem');

                    } else if ($this->uri->segment(6) == 'allitem') {

                        redirect('item');

                    } 
                    

            } else {

                

                $update = $this->m_item->app_disapp($app_disapp);

           

                if ($update) {



                    if ($this->uri->segment(5) == '1') {

                        $this->session->set_flashdata('message', 'Product Approved Successfully');

                    } else if ($this->uri->segment(5) == '0') {

                        $this->session->set_flashdata('message', 'Product Disapproved Successfully');

                    }


                    if ($this->uri->segment(6) == 'instabuy') {

                        redirect('item/instabuyitem');

                    } else if ($this->uri->segment(6) == 'auction') {

                        redirect('item/auctionitem');

                    } else if ($this->uri->segment(6) == 'trade') {

                        redirect('item/tradeitem');

                    } else if ($this->uri->segment(6) == 'allitem') {

                        redirect('item');

                    } else {

                        $this->session->set_flashdata('fail_message', 'Something Wrong Please Try Again!');

                    }

                }

             }

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



            $update = $this->m_item->addauctiondate($date, $this->input->post('item_id'));



            if ($update) {

                $notify = array(

                    'Item_Id' => $this->input->post('item_id'),

                    'User_Id' => $this->input->post('user_id'),

                    'Notification_Title' => 'Auction Release Date',

                    'Notification_Type' => '',

                    'Notification_Message' => 'Your Auction Stating Date is - ' . $ostartdate . ' And End Date Is - ' . $oenddate

                );



                $this->m_item->setnotification($notify);



                $response['code'] = 1;

                $response['message'] = 'Auction Starting Date And Ending Date Added Successfully';

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



    public function moredetails() {

        if ($this->session->userdata('Admin_Id')) {

            $response = array();



            $this->db->select("ai.*,ab.Brand_Name");

            $this->db->from("auction_item ai");

            $this->db->join("auction_brand ab", "ai.Brand_Id = ab.Brand_Id");

            $this->db->where('Item_Id', $this->input->post('item_id'));



            $query = $this->db->get();

            $data = $query->result();



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



    public function addmarketprice() {

        $response = array();



        if ($this->input->post('marketprice') && $this->input->post('marketprice') == '' && $this->input->post('item_id') && $this->input->post('item_id') == '') {

            $response['code'] = 0;

            $response['message'] = 'Somthing went to wrong please try again.';

        } else if (!preg_match("/[1-9][0-9]/", $this->input->post('marketprice'))) {

            $response['code'] = 0;

            $response['message'] = 'Please Enter valid Price.';

        } else {

            $upmarket = $this->m_item->addmarketprice($this->input->post('marketprice'), $this->input->post('item_id'));



            if ($upmarket) {

                $response['code'] = 1;

                $response['message'] = 'Market Price Added Successfully';

            } else {

                $response['code'] = 0;

                $response['message'] = 'Somthing went to wrong please try again.';

            }

        }



        echo json_encode($response);

    }



}

