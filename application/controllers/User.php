<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('m_user');
    }

    public function index() {
		if($this->session->userdata('Admin_Id'))
		{
			$data['user_list'] = $this->m_user->get_user();
			$this->load->view('show_user', $data);
		}
		else
		{
			redirect('login');
		}
    }
	
	public function user_ver() {
		if($this->session->userdata('Admin_Id'))
		{
			$data['user_list'] = $this->m_user->get_user_verify();
			$this->load->view('user_ver', $data);
		}
		else
		{
			redirect('login');
		}
    }

    public function add() {
		if($this->session->userdata('Admin_Id'))
		{
			$this->load->view('user_form');
		}
		else
		{
			redirect('login');
		}
    }

    public function addp() {
		if($this->session->userdata('Admin_Id'))
		{
			date_default_timezone_set("Asia/Kolkata");
			$created = date("Y-m-d H:i:s");

			$test = uniqFileNameGenerator($_FILES['upload']);
			$destinationPath = FCPATH . 'Items/' . $test;
			move_uploaded_file($_FILES['upload']['tmp_name'], $destinationPath);    



			$config['upload_path'] = './Items/';
			$config['allowed_types'] = 'gif|jpg|png|docx';
			$config['remove_spaces'] = TRUE;
			$config['overwrite'] = FALSE;
			$config['encrypt_name'] = TRUE;
			


			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			
				$this->m_user->insert_data($_POST['User_Name'], $_POST['User_Email'], $_POST['User_Password'], $_POST['User_Address'], $_POST['User_Phone'], $test, $_POST['User_Latitude'], $_POST['User_Longitude'], $created);
				$this->session->set_flashdata('message', 'User Added Successfully..');
				redirect("user/index");
		}
		else
		{
			redirect('login');
		}
    }

    public function editp() {
		if($this->session->userdata('Admin_Id'))
		{
			date_default_timezone_set("Asia/Kolkata");
			$modified = date("Y-m-d H:i:s");

        

			$test = uniqFileNameGenerator($_FILES['upload']);
			$destinationPath = FCPATH . 'Items/' . $test;
			move_uploaded_file($_FILES['upload']['tmp_name'], $destinationPath);    



			$config['upload_path'] = './Items/';
			$config['allowed_types'] = 'gif|jpg|png|docx';
			$config['remove_spaces'] = TRUE;
			$config['overwrite'] = FALSE;
			$config['encrypt_name'] = TRUE;
        


			$this->load->library('upload', $config);
			$this->upload->initialize($config);
        
            $this->m_user->update_data($_POST['User_Id'], $_POST['User_Name'], $_POST['User_Email'], $_POST['User_Password'], $_POST['User_Address'], $_POST['User_Phone'], $test, $modified);
            $this->session->set_flashdata('message', 'User Edit Successfully..');
            redirect("user/index");
        }
		else
		{
			redirect('login');
		}
    }

    public function active_data($User_Id) {

		if($this->session->userdata('Admin_Id'))
		{
			$this->m_user->active_data($User_Id);
			$this->session->set_flashdata('message', 'User Active Successfully...');
			redirect("user/index");
		}
		else
		{
			redirect('login');
		}
    }

    public function deactive_data($User_Id) {
		
		if($this->session->userdata('Admin_Id'))
		{
			$this->m_user->deactive_data($User_Id);
			$this->session->set_flashdata('message', 'User Deactive Successfully...');
			redirect("user/index");
		}
		else
		{
			redirect('login');
		}
    }

    public function edit_data($User_Id) {
		if($this->session->userdata('Admin_Id'))
		{
			$data['update_data'] = $this->m_user->edit_data($User_Id);
			$this->load->view('user_form', $data);
		}
		else
		{
			redirect('login');
		}
    }

    public function delete_data($User_Id) {
		if($this->session->userdata('Admin_Id'))
		{
			$this->m_user->delete_data($User_Id);
			$this->session->set_flashdata('message', 'User Delete Successfully...');
			redirect("user/index");
		}
		else
		{
			redirect('login');
		}
    }

    public function notification()
    {
    	if($this->session->userdata('Admin_Id'))
		{
	    	$status = intval(1);
	    	$zero = intval(0);

	    	$this->db->set('modified', 'NOW()', FALSE);
			$this->db->where('Admin_Id', $status);
			$this->db->where('Notification_Status', $zero);
			$this->db->update('notification',array('Notification_Status' => $status));

			if($this->db->affected_rows() > 0)
			{
				$response['code'] = 1;
			}
			else
			{
				$response['code'] = 0;
			}
			
			echo json_encode($response);
		}
		else
		{
			$response['code'] = 0;
		}
    }

    public function getverifyuserdetail()
    {
    	if($this->session->userdata('Admin_Id'))
		{
            $response = array();
            
	    	$this->db->select("*");
	    	$this->db->from("User_Stripe_Info");
	    	$this->db->where("User_Id",$this->input->post('User_id'));

	    	$query = $this->db->get();

	    $data = $query->result();
    


            if ($data) {

                $response['code'] = 1;

                $response['data'] = $data;
            } else {

                $response['code'] = 0;

                $response['message'] = "Not Verify User!";
            }
			header('Content-Type: application/json');
			 
			echo json_encode($response);
	
    } else {

            redirect('login');
        }
    }
    
    public function verifyUser() {
        if ($this->session->userdata('Admin_Id')) {
            $response = array();
            $User_Id = $this->input->post('User_Id');

            $this->db->select("User_Id");
            $this->db->from("User_Stripe_Info");
            $this->db->where("User_Id",$User_Id);

            $query = $this->db->get();

            $datas = $query->result();
          
            $verifyData = [];
            foreach ($datas as $data):
                $verifyData[] = $data->User_Id;
            endforeach;
            $UserId = implode(',', $verifyData);
            if(empty($UserId)){
                
                print_r('2');
               
            }else{
            $this->m_user->verifyUser($UserId);
            print_r('1');
            }
        }
    }
	
	public function detail()
	{
		//user detail fetch.
		$User_Id = $this->uri->segment("3");
		$this->db->select("*");
		$this->db->from("auction_user");
		$this->db->where("User_Id",$User_Id);
		
		$query = $this->db->get();

	    $data['user'] = $query->result();
		
		//order detail fetch.
		//$sql = "select * from auction_user_order";
		//$query = $this->db->query($sql);
		//$query->result();
		
		$this->db->select('auction_user_order.*,auction_user.User_FullName,auction_item.Item_FrontPicture');
		$this->db->from('auction_user_order');
		$this->db->join('auction_user', 'auction_user_order.Seller_Id = auction_user.User_Id'); 
		$this->db->join('auction_item', 'auction_item.Item_Id = auction_user_order.Item_Id'); 
		$this->db->where("auction_user_order.User_Id",$User_Id);
		$query = $this->db->get();
	    $data['orders'] = $query->result();
		
		//echo $this->db->last_query(); exit;
		//echo "<pre>";print_r($data['orders']); exit;
		$this->load->view("userdetail",$data);
		
		
	}

//     public function verifyuser()
//     {
//     	if($this->session->userdata('Admin_Id'))
// 		{
// 	    	$userid = intval($this->input->post('USERID'));
// 	    	print_r($userid);
// 	    	die;
// 	    	$verified = intval(1);

// 	    	$this->db->set('modified', 'NOW()', FALSE);
// 			$this->db->where('User_Id', $userid);
// 			$this->db->update('auction_user',array('User_verified' => $verified));

// 			if($this->db->affected_rows() > 0)
// 			{
// 				$response['code'] = 1;
// 				$response['message'] = 'User verify successfully.';
// 			}
// 			else
// 			{
// 				$response['code'] = 0;
// 				$response['message'] = 'somthing went to wrong.';
// 			}
			
// 			echo json_encode($response);
// 		}
// 		else
// 		{
// 			$response['code'] = 0;
// 		}
//     }



}
