<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	/**
		Function to get data from webservice
		
	*/
	private function getData()
	{
		$curl = curl_init();
		//Using Curl to make the call using the authorization key via headers
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://projectservice.staging.tangentmicroservices.com/api/v1/projects/",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"authorization: 16e0948676a59f358ef34bd8544735a5f5c9f6c7",
			"cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  //echo "cURL Error #:" . $err;
		  return false;
		} else {
		  return $response;
		}
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	/**
	 * list Page for this controller.
	 */
	public function listProject()
	{
		$data = array();
	
		$response = $this->getData();
		
		
		if ($response){
			$data['collection'] = json_decode($response);
		}
		
		$this->load->view('Project/listProject',$data);
	}
}
