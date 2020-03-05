<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_raffle extends CI_Model {

    public function get_raffle() {
        $id = 3;
        $type = intval($id);

        $this->db->select("r.*,ab.Brand_Name,ai.*");
        $this->db->from("raffle r");
        $this->db->join("auction_item ai", "ai.Item_Id = r.Item_Id","left");
        $this->db->join("auction_brand ab", "ai.Brand_Id = ab.Brand_Id","left");
        $this->db->where('Raffle_Status', 0);
        $this->db->order_by("Raffle_Id", "desc");

        $query = $this->db->get();

        return $query->result();
    }

    public function get_raffleUser($Raffle_Id) {
        $id = 3;
        $type = intval($id);

        $this->db->select("c.*,cu.*,au.*");
        $this->db->from("raffle_user cu");
        $this->db->join("raffle c", "c.Raffle_Id = cu.Raffle_Id");
        $this->db->join("auction_user au", "au.User_Id = cu.User_Id");
        $this->db->where('c.Raffle_Id', $Raffle_Id);
        $this->db->order_by("UserRaffle_Id", "desc");

        $query = $this->db->get();

        return $query->result();
    }

    public function get_raffleHistory() {
        $id = 3;
        $type = intval($id);

        $this->db->select("c.*,ab.Brand_Name,ai.*");
        $this->db->from("raffle c");
        $this->db->join("auction_item ai", "ai.Item_Id = c.Item_Id");
        $this->db->join("auction_brand ab", "ai.Brand_Id = ab.Brand_Id");
        $this->db->where('Raffle_Status', 1);
        $this->db->order_by("Raffle_Id", "desc");

        $query = $this->db->get();

        return $query->result();
    }

    public function get_raffleWinner($Raffle_Id) {
        $id = 3;
        $type = intval($id);

        $this->db->select("c.*,cu.*,au.*");
        $this->db->from("raffle_user cu");
        $this->db->join("raffle c", "c.Raffle_Id = cu.Raffle_Id");
        $this->db->join("auction_user au", "au.User_Id = cu.User_Id");
        $this->db->where('c.Raffle_Id', $Raffle_Id);
        $this->db->where('Winner', 1);
        $this->db->order_by("UserRaffle_Id", "desc");

        $query = $this->db->get();

        return $query->result();
    }

    public function delete_raffle($Raffle_Id) {
        $this->db->where('Raffle_Id', $Raffle_Id);
        $this->db->delete("raffle");

        return true;
    }

    public function add_winner($UserRaffle_Id, $Winner) {
        $data = array(
            'Winner' => 1
        );
        $this->db->where('UserRaffle_Id', $UserRaffle_Id);
        $this->db->update('raffle_user', $data);
    }

    public function add_raffle($Raffle_Id, $Raffle_Status) {
        $data = array(
            'Raffle_Status' => 1
        );
        $this->db->where('Raffle_Id', $Raffle_Id);
        $this->db->update('raffle', $data);
    }

    public function add_order($Seller_Id, $User_Id, $Admin_Id, $Item_Id, $Item_Name, $Item_NormalPrice, $Order_Status) {
        $data = array(
            'Seller_Id' => $Seller_Id,
            'User_Id' => $User_Id,
            'Admin_Id' => $Admin_Id,
            'Item_Id' => $Item_Id,
            'Item_Name' => $Item_Name,
            'Item_NormalPrice' => $Item_NormalPrice,
            'Order_Status' => 1
        );
        $this->db->insert('auction_user_order', $data);
    }

    public function addraffledate($data, $Raffle_Id) {

        $this->db->where('Raffle_Id', $Raffle_Id);
        $this->db->update('raffle', array("Start_Date" => $data['sdate'], "End_Date" => $data['edate'], "startdateampm" => $data['sdateampm'], "endddateampm" => $data['edateampm']));

        //print_r($this->db->last_query()); exit;
        return true;
    }

    public function setnotification($data) {
        $this->db->set('created', 'NOW()', FALSE);
        $this->db->insert('notification', array('User_Id' => $data['User_Id'], 'Item_Id' => $data['Item_Id'], 'Notification_Title' => $data['Notification_Title'], 'Notification_Type' => $data['Notification_Type'], 'Notification_Message' => $data['Notification_Message']));

        if ($data['Notification_Type'] != 'auction') {
            return true;
        }
    }

    public function addraffleprice($Raffle_Id,$Raffle_Price) {
       
        $data=array(
          'Raffle_Price' => $Raffle_Price
        );
        
        $this->db->where('Raffle_Id', $Raffle_Id);
        $this->db->update('raffle', $data);
        
        return true;
    }

}
