<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_list_approve extends CI_Model {

    public function get_approve_item() {
        $this->db->select("auction_item.*,auction_brand.Brand_Name");
		$this->db->from("auction_item");
		$this->db->join("auction_brand","auction_brand.Brand_Id = auction_item.Brand_Id");
		$this->db->where("Item_Status != 1");
		
		$query = $this->db->get();
		
		//echo $this->db->last_query(); die;
		return $query->result();
    }
	
	public function moreitem($itemid)
	{
		$this->db->select("auction_item.*,auction_brand.Brand_Name,auction_user.User_FullName");
		$this->db->from("auction_item");
		$this->db->join("auction_brand","auction_brand.Brand_Id = auction_item.Brand_Id");
		$this->db->join("auction_user","auction_user.User_Id = auction_item.User_Id");
		$this->db->where("Item_Id",$itemid);    
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function accept_item($itemid)
	{
		$this->db->where('Item_Id', $itemid);
		$this->db->update("auction_item",array("Item_Status"=>"1"));
	}
	
	public function update_pic($itemid,$picture)
	{
		$this->db->where('Item_Id', $itemid);
		$this->db->update("auction_item",array("Item_FrontPicture"=>$picture));
	}
	public function update_pic2($itemid,$picture)
	{
		$this->db->where('Item_Id', $itemid);
		$this->db->update("auction_item",array("Item_BackPicture"=>$picture));
	}
	public function update_pic3($itemid,$picture)
	{
		$this->db->where('Item_Id', $itemid);
		$this->db->update("auction_item",array("Item_SidePicture"=>$picture));
	}
	public function update_pic4($itemid,$picture)
	{
		$this->db->where('Item_Id', $itemid);
		$this->db->update("auction_item",array("Item_InsideTagPicture"=>$picture));
	}
	public function update_pic5($itemid,$picture)
	{
		$this->db->where('Item_Id', $itemid);
		$this->db->update("auction_item",array("Item_BoxPicture"=>$picture));
	}
}
