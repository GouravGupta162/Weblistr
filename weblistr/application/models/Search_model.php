<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->model(array('user_model','category_model','list_model','contact_model','featured_model','write_review_model'));  //Open 
		$this->load->library(array('session','email')); 
		$this->load->helper(array('url','form'));
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
	function queries($keyword,$catId)
	{
		$sql = "select product.*,'prd' as result_type from product where (product.prd_name like '%$keyword%'or product.prd_link like '%$keyword%') and FIND_IN_SET($catId ,product.cat_id) ";

		$results = array();
		if($this->db->query($sql)->num_rows() > 0) {
			$results = $this->db->query($sql)->result();
		}
		//$result = $this->db->query($sql)->result();
        return $results;
	}
	
	function queriesforzero($catId) //if 0 typed
	{
		$sql = "select product.*,'prd' as result_type from product where cat_id = $catId ";
		$results = array();
		if($this->db->query($sql)->num_rows() > 0) {
			$results = $this->db->query($sql)->result();
		}
		//$result = $this->db->query($sql)->result();
        return $results;
	}
	
	function search($keyword)
	{
	
		if(($keyword != '')&&($keyword != null)&&($keyword != '0')){
			
			$sql = "select product.*,'prd' as result_type from product where (product.prd_name like '%$keyword%' or product.prd_link like '%$keyword%') and status = 1 ";
			
			
			// $sql = "select product.*,category.cat_name,'prd' as result_type";
			// $sql = $sql." from product,category ";
			// $sql = $sql." where product.prd_name like '$keyword%'";
			// $sql = $sql." and category.cat_id = product.cat_id";
			// $sql = $sql." union all"; //Union All
			// $sql = $sql." select product.*,category.cat_name,'tag' as result_type";
			// $sql = $sql." from product,category";
			// $sql = $sql." where product.prd_id in (";
			// $sql = $sql." select prd_id from product_tags where tag_id in (select tag_id from tags where tag_name like '$keyword%') )";
			// $sql = $sql." and category.cat_id = product.cat_id ";
			
			// $sql = "select product.*,category.cat_name,'prd' as result_type";
			// $sql = $sql." from product,category ";
			// $sql = $sql." where product.prd_info like '$keyword%'";
			// $sql = $sql." and category.cat_id = product.cat_id";
			// $sql = $sql." union all"; //Union All
			// $sql = $sql." select product.*,category.cat_name,'tag' as result_type";
			// $sql = $sql." from product,category";
			// $sql = $sql." where product.prd_id in (";
			// $sql = $sql." select prd_id from product_tags where tag_id in (select tag_id from tags where tag_name like '$keyword%') )";
			// $sql = $sql." and category.cat_id = product.cat_id ";
		}
		else
		{
			$sql = "select product.*,'prd' as result_type from product  where status = 1";
			
			// $sql = "select product.*,category.cat_name,'prd' as result_type";
			// $sql = $sql." from product,category ";
			// $sql = $sql." union all"; //Union All
			// $sql = $sql." select product.*,category.cat_name,'tag' as result_type";
			// $sql = $sql." from product,category";
			// $sql = $sql." where product.prd_id in ( ";
			// $sql = $sql." select prd_id from product_tags where tag_id in (select tag_id from tags ) )";
			// $sql = $sql." and category.cat_id = product.cat_id ";
		}
		$results = array();
		if($this->db->query($sql)->num_rows() > 0) {
			$results = $this->db->query($sql)->result();
		}
		//$result = $this->db->query($sql)->result();
        return $results;
	}
		
	function getSearch_AutoComplete($keyword){ //Category Auto Comeplte
	
	
		$category = $this->input->post('category');
		
		if($category == 0){
			//echo "d";
			
			// $sql = "select product.*,'prd' as result_type";
			// $sql = $sql." from product,category ";
			// $sql = $sql." where  product.status = 1 and (product.prd_name like '%$keyword%' or prd_link like '%$keyword%') and category.cat_id = product.cat_id and category.status = 1 group by prd_id  ";
			
			// $sql = "select product.*,'prd' as result_type";
			// $sql = $sql." from product ";
			// $sql = $sql." where  product.status = 1 and (product.prd_name like '%$keyword%' or prd_link like '%$keyword%') and category.cat_id = product.cat_id and category.status = 1 group by prd_id  ";
			
			$sql = "select product.*,'prd' as result_type";
			$sql = $sql." from product ";
			$sql = $sql." where  product.status = 1 and (product.prd_name like '%$keyword%' or prd_link like '%$keyword%')  group by prd_id  ";
			
		}
		else
		{
			
//$sql = "select product.*,'prd' as result_type from product  ,category where status = 1 and (product.prd_name like '%t%' or prd_link like '%t%') and cat_id = $category and category.cat_id = $category and category.status = 1  group by prd_id "; 

$sql = "select product.*,'prd' as result_type from product ,category where product.status = 1 and (product.prd_name like '%$keyword%' or prd_link like '%$keyword%') and FIND_IN_SET('$category',product.cat_id) and category.cat_id = $category group by product.prd_id "; 

		}
		$result = array();
		if($this->db->query($sql)->num_rows() > 0) {
			$result = $this->db->query($sql)->result_array();
			
			foreach ($result as $row){
				//$row_set[] = htmlentities(stripslashes($row['cat_name'])); //build an array
				$new_row['label']= htmlentities(stripslashes($row['prd_name'])); //Show
				$new_row['value']= $row["prd_id"].','. $row["result_type"]; //Hidden Work
				$row_set[] = $new_row; //build an array
			}
			
			echo json_encode($row_set); //format the array into json data
			
		}
		else{
				echo json_encode('');
		}
		
		
	
		// $this->db->select('*');
		// $this->db->like('prd_name', $q);
		// $query = $this->db->get('product');
		// if($query->num_rows() > 0){
			// foreach ($query->result_array() as $row){
				// //$row_set[] = htmlentities(stripslashes($row['cat_name'])); //build an array
				// $new_row['label']=htmlentities(stripslashes($row['prd_name'])); //Show
				// $new_row['value']= $row["prd_id"].','. $row["cat_id"]; //Hidden Work
				// $row_set[] = $new_row; //build an array
			// }
			// echo json_encode($row_set); //format the array into json data
		// }
	}
}
?>