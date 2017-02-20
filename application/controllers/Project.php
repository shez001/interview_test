<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	/**
		Function to get data from webservice
		
	*/
	private function getProjectData()
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "80",
		  CURLOPT_URL => "http://userservice.staging.tangentmicroservices.com:80/api-token-auth/",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "{\n\t\"username\": \"jacob.zuma\",\n\t\"password\": \"tangent\"\n\t\n}\t",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/json",
			
		  ),
		));

		$token = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} 
		$auth_token = json_decode($token);
	
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
			"authorization: ".$auth_token->token,
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
	 * @author Shahzaad Ismail
	 * @abstract list Page for this controller.
	 */
	public function listProject()
	{
	
		if ($this->session->userdata('logged_in')){
			$data = array();
			$viewData = array();
			$response = $this->getProjectData();
			
			
			if ($response){
				$data['collection'] = json_decode($response);
			}
			
			$viewData['content'] = $this->load->view('Project/listProject',$data,TRUE);
			
			$this->load->view('welcome_message',$viewData);
		}
		else{
			redirect('Account','refresh');
		}
		
		
	}
}
