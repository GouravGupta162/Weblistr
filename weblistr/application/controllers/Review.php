<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Review extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('category_model');
		$this->load->model(array('user_model','category_model','list_model','contact_model','featured_model','write_review_model'));  //Open 
		$this->load->library(array('session','email'));  // Session on each controller
		$this->load->database(); // db 
		$this->load->helper(array('url','form','file')); // form action basic things
	}
	public function index() //pageload
	{
		$data['title']= 'Check Review';
		
		$this->load->view('header_view',$data);
		//$this->load->view('check_review_view', $data);
		//$this->load->view('footer_view',$data);
	}
	public function detail($id)
	{
		$temp = "Select * from product where prd_id = $id";
		$temprev = $this->db->query($temp)->row_array();
		$data['active'] = $temprev['status'] ;
		$access = $this->session->userdata('admin_status');
		
		if($temprev['status'] == '1')
		{
			$page =  '1';//$_GET['page'];
		 
			$query = "Select * from product where prd_id = $id";
			$row = $this->db->query($query)->row_array();
			$data['title'] = $row['prd_name']. ' - The Weblisters';
			//$data['title']= 'Check Review'.$id;;
			 
			$this->load->view('header_view',$data);
			$userid = $this->session->userdata('usr_id');
			if($userid != "")
			{ 
				$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1')  as prd_like_count , (select count(reviews.prd_share) from reviews where reviews.prd_id = $id and reviews.prd_share <> '0')  as prd_share_count , (select count(reviews.used) from reviews where reviews.prd_id = $id and reviews.used !='' )  as iused, (select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '' )  as prd_comment_count ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like = '1' and reviews.usr_id = $userid )  as user_liked ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.review_head != '' and reviews.usr_id = $userid) as user_commented ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.bookmark = '1' and reviews.usr_id = $userid) as user_bookmarked FROM `product` where product.prd_id = $id";
			}
			else
			{
				$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1' )  as prd_like_count , (select count(reviews.prd_share) from reviews where reviews.prd_id = $id and reviews.prd_share <> '0')  as prd_share_count , (select count(reviews.used) from reviews where reviews.prd_id = $id and reviews.used !='' )  as iused,(select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '')  as prd_comment_count, '0' as user_liked, '0' as user_commented, '0' as user_bookmarked FROM `product` where product.prd_id = $id";
			}
			
			$data['product'] = $this->db->query($query)->result();
			//$data['product'] = $this->db->query($query)->result_array();
			
			$data['reviews'] = $this->getReviews($id);
			
			
			// $data['reviews'] = $this->db->query("
			// select reviews.*,review_details.rating_stars,AVG(review_details.rating_stars) as rat_avg ,
			// user_register.usr_name,user_register.usr_id  from reviews,review_details,user_register 
			// where reviews.prd_id = $id 
			// and review_details.rev_id = reviews.rev_id 
			// and user_register.usr_id = reviews.usr_id  
			// group by reviews.rev_id limit 2")->result();
			
			$data['getAllTags'] = $this->write_review_model->getAllTags($id);
			
			//$data['getRatingSummary'] = $this->write_review_model->getRatingSummary($id); //Original
			$data['getRatingSummary'] = $this->write_review_model->getRatingSummary($id);
			
			
			//related Search
			$data['relatedSearch'] = $this->write_review_model->relatedSearch($id);
			
			$data['getDealProduct'] = $this->write_review_model->getDealProduct($id);
			
			
			$data['getRatingSummaryByGrouping'] = $this->write_review_model->getRatingSummaryByGrouping($id);
			
			
			$this->load->view('check_review_view', $data);//$this->load->view("registration_view.php", $data);
			$this->load->view('footer_view',$data);
		}
		
		else if($access == 1)
		{
			$page =  '1';//$_GET['page'];
		 
			$query = "Select * from product where prd_id = $id";
			$row = $this->db->query($query)->row_array();
			$data['title'] = $row['prd_name']. ' - The Weblisters';
			//$data['title']= 'Check Review'.$id;;
			 
			$this->load->view('header_view',$data);
			$userid = $this->session->userdata('usr_id');
			if($userid != "")
			{ 
				$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1')  as prd_like_count , (select count(reviews.prd_share) from reviews where reviews.prd_id = $id and reviews.prd_share <> '0')  as prd_share_count , (select count(reviews.used) from reviews where reviews.prd_id = $id and reviews.used !='' )  as iused, (select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '' )  as prd_comment_count ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like = '1' and reviews.usr_id = $userid )  as user_liked ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.review_head != '' and reviews.usr_id = $userid) as user_commented ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.bookmark = '1' and reviews.usr_id = $userid) as user_bookmarked FROM `product` where product.prd_id = $id";
			}
			else
			{
				//not logged in
				//$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1' )  as prd_like_count,(select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '')  as prd_comment_count, '0' as user_liked, '0' as user_commented, '0' as user_bookmarked FROM `product` where product.prd_id = $id";
				
				$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1' )  as prd_like_count , (select count(reviews.prd_share) from reviews where reviews.prd_id = $id and reviews.prd_share <> '0')  as prd_share_count , (select count(reviews.used) from reviews where reviews.prd_id = $id and reviews.used !='' )  as iused,(select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '')  as prd_comment_count, '0' as user_liked, '0' as user_commented, '0' as user_bookmarked FROM `product` where product.prd_id = $id";
			}
			
			$data['product'] = $this->db->query($query)->result();
			//$data['product'] = $this->db->query($query)->result_array();
			
			$data['reviews'] = $this->getReviews($id);
			
			
			// $data['reviews'] = $this->db->query("
			// select reviews.*,review_details.rating_stars,AVG(review_details.rating_stars) as rat_avg ,
			// user_register.usr_name,user_register.usr_id  from reviews,review_details,user_register 
			// where reviews.prd_id = $id 
			// and review_details.rev_id = reviews.rev_id 
			// and user_register.usr_id = reviews.usr_id  
			// group by reviews.rev_id limit 2")->result();
			
			$data['getAllTags'] = $this->write_review_model->getAllTags($id);
			
			//$data['getRatingSummary'] = $this->write_review_model->getRatingSummary($id); //Original
			$data['getRatingSummary'] = $this->write_review_model->getRatingSummary($id);
			
			
			//related Search
			$data['relatedSearch'] = $this->write_review_model->relatedSearch($id);
			
			$data['getDealProduct'] = $this->write_review_model->getDealProduct($id);
			
			
			$data['getRatingSummaryByGrouping'] = $this->write_review_model->getRatingSummaryByGrouping($id);
			
			
			$this->load->view('check_review_view', $data);//$this->load->view("registration_view.php", $data);
			$this->load->view('footer_view',$data);
		}
		else {
			
			$page =  '1';//$_GET['page'];
			$query = "Select * from product where prd_id = $id";
			$row = $this->db->query($query)->row_array();
			$data['title'] = $row['prd_name']. ' - The Weblisters';
			//$data['title']= 'Check Review'.$id;;
			 
			$this->load->view('header_view',$data);
			$userid = $this->session->userdata('usr_id');
			if($userid != "")
			{ 
				$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1')  as prd_like_count , (select count(reviews.prd_share) from reviews where reviews.prd_id = $id and reviews.prd_share <> '0')  as prd_share_count , (select count(reviews.used) from reviews where reviews.prd_id = $id and reviews.used !='' )  as iused, (select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '' )  as prd_comment_count ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like = '1' and reviews.usr_id = $userid )  as user_liked ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.review_head != '' and reviews.usr_id = $userid) as user_commented ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.bookmark = '1' and reviews.usr_id = $userid) as user_bookmarked FROM `product` where product.prd_id = $id";
			}
			else
			{
				//not logged in
				//$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1' )  as prd_like_count,(select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '')  as prd_comment_count, '0' as user_liked, '0' as user_commented, '0' as user_bookmarked FROM `product` where product.prd_id = $id";
				
				$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1' )  as prd_like_count , (select count(reviews.prd_share) from reviews where reviews.prd_id = $id and reviews.prd_share <> '0')  as prd_share_count , (select count(reviews.used) from reviews where reviews.prd_id = $id and reviews.used !='' )  as iused,(select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '')  as prd_comment_count, '0' as user_liked, '0' as user_commented, '0' as user_bookmarked FROM `product` where product.prd_id = $id";
			}
			
			$data['product'] = $this->db->query($query)->result();
			//$data['product'] = $this->db->query($query)->result_array();
			
			$data['reviews'] = $this->getReviews($id);
			
			
			// $data['reviews'] = $this->db->query("
			// select reviews.*,review_details.rating_stars,AVG(review_details.rating_stars) as rat_avg ,
			// user_register.usr_name,user_register.usr_id  from reviews,review_details,user_register 
			// where reviews.prd_id = $id 
			// and review_details.rev_id = reviews.rev_id 
			// and user_register.usr_id = reviews.usr_id  
			// group by reviews.rev_id limit 2")->result();
			
			$data['getAllTags'] = $this->write_review_model->getAllTags($id);
			
			//$data['getRatingSummary'] = $this->write_review_model->getRatingSummary($id); //Original
			$data['getRatingSummary'] = $this->write_review_model->getRatingSummary($id);
			
			
			//related Search
			$data['relatedSearch'] = $this->write_review_model->relatedSearch($id);
			
			$data['getDealProduct'] = $this->write_review_model->getDealProduct($id);
			
			
			$data['getRatingSummaryByGrouping'] = $this->write_review_model->getRatingSummaryByGrouping($id);
			
			
			$this->load->view('check_review_view', $data);//$this->load->view("registration_view.php", $data);
			$this->load->view('footer_view',$data);
		}
		
		
	}
	
	
	public function revdetail($id,$revId)
	{
		$temp = "Select * from reviews where rev_id = $revId";
		$temprev = $this->db->query($temp)->row_array();
		$data['active'] = $temprev['status'] ;
		if($temprev['status'] == '1')
		{
			$page =  '1';//$_GET['page'];
		 
			$query = "Select * from product where prd_id = $id";
			$row = $this->db->query($query)->row_array();
			$data['title'] = $row['prd_name']. ' - The Weblisters';
			//$data['title']= 'Check Review'.$id;;
			 
			$this->load->view('header_view',$data);
			$userid = $this->session->userdata('usr_id');
			if($userid != "")
			{ 
				$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1')  as prd_like_count , (select count(reviews.prd_share) from reviews where reviews.prd_id = $id and reviews.prd_share <> '0')  as prd_share_count , (select count(reviews.used) from reviews where reviews.prd_id = $id and reviews.used !='' )  as iused, (select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '' )  as prd_comment_count ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like = '1' and reviews.usr_id = $userid )  as user_liked ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.review_head != '' and reviews.usr_id = $userid) as user_commented ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.bookmark = '1' and reviews.usr_id = $userid) as user_bookmarked FROM `product` where product.prd_id = $id";
			}
			else
			{
				$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1' )  as prd_like_count , (select count(reviews.prd_share) from reviews where reviews.prd_id = $id and reviews.prd_share <> '0')  as prd_share_count , (select count(reviews.used) from reviews where reviews.prd_id = $id and reviews.used !='' )  as iused,(select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '')  as prd_comment_count, '0' as user_liked, '0' as user_commented, '0' as user_bookmarked FROM `product` where product.prd_id = $id";
			}
			
			$data['product'] = $this->db->query($query)->result();
			
			$data['reviews'] = $this->write_review_model->getReviewsbyId($id,$revId);
			
			$data['getAllTags'] = $this->write_review_model->getAllTags($id);
			$data['getRatingSummary'] = $this->write_review_model->getRatingSummary($id);
			//related Search
			$data['relatedSearch'] = $this->write_review_model->relatedSearch($id);
			$data['getDealProduct'] = $this->write_review_model->getDealProduct($id);
			$data['getRatingSummaryByGrouping'] = $this->write_review_model->getRatingSummaryByGrouping($id);
			$this->load->view('review_check_review_view', $data);//$this->load->view("registration_view.php", $data);
			$this->load->view('footer_view',$data);
		}
		else{
			$access = $this->session->userdata('admin_status');
			if($access == 1)
			{
				$page =  '1';//$_GET['page'];
		 
				$query = "Select * from product where prd_id = $id";
				$row = $this->db->query($query)->row_array();
				$data['title'] = $row['prd_name']. ' - The Weblisters';
				//$data['title']= 'Check Review'.$id;;
				 
				$this->load->view('header_view',$data);
				$userid = $this->session->userdata('usr_id');
				if($userid != "")
				{ 
					$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1')  as prd_like_count , (select count(reviews.prd_share) from reviews where reviews.prd_id = $id and reviews.prd_share <> '0')  as prd_share_count , (select count(reviews.used) from reviews where reviews.prd_id = $id and reviews.used !='' )  as iused, (select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '' )  as prd_comment_count ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like = '1' and reviews.usr_id = $userid )  as user_liked ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.review_head != '' and reviews.usr_id = $userid) as user_commented ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.bookmark = '1' and reviews.usr_id = $userid) as user_bookmarked FROM `product` where product.prd_id = $id";
				}
				else
				{
					$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1' )  as prd_like_count , (select count(reviews.prd_share) from reviews where reviews.prd_id = $id and reviews.prd_share <> '0')  as prd_share_count , (select count(reviews.used) from reviews where reviews.prd_id = $id and reviews.used !='' )  as iused,(select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '')  as prd_comment_count, '0' as user_liked, '0' as user_commented, '0' as user_bookmarked FROM `product` where product.prd_id = $id";
				}
				
				$data['product'] = $this->db->query($query)->result();
				
				$data['reviews'] = $this->write_review_model->getReviewsbyId($id,$revId);
				
				$data['getAllTags'] = $this->write_review_model->getAllTags($id);
				$data['getRatingSummary'] = $this->write_review_model->getRatingSummary($id);
				//related Search
				$data['relatedSearch'] = $this->write_review_model->relatedSearch($id);
				$data['getDealProduct'] = $this->write_review_model->getDealProduct($id);
				$data['getRatingSummaryByGrouping'] = $this->write_review_model->getRatingSummaryByGrouping($id);
				$this->load->view('review_check_review_view', $data);//$this->load->view("registration_view.php", $data);
				$this->load->view('footer_view',$data);
			}
			else{
				
				$page =  '1';//$_GET['page'];
				$query = "Select * from product where prd_id = $id";
				$row = $this->db->query($query)->row_array();
				$data['title'] = $row['prd_name']. ' - The Weblisters';
				//$data['title']= 'Check Review'.$id;;
				 
				$this->load->view('header_view',$data);
				$userid = $this->session->userdata('usr_id');
				if($userid != "")
				{ 
					$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1')  as prd_like_count , (select count(reviews.prd_share) from reviews where reviews.prd_id = $id and reviews.prd_share <> '0')  as prd_share_count , (select count(reviews.used) from reviews where reviews.prd_id = $id and reviews.used !='' )  as iused, (select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '' )  as prd_comment_count ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like = '1' and reviews.usr_id = $userid )  as user_liked ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.review_head != '' and reviews.usr_id = $userid) as user_commented ,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.bookmark = '1' and reviews.usr_id = $userid) as user_bookmarked FROM `product` where product.prd_id = $id";
				}
				else
				{
					$query = "SELECT product.*,(select count(reviews.prd_like) from reviews where reviews.prd_id = $id and reviews.prd_like= '1' )  as prd_like_count , (select count(reviews.prd_share) from reviews where reviews.prd_id = $id and reviews.prd_share <> '0')  as prd_share_count , (select count(reviews.used) from reviews where reviews.prd_id = $id and reviews.used !='' )  as iused,(select count(reviews.rev_id) from reviews where reviews.prd_id = $id and review_head != '')  as prd_comment_count, '0' as user_liked, '0' as user_commented, '0' as user_bookmarked FROM `product` where product.prd_id = $id";
				}
				
				$data['product'] = $this->db->query($query)->result();
				
				$data['reviews'] = $this->write_review_model->getReviewsbyId($id,$revId);
			
				
				$data['getAllTags'] = $this->write_review_model->getAllTags($id);
				$data['getRatingSummary'] = $this->write_review_model->getRatingSummary($id);
				//related Search
				$data['relatedSearch'] = $this->write_review_model->relatedSearch($id);
				$data['getDealProduct'] = $this->write_review_model->getDealProduct($id);
				$data['getRatingSummaryByGrouping'] = $this->write_review_model->getRatingSummaryByGrouping($id);
				$this->load->view('review_check_review_view', $data);//$this->load->view("registration_view.php", $data);
				$this->load->view('footer_view',$data);
			}
		}
		

		
		
	}
	
	function getCommentsListofReview()
	{
		return $this->write_review_model->getCommentsListofReview();
	}
	
	public function getScrollReviews()
	{
		$getresult = $_POST['getresult'];
		$prd_id = $_POST['prd_id'];
		$reviews = $this->write_review_model->getScrollReviews($getresult,$prd_id);
		
		if(sizeof($reviews)>0)
		{
		foreach ($reviews as $value) { 
		
		$getReviewCountStats = $this->write_review_model->getReviewCountStats($value->rev_id); //other stats
		$stat=count($getReviewCountStats);
		$getReviewComment = $this->write_review_model->getReviewComment($value->rev_id); //comment
		$countComment=count($getReviewComment);
		?>

		<!--single review start-->
		<div class="review">
		<div class="info-det">
		<div class="profile-pic">


		<?php 
		if(trim($value->register_method) == trim('facebook')){
			if($value->social_id != '')
			{
				?>
				<img width="100%" src="http://graph.facebook.com/<?php echo $value->social_id; ?>/picture?type=square" alt="profile-pic" />
				<?php
			}
			else{
				?>
					<img width="100%" src="http://www.clker.com/cliparts/M/o/W/d/C/j/about-icon-md.png" alt="profile-pic" />
				<?php
			}
		}
		else 
		{
		if($value->profile_image != ''){
			
			if (file_exists($value->profile_image)){ 
				?>
					<img width="100%" src='<?php echo $value->profile_image ?>' alt='profile-pic' />
				<?php
			}
			else{
				?>
					<img width="100%" src="http://www.clker.com/cliparts/M/o/W/d/C/j/about-icon-md.png" alt="profile-pic" />
				<?php
			}
			
		}
		else 
		{
		?>
		<img width="100%" src="http://www.clker.com/cliparts/M/o/W/d/C/j/about-icon-md.png" alt="profile-pic" />
		<?php
		}
		}

		?>

		</div>
		<div class="name reviewAtag">
		<h5> <a href="user/profile/<?php echo $value->usr_id; ?>">   <?php echo $value->usr_name; ?></a></h5>
		<h6></h6>
		</div>
		
		<div class="stars pull-right">
		<!--working here-->
		<?php 

		//echo $value->rat_avg; main stars rating from db

		$arrayData = explode(",",$value->rat_avg);

		$arrayvalue = $arrayData[0];

		$lenvalue = strlen($arrayvalue);



		if($lenvalue > 0)

		{

		if(strpos($arrayvalue, '.') !== FALSE)

		{

		$splited =  explode(".",$arrayvalue);

		$splitersize = sizeof($splited);

		if($splitersize > 1)
		{
			$mainstar = $splited[0];
			$dotstar = $splited[1];
			$this->contact_model->ratingNewWrite($mainstar,$dotstar);
			?><span class="c-count"><?php echo $mainstar; ?>.<?php echo $dotstar; ?> </span> <?php
		}

		}

		else{		
			$this->contact_model->ratingNewWrite($arrayvalue,'0');
			//$this->writeStarForReview($arrayvalue,'0');//echo $arrayvalue;
			?><span class="c-count"><?php echo $arrayvalue?>.0 </span> <?php
		}

		}

		?>

		<!---->

		</div>
		<div class="r-bg">
		
		
		<div class="info-para">
		<h2><?php echo $value->review_head; ?></h2>
		<?php echo $value->review_body; ?>
		</div>

		<!--Images Thumbnail in review section LIST-->
		<?php 
		$revImages = $this->write_review_model->getReviewImages($value->rev_id);
		if(sizeof($revImages)>0)
		{
		?>
		<div class="r_thumbnails">
		<ul>
		<?php
		foreach($revImages as $revimage){
		?>
		<li><a title="<?php echo $value->review_head ?>" data-fancybox-group="gallery<?php echo $value->rev_id; ?>" href="<?php echo $revimage['rev_image'] ?>" class="fancybox"><img src="<?php echo $revimage['thumbnail'] ?>"></a></li>
		<?php
		}
		?>
		</ul>
		</div> 
		<?php
		}
		?>
		
		</div>




		</div>
		<div class="rating">
		<div class="col-md-5 col-xs-12 space">
		</div>
		<div class="col-md-12 col-xs-12 b-bottom">
		<!--was this helpful start-->
		
				
				
		<div class="rtl-count">

		<ul><li>Was This Helpful?</li>





		<?php
// $getReviewCountStats = $this->write_review_model->getReviewCountStats($value->rev_id);  
// $stat = count($getReviewCountStats);

		if($stat>0) {

		$countvalue = $getReviewCountStats[0];



			if($countvalue['helpfull_status']==0) { ?>

			<li><span><a href="javascript:void(0);" onclick="helpfull('<?php echo $value->rev_id;  ?>','1')" id='help_atag_<?php echo $value->rev_id; ?>' >Yes</a></span>

				<span id='help_full_counter_<?php echo $value->rev_id; ?>' ><?php echo $countvalue['helpfull_count'] ?></span> 

			</li>

			<?php }

			else if ($this->session->userdata('usr_id')!= ""){ ?>

			<li><span  class='washelpfulldone'  ><a href="javascript:void(0);" onclick="helpfull('<?php echo $value->rev_id;  ?>','0')" id='help_atag_<?php echo $value->rev_id; ?>' >Yes</a></span>

				<span id='help_full_counter_<?php echo $value->rev_id; ?>' ><?php echo $countvalue['helpfull_count'] ?></span> 

			</li>

			<?php

				}
				else{
			?>
			<li><span><a href="javascript:void(0);" onclick="helpfull('<?php echo $value->rev_id;  ?>','1')" id='help_atag_<?php echo $value->rev_id; ?>' >Yes</a></span>

		<span id='help_full_counter_<?php echo $value->rev_id; ?>' ><?php echo $countvalue['helpfull_count'] ?></span> 

	</li>
			<?php
		}


		 }

		 else 

		 {

			 ?>

			 <li><span><a href="javascript:void(0);" onclick="helpfull('<?php echo $value->rev_id;  ?>','1')" id='help_atag_<?php echo $value->rev_id; ?>' >Yes</a></span><span id='help_full_counter_<?php echo $value->rev_id; ?>' >0</span> </li>

			 <?php

		 } 

		 ?>

		</ul>

		</div>
		
		
		<!--<div class="rtl-count">
		<ul><li>Was This Helpful?</li>


		<?php
		if($stat!=0) {
		$countvalue = $getReviewCountStats[0];

		if($countvalue['helpfull_status']==0) { ?>
		<li><span><a href="javascript:void(0);" onclick="helpfull('<?php echo $value->rev_id;  ?>','1')" id='help_atag_<?php echo $value->rev_id; ?>' >Yes</a></span>
		<span id='help_full_counter_<?php echo $value->rev_id; ?>' ><?php echo $countvalue['helpfull_count'] ?></span> 
		</li>
		<?php }
		else { ?>
		<li><span class='washelpfulldone' ><a href="javascript:void(0);" onclick="helpfull('<?php echo $value->rev_id;  ?>','0')" id='help_atag_<?php echo $value->rev_id; ?>' >Yes</a></span>
		<span id='help_full_counter_<?php echo $value->rev_id; ?>' ><?php echo $countvalue['helpfull_count'] ?></span> 
		</li>
		<?php
		}
		}
		else 
		{
		?>
		<li><span><a href="javascript:void(0);" onclick="helpfull('<?php echo $value->rev_id;  ?>','1')" id='help_atag_<?php echo $value->rev_id; ?>' >Yes</a></span><span id='help_full_counter_<?php echo $value->rev_id; ?>' >0</span> </li>
		<?php
		} 
		?>
		</ul>
		</div>-->
		<!--was this helpful end-->

		<div class="rate-right">
		<!--likeReview(revID,likeStats,favStats,likedislike 1:0) UnderProcess-->
		<!--like start-->

		<?php 
if($stat!=0) {
	
	
	$likecount = $this->db->query("SELECT count(rev_id) as like_count FROM `review_stats` where rev_id = ".$value->rev_id." and `like` = '1' ")->row_array();
$countvalue['like_count'] =  $likecount['like_count'];

		if($countvalue['like_status']==0) { ?>
		<a href="javascript:void(0);"  id='rev_a_like_<?php echo $value->rev_id ?>'   onClick="likeReview('<?php echo $value->rev_id; ?>','1')" >
		<div class="likes">
		<i class="fa fa-thumbs-up " id='thumb_<?php echo $value->rev_id; ?>' ></i>
		<span id='rev_like_counter_<?php echo $value->rev_id ?>'>
		<?php $this->write_review_model->ReviewCountNew($value->rev_id); //echo $countvalue['like_count']; 
		?>  </span>

		</div></a>

		<?php }

		else if($this->session->userdata('usr_id') == "") { ?>
		<a href="javascript:void(0);" id='rev_a_like_<?php echo $value->rev_id ?>' onClick="likeReview('<?php echo $value->rev_id; ?>','1')" >
		<div class="likes">
		<i class="fa fa-thumbs-up " id='thumb_<?php echo $value->rev_id; ?>' ></i>
		<span id='rev_like_counter_<?php echo $value->rev_id ?>'>
		<?php $this->write_review_model->ReviewCountNew($value->rev_id); //echo $countvalue['like_count']; 
		?>
		</span>
		</div></a>
		<?php } else { ?>

		<!--Dislike-->
		<a href="javascript:void(0);" id='rev_a_like_<?php echo $value->rev_id ?>' onClick="likeReview('<?php echo $value->rev_id; ?>','0')" >
		<div class="likes fb-like">


		<i class="fa fa-thumbs-up " style="color:#fff;" id='thumb_<?php echo $value->rev_id; ?>' ></i>
		<span id='rev_like_counter_<?php echo $value->rev_id ?>'>
		<?php $this->write_review_model->ReviewCountNew($value->rev_id); //echo $countvalue['like_count']; 
		?>
		</span>
		</div></a>
		<?php }
}
else{
	?>
	<a href="javascript:void(0);"  id='rev_a_like_<?php echo $value->rev_id ?>'   onClick="likeReview('<?php echo $value->rev_id; ?>','1')" >
<div class="likes">
		<i class="fa fa-thumbs-up " id='thumb_<?php echo $value->rev_id; ?>' ></i>
		<span id='rev_like_counter_<?php echo $value->rev_id ?>'>
        
        
        <?php $this->write_review_model->ReviewCountNew($value->rev_id); //echo $countvalue['like_count']; 
		?>
        
		<?php 
		//echo $this->write_review_model->getCountofTotalCommentsReview($value->rev_id); //commented on 26th 5 2016
		
		
		//echo $countvalue['like_count']; ?>  </span>

	  </div></a>
	<?php
}		?>
		<!--like end-->
		
			<!--
		<a href="javascript:void(0);" data-toggle="modal" data-target=".bs-example-modal-lg" onClick="CmtToggle(<?php echo $value->rev_id; ?>)" >
		<div class="str"  >
		  <i class="fa fa-comment"></i>
  
  <?php //echo $this->write_review_model->getCountofTotalCommentsReview($value->rev_id); ?>
  
		<?php //echo $countComment ?>
		</div>
		</a>-->
		
		
		
	<a href="javascript:void(0);" style="color:#fff; text-decoration:none" onclick="CmtToggle('<?php echo $value->rev_id;?>')">
	<div class="str" data-toggle="modal" data-target=".bs-example-modal-lg">
	<!--Reply-->
	<i aria-hidden="true" class="fa fa-comment"></i> 
	
		<input type='hidden' id='comment_counter_input_<?php echo $value->rev_id; ?>'  
			value='<?php echo $this->write_review_model->getCountofTotalCommentsReview($value->rev_id); ?>' />
		<span id='comment_counter_<?php echo $value->rev_id; ?>' class='comment_counter' >
		<?php echo $this->write_review_model->getCountofTotalCommentsReview($value->rev_id); ?>
		</span>
	</div>
	</a>
  
		
		
		<!--Comment Started -->
		<!--In same line -->
		<!--Comment Ended -->
		</div>
		</div>


		

	
		


		<div id="form_div_<?php echo $value->rev_id; ?>" style="display: none;" class="comm">




<div style='display:none;' id="cmtDiv_<?php echo $value->rev_id; ?>" class="comment-list">

		<?php 

//Comments of Reviews

if($countComment >0) //Comments of Review
{
?>

<?php
		foreach ($getReviewComment as $cmtValue)
		{
			?>
			<ul><li>
				<div class="comment-col">
                <div class="pull-left">
                <div class="commt-pic">
					<?php 
					if($cmtValue['register_method'] == 'facebook')
					{
						?>
							<img src="http://graph.facebook.com/<?php echo $cmtValue['social_id']; ?>/picture?type=large" alt="profile-pic" />
					   <?php
					}
					else if($cmtValue['profile_image'] != '')
					{
						if (file_exists($cmtValue['profile_image'])){ 
						?>
							<img src="<?php echo $cmtValue['profile_image'] ?>" alt="profile-pic">
						<?php 
						}
						else {
							?>
							<img src="images/about-icon-md.png" alt="profile-pic">
							<?php 
						}
					}
					else {
						?>
						<img src="images/about-icon-md.png" alt="profile-pic">
						<?php 
					}
					?>	
                    <span class="user-n"><?php echo $cmtValue['usr_name']; ?></span>
				</div>
                </div>
                
                <div class="pull-right">
                <div class="comm-date-time">
					<span class="commt-date"><?php echo date("d-m-Y", strtotime($cmtValue['date']));  ?></span>
				</div>
                
                </div>
               
                
                <div class="commt-des">
               <p>
				<?php echo $cmtValue['cmt_text'] ?></p>
                
				</div>
				</div>
				</li></ul>
			<!--<ul><li>
				<div class="comment-col">
                
                <div class="commt-pic">
					<?php 
					if($cmtValue['register_method'] == 'facebook')
					{
						?>
							<img src="http://graph.facebook.com/<?php echo $cmtValue['social_id']; ?>/picture?type=large" alt="profile-pic" />
					   <?php
					}
					else if($cmtValue['profile_image'] != '')
					{
						?>
							<img src="<?php echo $cmtValue['profile_image'] ?>" alt="profile-pic">
						<?php 
					}
					else{
						?>
						<img src="images/about-icon-md.png" alt="profile-pic">
						<?php 
					}
					?>
				</div>
                
                <div class="commt-des">
               <p><span class="user-n"><?php echo $cmtValue['usr_name']; ?></span>
				<?php echo $cmtValue['cmt_text'] ?></p>
                <div class="comm-date-time">
					<span class="commt-date"><?php echo date("d-m-Y", strtotime($cmtValue['date']));  ?></span>
				</div>
				</div>
				</div>
				</li></ul>-->
		
		<?php } ?>


<div class="view-commt"><a href="javascript:commentmodalread('<?php echo $value->rev_id; ?>')" >View All</a>
</div>

<?php

}
else{
	?>No Comments<?php
}
?>
</div>

<?php
			
if($this->session->userdata('usr_id') == $value->usr_id  )//if($this->session->userdata('admin_status') == '1')
{ 
?>

<div class="form-group">
<textarea placeholder="Write a comment here..." rows="1" name="textarea_<?php echo $value->rev_id; ?>" id="textarea_<?php echo $value->rev_id; ?>" class="form-control"></textarea>
</div>
<div id="rev_status_<?php echo $value->rev_id; ?>"></div>
<a onclick="reviewCMTsubmit('<?php echo $value->rev_id; ?>')" class="btn btn-default pull-right red" href="javascript:void(0)">Post</a>

<?php   
}
else{

//No Company Profile

}   ?>
		
		
		</div>
		
	
		</div>
		</div>
		<?php
		}//foreach end

		}
		else
		{
			echo "0";
		}
	}//main function end
	
	
	

	function callingWrite($rat_avg) //,
	{
		if(strpos($rat_avg, '.') !== FALSE)
		{

			$splited =  explode(".",$rat_avg);
			$splitersize = sizeof($splited);			
			$mainstar = $splited[0];
			$dotstar = $splited[1];
			switch ($dotstar) {
				case "1": $this->writeStar($mainstar,'0');	break;
				case "2": $this->writeStar($mainstar,'0'); break; 
				case "3": $this->writeStar($mainstar,'0'); break; 
				case "4": $this->writeStar($mainstar,'0');	break;
				case "5": $this->writeStar($mainstar,'5'); break; 
				case "6": $this->writeStar($mainstar,'5'); break; 
				case "7": $this->writeStar($mainstar,'5');	break;
				case "8": $this->writeStar($mainstar,'8'); break; 
				case "9": $this->writeStar($mainstar,'9'); break; 
			}
		}
		else{		
			$this->writeStar($rat_avg,'0');//echo $arrayvalue;
		}
		
	}
	
	public function getReviews($id)
	{
		$reviews = $this->write_review_model->getReviews($id);
		return $reviews;
	}
	function deletereview()
	{
		
		$revid = $this->input->post('revid'); //review id
		
		if(($this->session->userdata('usr_id')!=""))
		{  	
			$query = "delete reviews.* from reviews where rev_id = $revid";
			$reviewRow = $this->db->query($query);
			echo "1";
		}
		else{
			echo "0";
		}
	}
	function edit($id) //working here
	{
		$data['title']= 'Edit Review';
		$this->load->view('header_view',$data);
		$data['autocom'] = NULL;
		if($id != 0)
		{
			$query = "SELECT * from reviews where rev_id = $id";
			$reviewRow = $this->db->query($query)->row_array();
			$data['reviews'] = $reviewRow;
			
			$query = "SELECT product.* from product where product.prd_id = '".$reviewRow['prd_id']."' ";
			$data['autocom'] = $this->db->query($query)->result();
			
			$query = "SELECT * from review_details where rev_id = $id";
			$reviewRow = $this->db->query($query)->row_array();
			$data['review_details'] = $reviewRow;
			
			$query = "SELECT * from review_images where rev_id = $id";
			$data['review_images'] = $this->db->query($query)->result_array();
			
		}
		$this->load->view('edit_review_view', $data);//$this->load->view("registration_view.php", $data);
		$this->load->view('footer_view',$data);
	}
	public function UpdateReview()
	{
		if(($this->session->userdata('usr_id')!=""))
		{  	
			$userid = $this->session->userdata('usr_id');
			//odrnum done
			$this->write_review_model->UpdateReview($userid);
			
		}
		else
		{
			echo "0";
			//$websitename='df';
			
		}
	}
	
	public function write($id = 0)
	{
		//echo $id; exit;
		
		$data['title']= 'Write Review';
		$this->load->view('header_view',$data);
		$data['autocom'] = NULL;
		if($id != 0)
		{
			$query = "SELECT product.* from product where product.prd_id = $id";
			$data['autocom'] = $this->db->query($query)->result();
		}
		
		$data['getAllcat'] = $this->category_model->getAllcat();
		
		$this->load->view('write_review_view', $data);//$this->load->view("registration_view.php", $data);
		$this->load->view('footer_view',$data);
	}
	
	public function InsertReview()
	{
		if(($this->session->userdata('usr_id')!=""))
		{  	
			$userid = $this->session->userdata('usr_id');
			//odrnum done
			$this->write_review_model->InsertReview($userid);
			
		}
		else
		{
			echo "0";
			//$websitename='df';
			
		}
	}
	
	public function LikeReview()
	{
		$revID = $this->input->post("revID"); //revID
		$stts = $this->input->post("stts"); //stts 0means dislike, 1 means like
		if(($this->session->userdata('usr_id')!=""))
		{  	
			$userid = $this->session->userdata('usr_id');
			$this->write_review_model->LikeReview($userid,$revID,$stts);
		}
		else
		{
			echo "nologin";
		}
	}
	
	public function helpfull()
	{
		$revID = $this->input->post("rev_id"); //revID
		$stts = $this->input->post("stts"); //stts 0means dislike, 1 means like
		if(($this->session->userdata('usr_id')!=""))
		{  	
			$userid = $this->session->userdata('usr_id');
			$this->write_review_model->helpfull($userid,$revID,$stts);
		}
		else
		{
			echo "nologin";
		}
	}
	public function iusedthis()
	{
		$prdID = $this->input->post("prdID"); //prdID
		$catID = $this->input->post("catID"); //catID
		$stts = $this->input->post("stts"); //stts 0means dislike, 1 means like
		if(($this->session->userdata('usr_id')!=""))
		{  	
			$userid = $this->session->userdata('usr_id');
			$this->write_review_model->iusedthis($userid,$catID,$prdID,$stts);
		}
		else
		{
			echo "0";
		}
	}
	
	public function likeMainProduct()
	{
		$prdID = $this->input->post("prdID"); //prdID
		$catID = $this->input->post("catID"); //catID
		$stts = $this->input->post("stts"); //stts 0means dislike, 1 means like
		if(($this->session->userdata('usr_id')!=""))
		{  	
			$userid = $this->session->userdata('usr_id');
			$this->write_review_model->likeMainProduct($userid,$catID,$prdID,$stts);
		}
		else
		{
			echo "nologin";
		}
	}
	public function favBookmark()
	{
		$cat_Id = $this->input->post("catId"); //revID
		$prd_Id = $this->input->post("prdId"); //prdId
		$stts = $this->input->post("stts"); //stts 0means dislike, 1 means like
		if(($this->session->userdata('usr_id')!=""))
		{  	
			$userid = $this->session->userdata('usr_id');
			$this->write_review_model->favBookmark($userid,$cat_Id,$prd_Id,$stts);
		}
		else
		{
			echo "0";
		}
	}
	
	public function unbookmark()
	{
		$revId = $this->input->post("revId");
		$this->write_review_model->unbookmark($revId);
	}
	
	function getProduct_AutoComplete(){
		$q = strtolower($this->input->post('keyword'));
		$cat = strtolower($this->input->post('cat'));
		$this->list_model->getProduct_AutoComplete($q,$cat);
	}
	
	
	public function InsertCommentOnReview()
	{
		$revID = $this->input->post("revID"); //revID
		$text = $this->input->post("text"); //stts 0means dislike, 1 means like
		if(($this->session->userdata('usr_id')!=""))
		{  	
			$userid = $this->session->userdata('usr_id');
			return $this->write_review_model->InsertCommentOnReview($userid,$revID,$text);
		}
		else
		{
			echo "0";
		}
	}
	
	
	function writeStar($main,$dot)
	{
		//echo '-'.$main.'--------'.$dot;
		if($dot == 5)
		{
			
			if($main == 0){
				echo "<i class='fa fa-star-half'></i>";
			}
			
			if($main == 1){
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star-half'></i>";
				
			}
			else if($main == 2){
				
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star-half'></i>";
				
			}
			else if($main == 3){
				
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star-half'></i>";
				
			}
			else if($main == 4){
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star-half'></i>";
				
			}		
		}
		else if($dot == 0)
		{
			if($main == 1){
				
				echo "<i class='fa fa-star'></i>";
				
			}
			else if($main == 2){
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				
			}
			else if($main == '3'){
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				
			}
			else if($main == 4){
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				
				
			}		
			else if($main == 5){
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				
				
			}		
		}
		else if(($dot == 8)||($dot == 9))
		{
			if($main <= 3)
			{
				$main = $main + 1;
				if($main == 1){
				
				echo "<i class='fa fa-star'></i>";
				
			}
			else if($main == 2){
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
			}
			else if($main == 3){
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";

			}
			else if($main == 4){
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				
				
			}		
			else if($main == 5){
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				
			}	
			}
			else {
				if($main == 1){
				
				echo "<i class='fa fa-star'></i>";
				
			}
			else if($main == 2){
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
			}
			else if($main == 3){
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				
			}
			else if($main == 4){
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				
			}		
			else if($main == 5){
				
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				echo "<i class='fa fa-star'></i>";
				
			}	
			}
		}
	}
	
	function getcategoryProduct()
	{
		$catid = $this->input->post("cat_hidden"); //revID
		$this->write_review_model->getcategoryProduct($catid);
	}
	
	function IncreaseShareCount()
	{
		$catid = $this->input->post("catid"); //revID
		$prd_id = $this->input->post("prd_id"); //revID
		$userid = 0;
		$userid = $this->session->userdata('usr_id');
		
		$this->write_review_model->IncreaseShareCount($catid,$prd_id,$userid);
	}
	
	
	/////////////////

	function writeStarForReview($main,$dot)
	{

		if($dot == 5)

		{

			if($main == 0){

				?>
	<i class="fa fa-star-half"></i>

	<?php 

			}

			if($main == 1){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star-half"></i>
	<?php 

			}

			else if($main == 2){

				?>

				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
	<i class="fa fa-star-half"></i>
	<?php 

			}

			else if($main == 3){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star-half"></i>
				
	<?php 

			}

			else if($main == 4){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star-half"></i>
				
	<?php 

			}		

		}

		else if($dot == 0)

		{

			if($main == 1){

				?>
	<i class="fa fa-star"></i>
	<?php 

			}

			else if($main == 2){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<?php 

			}

			else if($main == '3'){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>

	<?php 

			}

			else if($main == 4){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>

	<?php 

			}		

			else if($main == 5){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
				
	<?php 

			}		

		}

		else if(($dot == 8)||($dot == 9))

		{

			if($main <= 3)

			{

				$main = $main + 1;

				if($main == 1){

				?>
	<i class="fa fa-star"></i>
	<?php 

			}

			else if($main == 2){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>

	<?php 

			}

			else if($main == 3){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>

	<?php 

			}

			else if($main == 4){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>

	<?php 

			}		

			else if($main == 5){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>

	<?php 

			}	

			}

			else {

				if($main == 1){

				?>
	<i class="fa fa-star"></i>
	<?php 

			}

			else if($main == 2){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>

	<?php 

			}

			else if($main == 3){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>

	<?php 

			}

			else if($main == 4){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>

	<?php 

			}		

			else if($main == 5){

				?>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>

	<?php 

			}	

			}

		}

	}

}
?>