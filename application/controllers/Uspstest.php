<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Uspstest extends CI_Controller {
	
	public function __construct() {
        parent::__construct();

        //$this->load->library('USPS');
    }

    public function index()
    {

    	$xml = "<CarrierPickupAvailabilityRequest USERID='879SENSU6454'>
              <FirmName>ABC Corp.</FirmName>
              <SuiteOrApt>Suite 777</SuiteOrApt>
              <Address2>1390 Market Street</Address2>
              <Urbanization></Urbanization>
              <City>Houston</City>
              <State>TX</State>
              <ZIP5>77058</ZIP5>
              <ZIP4>1234</ZIP4>
              </CarrierPickupAvailabilityRequest>";

      $ch = curl_init('https://stg-secure.shippingapis.com/ShippingAPI/?API=CarrierPickupAvailability&XML='.urlencode($xml));
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      $output = curl_exec($ch);
      curl_close($ch);
    
      $data = new SimpleXMLElement($output);
      echo "<pre>"; print_r($data); 

		/*//CREATE AN ARRAY OF ADDRESSES (MAX 5)
		$addresses = array(
			'0' => array(
				'firm_name' => 'XYZ Company',
				'address1' => '1249 Tongass Avenue',
				'address2' => '',
				'city' => 'Alaska',
				'state' => 'AK',
				'zip5' => '99901',
				'zip4' => ''
			),
			'1' => array(
				'firm_name' => 'ABC Company',
				'address1' => '550 E. Van Buren Street',
				'address2' => '',
				'city' => 'Arizona',
				'state' => 'AZ',
				'zip5' => '85004',
				'zip4' => ''
			)
		);


		//RUN ADDRESS STANDARDIZATION REQUEST
		$verified_address = $this->usps->address_standardization($addresses);

		//OUTPUT RESULTS
		echo "<pre>"; print_r($verified_address);

		$verified_address2 = $this->usps->trackorder('EJ958088694US');

		//OUTPUT RESULTS
		echo "<pre>"; print_r($verified_address2);*/

	//	$packagepickup = $this->usps->packagepickup();
	//	echo "<pre>"; print_r($packagepickup);
	}
}