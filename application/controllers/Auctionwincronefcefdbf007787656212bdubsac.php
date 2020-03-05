<?php
/*

	this is the cron for select or winner highst 
	bid range into the auction product.

*/ 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auctionwincronefcefdbf007787656212bdubsac extends CI_Controller {
	
	public $maxprice = array();
	public $winnerdata = array();
	public $sellerid = array();

	public function __construct() {
        parent::__construct();

        $this->load->model('m_item');
    }

	public function index() 
	{
		//this query get the itemid for only auction item and auction now date to past date only.
		//it means auction wen complete.

		$query = $this->db->query("SELECT Item_Id FROM auction_item WHERE Item_Type = '3' AND Item_Sale_EndDate IS NOT NULL AND Item_Sale_EndDate > NOW()");

		$getitem = $query->result();
        
		if($getitem[0]->Item_Id)
		{
			foreach($getitem as $key => $item)
			{
				$query = $this->db->query("SELECT MAX(Bid_Price) as bid_price FROM auction_bid WHERE Item_Id =".$item->Item_Id." AND completeauction = 0");
				
				$data = $query->row_array();
				
				if($data['bid_price'] != '')
				{
					$this->maxprice[$key] = $query->row_array();
                       
						$this->winneris(); 
						
						$this->db->query("UPDATE auction_bid SET completeauction = 1, modified2 = NOW() WHERE Item_Id =".$item->Item_Id);
				}
			
			}

			if(!empty($this->maxprice))
			{
					foreach($this->maxprice as $key => $maxs)
					{
					    
						$query = $this->db->query("SELECT Bid_id,User_Id,Item_Id,Bid_Price FROM auction_bid WHERE Bid_Price =".$maxs['bid_price']);
                            
						$this->winnerdata[$key] = $query->row_array();
						
					}	
			}
           
			if(!empty($this->winnerdata))
			{
				foreach($this->winnerdata as $key => $winss)
				{
				// 	echo $win['Item_Id']; exit;
					$this->db->select("User_Id,Item_Id");
					$this->db->from("auction_item");
					$this->db->where("Item_Id",$winss['Item_Id']);

					$query = $this->db->get();
	              
					$this->sellerid[$key] = $query->row_array();
				    
				}
				
			}

			// make order and cut the payment from payment gateway.
            


			//used for send notification user winner.
			if(!empty($this->winnerdata))
			{
				foreach($this->winnerdata as $key => $win)
				{
					$winnernotification = array(
						'Item_Id' => $win['Item_Id'],
						'User_Id' => $win['User_Id'],
						'Notification_Title' => 'Winner',
						'Notification_Type' => 'auction',
						'Notification_Message' => 'You are Winner For Auction Product.'
					);

					$this->m_item->setnotification($winnernotification);
				}
			}

			//send notification for user's product (seller)
			if(!empty($this->sellerid))
			{
				foreach($this->sellerid as $key => $sel)
				{
					$sellernotification = array(
						'Item_Id' => $sel['Item_Id'],
						'User_Id' => $sel['User_Id'],
						'Notification_Title' => 'Seller',
						'Notification_Type' => 'auction',
						'Notification_Message' => 'Your Product Purchased Successfully.'
					);

					$this->m_item->setnotification($sellernotification);
				}
			}
		}
		echo "done";
    }

    public function winneris()
    {
        	$query = $this->db->query("SELECT * FROM auction_item WHERE Item_Type = '3' AND Item_Sale_EndDate IS NOT NULL AND Item_Sale_EndDate > NOW()");

		$getitem = $query->result();
        $Item_Id=$getitem[0]->Item_Id;
        $Item_Name=$getitem[0]->Item_Name;
        $Seller_Id=$getitem[0]->User_Id;
    		if(!empty($this->maxprice))
			{
			    
					foreach($this->maxprice as $maxs)
					{
						$this->db->query("UPDATE auction_bid SET Winner = 1, modified1 = NOW() WHERE Bid_Price =".$maxs['bid_price']);
						
					}
					
			}
			
			$query=$this->db->query("SELECT * FROM auction_bid WHERE Item_Id=$Item_Id AND Winner =1 ");
			$getbid = $query->result();
			$User_Id=$getbid[0]->User_Id;
			$Item_Price=$getbid[0]->Bid_Price;
			$Order_Type='AUCTION';
			$created=date("Y-m-d H:i:s");
		
			$this->db->query("INSERT INTO `auction_user_order` (User_Id,Seller_Id, Item_Id,Item_Name,Item_NormalPrice,Order_Type,Order_Status, created) VALUES ('$User_Id','$Seller_Id', '$Item_Id','$Item_Name', '$Item_Price','$Order_Type',1,'$created')");

    }
}