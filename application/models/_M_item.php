<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_item extends CI_Model {
   
    public function add_raffle($Item_Id,$Raffle_Price)
    {
        $data=array(
          'Item_Id'=>$Item_Id,
          'Raffle_Price' => 20,
            
        );
        $this->db->insert('raffle',$data);
    }
    public function raffle_data($Item_Id) {
        $flag='1';
        $data = array(
            'RC_Status' =>$flag
        );
        $this->db->where('Item_Id',$Item_Id);
	$this->db->update('auction_item',$data);
    }
    public function add_contest($Item_Id)
    {
        $data=array(
          'Item_Id'=>$Item_Id,
             
        );
        $this->db->insert('contest',$data);
    }
    public function contest_data($Item_Id) {
        $flag='1';
        $data = array(
            'RC_Status' =>$flag
        );
        $this->db->where('Item_Id',$Item_Id);
	$this->db->update('auction_item',$data);
    }
    public function get_item()
    {
        $this->db->select("ai.*,ab.Brand_Name");
        $this->db->from("auction_item ai");
        $this->db->join("auction_brand ab","ai.Brand_Id = ab.Brand_Id");
        $this->db->where('RC_Status' , 0);
        $this->db->order_by("Item_Id", "desc");

        $query = $this->db->get();
    
        return $query->result();
    }
    public function delete_data($item_id)
	{
        $this->db->where('Item_Id', $item_id);
        $this->db->delete('auction_item');
		
		return true;
	}
	public function getitem($Item_Id)
    {
        $query=$this->db->query("select * from auction_item where Item_Id='$Item_Id' ");
	return $query->result();
    }
    public function edit_data($Item_Id)
  {
	$query=$this->db->query("select * from auction_item where Item_Id='$Item_Id' and Item_Status='1'");
	return $query->row_array();
  }
  
  public function get_raffle_user($Item_Id)
  {
        $query=$this->db->query("select t1.created,t1.Raffle_Price,t2.User_Id,User_Name,t3.Item_Id,Item_Name 
                                                    from raffle_user t1 
                                                    inner join auction_user t2 on t1.User_Id=t2.User_Id
                                                    inner join auction_item t3 on t1.Item_Id=t3.Item_Id 
                                                    left join raffle t4 on t4.Raffle_Id=t1.Raffle_Id and t4.Item_Id=t3.Item_Id
                                                    where t1.Item_Id='$Item_Id'");
        return $query->result();
  }
  public function get_raffle()
  {
        $query=$this->db->query("select * from raffle t1
                                                inner join auction_item t3 on t1.Item_Id=t3.Item_Id");
      return $query->result();
  }
  /*public function get_raffle_user()
  {
      $query=$this->db->query("select * from raffle_user as ru ,auction_user as au, auction_item as ai,raffle as r where ru.User_Id=au.User_Id and ru.Item_Id=ai.Item_Id and r.Raffle_Id=ru.Raffle_Id");
      return $query->result();
  }*/
  
  
  public function app_disapp($data)
  {
	  $this->db->set('modified', 'NOW()', FALSE);
	  $this->db->where('Item_Id', $data['Item_Id']);
	  $this->db->where('User_Id', $data['User_Id']);
	  $this->db->update('auction_item', array('Item_Status' => $data['stuatus']));
	  
	  $this->db->set('created', 'NOW()', FALSE);
	  $this->db->insert('notification', array('User_Id' => $data['User_Id'],'Item_Id' => $data['Item_Id'], 'Notification_Title' => $data['Notification_Title'], 'Notification_Type' => $data['Notification_Type'], 'Notification_Message' => $data['Notification_Message']));
	  
	  return true;
  }
  
  public function get_instabuy()
  {
	  $id = 1;
	  $type = intval($id);
	  
	  $this->db->select("ai.*,ab.Brand_Name");
	  $this->db->from("auction_item ai");
    $this->db->join("auction_brand ab","ai.Brand_Id = ab.Brand_Id");
	  $this->db->where('Item_Type', $type);
          $this->db->where('RC_Status', 0);
	  $this->db->order_by("Item_Id", "desc");

	  $query = $this->db->get();
	  
	  return $query->result();
  }
  
  public function get_auction()
  {
	  $id = 3;
	  $type = intval($id);
	  
	  $this->db->select("ai.*,ab.Brand_Name");
	  $this->db->from("auction_item ai");
      $this->db->join("auction_brand ab","ai.Brand_Id = ab.Brand_Id","left");
	  $this->db->where('Item_Type', $type);
      $this->db->where('RC_Status', 0);
	  $this->db->order_by("Item_Id", "desc");

	  $query = $this->db->get();
	  
	  return $query->result();
  }
  
  public function get_trade()
  {
	  $id = 2;
	  $type = intval($id);
	  
	  $this->db->select("ai.*,ab.Brand_Name");
	  $this->db->from("auction_item ai");
      $this->db->join("auction_brand ab","ai.Brand_Id = ab.Brand_Id","left");
      $this->db->where('Item_Type', $type);
      $this->db->where('RC_Status', 0);
	  $this->db->order_by("Item_Id", "desc");

	  $query = $this->db->get();
	  
	  return $query->result();
  }
  
  public function addauctiondate($data,$id)
  {
		$this->db->set('modified', 'NOW()', FALSE);
		$this->db->where('Item_Id', $id);
        $this->db->update('auction_item',array("Item_Sale_StartDate" => $data['sdate'] ,"Item_Sale_EndDate"=> $data['edate'], "startdateampm" => $data['sdateampm'] , "endddateampm" => $data['edateampm']));

		//print_r($this->db->last_query()); exit;
		return true;
  }

  public function setnotification($data)
  {
	  $this->db->set('created', 'NOW()', FALSE);
	  $this->db->insert('notification', array('User_Id' => $data['User_Id'],'Item_Id' => $data['Item_Id'], 'Notification_Title' => $data['Notification_Title'], 'Notification_Type' => $data['Notification_Type'], 'Notification_Message' => $data['Notification_Message']));
	  
    if($data['Notification_Type'] != 'auction')
    {
      return true;
    }
	  
  }

  public function addmarketprice($market,$id)
  {
    $this->db->set('modified', 'NOW()', FALSE);
    $this->db->where('Item_Id', $id);
    $this->db->update('auction_item',array("Item_MarketPrice" => $market));
    return true;
  }
}
