<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function insert_data($User_Name,  $User_Email, $User_Password, $User_Address, $User_Phone, $test, $User_Latitude, $User_Longitude,  $created) {
        $data = array(
            'User_Name' => ucfirst($User_Name),
            'User_Email' => $User_Email,
            'User_Password' => $User_Password,
            'User_Address' => $User_Address,
            'User_Phone' => $User_Phone,
            'User_ProfilePic' => $test,
            'User_Latitude' => $User_Latitude,
            'User_Longitude' => $User_Longitude,
            'created' => $created,
            
        );
        $this->db->insert('auction_user',$data);
    }
    public function update_data($User_Id,$User_Name, $User_Email, $User_Password, $User_Address, $User_Phone, $test,  $modified) {
        $data = array(
            'User_Name' => ucfirst($User_Name),
            'User_Email' => $User_Email,
            'User_Password' => $User_Password,
            'User_Address' => $User_Address,
            'User_Phone' => $User_Phone,
            'User_ProfilePic' => $test,
            'modified' => $modified,
            
        );
        $this->db->where('User_Id',$User_Id);
	$this->db->update('auction_user',$data);
    }
    
    public function active_data($User_Id) {
        $flag='1';
        $data = array(
            'User_Status' =>$flag
        );
        $this->db->where('User_Id',$User_Id);
	$this->db->update('auction_user',$data);
    }
    public function deactive_data($User_Id) {
        $flag='0';
        $data = array(
            'User_Status' =>$flag
        );
        $this->db->where('User_Id',$User_Id);
	$this->db->update('auction_user',$data);
    }
    public function get_user()
    {
        $query=$this->db->query("select * from auction_user order by User_Id DESC");
	return $query->result();
    }
	
	public function get_user_verify()
    {
        $query=$this->db->query("select * from auction_user where User_verified = '1' order by User_Id DESC");
	return $query->result();
    }
     public function delete_data($User_Id)
  {
        $this->db->where('User_Id', $User_Id);
        $this->db->delete('auction_user');
  }
public function edit_data($User_Id)
  {
	$query=$this->db->query("select * from auction_user where User_Id='$User_Id'");
	return $query->row_array();
  }
  public function verifyUser($UserId) {
        
        $data = array(
            'User_verified' =>1
        );
        $this->db->where('User_Id',$UserId);
	$this->db->update('auction_user',$data);
    }
}
