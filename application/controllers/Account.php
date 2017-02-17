<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->model('user','',TRUE);
	 }

	
	public function index()
	{
		$this->load->helper(array('form'));
		$data['content'] = $this->load->view("Account/login",null,TRUE);
		$this->load->view('welcome_message',$data);
		
	}
	
	public function login()
	{
		 //This method will have the credentials validation
	   $this->load->library('form_validation');
	 
	   $this->form_validation->set_rules('username', 'username', 'trim|required');
	   $this->form_validation->set_rules('password', 'password', 'trim|required|callback_check_credentials');
	 
	   if($this->form_validation->run() == FALSE)
	   {
		 //Field validation failed.  User redirected to login page
		$data['content'] = $this->load->view("Account\login",null,TRUE);
		$this->load->view('welcome_message',$data);
	   }
	   else
	   {
		 //Go to private area
		 $data['content'] = "Logged in";
		$this->load->view('welcome_message',$data);
	   }
	}
	
	
	function check_credentials($password)
	 {
	   //Field validation succeeded.  Validate against database
	   $username = $this->input->post('username');
	 
	   //query the database
	   $result = $this->user->login($username, $password);
	 
	   if($result)
	   {
		 $sess_array = array();
		 foreach($result as $row)
		 {
		   $sess_array = array(
			 'id' => $row->id,
			 'username' => $row->username
		   );
		   $this->session->set_userdata('logged_in', $sess_array);
		 }
		 return TRUE;
	   }
	   else
	   {
		 $this->form_validation->set_message('check_credentials', 'Invalid username or password');
		 return false;
	   }
	 }
	
	
}
