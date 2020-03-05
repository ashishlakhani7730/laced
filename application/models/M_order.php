<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_order extends CI_Model {
	
	public function getorderlist()
    {
    	$this->db->select("auo.Order_Id,auo.Item_Id,auo.Item_Name,auo.Item_NormalPrice,auo.Tracking_No1,auo.Tracking_No2,au.User_Id as buserid,au.User_Name as buyer,asa.User_Id as suserid,asa.User_Name as seller,ai.Item_FrontPicture");
    	$this->db->from("auction_user_order auo");
    	$this->db->join("auction_item ai","ai.Item_Id = auo.Item_Id");
    	$this->db->join("auction_user au","au.User_Id = auo.User_Id","left");
        $this->db->join("auction_user asa","asa.User_Id = auo.Seller_Id","left");
	    $this->db->where("auo.Order_Complete",0);
    	$query = $this->db->get();

		return $query->result();
    }
    public function add_seller_track($Order_Id,$Tracking_No3)
    {
    	$data = array(
            'Tracking_No3' => $Tracking_No3
        );
        $this->db->where('Order_Id',$Order_Id);
	$this->db->update('auction_user_order',$data);
    }
     public function add_buyer_track($Order_Id,$Tracking_No4)
    {
    	$data = array(
            'Tracking_No4' => $Tracking_No4
        );
        $this->db->where('Order_Id',$Order_Id);
	$this->db->update('auction_user_order',$data);
    }

}