<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

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
    public function validate($Admin_UserName, $Admin_Password) {
		
        $sql = "select * from auction_admin where Admin_Email=? AND Admin_Password=?";
        return $this->db->query($sql, array($Admin_UserName, $Admin_Password))->row_array();
    }

    public function check_name($Admin_Email) {
        $query = $this->db->query("select * from auction_admin where Admin_Email='$Admin_Email'");
        return $query->row_array();
    }

     public function change_data($Admin_Id, $newpassword) {

        $data = array(
            'Admin_Password' => $newpassword
        );

        $this->db->where('Admin_Id', $Admin_Id);
        $this->db->update('auction_admin', $data);
    }

   /* public function change_data($Admin_Email) {
        $Admin_Email = $data['Admin_Email'];
        $query1 = $this->db->query("SELECT *  from auction_admin where Admin_Email = '" . $Admin_Email . "' ");
        $row = $query1->result_array();
        if ($query1->num_rows() > 0) {
            $Admin_Email = $_REQUEST['Admin_Email'];
            $Password = rand(100000, 999999);
            $newpass = $Password;

            $this->db->where('Admin_Email', $Admin_Email);
            $this->db->update('auction_admin', $newpass);
            $mail_message = 'Dear ' . $row[0]['name'] . ',' . "\r\n";
            $mail_message .= 'Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>' . $Password . '</b>' . "\r\n";
            $mail_message .= '<br>Please Update your password.';
            $mail_message .= '<br>Thanks & Regards';
            $mail_message .= '<br>Your company name';
            require ("../PHPMailer/PHPMailerAutoload.php");
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jignesh.sensussoft@gmail.com';   //
            $mail->Password = 'bafadngwykwbrshs';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->From = $DefaultEmailID;
            $mail->FromName = $DefaultEmailSenderName;
            $mail->addAddress($Admin_Email);

            $mail->isHTML(true);

            $mail->Subject = 'WorldWide Local App Password Recovery';
            $mail->Body = $mail_message;
            

            $mail->Send();
            if (!$mail->send()) {

                $this->session->set_flashdata('message', 'Failed to send password, please try again!');
            } else {

                $this->session->set_flashdata('message', 'Password sent to your email!');
            }
            redirect("login/index");
        } else {

            $this->session->set_flashdata('message', 'Email not found try again!');
            redirect("login/forgot");
        }
    }*/

}
