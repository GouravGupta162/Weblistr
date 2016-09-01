<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		//$this->load->model('category_model');
		$this->load->model(array('user_model','category_model','list_model'));  //Open 
		$this->load->library(array('session','email'));  // Session on each controller
		$this->load->database(); // db 
		$this->load->helper(array('url','form')); // form action basic things
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/welcome
	 *	- or -
	 * 		http://example.com/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['getAllcat'] = $this->category_model->getAllcat();
		$this->load->view('test_view');
		
	}
	
	
	function home_follow()
	{
		$this->load->view('home_follow');
	}
	
	function wpblog()
	{
		$this->load->view('blog_view');
	}
	
	function login()
	{
		echo "0";
	}
	// public function index()
	// {
		// $this->load->view('welcome_message');
	// }
	// function test(){
		// $this->load->view('home_follow-page');
	// }
}
