<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bid extends CI_Controller {
	
	public function __construct() {
        parent::__construct();

        //$this->load->model('m_bid');
    }
	
	public function index()
	{
		if($this->session->userdata('Admin_Id'))
		{
			$this->db->select("*");
			$this->db->from("auction_item");
			$this->db->where("Item_Id IN (SELECT DISTINCT Item_Id FROM auction_bid where completeauction != 1)", NULL, FALSE);
			//$this->db->join('auction_bid ab','ab.Item_Id = ai.Item_Id');
			
			$query = $this->db->get();
			$data['bidlist'] = $query->result();
			
			// "<pre>"; print_r($data['bidlist']); exit;
			
			$this->load->view('bid_item', $data);
		}
		else
		{
			redirect('login');
		}
	}
	
	public function bidlist()
	{
		$response = array();
		
		if($this->session->userdata('Admin_Id'))
		{
			$this->db->select("ab.Bid_Price,ab.Winner,au.User_ProfilePic, au.User_Name");
			$this->db->from("auction_bid ab");
			$this->db->join('auction_user au','ab.User_Id = au.User_Id');
			$this->db->where('ab.Item_Id',$this->input->post('item_id'));
			$this->db->order_by('ab.Bid_Price','DESC');
			
			$query = $this->db->get();
			$list = $query->result();
			
			
			if($list)
			{
				$response['code'] = 1;
				$response['datas'] = $list;
			}
			else
			{
				$response['code'] = 0;
				$response['message'] = "Please Try Again";
			}
			
			header('Content-Type: application/json');
			echo json_encode($response);
		}
		else
		{
			redirect('login');
		}
	}
	
	public function auc_winner()
	{
		if($this->session->userdata('Admin_Id'))
		{
			$this->db->select("*");
			$this->db->from("auction_item");
			$this->db->where("Item_Id IN (SELECT DISTINCT Item_Id FROM auction_bid where completeauction = 1)", NULL, FALSE);
			//$this->db->join('auction_bid ab','ab.Item_Id = ai.Item_Id');
			
			$query = $this->db->get();
			$data['bidlist'] = $query->result();
			
			//echo "<pre>"; print_r($data['bidlist']); exit;
			
			$this->load->view('auction_winner', $data);
		}
		else
		{
			redirect('login');
		}
	}
	//cut the customer or buyer payment who is highest of them.
	public function winner()
	{
		$response = array();
		
		if($this->session->userdata('Admin_Id'))
		{
			$this->db->select_max('Bid_Price');
			$this->db->from("auction_bid");
			$this->db->where('Item_Id',$this->input->post('item_id'));
			$this->db->where('completeauction',"0");
			
			$query = $this->db->get();
			$list = $query->result();
			
			$this->db->set('Winner','1',false);
			$this->db->where('Bid_Price',$list[0]->Bid_Price);
			$this->db->where('Item_Id',$this->input->post('item_id'));
			$this->db->update('auction_bid');
			
			$this->db->set('completeauction','1',false);
			$this->db->where('Item_Id',$this->input->post('item_id'));
			$this->db->update('auction_bid');
			
			// getting the Id
			$this->db->where('Bid_Price',$list[0]->Bid_Price);
			$this->db->where('Item_Id',$this->input->post('item_id'));
			$query = $this->db->get('auction_bid');
			$result = $query->result_array();
			$updated_id = $result[0]['User_Id'];
			//echo $updated_id;
			
			$this->db->select("*");
			$this->db->from("User_Stripe_Info");
			$this->db->where("User_Id",$updated_id);
			$querys = $this->db->get();
			$stripe = $querys->result();
			
			//echo "<pre>"; print_r($stripe); exit;
			if($stripe[0]->Stripe_User_Id != '')
			{
				require(FCPATH.'stripepaymentgateway/init.php');
				$params = array(
					"testmode"  => "on",
					"private_live_key" => "sk_live_dndDG08hdcyh0JcL5b71kPFS",
					"public_live_key"  => "pk_live_OdH5iU49mo8hsamiJU5DM1LK",
					"private_test_key" => "sk_test_fusISb6VHHH4YNsM1n7nHQpk",
					"public_test_key"  => "pk_test_zAsblhyos8R4Z3XuSz6lAfFz"
				);
				
				if ($params['testmode'] == "on") {
					\Stripe\Stripe::setApiKey($params['private_test_key']);
					$pubkey = $params['public_test_key'];
				} else {
					\Stripe\Stripe::setApiKey($params['private_live_key']);
					$pubkey = $params['public_live_key'];
				} 
				$message = 'Laced userID:'.$updated_id.' to payment for Auction winner';
				$Ammount = ($result[0]['Bid_Price'] * 100); 
				$charge = \Stripe\Charge::create(array(		 
					"amount" => $Ammount,
					"currency" => "usd",
					"source" => "tok_visa",
					"description" => $message), 
					array("stripe_account" => $stripe[0]->Stripe_User_Id) 	  
				);
				
				$response['code'] = 1;
			}
			else
			{
				$response['code'] = 0;
				$response['message'] = "Please Try Again";
			}
			
			header('Content-Type: application/json');
			echo json_encode($response);
		}
		else
		{
			redirect('login');
		}
	}
	//integrate to seller payment process.
	public function payouts()
	{
		$this->db->select("ab.*,ai.*,au.User_FullName,au.User_Email,au.User_Phone");
		$this->db->from("auction_bid ab");
		$this->db->join("auction_item ai","ai.Item_Id = ab.Item_Id");
		$this->db->join("auction_user au","au.User_Id = ai.User_Id");
		$this->db->where("winner","1");
		
		$query = $this->db->get();
		$data["item_seller"] = $query->result();
		//echo "<pre>"; print_r($data);exit;
		$this->load->view("payouts",$data);
	}
	
	public function pay_stripe()
	{
		$this->db->select("*");
		$this->db->from("User_Stripe_Info");
		$this->db->where("User_Id",$this->input->post("user_id"));
		$querys = $this->db->get();
		$stripe = $querys->result();
			
		require(FCPATH.'stripepaymentgateway/init.php');
            $params = array(
                "testmode"  => "on",
                "private_live_key" => "sk_live_dndDG08hdcyh0JcL5b71kPFS",
                "public_live_key"  => "pk_live_OdH5iU49mo8hsamiJU5DM1LK",
                "private_test_key" => "sk_test_fusISb6VHHH4YNsM1n7nHQpk",
                "public_test_key"  => "pk_test_zAsblhyos8R4Z3XuSz6lAfFz"
            );
			
			if ($params['testmode'] == "on") {
                \Stripe\Stripe::setApiKey($params['private_test_key']);
                $pubkey = $params['public_test_key'];
            } else {
                \Stripe\Stripe::setApiKey($params['private_live_key']);
                $pubkey = $params['public_live_key'];
            } 
			$message = 'Laced userID:'.$this->input->post("user_id").' to payout for Auction product purchase';
            $Ammount = ($this->input->post("bid_price") * 100); 
            /*$charge = \Stripe\Payout::create(array(		 
				"amount" => 5000,
				"currency" => "usd",
				"description" => $message,
				"method" => "instant"),
                array("stripe_account" => $stripe[0]->Stripe_User_Id) 	  
            );*/
			
			$trans = \Stripe\Transfer::create(array(
			  "amount" => $Ammount,
			  "currency" => "usd",
			  "destination" => $stripe[0]->Stripe_User_Id,
			  "description" => "test")
			  //array("stripe_account" => $stripe[0]->Stripe_User_Id)
			);
			
			$this->db->set('payseller','1',false);
			$this->db->where('Bid_id',$this->input->post('bid_id'));
			$this->db->update('auction_bid');
			
		if(isset($charge['balance_transaction'])):
            $response['code'] = 1;
            $response['message'] = $charge['balance_transaction'];
        else:
            $response['code'] = 0;
            $response['message'] = 'Sorry your transaction fail. Please try again.';
        endif;
		echo json_encode($response);
	}
}