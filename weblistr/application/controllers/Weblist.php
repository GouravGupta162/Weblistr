<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class weblist extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('category_model');
		$this->load->model(array('user_model','category_model','list_model'));  //Open 
		$this->load->library(array('session','email'));  // Session on each controller
		$this->load->database(); // db 
		$this->load->helper(array('url','form')); // form action basic things
	}
	public function index()
	{
		$data['title']= 'List a Website';
		$this->load->view('header_view',$data);
		$data['getAllcat'] = $this->category_model->getAllcat();
		$this->load->view('list_your_website_view', $data);//$this->load->view("registration_view.php", $data);
		$this->load->view('footer_view',$data);
	}
	
	
	public function edit($id = 0)
	{
		$data['title']= 'Edit Your Website';
		$data['autocom'] = NULL;
		$this->load->view('header_view',$data);
		//$data['getAllcat'] = $this->category_model->getAllcat();
		//$this->load->view('list_your_website_view', $data);//$this->load->view("registration_view.php", $data);
		//$this->load->view('footer_view',$data);
		
			
		$sql = "select cat_id from product where prd_id = $id  ";
		//$sql = "SELECT * FROM `category` where cat_id in (select cat_id from product where prd_id = $id)";
		$query = $this->db->query($sql);
		$data['getAllSelectedCat'] = $query->row_array();//$this->category_model->getSelectedCategory($id);
		
		$sql = "SELECT * FROM `category` ";
		$query = $this->db->query($sql);
		$data['getAllCat'] = $query->result_array();//$this->category_model->getSelectedCategory($id);
		
		$sql = "select * from product where prd_id = $id";
		$query = $this->db->query($sql);
		$data['product'] = $query->row_array();//$this->category_model->getSelectedCategory($id);
		
		$data['autocom'] = $query->num_rows();// $this->db->query($query)->result();
		
		
		$this->load->view('edit_list_website_view', $data);//$this->load->view("registration_view.php", $data);
		$this->load->view('footer_view',$data);
			
	}
	public function add_list_your_website() //add_list_your_website
	{
		if(($this->session->userdata('usr_id')!=""))
		{   
			$userid = $this->session->userdata('usr_id');
		//data: { cat_id:cat_hidden, name:webname,link:weblink , address:webaddress,number:webnumber ,info:webinfo  }
			$this->list_model->add_list_your_website($userid);
		//$result=$this->list_model->add_list_your_website($name,$link,$cat_id,$info);
		}
		else
		{
			echo "0";
		}
	}
	
	public function edit_list_your_website() //add_list_your_website
	{
		if(($this->session->userdata('usr_id')!=""))
		{   
			$userid = $this->session->userdata('usr_id');
			//data: { cat_id:cat_hidden, name:webname,link:weblink , address:webaddress,number:webnumber ,info:webinfo  }
			$this->list_model->edit_list_your_website($userid);
			//$result=$this->list_model->add_list_your_website($name,$link,$cat_id,$info);
		}
		else
		{
			echo "0";
		}
	}
}
?>