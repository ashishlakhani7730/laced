<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_contact extends CI_Model {

    public function get_contact() {

        $this->db->select("*");
        $this->db->from("contact");
        $this->db->where('Contact_Status', 0);
        $this->db->order_by("Contact_Id", "desc");

        $query = $this->db->get();

        return $query->result();
    }
     public function solved_query() {

        $this->db->select("*");
        $this->db->from("contact");
        $this->db->where('Contact_Status', 1);
        $this->db->order_by("Contact_Id", "desc");

        $query = $this->db->get();

        return $query->result();
    }
    public function check_name($Email) {
        $query = $this->db->query("select * from contact where Email='$Email'");
        return $query->row_array();
    }
    public function solve_query($Contact_Id, $Contact_Status) {

        $data = array(
            'Contact_Status' => 1
        );

        $this->db->where('Contact_Id', $Contact_Id);
        $this->db->update('contact', $data);
    }
    public function delete_query($Contact_Id) {
        $this->db->where('Contact_Id', $Contact_Id);
        $this->db->delete("contact");

        return true;
    }

//    public function get_contactUser($Contest_Id) {
//        $id = 3;
//        $type = intval($id);
//
//        $this->db->select("c.*,cu.*,au.*");
//        $this->db->from("contact_user cu");
//        $this->db->join("contact c", "c.Contest_Id = cu.Contest_Id");
//        $this->db->join("auction_user au", "au.User_Id = cu.User_Id");
//        $this->db->where('c.Contest_Id', $Contest_Id);
//        $this->db->order_by("UserContest_Id", "desc");
//
//        $query = $this->db->get();
//
//        return $query->result();
//    }
//
//    public function get_contactHistory() {
//        $id = 3;
//        $type = intval($id);
//
//        $this->db->select("c.*,ab.Brand_Name,ai.*");
//        $this->db->from("contact c");
//        $this->db->join("auction_item ai", "ai.Item_Id = c.Item_Id");
//        $this->db->join("auction_brand ab", "ai.Brand_Id = ab.Brand_Id");
//        $this->db->where('Contest_Status', 1);
//        $this->db->order_by("Contest_Id", "desc");
//
//        $query = $this->db->get();
//
//        return $query->result();
//    }
//
//    public function get_contactWinner($Contest_Id) {
//        $id = 3;
//        $type = intval($id);
//
//        $this->db->select("c.*,cu.*,au.*");
//        $this->db->from("contact_user cu");
//        $this->db->join("contact c", "c.Contest_Id = cu.Contest_Id");
//        $this->db->join("auction_user au", "au.User_Id = cu.User_Id");
//        $this->db->where('c.Contest_Id', $Contest_Id);
//        $this->db->where('Winner', 1);
//        $this->db->order_by("UserContest_Id", "desc");
//
//        $query = $this->db->get();
//
//        return $query->result();
//    }
//
//    public function delete_contact($Contest_Id) {
//        $this->db->where('Contest_Id', $Contest_Id);
//        $this->db->delete("contact");
//
//        return true;
//    }
//
//    public function add_winner($UserContest_Id, $Winner) {
//        $data = array(
//            'Winner' => 1
//        );
//        $this->db->where('UserContest_Id', $UserContest_Id);
//        $this->db->update('contact_user', $data);
//    }
//    public function add_contact($Contest_Id, $Contest_Status) {
//        $data = array(
//            'Contest_Status' => 1
//        );
//        $this->db->where('Contest_Id', $Contest_Id);
//        $this->db->update('contact', $data);
//    }
//    public function add_order($Seller_Id, $User_Id ,$Admin_Id,$Item_Id,$Item_Name,$Item_NormalPrice,$Order_Status) {
//        $data = array(
//            'Seller_Id'=>$Seller_Id,
//            'User_Id'=>$User_Id,
//            'Admin_Id'=>$Admin_Id,
//            'Item_Id'=>$Item_Id,
//            'Item_Name'=>$Item_Name,
//            'Item_NormalPrice'=>$Item_NormalPrice,
//            'Order_Status' => 1
//        );
//        $this->db->insert('auction_user_order', $data);
//    }
//    public function addcontactdate($data, $Contest_Id) {
//
//        $this->db->where('Contest_Id', $Contest_Id);
//        $this->db->update('contact', array("Start_Date" => $data['sdate'], "End_Date" => $data['edate'], "startdateampm" => $data['sdateampm'], "endddateampm" => $data['edateampm']));
//
//        //print_r($this->db->last_query()); exit;
//        return true;
//    }
//
//    public function setnotification($data) {
//        $this->db->set('created', 'NOW()', FALSE);
//        $this->db->insert('notification', array('User_Id' => $data['User_Id'], 'Item_Id' => $data['Item_Id'], 'Notification_Title' => $data['Notification_Title'], 'Notification_Type' => $data['Notification_Type'], 'Notification_Message' => $data['Notification_Message']));
//
//        if ($data['Notification_Type'] != 'auction') {
//            return true;
//        }
//    }

}
