<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class category_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->library(array('session','email'));  // Session on each controller
		$this->load->helper(array('url','form'));
    }
	function getAllcat()
	{
		$sql = "SELECT * FROM `category` order by cat_name asc";
		$query = $this->db->query($sql);
		if($query->num_rows()>0)
        {
			return $query->result_array();
		}
	}
	function getAllcatForhomepage()
	{
		$sql = "SELECT * FROM `category` where status = 1 limit 8";
		$query = $this->db->query($sql);
		if($query->num_rows()>0)
        {
			return $query->result_array();
		}
	}
	function catname($catid)
	{
		$sql = "SELECT * FROM `category` where cat_id in($catid) ";
		$query = $this->db->query($sql);
		$resultcat = $query->result_array();
		return $resultcat;
	}
	function getAllcategoryHomeNew()
	{
		$sql = "SELECT * FROM `category` join category_attribute where category.popular_status = 1 and category_attribute.cat_id = category.cat_id limit 10";
		
		// $this->db->select('*'); // <-- There is never any reason to write this line!
		// $this->db->from('category');
		// $this->db->join('category_attribute', 'category_attribute.cat_id = category.cat_id');
		// $query = $this->db->get();
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0)
        {
			return $query->result_array();
		}
	}
	
	function getAllcategoryHome()
	{
		$sql = "SELECT * FROM `category` join category_attribute where category.popular_status = 1 and category_attribute.cat_id = category.cat_id limit 8";
		
		// $this->db->select('*'); // <-- There is never any reason to write this line!
		// $this->db->from('category');
		// $this->db->join('category_attribute', 'category_attribute.cat_id = category.cat_id');
		// $query = $this->db->get();
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0)
        {
			return $query->result_array();
		}
	}
	
	function getRecentReviewbyCategory($id)
	{
		// $sql = "SELECT reviews.*,product.*,user_register.*,review_details.rating_stars
// FROM reviews
// INNER JOIN product ON reviews.prd_id = product.prd_id 
// INNER JOIN user_register ON reviews.usr_id = user_register.usr_id

// INNER JOIN review_details ON reviews.rev_id = review_details.rev_id

 // where reviews.cat_id = $id  order by reviews.rev_id desc limit 2";

 $sql = "SELECT reviews.*,product.*,user_register.*,review_details.rating_stars
FROM reviews
INNER JOIN product ON reviews.prd_id = product.prd_id 
INNER JOIN user_register ON reviews.usr_id = user_register.usr_id

INNER JOIN review_details ON reviews.rev_id = review_details.rev_id

 where product.status = 1 and reviews.cat_id = $id and reviews.status = 1 order by reviews.rev_id desc limit 5";
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function getAllcategory()
	{
		$sql = "SELECT * FROM `category` join category_attribute where category_attribute.cat_id = category.cat_id ";
		
		// $this->db->select('*'); // <-- There is never any reason to write this line!
		// $this->db->from('category');
		// $this->db->join('category_attribute', 'category_attribute.cat_id = category.cat_id');
		// $query = $this->db->get();
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0)
        {
			return $query->result_array();
		}
	}
	
	function getPopularCategory()
	{
		$sql = "select distinct category.cat_id,category.cat_name,category.cat_image from category,product where FIND_IN_SET(1,category.popular_status) and FIND_IN_SET(category.cat_id,product.cat_id) limit 9";//"select cat_id,cat_name,cat_image from category limit 6";
		
		// $this->db->select('*'); // <-- There is never any reason to write this line!
		// $this->db->from('category');
		// $this->db->join('category_attribute', 'category_attribute.cat_id = category.cat_id');
		// $query = $this->db->get();
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0)
        {
			return $query->result_array();
		}
	}
	
	function getPopularProduct($cat_id)
	{
		//select * from product where cat_id = 1
		$sql = "select * from product where status = 1 and FIND_IN_SET($cat_id,product.cat_id) limit 3";
		
		// $this->db->select('*'); // <-- There is never any reason to write this line!
		// $this->db->from('category');
		// $this->db->join('category_attribute', 'category_attribute.cat_id = category.cat_id');
		// $query = $this->db->get();
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0)
        {
			return $query->result_array();
		}
	}
	function getCategory_AutoComplete($q){ //Category Auto Comeplte
		$this->db->select('*');
		$this->db->like('cat_name', $q);
		$query = $this->db->get('category');
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $row){
				//$row_set[] = htmlentities(stripslashes($row['cat_name'])); //build an array
				
				
				$new_row['label']=htmlentities(stripslashes($row['cat_name'])); //Show
				$new_row['value']= $row["cat_id"]; //Hidden Work
				$row_set[] = $new_row; //build an array
			}
			echo json_encode($row_set); //format the array into json data
		}
	}
	/*function fetchup()
	{
		//$this->db->where("id",$user_id);
		//$data = array(
			//'image' => $userfile['file_name']
		//);
		//$this->db->update('user',$data);
		//return true;
		return "fetchu up ";
	}*/

	function checkprd_bookmarked($prd,$usr)
	{
		$sql = "SELECT * FROM `reviews` where prd_id = $prd and usr_id = $usr and bookmark = 1";
		$query = $this->db->query($sql);
		//return $query->row_array();
		if($query->num_rows() > 0){
			return "1";
		}
		else
		{
			return "0";
		}
	}
	
}
?>