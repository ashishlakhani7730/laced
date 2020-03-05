<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_changepwd extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
        
        
        public function check_name($Admin_Id,$oldpassword)
        {
            $query=$this->db->query("select * from auction_admin where Admin_Id='$Admin_Id' and Admin_Password='$oldpassword'");
            return $query->row_array();
        }
        public function changepass($Admin_Id,$newpassword) {
        $data = array(
            
            'Admin_Password' => $newpassword
            
        );
        $this->db->where('Admin_Id',$Admin_Id);
	$this->db->update('auction_admin',$data);
    }
}
