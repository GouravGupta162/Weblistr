<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contact extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('category_model');
		$this->load->model(array('user_model','category_model','list_model','contact_model'));  //Open 
		$this->load->library(array('session','email'));  // Session on each controller
		$this->load->database(); // db 
		$this->load->helper(array('url','form')); // form action basic things
		
	}
	public function index()
	{
		$data['title']= 'Contact';
		
		
		$this->load->view('header_view',$data);
		//$data["fetchup"] = $this->user_model->fetchup();
		
		//$data['getAllCategory'] = $this->getAllCategory();
		//$data['getPopularCategory'] = $this->getPopularCategory();
		$this->load->view('contact_view', $data);//$this->load->view("registration_view.php", $data);
		$this->load->view('footer_view',$data);
	}
	//After login first Screen for user
	public function getAllCategory()
	{
		$result=$this->category_model->getAllcategory();
		//var_dump('result',var_export($result));
		//var_dump($result);
		return $result;
	}
	
	public function getPopularCategory()
	{
		$result=$this->category_model->getPopularCategory();
		//var_dump('result',var_export($result));
		//var_dump($result);
		return $result;
	}
	function PostContact()
	{
		$result=$this->contact_model->PostContact();
		return $result;
	}

}
?>