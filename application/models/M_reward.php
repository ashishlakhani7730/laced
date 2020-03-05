<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_reward extends CI_Model {
    
     public function insert_data($Reward_Name,$Reward_Code,$Price,$Price_Type,$Minimum_Price,$Start_Date,$End_Date,$No_Of_Use,$Condition) {
        $data=array(
            'Reward_Name'=>$Reward_Name,
            'Reward_Code'=>$Reward_Code,
            'Price'=>$Price,
            'Price_Type'=>$Price_Type,
            'Minimum_Price'=>$Minimum_Price,
            'Start_Date'=>$Start_Date,
            'End_Date'=>$End_Date,
            'No_Of_Use'=>$No_Of_Use,
            'Condition'=>$Condition
        );
        $this->db->insert('reward',$data);

    }
    public function get_reward() {
        $id = 3;
        $type = intval($id);

        $this->db->select("*");
        $this->db->from("reward");
       

        $query = $this->db->get();

        return $query->result();
    }
    public function delete_reward($Reward_Id)
	{
		$this->db->where('Reward_Id', $Reward_Id);
		$this->db->delete("reward");
		
		return true;
	}
    
    public function addrewarddate($data, $Raffle_Id) {

        $this->db->where('Raffle_Id', $Raffle_Id);
        $this->db->update('reward', array("Start_Date" => $data['sdate'], "End_Date" => $data['edate'], "startdateampm" => $data['sdateampm'], "endddateampm" => $data['edateampm']));

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

}
