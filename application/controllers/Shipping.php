<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('m_shipping');
    }

    public function index() {
        $data['shipping_list'] = $this->m_shipping->getshippinglist();
        $this->load->view('shipping_item', $data);
    }

    public function unshippedItem() {
        $data['shipping_list'] = $this->m_shipping->getunshippedlist();
        $this->load->view('unshipped_item', $data);
    }

    public function shippedItem() {
        $data['shipping_list'] = $this->m_shipping->getshippedlist();
        $this->load->view('shipped_item', $data);
    }

    public function verifyProduct() {
        $Order_Id = $this->input->post('Order_Id');
        $this->m_shipping->verifyProduct($Order_Id);
    }

    public function undeliveredItem() {
        $data['shipping_list'] = $this->m_shipping->getundeliveredlist();
        $this->load->view('undelivered_item', $data);
    }

    public function deliveredItem() {
        $data['shipping_list'] = $this->m_shipping->getdeliveredlist();
        $this->load->view('delivered_item', $data);
    }

    public function shippingTradeItem() {
        $data['shipping_list'] = $this->m_shipping->getshippingTradelist();

        $this->load->view('shipping_trade_item', $data);
    }

    public function more() {
        $Trade_Id = $this->uri->segment(3);
//		echo $Trade_Id; exit;
//        $data['shipping_list'] = $this->m_shipping->getshippingTradelist();

        $seller_list = $this->m_shipping->getmoresellerlist($Trade_Id);
        $sellers = $this->m_shipping->seller($Trade_Id);
        $buyer_list = $this->m_shipping->getmorebuyerlist($Trade_Id);
        $buyers = $this->m_shipping->buyer($Trade_Id);
//        echo "<pre>";
//        print_r($seller_list);
//        print_r($buyer_list);
//        die;
        $this->load->view('shipping_trade_detail', ['seller_list' => $seller_list, 'sellers' => $sellers, 'buyers' => $buyers, 'buyer_list' => $buyer_list]);
    }

    public function sellerVerify() {
        $suserid = $this->input->post('suserid');
        $Trade_Id = $this->input->post('Trade_Id');

        $this->db->select("auo.Order_Id");
        $this->db->from("auction_user_order auo");
        $this->db->where('auo.Seller_Id', $suserid);
        $this->db->where('auo.Item_Id', $Trade_Id);
        $query = $this->db->get();
        $datas = $query->result();
        $productData = [];
        foreach ($datas as $data):
            $productData[] = $data->Order_Id;
        endforeach;
        $Order_Id = implode(',', $productData);
        $this->m_shipping->verifyProduct($Order_Id);

        $this->db->select("Is_Verify");
        $this->db->from("trade");
        $this->db->where('Trade_Id', $Trade_Id);
        $query = $this->db->get();
        $datass = $query->result();

        $status = [];
        foreach ($datass as $data):
            $status[] = $data->Is_Verify;
        endforeach;
        $IsVerify = implode(',', $status);
        if ($IsVerify == '0') {
            $Is_Verify = 1;
            $this->m_shipping->IsVerify($Trade_Id, $Is_Verify);
        } elseif ($IsVerify == '1') {
            $Is_Verify = 2;
            $this->m_shipping->IsVerify($Trade_Id, $Is_Verify);
        }
    }

    public function buyerVerify() {

        $buserid = $this->input->post('buserid');
        $Trade_Id = $this->input->post('Trade_Id');

        $this->db->select("auo.Order_Id");
        $this->db->from("auction_user_order auo");
        $this->db->where('auo.Seller_Id', $buserid);
        $this->db->where('auo.Item_Id', $Trade_Id);
        $query = $this->db->get();
        $datas = $query->result();

        $productData = [];
        foreach ($datas as $data):
            $productData[] = $data->Order_Id;
        endforeach;
        $Order_Id = implode(',', $productData);
        $this->m_shipping->verifyProduct($Order_Id);

        $this->db->select("Is_Verify");
        $this->db->from("trade");
        $this->db->where('Trade_Id', $Trade_Id);
        $query = $this->db->get();
        $datass = $query->result();

        $status = [];
        foreach ($datass as $data):
            $status[] = $data->Is_Verify;
        endforeach;
        $IsVerify = implode(',', $status);
        if ($IsVerify == '0') {
            $Is_Verify = 1;
            $this->m_shipping->IsVerify($Trade_Id, $Is_Verify);
        } elseif ($IsVerify == '1') {
            $Is_Verify = 2;
            $this->m_shipping->IsVerify($Trade_Id, $Is_Verify);
        }
    }

    public function shippedTradeItem() {
        $data['shipping_list'] = $this->m_shipping->getshippedTradelist();
        $this->load->view('shipped_trade_item', $data);
    }

    public function moreTradeDetail() {
        $Trade_Id = $this->uri->segment(3);
//        $data['shipping_list'] = $this->m_shipping->getshippedTradelist();
        $seller_list = $this->m_shipping->getsellerlist($Trade_Id);
        $sellers = $this->m_shipping->seller($Trade_Id);
        $buyer_list = $this->m_shipping->getbuyerlist($Trade_Id);
        $buyers = $this->m_shipping->buyer($Trade_Id);
        $this->load->view('shipped_trade_detail', ['seller_list' => $seller_list, 'sellers' => $sellers, 'buyers' => $buyers, 'buyer_list' => $buyer_list]);
    }

    public function addsellertrackno() {
        $response = array();
        $suserid = $this->input->post('suserid');
        $Trade_Id = $this->input->post('Trade_Id');
        
        $this->db->select("auo.Order_Id");
        $this->db->from("auction_user_order auo");
        $this->db->where('auo.Seller_Id', $suserid);
        $this->db->where('auo.Item_Id', $Trade_Id);
        $query = $this->db->get();
        $datas = $query->result();

        $productData = [];
        foreach ($datas as $data):
            $productData[] = $data->Order_Id;
        endforeach;
        $Order_Id = implode(',', $productData);

        $Tracking_No2 = $this->input->post('Tracking_No2');
        if ($this->input->post('Tracking_No2') && $this->input->post('Tracking_No2') == '' && $this->input->post('Order_Id') && $this->input->post('Order_Id') == '') {
            $response['code'] = 0;
            $response['message'] = 'Somthing went to wrong please try again.';
        } else {
            $url = "https://secure.shippingapis.com/ShippingAPI.dll";
            $service = "TrackV2";
            $xml = rawurlencode("
            <TrackRequest USERID='538LACED2174'>
                <TrackID ID='" . $Tracking_No2 . "'></TrackID>
                </TrackRequest>");
            $request = $url . "?API=" . $service . "&XML=" . $xml;
            // send the POST values to USPS
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $request);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPGET, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // parameters to post
            $trackingresult = curl_exec($ch);
            curl_close($ch);
            $trackingresult = new SimpleXMLElement($trackingresult);

            if (empty($trackingresult->TrackInfo->TrackDetail)) {
                $response["code"] = 0;
                $response["message"] = "Sorry, Tracking Number is invalid. Please,try again.";
            } else {

                $upmarket = $this->m_shipping->addtrackno($Order_Id, $Tracking_No2);
                if ($upmarket) {
                    $response['code'] = 1;
                    $response['message'] = 'Tracking No Added Successfully';
                } else {
                    $response['code'] = 0;
                    $response['message'] = 'Somthing went to wrong please try again.';
                }
            }
        }

        $this->db->select("Is_Verify");
        $this->db->from("trade");
        $this->db->where('Trade_Id', $Trade_Id);
        $query = $this->db->get();
        $datass = $query->result();

        $status = [];
        foreach ($datass as $data):
            $status[] = $data->Is_Verify;
        endforeach;
        $IsVerify = implode(',', $status);
        if ($IsVerify == '2') {
            $Is_Verify = 3;
            $this->m_shipping->IsVerify($Trade_Id, $Is_Verify);
        } elseif ($IsVerify == '3') {
            $Is_Verify = 4;
            $this->m_shipping->IsVerify($Trade_Id, $Is_Verify);
        }

        echo json_encode($response);
    }

    public function addbuyertrackno() {
        $response = array();
        $buserid = $this->input->post('buserid');
        $Trade_Id = $this->input->post('Trade_Id');

        $this->db->select("auo.Order_Id");
        $this->db->from("auction_user_order auo");
        $this->db->where('auo.Seller_Id', $buserid);
        $this->db->where('auo.Item_Id', $Trade_Id);
        $query = $this->db->get();
        $datas = $query->result();

        $productData = [];
        foreach ($datas as $data):
            $productData[] = $data->Order_Id;
        endforeach;
        $Order_Id = implode(',', $productData);

        $Tracking_No2 = $this->input->post('Tracking_No2');
        if ($this->input->post('Tracking_No2') && $this->input->post('Tracking_No2') == '' && $this->input->post('Order_Id') && $this->input->post('Order_Id') == '') {
            $response['code'] = 0;
            $response['message'] = 'Somthing went to wrong please try again.';
        } else {
            $url = "https://secure.shippingapis.com/ShippingAPI.dll";
            $service = "TrackV2";
            $xml = rawurlencode("
            <TrackRequest USERID='538LACED2174'>
                <TrackID ID='" . $Tracking_No2 . "'></TrackID>
                </TrackRequest>");
            $request = $url . "?API=" . $service . "&XML=" . $xml;
            // send the POST values to USPS
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $request);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPGET, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // parameters to post
            $trackingresult = curl_exec($ch);
            curl_close($ch);
            $trackingresult = new SimpleXMLElement($trackingresult);

            if (empty($trackingresult->TrackInfo->TrackDetail)) {
                $response["code"] = 0;
                $response["message"] = "Sorry, Tracking Number is invalid. Please,try again.";
            } else {

                $upmarket = $this->m_shipping->addtrackno($Order_Id, $Tracking_No2);
                if ($upmarket) {
                    $response['code'] = 1;
                    $response['message'] = 'Tracking No Added Successfully';
                } else {
                    $response['code'] = 0;
                    $response['message'] = 'Somthing went to wrong please try again.';
                }
            }
        }

        $this->db->select("Is_Verify");
        $this->db->from("trade");
        $this->db->where('Trade_Id', $Trade_Id);
        $query = $this->db->get();
        $datass = $query->result();

        $status = [];
        foreach ($datass as $data):
            $status[] = $data->Is_Verify;
        endforeach;
        $IsVerify = implode(',', $status);
        if ($IsVerify == '2') {
            $Is_Verify = 3;
            $this->m_shipping->IsVerify($Trade_Id, $Is_Verify);
        } elseif ($IsVerify == '3') {
            $Is_Verify = 4;
            $this->m_shipping->IsVerify($Trade_Id, $Is_Verify);
        }
        echo json_encode($response);
    }

    public function addtrackno() {
        $response = array();
        $Order_Id = $_POST['Order_Id'];
        $Tracking_No2 = $this->input->post('Tracking_No2');
        
        if ($this->input->post('Tracking_No2') && $this->input->post('Tracking_No2') == '' && $this->input->post('Order_Id') && $this->input->post('Order_Id') == '') {
            $response['code'] = 0;
            $response['message'] = 'Somthing went to wrong please try again.';
        } else {
            $url = "https://secure.shippingapis.com/ShippingAPI.dll";
            $service = "	";
            $xml = rawurlencode("<TrackRequest USERID='538LACED2174'><Tr ackID ID='".$Tracking_No2."'></TrackID></TrackRequest>");
            $request = $url . "?API=" . $service . "&XML=" . $xml;
            // send the POST values to USPS
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $request);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPGET, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // parameters to post
			
            $trackingresult = curl_exec($ch);
			echo json_encode($trackingresult); exit;
            curl_close($ch);
            $trackingresult = new SimpleXMLElement($trackingresult);

            if (empty($trackingresult->TrackInfo->TrackDetail)) {
                $response["code"] = 0;
                $response["message"] = "Sorry, Tracking Number is invalid. Please,try again.";
            } else {
                $update = $this->m_shipping->addtrackno($_POST['Order_Id'], $Tracking_No2);
                if ($update) {
                    $response['code'] = 1;
                    $response['message'] = 'Tracking No Added Successfully';
                } else {
                    $response['code'] = 0;
                    $response['message'] = 'Somthing went to wrong please try again.';
                }
            }
        }

        echo json_encode($response);
    }

    public function moredetails() {
        if ($this->session->userdata('Admin_Id')) {
            $response = array();
            $item_id=$this->input->post('item_id');
            $buyerid=$this->input->post('buyerid');
            $sellerid=$this->input->post('sellerid');
           
            
            $this->db->select("ai.*,ab.Brand_Name");
            $this->db->from("auction_item ai");
            $this->db->join("auction_brand ab", "ai.Brand_Id = ab.Brand_Id","left");
            $this->db->where('Item_Id', $this->input->post('item_id'));

            $query = $this->db->get();
            $data = $query->result();
             

            $this->db->select("User_ProfilePic");
            $this->db->from("auction_user");
            $this->db->where('User_Id', $this->input->post('buyerid'));

            $query2 = $this->db->get();
            $data['buyerimg'] = $query2->row_array();

            $this->db->select("User_ProfilePic");
            $this->db->from("auction_user");
            $this->db->where('User_Id', $this->input->post('sellerid'));

            $query2 = $this->db->get();
            $data['sellerimg'] = $query2->row_array();

//            echo "<pre>"; print_r($data);die;

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
    
    public function haveitem_moredetails() {
        if ($this->session->userdata('Admin_Id')) {
            $response = array();
            $item_id=$this->input->post('Item_Id');
            
            $sellerid=$this->input->post('sellerid');
           
            
            $this->db->select("ai.*,ab.Brand_Name");
            $this->db->from("auction_item ai");
            $this->db->join("auction_brand ab", "ai.Brand_Id = ab.Brand_Id","left");
            $this->db->where('Item_Id', $this->input->post('Item_Id'));

            $query = $this->db->get();
            $data = $query->result();
             

           

            $this->db->select("User_ProfilePic");
            $this->db->from("auction_user");
            $this->db->where('User_Id', $this->input->post('sellerid'));

            $query2 = $this->db->get();
            $data['sellerimg'] = $query2->row_array();

//            echo "<pre>"; print_r($data);die;

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
    
    public function item_moredetails() {
        if ($this->session->userdata('Admin_Id')) {
            $response = array();
            $item_id=$this->input->post('Item_Id');
            
            $sellerid=$this->input->post('sellerid');
           
            
            $this->db->select("ai.*,ab.Brand_Name");
            $this->db->from("auction_item ai");
            $this->db->join("auction_brand ab", "ai.Brand_Id = ab.Brand_Id","left");
            $this->db->where('Item_Id', $this->input->post('Item_Id'));

            $query = $this->db->get();
            $data = $query->result();
             

           
            $this->db->select("User_ProfilePic");
            $this->db->from("auction_user");
            $this->db->where('User_Id', $this->input->post('buyerid'));

            $query2 = $this->db->get();
            $data['buyerimg'] = $query2->row_array();


//            echo "<pre>"; print_r($data);die;

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
    
    public function trackdetail() {
        if ($this->session->userdata('Admin_Id')) {
            $response = array();
            $Tracking_No1 = $this->input->post('Tracking_No1');
            $url = "https://secure.shippingapis.com/ShippingAPI.dll";
            $service = "TrackV2";
            $xml = rawurlencode("
            <TrackRequest USERID='538LACED2174'>
                <TrackID ID='" . $Tracking_No1 . "'></TrackID>
                </TrackRequest>");
            $request = $url . "?API=" . $service . "&XML=" . $xml;
            // send the POST values to USPS
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $request);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPGET, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // parameters to post
            $trackingresults = curl_exec($ch);
            curl_close($ch);
            $trackingresults = new SimpleXMLElement($trackingresults);


            $status = [];
            foreach ($trackingresults as $trackingresult):
                $status['TrackDetail'] = $trackingresult->TrackDetail;
            endforeach;


            if ($status) {

                $response['code'] = 1;
                $response['data'] = $status;
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

    public function tracking() {
//        $data['shipping_list'] = $this->m_shipping->gettrackinglist();
        $this->load->view('tracking_detail');
    }

    public function getTrackingInfo() {
        if ($this->session->userdata('Admin_Id')) {
            $response = array();
            $Tracking_No1 = $this->input->post('Tracking_No1');

            $url = "https://secure.shippingapis.com/ShippingAPI.dll";
            $service = "TrackV2";
            $xml = rawurlencode("
            <TrackRequest USERID='538LACED2174'>
                <TrackID ID='".$Tracking_No1."'></TrackID>
                </TrackRequest>");
            $request=$url."?API=".$service."&XML=".$xml;
            // send the POST values to USPS
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $request);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPGET, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // parameters to post
            $trackingresults = curl_exec($ch);
            curl_close($ch);
            $trackingresults = new SimpleXMLElement($trackingresults);

            $status = [];
            foreach ($trackingresults as $trackingresult):
                $status['TrackDetail'] = $trackingresult->TrackDetail;
            endforeach;

            if ($status) {
                $response['code'] = 1;
                $response['data'] = $status;
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
