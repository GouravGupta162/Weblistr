<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('user_model','category_model','list_model','contact_model','featured_model','write_review_model','search_model'));  //Open 
		$this->load->library(array('session','email'));  // Session on each controller
		$this->load->database(); // db 
		$this->load->helper(array('url','form')); // form action basic things
		//$this->load->library('../controllers/Category');// another controler Category
		 
	}
	public function index()
	{
		//echo $q;
		//exit;
		//$this->search();
	}	
	
	public function query($q = "0")	{
		$data['searchfor'] = '';
		$data['searchresult'] ='';
		
		
		if(trim($q) != "0"){
			
			if (strpos($q, '_') !== false) {
				$q = str_Replace('_',' ',$q);
			}
			$title =  $q;
			$data['title'] = 'Search '.$title;
			$this->load->view('header_view',$data);	
			$data['searchfor'] = $q;
			
			$response = $this->search_model->search($q);
			if(sizeof($response)>0)
			{
				$data['result_status'] = "result";
			}
			else{
				$data['result_status'] = "noresult";
			}
			$data['searchresult'] = $response;//$this->search_model->search($q);
		}
		else
		{
			$data['title']= 'All Results';
			$this->load->view('header_view',$data);	
			$data['result_status'] = "result";		
			$data['searchfor'] = 'All Results';		
			
			
			$response = $this->search_model->search($q);
			
			if(sizeof($response)>0)
			{
				$data['result_status'] = "result";
			}
			else{
				$data['result_status'] = "noresult";
			}
			$data['searchresult'] = $response;//$this->search_model->search($q);

		}
		$this->load->view('search_view', $data); //$this->load->view('welcome_view.php', $data);
		$this->load->view('footer_view',$data);
	}
	
	public function queries($q = "0",$cat = "0")	{
		$data['searchfor'] = '';
		$data['searchresult'] ='';
		$data['result_status'] = "result";
		
		$sql = "SELECT * FROM `category` where FIND_IN_SET($cat,cat_id) ";
		$query = $this->db->query($sql);
		$resultcat = $query->row_array();
		$data['cat_name'] = $resultcat['cat_name'] ;
		
		if($q != "0"){
			
			if (strpos($q, '_') !== false) {
				$q = str_Replace('_',' ',$q);
			}
			$title =  $q;
			$data['title'] = 'Search '.$title;
			$this->load->view('header_view',$data);	
			$data['searchfor'] = $q;
			$data['searchresult'] = $this->search_model->queries($q,$cat);
			if(sizeof($data['searchresult']) > 0)
			{
				$data['result_status'] = "result";
			}
			else{
				$data['result_status'] = "noresult";
			}
			
		}
		else
		{
			$data['title']= 'All Results';
			$this->load->view('header_view',$data);	
			//$data['result_status'] = "noresult";		
			
			$data['searchfor'] = 'All Results';		
			
			$data['searchresult'] = $this->search_model->queriesforzero($cat);
			
			if(sizeof($data['searchresult']) > 0)
			{
				$data['result_status'] = "result";
			}
			else{
				$data['result_status'] = "noresult";
			}
			
		}
		$this->load->view('search_with_cat_view', $data); //$this->load->view('welcome_view.php', $data);
		$this->load->view('footer_view',$data);
	}
	
	
	function getSearch_AutoComplete(){
		$q = strtolower($this->input->post('keyword'));
		
		
		$this->search_model->getSearch_AutoComplete($q);
	}
}
?>