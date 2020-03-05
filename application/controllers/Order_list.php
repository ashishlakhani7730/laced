<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_list extends CI_Controller {
	
	public function __construct() {
        parent::__construct();

        $this->load->model('m_order');
    }

    public function index()
    {
    	$data['order_list'] = $this->m_order->getorderlist();
    	//echo "<pre>"; print_r($data['order_list'] ); exit;
    	$this->load->view('orderlist',$data);
    }
   
    public function Sellertrack() {
        $Order_Id = $_POST['Order_Id'];
         $Tracking_No3 = substr(md5(rand()), 0, 9);
       	$this->m_order->add_seller_track($_POST['Order_Id'],$Tracking_No3);
    }	
    
    public function Buyertrack() {
        $Order_Id = $_POST['Order_Id'];
         $Tracking_No4 = substr(md5(rand()), 0, 9);
       	$this->m_order->add_buyer_track($_POST['Order_Id'],$Tracking_No4);
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
	
	public function deliverd()
	{
		$datas = array("Order_Status"=>"2");
		$this->db->where("Order_Id",$this->input->post('Order_Id'));
		$this->db->update("auction_user_order",$datas);
	}
	
	public function shippingyou()
	{
		$datas = array("Tracking_No2"=>"2");
		$this->db->where("Order_Id",$this->input->post('Order_Id'));
		$this->db->update("auction_user_order",$datas);
	}
	
	public function complete()
	{
		$datas = array("Order_Complete"=>"1");
		$this->db->where("Order_Id",$this->input->post('Order_Id'));
		$this->db->update("auction_user_order",$datas);
	}
}