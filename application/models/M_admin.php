<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

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
    public function add_admin($Admin_Name,$Admin_UserName, $Admin_Email, $Admin_Phone, $Admin_Address, $Admin_Password,$Permission, $created) {
        $data = array(
            'Admin_Name' => $Admin_Name,
            'Admin_UserName' => $Admin_UserName,
            'Admin_Email' => $Admin_Email,
            'Admin_Phone' => $Admin_Phone,
            'Admin_Address' => $Admin_Address,
            'Admin_Password' => $Admin_Password,
            'Admin_Role' => $Permission,
            'Admin_Type' => 'childAdmin',
            'created' => $created
        );
        $this->db->insert('auction_admin', $data);
    }
    public function update_permision($Admin_Id, $Permission, $modified) {
        $data = array(
            
            'Admin_Role' => $Permission,
            'modified' => $modified
        );
        $this->db->where('Admin_Id', $Admin_Id);
        $this->db->update('auction_admin',$data);
    }
    

    public function adminlist() {
        $query = $this->db->query("select * from auction_admin where Admin_Id!='1' order by Admin_Id DESC");
        return $query->result();
    }

    public function delete_data($Admin_Id) {
        $this->db->where('Admin_Id', $Admin_Id);
        $this->db->delete('auction_admin');
    }
    public function edit_data($Admin_Id) {
        $query = $this->db->query("select * from auction_admin where Admin_Id='$Admin_Id'");
        return $query->row_array();
    }
    

   

}
