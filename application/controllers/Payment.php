<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('m_payment');
    }

    public function index() {
        $data['payment_list'] = $this->m_payment->getpaymentlist();
//    	echo "<pre>"; print_r($data['payment_list'] ); die;
        $this->load->view('paymentlist', $data);
    }

    public function more_detail($suserid) {

        $data['payment_list'] = $this->m_payment->getpaymentdetail($suserid);
//    	echo "<pre>"; print_r($data['payment_list'] ); exit;
        $this->load->view('morePaymentDetail', $data);
    }

    public function payment_history() {

        $data['payment_list'] = $this->m_payment->paymentHistorylist();
//    	echo "<pre>"; print_r($data['payment_list'] ); exit;
        $this->load->view('payment_history', $data);
    }

    public function completePayment() {
        
        $suserid = $this->input->post('suserid');
        
        $this->db->select("ap.Payment_Id");
        $this->db->from("auction_payment ap");
        $this->db->join("auction_user_order auo", "ap.Info_Id = auo.Order_Id", "left");
        $this->db->join("auction_user au", "au.User_Id = ap.User_Id", "left");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id", "left");
        $this->db->join("auction_item ai", "ai.Item_Id = auo.Item_Id");
        $this->db->where('asa.User_Id', $this->input->post('suserid'));
        $this->db->where('Payment_Complete', 0);
        $querys = $this->db->get();
        $datas = $querys->result();

        $paymentData = [];
        foreach ($datas as $data):
            $paymentData[] = $data->Payment_Id;
        endforeach;

        $Payment_Id = implode(',', $paymentData);
      
        $this->db->select("sum(auo.Item_NormalPrice) as total");
        $this->db->from("auction_payment ap");
        $this->db->join("auction_user_order auo", "ap.Info_Id = auo.Order_Id");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id", "left");
        $this->db->where("ap.Payment_Id IN ($Payment_Id)");
        $query = $this->db->get();
        $dataaa = $query->result();
         $Payment = [];
        foreach ($dataaa as $dataa):
            $Payment[] = $dataa->total;
        endforeach;
        $Payments = implode(',', $Payment);
       
        $payment = paymentRefund($suserid,$Payments);
        
        $Payment_Complete = $this->input->post('Payment_Complete');
        $this->m_payment->completePayment($Payment_Id, $Payment_Complete);
    }

    public function add_all_walletBalance() {
        $suserid = $this->input->post('suserid');
        $this->db->select("ap.Payment_Id");
        $this->db->from("auction_payment ap");
        $this->db->join("auction_user_order auo", "ap.Info_Id = auo.Order_Id", "left");
        $this->db->join("auction_user au", "au.User_Id = ap.User_Id", "left");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id", "left");
        $this->db->join("auction_item ai", "ai.Item_Id = auo.Item_Id");
        $this->db->where('asa.User_Id', $this->input->post('suserid'));
        $this->db->where('Payment_Complete', 0);
        $querys = $this->db->get();
        $datas = $querys->result();
        $paymentData = [];
        foreach ($datas as $data):
            $paymentData[] = $data->Payment_Id;
        endforeach;

        $Payment_Id = implode(',', $paymentData);

        $this->db->select("sum(auo.Item_NormalPrice) as total");
        $this->db->from("auction_payment ap");
        $this->db->join("auction_user_order auo", "ap.Info_Id = auo.Order_Id", "left");
        $this->db->join("auction_user au", "au.User_Id = ap.User_Id", "left");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id", "left");
        $this->db->join("auction_item ai", "ai.Item_Id = auo.Item_Id");
        $this->db->where('Payment_Complete', 0);
        $this->db->group_by('asa.User_Id');
        $query = $this->db->get();
        $datas = $query->result();
        $total = [];
        foreach ($datas as $data):
            $total['total'] = $data->total;
        endforeach;

        $this->db->select("wl.*");
        $this->db->from("wallet_ledger wl");
        $this->db->where('wl.User_Id', $this->input->post('suserid'));
        $this->db->group_by('wl.User_Id');
        $this->db->order_by("Wallet_Id", "desc");
        $query = $this->db->get();
        $datass = $query->result();
        $walletData = [];
        foreach ($datass as $datas):
            $walletData['Wallet_Pre_Balance'] = $datas->Wallet_Pre_Balance;
            $walletData['Wallet_Post_Balance'] = $datas->Wallet_Post_Balance;
            $walletData['Wallet_Current_Balance'] = $datas->Wallet_Current_Balance;
        endforeach;

        $Wallet_Pre_Balance = $walletData['Wallet_Current_Balance'];
        $Wallet_Post_Balance = $walletData['Wallet_Current_Balance'] + $total['total'];
        $Wallet_Current_Balance = $Wallet_Post_Balance;
        $Message = 'Instabuy Payment';
        $Type = 'Wallet';
        $Payment_TransferNo = $this->input->post('Payment_TransferNo');
        $Payment_Complete = $this->input->post('Payment_Complete');
        $this->m_payment->completePayment($Payment_Id, $Payment_Complete);
        $this->m_payment->add_walletBalance($suserid, $Wallet_Pre_Balance, $Wallet_Post_Balance, $Wallet_Current_Balance, $Message,$Type,$Payment_TransferNo);
        $this->m_payment->upd_user_balance($suserid, $Wallet_Current_Balance);
    }

     public function complete_Payment() {
        $Payment_Id = $this->input->post('Payment_Id');
        $suserid = $this->input->post('suserid');
       
        $this->db->select("auo.Item_NormalPrice");
        $this->db->from("auction_payment ap");
        $this->db->join("auction_user_order auo", "ap.Info_Id = auo.Order_Id");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id", "left");
        $this->db->where('ap.Payment_Id', $Payment_Id);
        $query = $this->db->get();
        $datas = $query->result();
        
         $Payment = [];
        foreach ($datas as $data):
            $Payment[] = $data->Item_NormalPrice;
        endforeach;
        $Payments = implode(',', $Payments);
        $payment = paymentRefund($suserid,$PaymentId);
        
        $Payment_Complete = $this->input->post('Payment_Complete');
        $this->m_payment->complete_Payment($Payment_Id, $Payment_Complete);
    }

    public function add_walletBalance() {

        $Payment_Id = $this->input->post('Payment_Id');
        $suserid = $this->input->post('suserid');

        $this->db->select("wl.*,auo.Item_NormalPrice");
        $this->db->from("wallet_ledger wl,auction_payment ap");
        $this->db->join("auction_user_order auo", "ap.Info_Id = auo.Order_Id");
        $this->db->join("auction_user asa", "asa.User_Id = auo.Seller_Id", "left");
        $this->db->where('wl.User_Id', $this->input->post('suserid'));
        $this->db->order_by("Wallet_Id", "desc");
        $this->db->limit('1');
        $query = $this->db->get();
        $datas = $query->result();
         
        $walletData = [];
        foreach ($datas as $data):
            $walletData['Wallet_Pre_Balance'] = $data->Wallet_Pre_Balance;
            $walletData['Wallet_Post_Balance'] = $data->Wallet_Post_Balance;
            $walletData['Wallet_Current_Balance'] = $data->Wallet_Current_Balance;
            $walletData['Item_NormalPrice'] = $data->Item_NormalPrice;

        endforeach;

        $Wallet_Pre_Balance = $walletData['Wallet_Current_Balance'];
        $Wallet_Post_Balance = $walletData['Wallet_Current_Balance'] + $walletData['Item_NormalPrice'];
        $Wallet_Current_Balance = $Wallet_Post_Balance;
        $Message = 'Instabuy Payment';
        $Type = 'Wallet';
        $Payment_TransferNo=$this->input->post('Payment_TransferNo');
        $Payment_Complete = $this->input->post('Payment_Complete');
        $this->m_payment->completePayment($Payment_Id, $Payment_Complete);
        $this->m_payment->add_walletBalance($suserid, $Wallet_Pre_Balance, $Wallet_Post_Balance, $Wallet_Current_Balance, $Message,$Type,$Payment_TransferNo);
        $this->m_payment->upd_user_balance($suserid, $Wallet_Current_Balance);
    }

    public function delete_data() {

        $feedback = $this->m_payment->delete_data($this->uri->segment(3));
        $this->session->set_flashdata('message', 'delete successfully...');
        redirect("Payment/index");
    }

    public function moredetails() {
        if ($this->session->userdata('Admin_Id')) {
            $response = array();

            $this->db->select("ai.*,ab.Brand_Name");
            $this->db->from("auction_item ai");
            $this->db->join("auction_brand ab", "ai.Brand_Id = ab.Brand_Id");
            $this->db->where('Item_Id', $this->input->post('item_id'));

            $query = $this->db->get();
            $data = $query->result();


            $this->db->select("User_ProfilePic");
            $this->db->from("auction_user");
            $this->db->where('User_Id', $this->input->post('buyerid'));

            $query2 = $this->db->get();
            $data['buyerimg'] = $query2->row_array();

            $this->db->select("Payment_RefrenceNumber");
            $this->db->from("auction_payment");

            $query2 = $this->db->get();
            $data['refeno'] = $query2->row_array();

            $this->db->select("User_ProfilePic");
            $this->db->from("auction_user");
            $this->db->where('User_Id', $this->input->post('sellerid'));

            $query2 = $this->db->get();
            $data['sellerimg'] = $query2->row_array();


            //echo "<pre>"; print_r($data);

            if ($data) {
                $response['code'] = 1;
                $response['data'] = $data;
            } else {
                $response['code'] = 0;
                $response['message'] = "Please Try Again!";
            }



            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            redirect('login');
        }
    }

}
