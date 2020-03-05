<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_profile extends CI_Model {

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
     * @see https://codeigniter.com/profile_guide/general/urls.html
     */
    
    public function update_data($Admin_Id,$Admin_UserName,  $Admin_Email, $Admin_Phone, $Admin_Address , $modified) {
        $data = array(
            
            'Admin_UserName' =>$Admin_UserName,
            'Admin_Email' => $Admin_Email,
            'Admin_Phone' => $Admin_Phone,
            'Admin_Address' => $Admin_Address,
            
            'modified' => $modified,
            
        );
        $this->db->where('Admin_Id',$Admin_Id);
	$this->db->update('auction_admin',$data);
    }
    public function update_profile($data,$Admin_Id)
    {
        $this->db->set('modified', 'NOW()', FALSE);
        $this->db->where('Admin_Id',$Admin_Id);
	$this->db->update('auction_admin',$data);

        return true;
       
    }
    
    public function get_admin()
    {
        $query=$this->db->query("select * from auction_admin");
	return $query->result();
    }
    
public function edit_data($Admin_Id)
  {
	$query=$this->db->query("select * from auction_admin where Admin_Id='$Admin_Id'");
	return $query->row_array();
  }
  public function edit_profile($Admin_Id)
  {
	$query=$this->db->query("select * from auction_admin where Admin_Id='$Admin_Id'");
	return $query->row_array();
  }
}
