<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_aboutus extends CI_Model {

    public function insert_data($adminid, $steps, $exits) {
        if ($exits) {
            $this->db->set('modified', 'NOW()', FALSE);
            $this->db->where('Admin_Id', $adminid);
            $this->db->update('howitworks', array('steps' => $steps));

            return true;
        } else {
            $data = array(
                'Admin_Id' => $adminid,
                'steps' => $steps,
            );
            $this->db->set('created', 'NOW()', FALSE);
            $this->db->insert('howitworks', $data);

            return true;
        }
    }

    public function get_step($adminid) {
        $this->db->select("steps");
        $this->db->from('howitworks');
        $this->db->where('Admin_Id', $adminid);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }
    }

    public function insert_datatrems($adminid, $termscondition, $exits) {
        if ($exits) {
            $this->db->set('modified', 'NOW()', FALSE);
            $this->db->where('Admin_Id', $adminid);
            $this->db->update('tandc', array('tremscondition' => $termscondition));

            return true;
        } else {
            $data = array(
                'Admin_Id' => $adminid,
                'tremscondition' => $termscondition,
            );
            $this->db->set('created', 'NOW()', FALSE);
            $this->db->insert('tandc', $data);

            return true;
        }
    }

    public function get_trems($adminid) {
        $this->db->select("tremscondition");
        $this->db->from('tandc');
        $this->db->where('Admin_Id', $adminid);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }
    }

    public function insert_datappolicy($adminid, $policy, $exits) {
        if ($exits) {
            $this->db->set('modified', 'NOW()', FALSE);
            $this->db->where('Admin_Id', $adminid);
            $this->db->update('policy', array('policy' => $policy));

            return true;
        } else {
            $data = array(
                'Admin_Id' => $adminid,
                'policy' => $policy,
            );
            $this->db->set('created', 'NOW()', FALSE);
            $this->db->insert('policy', $data);

            return true;
        }
    }

    public function get_ppolicy($adminid) {
        $this->db->select("policy");
        $this->db->from('policy');
        $this->db->where('Admin_Id', $adminid);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }
    }

    public function insert_datafpolicy($adminid, $fpolicy, $exits) {
        if ($exits) {
            $this->db->set('modified', 'NOW()', FALSE);
            $this->db->where('Admin_Id', $adminid);
            $this->db->update('fpolicy', array('fpolicy' => $fpolicy));

            return true;
        } else {
            $data = array(
                'Admin_Id' => $adminid,
                'fpolicy' => $fpolicy,
            );
            $this->db->set('created', 'NOW()', FALSE);
            $this->db->insert('fpolicy', $data);

            return true;
        }
    }

    public function get_fpolicy($adminid) {
        $this->db->select("fpolicy");
        $this->db->from('fpolicy');
        $this->db->where('Admin_Id', $adminid);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }
    }

    public function get_feedback() {
        $this->db->select("u.User_Name,u.User_ProfilePic,f.feedback,f.Feedback_Id");
        $this->db->from('feedback f');
        $this->db->join('auction_user u', 'u.User_Id = f.User_Id');
        $this->db->order_by("f.Feedback_Id", "desc");

        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addqueans($que, $ans, $adminid) {
        $data = array(
            'question' => $que,
            'answer' => $ans,
            'Admin_Id' => $adminid
        );

        $this->db->set('created', 'NOW()', FALSE);
        $this->db->insert('faq', $data);

        return true;
    }

    public function delete_faq($fid) {
        $this->db->where('F_Id', $fid);
        $this->db->delete("faq");

        return true;
    }

    public function delete_feedback($Feedback_Id) {
        $this->db->where('Feedback_Id', $Feedback_Id);
        $this->db->delete("feedback");

        return true;
    }
    public function delete_rate($Rate_Id) {
        $this->db->where('Rate_Id', $Rate_Id);
        $this->db->delete("rateus");

        return true;
    }
    public function delete_notification($Notification_Id) {
        $this->db->where('Notification_Id', $Notification_Id);
        $this->db->delete("notification");

        return true;
    }

    public function update_faq($data, $fid) {
        $this->db->set('modified', 'NOW()', FALSE);
        $this->db->where('F_Id', $fid);
        $this->db->update('faq', $data);

        return true;
    }

    public function get_rating() {
        $this->db->select("u.User_Name,u.User_ProfilePic,r.*");
        $this->db->from('rateus r');
        $this->db->join('auction_user u', 'u.User_Id = r.User_Id',"left");
        $this->db->order_by("r.Rate_Id", "desc");

        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
