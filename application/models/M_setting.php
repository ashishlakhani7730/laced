<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_setting extends CI_Model {

   public function get_setting() {
        $this->db->select("*");
        $this->db->from('auction_admin');
        $this->db->order_by("Admin_Id", "desc");

        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }


}
