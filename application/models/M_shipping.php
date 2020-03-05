<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_shipping extends CI_Model {

    public function getunshippedlist() {
        $this->db->select("auo.Order_Id,auo.Item_Id,auo.Item_Name,auo.Item_NormalPrice,auo.Tracking_No1,au.User_Id as buserid,au.User_Name as buyer,asa.User_Id as suserid,asa.User_Name as seller,asa.User_Email as sellerEmail,asa.User_Address as sellerAddress,asa.User_Phone as sellerPhone,ai.Item_FrontPicture");
        $this->db->from("auction_user_order auo");
        $this->db->join("auction_item ai", "ai.Item_Id = auo.Item_Id");
        $this->db->join("auction_user au", "au.User_Id = auo.User_Id", "left");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id", "left");
        $this->db->where('auo.Tracking_No1', '');
        $this->db->where('auo.Order_Status', 1);
        $this->db->where("auo.Order_Type != 'TRADE'");
        $query = $this->db->get();
		
		
        return $query->result();
    }
					
    public function getshippinglist() {
        $this->db->select("auo.Order_Id,auo.Item_Id,auo.Item_Name,auo.Item_NormalPrice,auo.Tracking_No1,au.User_Id as buserid,au.User_Name as buyer,asa.User_Id as suserid,asa.User_Name as seller,asa.User_Email as sellerEmail,asa.User_Phone as sellerPhone,ai.Item_FrontPicture");
        $this->db->from("auction_user_order auo");
        $this->db->join("auction_item ai", "ai.Item_Id = auo.Item_Id","left");
        $this->db->join("auction_user au", "au.User_Id = auo.User_Id", "left");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id", "left");
       
        $this->db->where('auo.Order_Status', 1);
        $this->db->where("auo.Tracking_No1 != ''");
        $this->db->where("auo.Order_Type != 'TRADE'");
        $query = $this->db->get();

        return $query->result();
    }

    public function getshippedlist() {
        $this->db->select("auo.Order_Id,auo.Item_Id,auo.Item_Name,auo.Item_NormalPrice,auo.Tracking_No1,auo.Tracking_No2,au.User_Id as buserid,au.User_Name as buyer,au.User_Email as buyerEmail,au.User_Address as buyerAddress,au.User_Phone as buyerPhone,asa.User_Id as suserid,asa.User_Name as seller,asa.User_Email as sellerEmail,asa.User_Phone as sellerPhone,ai.Item_FrontPicture");
        $this->db->from("auction_user_order auo");
        $this->db->join("auction_item ai", "ai.Item_Id = auo.Item_Id");
        $this->db->join("auction_user au", "au.User_Id = auo.User_Id", "left");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id", "left");
        
        $this->db->where('auo.Order_Status', 2);
        $this->db->where('auo.Tracking_No2', '');
        $this->db->where("auo.Order_Type != 'TRADE'");
        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
        return $query->result();
    }

    public function getshippingTradelist() {
        $this->db->select("t.*,au.User_Id as buserid,auo.Tracking_No1,au.User_Name as buyer,au.User_Email as buyerEmail,au.User_Address as buyerAddress,au.User_Phone as buyerPhone,asa.User_Id as suserid,asa.User_Name as seller,asa.User_Email as sellerEmail,asa.User_Address as sellerAddress,asa.User_Phone as sellerPhone,ai.Item_FrontPicture");
        $this->db->from("trade t,auction_user_order auo");
        $this->db->join("auction_item ai", "ai.Item_Id = t.Item_Id");
        $this->db->join("auction_user au", "au.User_Id = t.Receiver_Id");
        $this->db->join("auction_user asa", "asa.User_Id = t.User_Id");
        $this->db->where('t.Trade_Status', 1);
        $where = '(t.Is_Verify= 0  or t.Is_Verify = 1)';
        $this->db->where($where);
        $this->db->where("t.Trade_Status",1);
        $this->db->where("auo.Order_Type",'TRADE');
        $this->db->order_by('t.Trade_Id', "desc");
        $this->db->group_by('t.Trade_Id');
        $query = $this->db->get();
        return $query->result();
    }


    public function getmoresellerlist($Trade_Id) {
        $this->db->select("have_Item_Id");
        $this->db->from("trade t");
        $this->db->where('Trade_Id', $Trade_Id);
        $query = $this->db->get();
        $datas = $query->result();
        
        $have_Item_Id =$datas[0]->have_Item_Id;
   
        $this->db->select("ai.Item_Id,ai.Item_Name,ai.Item_FrontPicture,t.Trade_Id,auo.Order_Id,auo.Order_Status,auo.Tracking_No1,t.Receiver_Id,t.User_Id,t.Trade_Status,au.User_Id as suserid,au.User_Name as seller");
        $this->db->from("trade t,auction_item ai");
        $this->db->join("auction_user au", "au.User_Id = t.User_Id");
        $this->db->join("auction_user_order auo", "auo.Item_Id = $Trade_Id");
        $this->db->where("ai.Item_Id IN ($have_Item_Id)");
        
        $this->db->where('t.Trade_Id', $Trade_Id);
        $this->db->where('t.have_Item_Id', $have_Item_Id);
        $this->db->where("t.User_Id=auo.Seller_Id");
        $this->db->where("auo.Order_Type",'TRADE');
        $this->db->group_by('ai.Item_Id');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getmorebuyerlist($Trade_Id) {

        $this->db->select("Item_Id");
        $this->db->from("trade t");
        $this->db->where('Trade_Id', $Trade_Id);
        $query = $this->db->get();
        $datas = $query->result();

        $Item_Id =$datas[0]->Item_Id;


        $this->db->select("ai.Item_Id,ai.Item_Name,ai.Item_FrontPicture,t.Trade_Id,auo.Order_Id,auo.Order_Status,auo.Tracking_No1,t.Receiver_Id,t.User_Id,t.Trade_Status,au.User_Id as buserid,au.User_Name as buyer");
        $this->db->from("trade t,auction_item ai");
        $this->db->join("auction_user au", "au.User_Id = t.Receiver_Id");
        $this->db->join("auction_user_order auo", "auo.Item_Id = $Trade_Id");
        $this->db->where("ai.Item_Id IN ($Item_Id)");
        
        $this->db->where('t.Trade_Id', $Trade_Id);
        $this->db->where('t.Item_Id', $Item_Id);
        $this->db->where("t.Receiver_Id=auo.Seller_Id");
        $this->db->where("auo.Order_Type",'TRADE');
        $this->db->group_by('ai.Item_Id');
        $query = $this->db->get();
        return $query->result();
    }
    public function seller($Trade_Id) {
        $this->db->select("have_Item_Id");
        $this->db->from("trade t");
        $this->db->where('Trade_Id', $Trade_Id);
        $query = $this->db->get();
        $datas = $query->result();
        
        $have_Item_Id =$datas[0]->have_Item_Id;
   
        $this->db->select("ai.Item_Name,ai.Item_FrontPicture,t.Trade_Id,auo.Order_Id,auo.Order_Status,auo.Tracking_No1,auo.Tracking_No2,t.*,au.User_Id as suserid,au.User_Name as seller");
        $this->db->from("trade t,auction_item ai");
        $this->db->join("auction_user au", "au.User_Id = t.User_Id");
        $this->db->join("auction_user_order auo", "auo.Item_Id = $Trade_Id");
        $this->db->where("ai.Item_Id IN ($have_Item_Id)");
        
        $this->db->where('t.Trade_Id', $Trade_Id);
        $this->db->where('t.have_Item_Id', $have_Item_Id);
        $this->db->where("t.User_Id=auo.Seller_Id");
        $this->db->where("auo.Order_Type",'TRADE');
        $this->db->group_by('ai.Item_Id');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function buyer($Trade_Id) {

        $this->db->select("Item_Id");
        $this->db->from("trade t");
        $this->db->where('Trade_Id', $Trade_Id);
        $query = $this->db->get();
        $datas = $query->result();

        $Item_Id =$datas[0]->Item_Id;


        $this->db->select("ai.Item_Name,ai.Item_FrontPicture,t.Trade_Id,auo.Order_Id,auo.Order_Status,auo.Tracking_No1,auo.Tracking_No2,t.*,au.User_Id as buserid,au.User_Name as buyer");
        $this->db->from("trade t,auction_item ai");
        $this->db->join("auction_user au", "au.User_Id = t.Receiver_Id");
        $this->db->join("auction_user_order auo", "auo.Item_Id = $Trade_Id");
        
        $this->db->where("ai.Item_Id IN ($Item_Id)");
        
        $this->db->where('t.Trade_Id', $Trade_Id);
        $this->db->where('t.Item_Id', $Item_Id);
        $this->db->where("t.Receiver_Id=auo.Seller_Id");
        $this->db->where("auo.Order_Type",'TRADE');
        $this->db->group_by('ai.Item_Id');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getshippedTradelist() {
        $this->db->select("t.*,au.User_Id as buserid,au.User_Name as buyer,au.User_Email as buyerEmail,au.User_Address as buyerAddress,au.User_Phone as buyerPhone,asa.User_Id as suserid,asa.User_Name as seller,asa.User_Email as sellerEmail,asa.User_Address as sellerAddress,asa.User_Phone as sellerPhone,ai.Item_FrontPicture");
        $this->db->from("trade t");
        $this->db->join("auction_item ai", "ai.Item_Id = t.Item_Id");
        $this->db->join("auction_user au", "au.User_Id = t.Receiver_Id", "left");
        $this->db->join("auction_user asa", "asa.User_Id = t.User_Id", "left");
        $this->db->where('t.Trade_Status', 1);
        $where = '(t.Is_Verify= 2  or t.Is_Verify = 3)';
        $this->db->where($where);
        $this->db->order_by('t.Trade_Id', "desc");
        $this->db->group_by('t.Trade_Id');
        $query = $this->db->get();

        return $query->result();
    }
    public function getsellerlist($Trade_Id) {
        $this->db->select("have_Item_Id");
        $this->db->from("trade t");
        $this->db->where('Trade_Id', $Trade_Id);
        $query = $this->db->get();
        $datas = $query->result();

        $have_Item_Id =$datas[0]->have_Item_Id;

         $this->db->select("ai.Item_Id,ai.Item_Name,ai.Item_FrontPicture,t.Trade_Id,auo.Order_Id,auo.Order_Status,auo.Tracking_No1,t.Receiver_Id,t.User_Id,t.Trade_Status,au.User_Id as suserid,au.User_Name as seller");
        $this->db->from("trade t,auction_item ai");
        $this->db->join("auction_user au", "au.User_Id = t.User_Id");
        $this->db->join("auction_user_order auo", "auo.Item_Id = $Trade_Id");
        $this->db->where("ai.Item_Id IN ($have_Item_Id)");
        $this->db->where('t.Trade_Id', $Trade_Id);
        $this->db->where('t.have_Item_Id', $have_Item_Id);
        $this->db->where("t.User_Id=auo.Seller_Id");
        $this->db->where("auo.Order_Status",2);
        $this->db->where("auo.Order_Type",'TRADE');
        $this->db->group_by('ai.Item_Id');
        $query = $this->db->get();
        return $query->result();
    }

    public function getbuyerlist($Trade_Id) {

        $this->db->select("Item_Id");
        $this->db->from("trade t");
        $this->db->where('Trade_Id', $Trade_Id);
        $query = $this->db->get();
        $datas = $query->result();

        $Item_Id =$datas[0]->Item_Id;

        $this->db->select("ai.Item_Id,ai.Item_Name,ai.Item_FrontPicture,t.Trade_Id,auo.Order_Id,auo.Order_Status,auo.Tracking_No1,t.Receiver_Id,t.User_Id,t.Trade_Status,au.User_Id as buserid,au.User_Name as buyer");
        $this->db->from("trade t,auction_item ai");
        $this->db->join("auction_user au", "au.User_Id = t.Receiver_Id");
        $this->db->join("auction_user_order auo", "auo.Item_Id = $Trade_Id");
        $this->db->where("ai.Item_Id IN ($Item_Id)");
        $this->db->where('t.Trade_Id', $Trade_Id);
        $this->db->where('t.Item_Id', $Item_Id);
        $this->db->where("t.Receiver_Id=auo.Seller_Id");
        $this->db->where("auo.Order_Type",'TRADE');
        $this->db->where("auo.Order_Status",2);
        $this->db->group_by('ai.Item_Id');
        $query = $this->db->get();
        return $query->result();
    }

    public function addtrackno($Order_Id, $Tracking_No2) {
        $data = array(
            'Tracking_No2' => $Tracking_No2
        );
        $this->db->where('Order_Id', $Order_Id);
        $this->db->update('auction_user_order', $data);
        return true;
    }

    public function verifyProduct($Order_Id) {
        $data = array(
            'Order_Status' => 2
        );
        $this->db->where('Order_Id', $Order_Id);
        $this->db->update('auction_user_order', $data);
    }

    public function IsVerify($Trade_Id, $Is_Verify) {

        $data = array(
            'Is_Verify' => $Is_Verify
        );
        $this->db->where('Trade_Id', $Trade_Id);
        $this->db->update('trade', $data);
    }

//    public function getundeliveredlist() {
//        
//
//        $query = $this->db->query("SELECT auo.*,ai.*,au.User_Id as buserid,au.User_Name as buyer,au.User_Email as buyerEmail,au.User_Address as buyerAddress,au.User_Phone as buyerPhone,asa.User_Id as suserid,asa.User_Name as seller,asa.User_Email as sellerEmail,asa.User_Phone as sellerPhone,ai.Item_FrontPicture
//                        FROM auction_user_order auo 
//                        left join auction_item ai on ai.Item_Id = auo.Item_Id
//                        left join auction_user au on au.User_Id = auo.User_Id
//                        left join auction_user asa on asa.User_Id = auo.Seller_Id
//                        WHERE Tracking_No2 !='' AND Order_Complete='0'");
//
//        
//
//        return $query->result();
//    }
    public function getundeliveredlist() {
        $this->db->select("auo.*,ai.*,auo.Tracking_No1,auo.Tracking_No2,au.User_Id as buserid,au.User_Name as buyer,au.User_Email as buyerEmail,au.User_Address as buyerAddress,au.User_Phone as buyerPhone,asa.User_Id as suserid,asa.User_Name as seller,asa.User_Email as sellerEmail,asa.User_Phone as sellerPhone,ai.Item_FrontPicture");
        $this->db->from("auction_user_order auo");
        $this->db->join("auction_item ai", "ai.Item_Id = auo.Item_Id","left");
        $this->db->join("auction_user au", "au.User_Id = auo.User_Id", "left");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id", "left");
        $this->db->where('auo.Order_Complete', 0);
        $this->db->where("auo.Tracking_No2 != ''");
        $this->db->group_by('ai.Item_Id');
        $query = $this->db->get();
        return $query->result();
    }


    public function getdeliveredlist() {
        $this->db->select("auo.*,ai.*,auo.Tracking_No1,auo.Tracking_No2,au.User_Id as buserid,au.User_Name as buyer,au.User_Email as buyerEmail,au.User_Address as buyerAddress,au.User_Phone as buyerPhone,asa.User_Id as suserid,asa.User_Name as seller,asa.User_Email as sellerEmail,asa.User_Phone as sellerPhone,ai.Item_FrontPicture");
        $this->db->from("auction_user_order auo");
        $this->db->join("auction_item ai", "ai.Item_Id = auo.Item_Id","left");
        $this->db->join("auction_user au", "au.User_Id = auo.User_Id","left");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id","left");
        $this->db->join("trade t", "t.User_Id = auo.Seller_Id","left");
        $this->db->where('auo.Order_Complete', 1);
        $this->db->where("auo.Tracking_No2 != ''");
        $this->db->group_by('ai.Item_Id');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_buyer_track($Order_Id, $Tracking_No4) {
        $data = array(
            'Tracking_No4' => $Tracking_No4
        );
        $this->db->where('Order_Id', $Order_Id);
        $this->db->update('auction_user_order', $data);
    }

}
