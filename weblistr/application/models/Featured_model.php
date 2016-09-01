<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class featured_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->database();
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
	
	function getFeaturedProduct()
	{
		$sql = "SELECT * FROM product where featured_status = 1 and status = 1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function getFeaturedLike($prdid)
	{
		$id = $prdid;
		//$query = "SELECT (select count(reviews.prd_like) from reviews where reviews.prd_id = 2 and reviews.prd_like= '1' ) as prd_like_count , (select count(reviews.used) from reviews where reviews.prd_id = 2 and reviews.used !='' ) as iused,(select count(reviews.rev_id) from reviews where reviews.prd_id = 2 and review_head != '') as prd_comment_count, '0' as user_liked, '0' as user_commented, '0' as user_bookmarked FROM `product` where product.prd_id = 2";
		$query = "SELECT (select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1' )  as prd_like_count , (select count(reviews.used) from reviews where reviews.prd_id = $id and reviews.used !='' )  as iused,(select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '')  as prd_comment_count, '0' as user_liked, '0' as user_commented, '0' as user_bookmarked FROM `product` where product.prd_id = $id";
		$query = $this->db->query($query);
		return $query->row_array();
	}

	
	
}
?>