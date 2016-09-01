<?php
class Verify extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array("url","form","string"));
		$this->load->model("verifymodel");
		$this->load->database();
	}
	function index($id = 0)
	{
		
		//$this->load->view("header");
		$data['verify'] = $this->verify($id);
		//$this->load->view("verify",$data);
		
		//$this->load->view("footer");
	}
	function verify($id)
	{
		$this->verifymodel->index($id);	
	}
	function sendmail($to,$pwd)
	{
		$this->email->from('info@gamer.com', 'Your Name');
		$this->email->to($to);
		
		$this->email->subject('Verify Your Account');
		$link = base_url()."verify/index/".base64_encode($to)."_@_". $pwd;

		$this->email->message('Click on link to verify your account'.$link);
		$this->email->send();
	}
}
?>