<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('category_model');
		$this->load->model(array('user_model','category_model','list_model','write_review_model'));  //Open 
		$this->load->library(array('session','email'));  // Session on each controller
		$this->load->database(); // db 
		$this->load->helper(array('url','form')); // form action basic things
		
	}
	public function index()
	{
		$data['title']= "All Categories - The Weblisters";
		
		
		$this->load->view('header_view',$data);
		//$data["fetchup"] = $this->user_model->fetchup();
		
		$data['getAllCategory'] = $this->getAllCategory();
		$data['getPopularCategory'] = $this->getPopularCategory();
		$this->load->view('category_view', $data);//$this->load->view("registration_view.php", $data);
		$this->load->view('footer_view',$data);
	}
	
	public function select($id)
	{
		
				
		$data['product'] = $this->db->query("SELECT * FROM `product` where FIND_IN_SET($id,cat_id) and status = 1 order by prd_id desc ")->result();
        $data['category'] = $this->db->query("SELECT * FROM `category` where FIND_IN_SET($id,cat_id)")->result();
        $result = $this->db->query("SELECT * FROM `category` where FIND_IN_SET($id,cat_id)")->row_array();
       // =$result;
		$data['title']= $result['cat_name']." - The Weblisters";
		$this->load->view('header_view',$data);

		// if((sizeof($data['product'])>0)&&(sizeof($data['category'])>0))
        // {
			// foreach($data['product'] as $key){
				// //echo $key->prd_id;
			// }
		// }
		// else{
			// //No Products
		// }		
		$data['getRecentReviewbyCategory'] = $this->category_model->getRecentReviewbyCategory($id);
		
		$this->load->view('selectcat_view', $data);//$this->load->view("registration_view.php", $data);
		
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
	
	function getCategory_AutoComplete(){
		$q = strtolower($this->input->post('keyword'));
		$this->category_model->getCategory_AutoComplete($q);
	}
	
	

	
}
?>