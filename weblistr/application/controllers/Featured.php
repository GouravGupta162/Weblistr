<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Featured extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('category_model');
		$this->load->model(array('user_model','category_model','list_model','contact_model','featured_model','write_review_model'));  //Open 
		$this->load->library(array('session','email'));  // Session on each controller
		$this->load->database(); // db 
		$this->load->helper(array('url','form')); // form action basic things
		
	}
	public function index()
	{
		$data['title']= 'Featured';
		
		
		$this->load->view('header_view',$data);
		
		$data['getRecentReviewforfeatured'] = $this->getRecentReviews();
		
		$data['getFeaturedProduct'] = $this->featured_model->getFeaturedProduct();
		$this->load->view('featured_view', $data);//$this->load->view("registration_view.php", $data);
		$this->load->view('footer_view',$data);
	}
	
	function getRecentReviews() //HomePage Views
	{
		$userID = $this->session->userdata('usr_id');
		if($userID != "")
		{
			$sql = "select reviews.rev_id,reviews.review_head,reviews.review_body
			,reviews.date,product.prd_name,product.prd_image,user_register.usr_name,user_register.usr_id,user_register.country,reviews.prd_id
			,(select count(rev.rev_id) from reviews rev where rev.prd_id = reviews.prd_id and status = 1) as total_reviews
			,(select count(rev.rev_id) from review_stats rev where rev.like = 1 and rev.rev_id = reviews.rev_id) as like_count
			,(select count(rev.rev_id) from reviews rev where rev.bookmark = 1 and rev.prd_id = reviews.prd_id) as bookmark_count
			,(select avg(revdtl.rating_stars) from review_details revdtl where revdtl.rev_id = reviews.rev_id) as avg_ttl
			,product.cat_id
			from reviews,product,user_register,tbl_country  , category  
			where product.prd_id = reviews.prd_id
			and product.status = 1
			and user_register.usr_id = reviews.usr_id
			and reviews.review_head != '' and reviews.status = 1
			and category.status = 1
			and category.cat_id = product.cat_id
			order by date desc limit 5";
		
		}
		else
		{
			//Not used under process - 21st March, 2016
			$sql = "select reviews.rev_id,reviews.review_head,reviews.review_body
			,reviews.date,product.prd_name,product.prd_image,user_register.usr_name,user_register.usr_id,user_register.country,reviews.prd_id
			,(select count(rev.rev_id) from reviews rev where rev.prd_id = reviews.prd_id and status = 1) as total_reviews
			,(select count(rev.rev_id) from review_stats rev where rev.like = 1 and rev.rev_id = reviews.rev_id) as like_count
			,(select count(rev.rev_id) from reviews rev where rev.bookmark = 1 and rev.prd_id = reviews.prd_id) as bookmark_count
			,(select avg(revdtl.rating_stars) from review_details revdtl where revdtl.rev_id = reviews.rev_id) as avg_ttl
			,product.cat_id
			from reviews,product,user_register  , category  
			where product.prd_id = reviews.prd_id 
			and product.status = 1
			and user_register.usr_id = reviews.usr_id
			and reviews.review_head != '' and reviews.status = 1 
			and category.status = 1
			and category.cat_id = product.cat_id
			order by date desc limit 5";
		}
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
	}
	
}
?>