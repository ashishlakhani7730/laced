<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_payment extends CI_Model {

    public function getpaymentlist() {
        $this->db->select("ap.Info_Id,sum(auo.Item_NormalPrice) as total,ap.Payment_Id,auo.Item_Id,auo.Item_Name,ap.User_Id as buserid,au.User_Name as buyer,au.User_Email as buyerEmail,asa.User_Id as suserid,asa.User_Name as seller,asa.User_Email as sellerEmail,asa.User_ProfilePic as sellerProfile,ai.Item_FrontPicture");
        $this->db->from("auction_payment ap");
        $this->db->join("auction_user_order auo", "ap.Info_Id = auo.Order_Id", "left");
        $this->db->join("auction_user au", "au.User_Id = ap.User_Id", "left");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id", "left");
        $this->db->join("auction_item ai", "ai.Item_Id = auo.Item_Id");
        $this->db->where('Payment_Complete', 0);
        $this->db->where('Info_Type', 'Instaby');
        $this->db->group_by('asa.User_Id');
        $this->db->order_by("Payment_Id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getpaymentdetail($suserid) {
        $this->db->select("ap.Info_Id,ap.Payment_Id,ap.Pyment_Method,ap.Payment_Amount,ap.Payment_TransferNo,ap.created,auo.Item_NormalPrice,ap.Info_Type,auo.Item_Id,auo.Item_Name,ap.User_Id as buserid,au.User_Name as buyer,au.User_Email as buyerEmail,asa.User_Id as suserid,asa.User_Name as seller,asa.User_Email as sellerEmail,asa.User_ProfilePic as sellerProfile,ai.Item_FrontPicture");
        $this->db->from("auction_payment ap");
        $this->db->join("auction_user_order auo", "ap.Info_Id = auo.Order_Id", "left");
        $this->db->join("auction_user au", "au.User_Id = ap.User_Id", "left");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id", "left");
        $this->db->join("auction_item ai", "ai.Item_Id = auo.Item_Id");
        $this->db->where('Payment_Complete', 0);
        $this->db->where('Info_Type', 'Instaby');
        $this->db->where('asa.User_Id', $suserid);
        $this->db->order_by("Payment_Id", "desc");
        $query = $this->db->get();

        return $query->result();
    }

    public function paymentHistorylist() {
        $this->db->select("ap.Info_Id,ap.Payment_Id,ap.Pyment_Method,ap.Payment_Amount,ap.Payment_TransferNo,ap.created,auo.Item_NormalPrice,ap.Info_Type,auo.Item_Id,auo.Item_Name,ap.User_Id as buserid,au.User_Name as buyer,au.User_Email as buyerEmail,asa.User_Id as suserid,asa.User_Name as seller,asa.User_Email as sellerEmail,asa.User_ProfilePic as sellerProfile,ai.Item_FrontPicture");
        $this->db->from("auction_payment ap");
        $this->db->join("auction_user_order auo", "ap.Info_Id = auo.Order_Id", "left");
        $this->db->join("auction_user au", "au.User_Id = ap.User_Id", "left");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id", "left");
        $this->db->join("auction_item ai", "ai.Item_Id = auo.Item_Id");
        $this->db->where('Payment_Complete', 1);
        $this->db->where('Info_Type', 'Instaby');
        $this->db->order_by("Payment_Id", "desc");
        $query = $this->db->get();

        return $query->result();
    }

    public function completePayment($Payment_Id, $Payment_Complete) {

        $data = array(
            'Payment_Complete' => 1
        );

        $this->db->where("Payment_Id IN ($Payment_Id)");
        $this->db->update('auction_payment', $data);
    }

    public function add_walletBalance($suserid, $Wallet_Pre_Balance, $Wallet_Post_Balance, $Wallet_Current_Balance, $Message,$Type,$Payment_TransferNo) {

        $data = array(
            'User_Id' => $suserid,
            'Wallet_Pre_Balance' => $Wallet_Pre_Balance,
            'Wallet_Post_Balance' => $Wallet_Post_Balance,
            'Wallet_Current_Balance' => $Wallet_Current_Balance,
            'Message' => $Message
        );
        $this->db->insert('wallet_ledger', $data);
        $insert_id = $this->db->insert_id();
        $data1 = array(
            'User_Id' => $suserid,
            'Type' => $Type,
            'Payment_Amount' => $Wallet_Current_Balance,
            'Payment_TransferNo' => $insert_id
        );
        $this->db->insert('payment_history', $data1);
        
    }

    public function upd_user_balance($suserid, $Wallet_Current_Balance) {
        $data = array(
            'wallet_balance' => $Wallet_Current_Balance
        );
        $this->db->where('User_Id', $suserid);
        $this->db->update('auction_user', $data);
    }

    public function complete_Payment($Payment_Id, $Payment_Complete) {
        $data = array(
            'Payment_Complete' => 1
        );
        $this->db->where('Payment_Id', $Payment_Id);
        $this->db->update('auction_payment', $data);
    }

    public function delete_data($Payment_Id) {
        $this->db->where('Payment_Id', $Payment_Id);
        $this->db->delete("auction_payment");

        return true;
    }

}
