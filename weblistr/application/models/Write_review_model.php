<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class write_review_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->model(array('user_model','category_model','list_model','contact_model','featured_model','write_review_model'));  //Open 
		$this->load->library(array('session','email')); 
		$this->load->helper(array('url','form'));
    }
	
	
	function relatedSearch($prdid){
		$sql = "SELECT product.* from product where product.cat_id in (SELECT product.cat_id FROM `product` where product.prd_id = $prdid) and product.prd_id <> $prdid and status = 1 order by product.prd_id desc limit 2";
		$result = $this->db->query($sql)->result_array();
        return $result;
	}
	
	public function getReviewsbyId($id,$revid){
        $sql = "select reviews.*,review_details.rating_stars,AVG(review_details.rating_stars) as rat_avg ,
		user_register.usr_name,user_register.profile_image,user_register.social_id,user_register.register_method,user_register.usr_id  from reviews,review_details,user_register 
		where reviews.prd_id = $id 
		and review_details.rev_id = reviews.rev_id 
		and reviews.rev_id = $revid
		and user_register.usr_id = reviews.usr_id  
		group by reviews.rev_id limit 1 ";
        $result = $this->db->query($sql)->result();
        return $result;
		//where reviews.prd_id = $id and reviews.status = 1
    }
	
	public function getReviews($id){
        $sql = "select reviews.*,review_details.rating_stars,AVG(review_details.rating_stars) as rat_avg ,
		user_register.usr_name,user_register.profile_image,user_register.social_id,user_register.register_method,user_register.usr_id  from reviews,review_details,user_register 
		where reviews.prd_id = $id and reviews.status = 1
		and review_details.rev_id = reviews.rev_id 
		and user_register.usr_id = reviews.usr_id  
		group by reviews.rev_id order by reviews.rev_id desc  limit 2 ";
        $result = $this->db->query($sql)->result();
        return $result;
    }
	
	public function getScrollReviews($getResult,$prd_id){
        $sql = "select reviews.*,review_details.rating_stars,AVG(review_details.rating_stars) as rat_avg ,
		user_register.usr_name,user_register.profile_image,user_register.social_id,user_register.register_method,user_register.usr_id  from reviews,review_details,user_register 
		where reviews.prd_id = $prd_id 
		and review_details.rev_id = reviews.rev_id   and reviews.status = 1
		and user_register.usr_id = reviews.usr_id  
		group by reviews.rev_id order by reviews.rev_id desc  limit $getResult,2 ";
        $result = $this->db->query($sql)->result();
        return $result;
    }
	
	
	public function check_like($rev,$usr)
	{
		$where = "rev_id='$rev' and usr_id='$usr' ";
		$this->db->where($where);
        $query=$this->db->get("review_stats");
        if($query->num_rows() > 0)
		{
			foreach($query->result() as $rows)
            {
				//var_dump($rows);
				return $rows->reviews_stats_id;
			}
		}
		return "0";
	}
	
	public function check_helpfull($rev,$usr)
	{
		$where = "rev_id='$rev' and usr_id='$usr' ";
		$this->db->where($where);
        $query=$this->db->get("review_stats");
        if($query->num_rows() > 0)
		{
			foreach($query->result() as $rows)
            {
				//var_dump($rows);
				return $rows->reviews_stats_id;
			}
		}
		return "0";
	}
	
	
	public function helpfull($user,$revID,$stts)
	{
		//$stts  = 0 means dislike, 1 means like
		//$userid,$revID,$likeStats,$favStats);
		
		//First time user doing like when reviewstats table not having data of that review or user related
		$checker = $this->check_helpfull($revID,$user); //like checking
		if($checker == 0)
		{
			$data = array(
						'rev_id'=>$revID,
						'usr_id'=>$user,
						'helpfull'=>'1',
						'status'=>'0'
				);
			$this->db->insert('review_stats', $data); 
			
			$query = $this->db->query('SELECT LAST_INSERT_ID()');
			$row = $query->row_array();
			$rev_stat_id = $row['LAST_INSERT_ID()']; //review_stats table auto gen id
			//echo $rev_stat_id;
			
			$row = $this->db->query("SELECT count(rev_id) as helpfull_count FROM `review_stats` where rev_id = $revID and `helpfull` = '1' ");
			//if($row->num_rows()!=0)
			//{
			
			$row1=$row->row_array();
			echo $row1['helpfull_count'];
			//}
		}
		else {
			//update
			$data = array(
							//'helpfull'=>'1',
							'helpfull'=>$stts,
							'status'=>'0'
					);
					
			$this->db->where('rev_id', $revID);
			$this->db->where('usr_id', $user);
			$this->db->update('review_stats', $data);
			
			$row = $this->db->query("SELECT count(rev_id) as helpfull_count FROM `review_stats` where rev_id = $revID and `helpfull` = '1' ");
			//if($row->num_rows()!=0)
			//{
			
			$row1=$row->row_array();
			echo $row1['helpfull_count'];
			//}
		}
	}
	
	function getRatingSummaryByGrouping($prd_id)
	{
		$sql = "select (select count(rating_stars) FROM `review_details` where review_details.rev_id in (select rev_id from reviews where reviews.status = 1 and  reviews.prd_id = '$prd_id') and review_details.rating_stars in ('.5','0.5','1','1.0','1.5')) as 'grouper1'

		, (select count(rating_stars) FROM `review_details` where review_details.rev_id in (select rev_id from reviews where  reviews.status = 1 and reviews.prd_id = '$prd_id')and review_details.rating_stars in ('2','2.0','2.5') ) as 'grouper2'

		, (select count(rating_stars) FROM `review_details` where review_details.rev_id in (select rev_id from reviews where  reviews.status = 1 and reviews.prd_id = '$prd_id')and review_details.rating_stars in ('3','3.0','3.5')) as 'grouper3'

		,(select count(rating_stars) FROM `review_details` where review_details.rev_id in (select rev_id from reviews where  reviews.status = 1 and reviews.prd_id = '$prd_id') and review_details.rating_stars in ('4','4.0','4.5')) as 'grouper4'

		,(select count(rating_stars) FROM `review_details` where review_details.rev_id in (select rev_id from reviews where  reviews.status = 1 and reviews.prd_id = '$prd_id') and review_details.rating_stars in ( '5','5.0' ) ) as 'grouper5'";
		
	//$sql = "select (select count(rating_stars) FROM `review_details` where review_details.rev_id in (select rev_id from reviews where reviews.status = 1 and  reviews.prd_id = '$prd_id') and review_details.rating_stars = '1') as 'grouper1', (select count(rating_stars) FROM `review_details` where review_details.rev_id in (select rev_id from reviews where  reviews.status = 1 and reviews.prd_id = '$prd_id')and review_details.rating_stars = '2') as 'grouper2', (select count(rating_stars) FROM `review_details` where review_details.rev_id in (select rev_id from reviews where  reviews.status = 1 and reviews.prd_id = '$prd_id')and review_details.rating_stars = '3') as 'grouper3' ,(select count(rating_stars) FROM `review_details` where review_details.rev_id in (select rev_id from reviews where  reviews.status = 1 and reviews.prd_id = '$prd_id') and review_details.rating_stars = '4') as 'grouper4' ,(select count(rating_stars) FROM `review_details` where review_details.rev_id in (select rev_id from reviews where  reviews.status = 1 and reviews.prd_id = '$prd_id') and review_details.rating_stars = '5') as 'grouper5'";
		$row = $this->db->query($sql)->row_array();
		return $row;
	}
	
	public function LikeReview($user,$revID,$stts)
	{
		//$stts  = 0 means dislike, 1 means like
		//$userid,$revID,$likeStats,$favStats);
		
		//First time user doing like when reviewstats table not having data of that review or user related
		$checker = $this->check_like($revID,$user); //like checking
		if($checker == 0)
		{
			$data = array(
					'rev_id'=>$revID,
					'usr_id'=>$user,
					'like'=>'1',
					'status'=>'0'
				);
			$this->db->insert('review_stats', $data); 
			
			$query = $this->db->query('SELECT LAST_INSERT_ID()');
			$row = $query->row_array();
			$rev_stat_id = $row['LAST_INSERT_ID()']; //review_stats table auto gen id
			
			$row = $this->db->query("SELECT count(rev_id) as like_count FROM `review_stats` where rev_id = $revID and `like` = '1' ")->row_array();
			echo $row['like_count'];
		
		}
		else {
			//update
			$data = array(
						'like'=>$stts,
						'status'=>'0'
					);
					
			$this->db->where('rev_id', $revID);
			$this->db->where('usr_id', $user);
			$this->db->update('review_stats', $data);
			
			$row = $this->db->query("SELECT count(rev_id) as like_count FROM `review_stats` where rev_id = $revID and `like` = '1' ")->row_array();
			echo $row['like_count'];
			
			//echo "-1";
		}
	}
	
	public function iusedthis($user,$catID,$prdID,$stts)
	{
		//$stts  = 0 means not used, 1 means used
		
		$where = "prd_id='$prdID' and usr_id='$user' ";
		$this->db->where($where);
        $query=$this->db->get("reviews");
		$checker = 0;
        if($query->num_rows() > 0)
		{
			foreach($query->result() as $rows)
            {
				//var_dump($rows);
				$checker = $rows->rev_id;
			}
		}
		//$date = date('Y-m-d H:i:s');
		if($checker == 0)
		{
			$data = array(
						'cat_id'=>$catID,
						'prd_id'=>$prdID,
						'usr_id'=>$user,
						'used'=>'1',
						//'date'=>$date,
						'status'=>'0'
				);
			$this->db->insert('reviews', $data); 
			
			$query = $this->db->query('SELECT LAST_INSERT_ID()');
			$row = $query->row_array();
			$rev_stat_id = $row['LAST_INSERT_ID()']; //review_stats table auto gen id
			//echo $rev_stat_id;
			
			
			///Email code 
			$toemailusrid = $user;
			$query = $this->db->query("SELECT * from user_register where usr_id = $toemailusrid ");
			$row = $query->row_array();
			$email_id = $row['email_id']; //review table auto gen id
			$usr_name = $row['usr_name']; //review table auto gen id
			if($email_id != '')
			{
				$query = $this->db->query('SELECT * FROM adminemail ');
				$adminEmail = $query->row_array();
				$fromname = $adminEmail['name'];
				$fromEmail = $adminEmail['email'];
				
				$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
				$this->email->to($email_id);
				$this->email->subject('Bookmarked/ I use notification');
				
				//Email Template Model
					$logolink = base_url()."images/logo.png";
					$emailmodel =& get_instance(); 
					$emailmodel->load->model("emailmodel");
					$mailbody = $this->emailmodel->NewBookmark($logolink,$usr_name);
				//Email Template Model
				$this->email->set_mailtype("html");
				$this->email->message($mailbody);
				$this->email->send();
			
			}
			///Email code
			
			$row = $this->db->query("SELECT count(rev_id) as like_count FROM `reviews` where prd_id = $prdID and `used` = '1' ")->row_array();
			echo $row['like_count']+1;
			
		}
		else {
			//update
			$data = array(
					'used'=>$stts,
					//'date'=>$date,
					'status'=>'0'
				);					
			$this->db->where('rev_id', $checker);
			$this->db->update('reviews', $data);
			//echo "-1";
			///Email code 
			$toemailusrid = $user;
			$query = $this->db->query("SELECT * from user_register where usr_id = $toemailusrid ");
			$row = $query->row_array();
			$email_id = $row['email_id']; //review table auto gen id
			$usr_name = $row['usr_name']; //review table auto gen id
			if($email_id != '')
			{
				$query = $this->db->query('SELECT * FROM adminemail ');
				$adminEmail = $query->row_array();
				$fromname = $adminEmail['name'];
				$fromEmail = $adminEmail['email'];
				
				$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
				$this->email->to($email_id);
				$this->email->subject('Bookmarked/ I use notification');
				
				//Email Template Model
					$logolink = base_url()."images/logo.png";
					$emailmodel =& get_instance(); 
					$emailmodel->load->model("emailmodel");
					$mailbody = $this->emailmodel->NewBookmark($logolink,$usr_name);
				//Email Template Model
				$this->email->set_mailtype("html");
				$this->email->message($mailbody);
				$this->email->send();
			
			}
			///Email code
			$row = $this->db->query("SELECT count(rev_id) as like_count FROM `reviews` where prd_id = $prdID and `used` = '1' ")->row_array();
			echo $row['like_count']+1;
		}
	}
	
	
	public function likeMainProduct($user,$catID,$prdID,$stts)
	{
		//$stts  = 0 means dislike, 1 means like
		//$userid,$revID,$likeStats,$favStats);
		
		
		$where = "prd_id='$prdID' and usr_id='$user' ";
		$this->db->where($where);
        $query=$this->db->get("reviews");
		$checker = 0;
        if($query->num_rows() > 0)
		{
			foreach($query->result() as $rows)
            {
				//var_dump($rows);
				$checker = $rows->rev_id;
			}
		}
		//$date = date('Y-m-d H:i:s');
		if($checker == 0)
		{
			$data = array(
						'cat_id'=>$catID,
						'prd_id'=>$prdID,
						'usr_id'=>$user,
						'prd_like'=>'1'
						//'date'=>$date,
						
				);
			$this->db->insert('reviews', $data); 
			
			$query = $this->db->query('SELECT LAST_INSERT_ID()');
			$row = $query->row_array();
			$rev_stat_id = $row['LAST_INSERT_ID()']; //review_stats table auto gen id
			
			$row = $this->db->query("SELECT count(rev_id) as like_count FROM `reviews` where prd_id = $prdID and `prd_like` = '1' ")->row_array();
			echo $row['like_count'];
			
			//echo $stts+1;
		}
		else {
			//update
			$data = array(
					'prd_like'=>$stts
				);					
			$this->db->where('rev_id', $checker);
			$this->db->update('reviews', $data);
			
			$row = $this->db->query("SELECT count(rev_id) as like_count FROM `reviews` where prd_id = $prdID and `prd_like` = '1' ")->row_array();
			echo $row['like_count'];
			
			//echo $stts+1;
		}
	}
	
	public function favBookmark($user,$catID,$prdID,$stts)
	{
		$where = "prd_id='$prdID' and usr_id='$user' ";
		$this->db->where($where);
        $query=$this->db->get("reviews");
		$checker = 0;
        if($query->num_rows() > 0)
		{
			foreach($query->result() as $rows)
            {
				//var_dump($rows);
				$checker = $rows->rev_id;
			}
		}
		//$date = date('Y-m-d H:i:s');
		if($checker == 0)
		{
			$data = array(
						'cat_id'=>$catID,
						'prd_id'=>$prdID,
						'usr_id'=>$user,
						'bookmark'=>'1',
						//'date'=>$date,
						'status'=>'0'
				);
			$this->db->insert('reviews', $data); 
			
			
			///Email code 
			$toemailusrid = $user;
			$query = $this->db->query("SELECT * from user_register where usr_id = $toemailusrid ");
			$row = $query->row_array();
			$email_id = $row['email_id']; //review table auto gen id
			$usr_name = $row['usr_name']; //review table auto gen id
			if($email_id != '')
			{
				$query = $this->db->query('SELECT * FROM adminemail ');
				$adminEmail = $query->row_array();
				$fromname = $adminEmail['name'];
				$fromEmail = $adminEmail['email'];
				
				$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
				$this->email->to($email_id);
				$this->email->subject('Bookmarked/ I use notification');
				
				//Email Template Model
					$logolink = base_url()."images/logo.png";
					$emailmodel =& get_instance(); 
					$emailmodel->load->model("emailmodel");
					$mailbody = $this->emailmodel->NewBookmark($logolink,$usr_name);
				//Email Template Model
				$this->email->set_mailtype("html");
				$this->email->message($mailbody);
				$this->email->send();
			
			}
			///Email code
			
			$query = $this->db->query('SELECT LAST_INSERT_ID()');
			$row = $query->row_array();
			$rev_stat_id = $row['LAST_INSERT_ID()']; //review_stats table auto gen id
			echo $stts+1;
		}
		else {
			//update
			$data = array(
					'bookmark'=>$stts,
					//'date'=>$date,
					'status'=>'0'
				);					
			$this->db->where('rev_id', $checker);
			$this->db->update('reviews', $data);
			
			///Email code 
			$toemailusrid = $user;
			$query = $this->db->query("SELECT * from user_register where usr_id = $toemailusrid ");
			$row = $query->row_array();
			$email_id = $row['email_id']; //review table auto gen id
			$usr_name = $row['usr_name']; //review table auto gen id
			if($email_id != '')
			{
				$query = $this->db->query('SELECT * FROM adminemail ');
				$adminEmail = $query->row_array();
				$fromname = $adminEmail['name'];
				$fromEmail = $adminEmail['email'];
				
				$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
				$this->email->to($email_id);
				$this->email->subject('Bookmarked/ I use notification');
				
				//Email Template Model
					$logolink = base_url()."images/logo.png";
					$emailmodel =& get_instance(); 
					$emailmodel->load->model("emailmodel");
					$mailbody = $this->emailmodel->NewBookmark($logolink,$usr_name);
				//Email Template Model
				$this->email->set_mailtype("html");
				$this->email->message($mailbody);
				$this->email->send();
			}
			///Email code
			
			echo $stts+1;
		}
	}
	
	function IncreaseShareCount($catID,$prdID,$user)
	{
		$where = "prd_id='$prdID' and usr_id='$user' ";
		$this->db->where($where);
        $query=$this->db->get("reviews");
		$checker = 0;
        if($query->num_rows() > 0)
		{
			$checker = $query->row_array()['rev_id'];//$query->num_rows();
		}
		
		if($checker == 0)
		{
			$data = array(
						'cat_id'=>$catID,
						'prd_id'=>$prdID,
						'usr_id'=>$user,
						'prd_share'=>'1',
						'status'=>'0'
				);
			$this->db->insert('reviews', $data); 
			
			$query = $this->db->query("select sum(prd_share) as prd_share from reviews where prd_id = $prdID ");
			$row = $query->row_array()['prd_share'];
			echo $row;
			// $query = $this->db->query('SELECT LAST_INSERT_ID()');
			// $row = $query->row_array();
			// $rev_stat_id = $row['LAST_INSERT_ID()']; //review_stats table auto gen id
			// echo $stts+1;
		}
		else {
			
			$query = $this->db->query("select sum(prd_share) as prd_share from reviews where prd_id = $prdID ");
			$row = $query->row_array()['prd_share'];			
			$row=$row+1;
			$query = $this->db->query("update reviews set prd_share = $row  where rev_id = $checker ");
			
			echo $row;
		}
		
	}
	
	function unbookmark($id)
	{
		$data = array(
				'bookmark'=>'0',
				'status'=>'0'
			);					
		$this->db->where('rev_id', $id);
		$this->db->update('reviews', $data);
		echo '0';
	}
	function helpfullCountNew($revID)
	{
		$sql = "select count(review_stats.helpfull) as helpfull_count from review_stats  where rev_id = $revID and helpfull = 1  ";
		$query = $this->db->query($sql);
		$row = $query->row_array()['helpfull_count'];			
		echo $row;
	}
	
	function ReviewCountNew($revID)
	{
		$sql = "select count(review_stats.like) as like_count from review_stats  where rev_id = '$revID' and `like` = '1'  ";
		$query = $this->db->query($sql);
		$row = $query->row_array()['like_count'];			
		echo $row;
	}
	
	function getReviewCountStats($revID)
	{
		$query = $this->db->query("select * from review_stats where rev_id = $revID");
		if($query->num_rows()>0)
		{
			$userID = $this->session->userdata('usr_id');
			if($userID != "")
			{
				
$sql =        "SELECT (case when (review_stats.like = 1 ) THEN 1  ELSE 0  END) as like_status ";
$sql = $sql . ",(case when (review_stats.fav = 1 ) THEN 1 ELSE 0 END) as fav_status ";
$sql = $sql . ",(select count(review_stats.like) from review_stats where review_stats.like = 1 and rev_id = $revID ) as like_count ";
$sql = $sql . ",(select count(review_stats.fav) from review_stats where review_stats.fav = 1  and rev_id = $revID ) as fav_count ";
$sql = $sql . ",(select sum(review_stats.share) from review_stats where rev_id = $revID ) as share_count ";
$sql = $sql . ",(select sum(revhelpcount.helpfull) from review_stats as revhelpcount where revhelpcount.rev_id = $revID ) as helpfull_count ";
$sql = $sql . ",(case when (review_stats.helpfull = 1 ) THEN 1 ELSE 0 END) as helpfull_status ";
$sql = $sql . "from review_stats where rev_id = $revID and usr_id = $userID ";
				
				
				// $sql = "SELECT ";
				// $sql = $sql . "(case when (review_stats.like = 1 ) THEN 1  ELSE 0  END) as like_status ";
				// $sql = $sql . ",(case when (review_stats.fav = 1 ) THEN 1 ELSE 0 END) as fav_status ";
				// $sql = $sql . ",(select count(review_stats.like) from review_stats where review_stats.like = 1 and rev_id = $revID ) as like_count ";
				// $sql = $sql . ",(select count(review_stats.fav) from review_stats where review_stats.fav = 1  and rev_id = $revID ) as fav_count ";
				// $sql = $sql . ",(select sum(review_stats.share) from review_stats where rev_id = $revID ) as share_count ";
				// $sql = $sql . "from review_stats where rev_id = $revID and usr_id = $userID ";
				
				$query = $this->db->query($sql);
				
				if($query->num_rows()>0)
				{
					return $query->result_array();
				}
			}
			else {
				$sql = "SELECT ";
				$sql = $sql . "(case when (review_stats.like = 1 ) THEN 1  ELSE 0  END) as like_status ";
				$sql = $sql . ",(case when (review_stats.fav = 1 ) THEN 1 ELSE 0 END) as fav_status ";
				$sql = $sql . ",(select count(review_stats.like) from review_stats where review_stats.like = 1 and rev_id = $revID ) as like_count ";
				$sql = $sql . ",(select count(review_stats.fav) from review_stats where review_stats.fav = 1  and rev_id = $revID ) as fav_count ";
				$sql = $sql . ",(select sum(review_stats.share) from review_stats where rev_id = $revID ) as share_count ";
				
				$sql = $sql . ",(select sum(review_stats.helpfull) from review_stats where rev_id = $revID ) as helpfull_count ";
				$sql = $sql . ",(case when (review_stats.helpfull = 1 ) THEN 1 ELSE 0 END) as helpfull_status ";
				
				$sql = $sql . "from review_stats where rev_id = $revID group by rev_id";
				$query = $this->db->query($sql);
				
				if($query->num_rows()>0)
				{
					return $query->result_array();
				}
			}
		}
		else{
			//echo "GRV NO Result found";
			$dummy = array(
				// 'like_status'=>'0',
				// 'fav_status'=>'0',
				// 'like_count'=>'0',
				// 'fav_count'=>'0',
				// 'wer'=>'0',
				// 'werwe'=>'0',
				// 'fav_stawerwetus'=>'0',
				// 'like_count'=>'0',
				// 'fav_count'=>'0',
				// 'share_count'=>'0'
			);
			return $dummy;
		}		
	}
	
	
	function getAllTags($prdId)
	{
		//Not used under process - 21st March, 2016
		$sql = "SELECT product_tags.prd_tag_id,product_tags.tag_id,tags.tag_name FROM `product_tags`,tags where product_tags.prd_id = $prdId and tags.tag_id = product_tags.tag_id";
		
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
	}
	
	function getReviewComment($RevID) //RevID
	{
		//Not used under process - 21st March, 2016
		//$sql = "SELECT * FROM comment_reviews where rev_id = $RevID ";
		
		$sql = "SELECT comment_reviews.*,user_register.* FROM `comment_reviews` inner join user_register on comment_reviews.usr_id = user_register.usr_id where rev_id = $RevID  order by date desc limit 2 ";
		
		$query = $this->db->query($sql);
		
		
		return $query->result_array();
		
	}
	
	function getRecentReviews() //HomePage Views
	{
		$userID = $this->session->userdata('usr_id');
		if($userID != "")
		{
			// $sql = "select reviews.rev_id,reviews.review_head,reviews.review_body
			// ,reviews.date,product.prd_name,product.prd_image,user_register.usr_name,user_register.usr_id,user_register.country,reviews.prd_id
			// ,(select count(rev.rev_id) from reviews rev where rev.prd_id = reviews.prd_id and reviews.status = 1 and reviews.review_head<>'') as total_reviews
			// ,(select count(rev.rev_id) from review_stats rev where rev.like = 1 and rev.rev_id = reviews.rev_id) as like_count
			// ,(select count(rev.rev_id) from reviews rev where rev.bookmark = 1 and rev.prd_id = reviews.prd_id) as bookmark_count
			// ,(select avg(revdtl.rating_stars) from review_details revdtl where revdtl.rev_id = reviews.rev_id) as avg_ttl
			// ,product.cat_id
			// from reviews,product,user_register,tbl_country  , category  
			// where product.prd_id = reviews.prd_id
			// and product.status = 1
			// and user_register.usr_id = reviews.usr_id
			// and reviews.review_head != '' and reviews.status = 1
			// and category.status = 1
			// and category.cat_id = product.cat_id
			// order by date desc limit 2";
			$sql = "select reviews.rev_id,reviews.review_head,reviews.review_body
			,reviews.date,product.prd_name,product.prd_image,user_register.usr_name,user_register.usr_id,user_register.country,reviews.prd_id
			,(select count(rev.rev_id) from reviews rev where rev.prd_id = reviews.prd_id and reviews.status = 1 and reviews.review_head<>'') as total_reviews
			,(select count(rev.rev_id) from review_stats rev where rev.like = 1 and rev.rev_id = reviews.rev_id) as like_count
			,(select count(rev.rev_id) from reviews rev where rev.bookmark = 1 and rev.prd_id = reviews.prd_id) as bookmark_count
			,(select avg(revdtl.rating_stars) from review_details revdtl where revdtl.rev_id = reviews.rev_id) as avg_ttl
			,product.cat_id
			from reviews,product,user_register,tbl_country  , category  
			where product.prd_id = reviews.prd_id
			and product.status = 1
			and user_register.usr_id = reviews.usr_id
			and reviews.review_head != '' and reviews.status = 1
			and FIND_IN_SET(category.cat_id,product.cat_id)
			order by date desc limit 2";
		
		}
		else
		{
			
			// $sql = "select reviews.rev_id,reviews.review_head,reviews.review_body
			// ,reviews.date,product.prd_name,product.prd_image,user_register.usr_name,user_register.usr_id,user_register.country,reviews.prd_id
			// ,(select count(rev.rev_id) from reviews rev where rev.prd_id = reviews.prd_id and reviews.status = 1 and reviews.review_head<>'') as total_reviews
			// ,(select count(rev.rev_id) from review_stats rev where rev.like = 1 and rev.rev_id = reviews.rev_id) as like_count
			// ,(select count(rev.rev_id) from reviews rev where rev.bookmark = 1 and rev.prd_id = reviews.prd_id) as bookmark_count
			// ,(select avg(revdtl.rating_stars) from review_details revdtl where revdtl.rev_id = reviews.rev_id) as avg_ttl
			// ,product.cat_id
			// from reviews,product,user_register  , category  
			// where product.prd_id = reviews.prd_id 
			// and product.status = 1
			// and user_register.usr_id = reviews.usr_id
			// and reviews.review_head != '' and reviews.status = 1 
			// and category.status = 1
			// and category.cat_id = product.cat_id
			// order by date desc limit 2";
			
			$sql = "select reviews.rev_id,reviews.review_head,reviews.review_body
			,reviews.date,product.prd_name,product.prd_image,user_register.usr_name,user_register.usr_id,user_register.country,reviews.prd_id
			,(select count(rev.rev_id) from reviews rev where rev.prd_id = reviews.prd_id and reviews.status = 1 and reviews.review_head<>'') as total_reviews
			,(select count(rev.rev_id) from review_stats rev where rev.like = 1 and rev.rev_id = reviews.rev_id) as like_count
			,(select count(rev.rev_id) from reviews rev where rev.bookmark = 1 and rev.prd_id = reviews.prd_id) as bookmark_count
			,(select avg(revdtl.rating_stars) from review_details revdtl where revdtl.rev_id = reviews.rev_id) as avg_ttl
			,product.cat_id
			from reviews,product,user_register  , category  
			where product.prd_id = reviews.prd_id 
			and product.status = 1
			and user_register.usr_id = reviews.usr_id
			and reviews.review_head != '' and reviews.status = 1 
			and FIND_IN_SET(category.cat_id,product.cat_id)
			order by date desc limit 2";
		}
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
	}
	function getRecentReviewScroll($getresult) //HomePage Views Scroll
	{
		$userID = $this->session->userdata('usr_id');
		if($userID != "")
		{
			// $sql = "select reviews.rev_id,reviews.review_head,reviews.review_body
			// ,reviews.date,product.prd_name,user_register.usr_name,user_register.usr_id,user_register.country,reviews.prd_id
			// ,(select count(rev.rev_id) from reviews rev where rev.prd_id = reviews.prd_id and status = 1) as total_reviews
			// ,(select count(rev.rev_id) from reviews rev where rev.prd_like = 1 and rev.prd_id = reviews.prd_id) as like_count
			// ,(select count(rev.rev_id) from reviews rev where rev.bookmark = 1 and rev.prd_id = reviews.prd_id) as bookmark_count
			// ,(select avg(revdtl.rating_stars) from review_details revdtl where revdtl.rev_id = reviews.rev_id) as avg_ttl
			// ,product.cat_id
			// from reviews,product,user_register, category  
			// where product.prd_id = reviews.prd_id
			// and product.status = 1
			// and user_register.usr_id = reviews.usr_id 
			// and reviews.review_head != '' and reviews.status = 1 
			// and category.status = 1
			// and category.cat_id = product.cat_id
			// order by date desc limit $getresult,2";
			
			$sql = "select reviews.rev_id,reviews.review_head,reviews.review_body
			,reviews.date,product.prd_name,user_register.usr_name,user_register.usr_id,user_register.country,reviews.prd_id
			,(select count(rev.rev_id) from reviews rev where rev.prd_id = reviews.prd_id and status = 1) as total_reviews
			,(select count(rev.rev_id) from reviews rev where rev.prd_like = 1 and rev.prd_id = reviews.prd_id) as like_count
			,(select count(rev.rev_id) from reviews rev where rev.bookmark = 1 and rev.prd_id = reviews.prd_id) as bookmark_count
			,(select avg(revdtl.rating_stars) from review_details revdtl where revdtl.rev_id = reviews.rev_id) as avg_ttl
			,product.cat_id
			from reviews,product,user_register, category  
			where product.prd_id = reviews.prd_id
			and product.status = 1
			and user_register.usr_id = reviews.usr_id 
			and reviews.review_head != '' and reviews.status = 1 
			and FIND_IN_SET(category.cat_id,product.cat_id)
			order by date desc limit $getresult,2";
		}
		else
		{

			// $sql = "select reviews.rev_id,reviews.review_head,reviews.review_body
			// ,reviews.date,product.prd_name,user_register.usr_name,user_register.usr_id,user_register.country,reviews.prd_id
			// ,(select count(rev.rev_id) from reviews rev where rev.prd_id = reviews.prd_id and status = 1) as total_reviews
			// ,(select count(rev.rev_id) from reviews rev where rev.prd_like = 1 and rev.prd_id = reviews.prd_id) as like_count
			// ,(select count(rev.rev_id) from reviews rev where rev.bookmark = 1 and rev.prd_id = reviews.prd_id) as bookmark_count
			// ,(select avg(revdtl.rating_stars) from review_details revdtl where revdtl.rev_id = reviews.rev_id) as avg_ttl
			// ,product.cat_id
			// from reviews,product,user_register , category   
			// where product.prd_id = reviews.prd_id
			// and product.status = 1
			// and user_register.usr_id = reviews.usr_id
			// and reviews.review_head != '' and reviews.status = 1 
			// and category.status = 1
			// and category.cat_id = product.cat_id
			// order by date desc limit $getresult,2";
			
			$sql = "select reviews.rev_id,reviews.review_head,reviews.review_body
			,reviews.date,product.prd_name,user_register.usr_name,user_register.usr_id,user_register.country,reviews.prd_id
			,(select count(rev.rev_id) from reviews rev where rev.prd_id = reviews.prd_id and status = 1) as total_reviews
			,(select count(rev.rev_id) from reviews rev where rev.prd_like = 1 and rev.prd_id = reviews.prd_id) as like_count
			,(select count(rev.rev_id) from reviews rev where rev.bookmark = 1 and rev.prd_id = reviews.prd_id) as bookmark_count
			,(select avg(revdtl.rating_stars) from review_details revdtl where revdtl.rev_id = reviews.rev_id) as avg_ttl
			,product.cat_id
			from reviews,product,user_register , category   
			where product.prd_id = reviews.prd_id
			and product.status = 1
			and user_register.usr_id = reviews.usr_id
			and reviews.review_head != '' and reviews.status = 1 
			and FIND_IN_SET(category.cat_id,product.cat_id)
			order by date desc limit $getresult,2";
		}
		$query = $this->db->query($sql);
		
		//if($query->num_rows()>0)
		{
			return $query->result_array();
		}
	}
	
	function UpdateReview($user)
	{
		$rev_hidden = $this->input->post('rev_hidden'); //review id
		$webTitle=$this->input->post('webTitle');
		$webBody=$this->input->post('webBody');
		$odrnum=$this->input->post('odrnum');
		$rate1=$this->input->post('rate1');
		
		$rev_id = $rev_hidden;
		
		$data = array(
				'odrnum'=>$odrnum,
				'review_head'=>$webTitle,
				'review_body'=>$webBody
		);
		
		$this->db->where('rev_id', $rev_id);
		$this->db->update('reviews',$data);
		
		
		if(($rate1 != "") && ($rate1 != "0"))
		{
			$data = array (
				'rating_stars'=>$rate1,
				'rating_type'=>'totalrating'
			);
		   
			$this->db->where('rev_id', $rev_id);
			$this->db->update('review_details',$data);
		}
		
		
		
		$checkimage = strlen($_FILES['my_file']['name'][0]);
		if($checkimage > 0)
		{
			$this->db->delete('review_images', array('rev_id' => $rev_hidden));
			
			$uploaddir = "images/reviews/";//$rev_id 
			$thumbdir = "images/reviews/thumb/";//$rev_id 
			foreach($_FILES['my_file']['name'] as $name => $value)
			{
				$filename = stripslashes($_FILES['my_file']['name'][$name]);
				$size=filesize($_FILES['my_file']['tmp_name'][$name]);
				//Convert extension into a lower case format
				$ext = $this->getExtension($filename);
				$ext = strtolower($ext);
				//echo "\n";
				
				$image_name=time().$filename; 
				$newname=$uploaddir.$image_name;
				$thumbname=$thumbdir.$image_name;
				
				$fname = $_FILES['my_file']['name']; 
				$fileTmpName= $_FILES["my_file"]["tmp_name"][$name]; 
				
				if($fileTmpName != ''){
				$thumbimagestatus = $this->resizesave($fileTmpName,$thumbname,50,50);
				$mainimagestatus = $this->resizesave($fileTmpName,$newname,500,500);
				
				if($mainimagestatus == 1)
				{
					$data = array(
							'rev_id'=>$rev_hidden,
							'rev_image'=>$newname,
							'thumbnail'=>$thumbname
						);
					$this->db->insert('review_images', $data); 
				}
				//review_images
				}
			}
		}
		echo "1";
	}
	public function InsertReview($user)
	{
		
		$user_type = $this->session->userdata('admin_status');//admin status == 1
		
		if($user_type != "1")
		{
			$ttlID=$this->input->post('prd_hidden');
			$arrayData = explode(",",$ttlID);
			$prd_id=$arrayData[0];
			if(strpos($arrayData[1], ",") !== false ) 
			{
				$newarrayData = explode(",",$arrayData[1]);
				$cat_id = "";
				$flag = false;
				for($i = 1; $i <= count($newarrayData); $i++)
				{
					if($flag == true && $i<count($newarrayData))
					{
						$cat_id .= ",";
					}
					$cat_id .= $newarrayData[$i];
					$flag = true;
				}
			}
			else{
				$cat_id =$arrayData[1];
			}
			
			
			
			$rate1=$this->input->post('rate1');
			
			//Order number
			$odrnum=$this->input->post('odrnum');
			
			// $rate2=$this->input->post('rate2');
			// $rate3=$this->input->post('rate3');
			// $rate4=$this->input->post('rate4');
			// $rate5=$this->input->post('rate5');
			
			$webTitle=$this->input->post('webTitle');
			$webBody=$this->input->post('webBody');
			
			//$date = date('Y-m-d h:i:s');
			
			$data = array(
						'cat_id'=>$cat_id,
						'prd_id'=>$prd_id,
						'usr_id'=>$user,
						'odrnum'=>$odrnum,
						'review_head'=>$webTitle,
						'review_body'=>$webBody,
						//'date'=>$date,
						'status'=>'0'
				);
				
			$this->db->insert('reviews', $data); 
			
			$query = $this->db->query('SELECT LAST_INSERT_ID()');
			$row = $query->row_array();
			$rev_id = $row['LAST_INSERT_ID()']; //review table auto gen id
			
			// $data = array(
			   // array(
					// 'rev_id'=>$rev_id,
					// 'rating_stars'=>$rate1,
					// 'rating_type'=>'totalrating'
			   // )
			   // ,
			   // array(
					// 'rev_id'=>$rev_id,
					// 'rating_stars'=>$rate2,
					// 'rating_type'=>'value'
			   // ),
			   // array(
					// 'rev_id'=>$rev_id,
					// 'rating_stars'=>$rate3,
					// 'rating_type'=>'shipping'
			   // ),
			   // array(
					// 'rev_id'=>$rev_id,
					// 'rating_stars'=>$rate4,
					// 'rating_type'=>'support'
			   // ),
			   // array(
					// 'rev_id'=>$rev_id,
					// 'rating_stars'=>$rate5,
					// 'rating_type'=>'other'
			   // )
			// );
			
			if($rate1 != '0')
			{
				$data = array('rev_id'=>$rev_id,'rating_stars'=>$rate1,'rating_type'=>'totalrating');
			}
			else{
				$data = array('rev_id'=>$rev_id,'rating_stars'=>'1','rating_type'=>'totalrating');
			}
			$this->db->insert('review_details', $data); 
			
			
			
			//$this->db->insert_batch('review_details', $data); 
			
			
			//work here
			$checkimage = strlen($_FILES['my_file']['name'][0]);
				if($checkimage > 0)
				{
				$uploaddir = "images/reviews/";//$rev_id 
				$thumbdir = "images/reviews/thumb/";//$rev_id 
				foreach($_FILES['my_file']['name'] as $name => $value)
				{
					$filename = stripslashes($_FILES['my_file']['name'][$name]);
					$size=filesize($_FILES['my_file']['tmp_name'][$name]);
					//Convert extension into a lower case format
					$ext = $this->getExtension($filename);
					$ext = strtolower($ext);
					//echo "\n";
					
					$image_name=time().$filename; 
					$newname=$uploaddir.$image_name;
					$thumbname=$thumbdir.$image_name;
					
					$fname = $_FILES['my_file']['name']; 
					$fileTmpName= $_FILES["my_file"]["tmp_name"][$name]; 
					
					if($fileTmpName != ''){
					$thumbimagestatus = $this->resizesave($fileTmpName,$thumbname,50,50);
					$mainimagestatus = $this->resizesave($fileTmpName,$newname,500,500);
					
					if($mainimagestatus == 1)
					{
						$data = array(
								'rev_id'=>$rev_id,
								'rev_image'=>$newname,
								'thumbnail'=>$thumbname
							);
						$this->db->insert('review_images', $data); 
					}
					//review_images
					}
				}
			}
			//Notification Model Loading and calling it Start
				$notification =& get_instance(); 
				$notification->load->model("notificationmodel");
				$this->notificationmodel->writeReviewNotification($prd_id,$rev_id,$user,$webTitle);
			//Notification Model Loading and calling it End
			
			
			
				///Email code 
				$toemailusrid = $user;
				$query = $this->db->query("SELECT * from reviews where usr_id = $toemailusrid ")->num_rows();
				if($query == 1)
				{
					$query = $this->db->query("SELECT * from user_register where usr_id = $toemailusrid ");
					$row = $query->row_array();
					$email_id = $row['email_id']; //review table auto gen id
					$usr_name = $row['usr_name']; //review table auto gen id
					if($email_id != '')
					{
						$query = $this->db->query('SELECT * FROM adminemail ');
						$adminEmail = $query->row_array();
						$fromname = $adminEmail['name'];
						$fromEmail = $adminEmail['email'];
						
						$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
						$this->email->to($email_id);
						$this->email->subject('Review Submitted');
						
						//Email Template Model
							$logolink = base_url()."images/logo.png";
							$emailmodel =& get_instance(); 
							$emailmodel->load->model("emailmodel");
							$mailbody = $this->emailmodel->ReviewSubmit($logolink,$usr_name);
						//Email Template Model
						
						//$mailbody = $this->mailtemplate('Your review has been submitted!');
						$this->email->set_mailtype("html");
						$this->email->message($mailbody);
						$this->email->send();
					
					}
				}
				///Email code 
			
				echo "1";
		}
		else
		{
			echo "noaccess";
		}
	}
	
	public function InsertCommentOnReview($userid,$revID,$text)
	{
		$date = date('Y-m-d h:i:s');
		$data = array(
					'rev_id'=>$revID,
					'usr_id'=>$userid,
					'cmt_text'=>$text,
					'date'=>$date,
					'status'=>'0'
			);
			//$sql = "insert into comment_reviews(rev_id,usr_id,cmt_text,status) values ('3','4','sdsf','0')";
		$this->db->insert('comment_reviews', $data); 
		//$this->db->query($sql);
		$query = $this->db->query('SELECT LAST_INSERT_ID()');
		$row = $query->row_array();
		$cmt_rev_id = $row['LAST_INSERT_ID()']; //review table auto gen id
		
		$getReviewComment = $this->write_review_model->getReviewComment($revID);
		
		///Email code 
		$query = $this->db->query("SELECT * from reviews where rev_id = $revID ");
		$row = $query->row_array()['usr_id'];
		
		$toemailusrid = $row;//$userid;
		
		$query = $this->db->query("SELECT * from user_register where usr_id = $toemailusrid ");
		$row = $query->row_array();
		$email_id = $row['email_id']; //review table auto gen id
		$usr_name = $row['usr_name']; //review table auto gen id
		if($email_id != '')
		{
			$query = $this->db->query('SELECT * FROM adminemail ');
			$adminEmail = $query->row_array();
			$fromname = $adminEmail['name'];
			$fromEmail = $adminEmail['email'];
			
			$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
			$this->email->to($email_id);
			$this->email->subject('Comment Submitted');
			
			//Email Template Model
				$logolink = base_url()."images/logo.png";
				$emailmodel =& get_instance(); 
				$emailmodel->load->model("emailmodel");
				$mailbody = $this->emailmodel->ReplyComment($logolink,$usr_name);
			//Email Template Model
			
			//$mailbody = $this->mailtemplate('Your comment on review has been submitted!');
			$this->email->set_mailtype("html");
			$this->email->message($mailbody);
			$this->email->send();
		
		}
		///Email code 
		
		
		?>
		<ul>
		<?php
		foreach ($getReviewComment as $cmtValue)
		{
			?>
				<li>
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
				</li>
		<?php } ?>
		</ul>
		<!--<div class="view-commt"><a href="javascript:commentmodalread('<?php //echo $revID; ?>')" >View All</a></div>-->
		<?php
		//echo $cmt_rev_id;
	}
	
	
	function getCommentsListofReview()
	{
		$revid=$this->input->post('revid');
		
		$sql = "SELECT comment_reviews.*,user_register.* FROM `comment_reviews` inner join user_register on comment_reviews.usr_id = user_register.usr_id where rev_id = $revid";
		$query = $this->db->query($sql);
		$getReviewComment = $query->result_array();
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
						}else{
							?>
								<img src="images/about-icon-md.png" alt="profile-pic">
							<?php 
						}
					}
					else{
						?>
						<img src="images/about-icon-md.png" alt="profile-pic">
						<?php 
					}
					?>
				 <span class="user-n"><a href="user/profile/<?php  echo $cmtValue['usr_id']; ?>"> <?php echo $cmtValue['usr_name']; ?></a></span>       
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
		<?php }
		
		
	}
	
	function getRatingSummary($prdId)
	{
		
		$sql = "select round((sum(review_details.rating_stars) / (SELECT count(reviews.rev_id) FROM `reviews` where prd_id = $prdId and status = 1 )),1) as service_rating
				,review_details.rating_type 
				,(SELECT count(reviews.rev_id) FROM `reviews` where prd_id = $prdId and status = 1 ) as num_usr 
				from review_details where review_details.rev_id in 
				(SELECT reviews.rev_id FROM `reviews` where reviews.prd_id = $prdId and status = 1 )
				group by review_details.rating_type ";
				
		//$sql =  "select sum(review_details.rating_stars) as service_rating ,(SELECT count(rev_id)  FROM `reviews` where prd_id = $prdId and status = 1 )as numuser from review_details where rev_id in(SELECT rev_id FROM `reviews` where prd_id = $prdId and status = 1  ) "; 
		
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
	}
	
	function getCountofReview($prdId)
	{	
		$sql = "SELECT count(reviews.rev_id) as total_comment FROM `reviews`,`review_details` where prd_id = $prdId  and status = 1 and review_head <> '' and review_details.rev_id = reviews.rev_id  ";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		echo $row['total_comment'];
	}
	
	function getCountofReviewNew($prdId)
	{	
		$sql = "SELECT count(reviews.rev_id) as total_comment FROM `reviews`,`review_details` where prd_id = $prdId  and status = 1 and review_head <> '' and review_details.rev_id = reviews.rev_id  ";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		echo $row['total_comment'];
	}
	
	
	function getCountofTotalCommentsReview($revid)
	{	
		$sql = "SELECT count(cmt_rev_id) as total_comment FROM `comment_reviews` where rev_id = $revid ";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		echo $row['total_comment'];
	}
	
	function getCompanyStats($prdId)
	{	
		$sql = "SELECT sum(prd_like) as prd_like_count ,sum(bookmark) as bookmark_count,sum(used) as iuse_count  FROM `reviews` where prd_id = $prdId ";
		$query = $this->db->query($sql);
		return $query->row_array();
		
	}
	
	function getExtension($str)
	{
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
	
	function getReviewImages($revid)
	{
		$sql = "SELECT * FROM review_images where rev_id = $revid ";
		$query = $this->db->query($sql);
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
	}
	
	function getCompanylikeModalDetails($prdId)
	{
		$sql = "SELECT usr_id,date FROM `reviews` where prd_id = $prdId and prd_like = 1  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function getCompanybookmarkModalDetails($prdId)
	{
		$sql = "SELECT usr_id,date FROM `reviews` where prd_id = $prdId and bookmark = 1  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function getCompanyiuseModalDetails($prdId)
	{
		$sql = "SELECT usr_id,date FROM `reviews` where prd_id = $prdId and used = 1 ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function getcategoryProduct($catid)
	{
		$product = $this->db->query("SELECT * FROM `product` where FIND_IN_SET($catid,cat_id) order by prd_name asc ")->result_array();
		?>
		<option class="dropdownlivalue" value='0' id='0' >Select company name</option>
		<?php foreach($product as $prd){ ?>
		<option class="dropdownlivalue" value='<?php echo $prd['prd_id']; ?>' id='<?php echo $prd['prd_id']; ?>' ><?php echo $prd['prd_name']; ?></option>
		<?php
		}
	}
	
	function getDealProduct($prdid)
	{
		return $this->db->query("SELECT * FROM `product` where prd_id = $prdid")->row_array();
	}
	
	function resizesave($fileTempNmae,$filepath,$compresswidth,$compressheight)
	{
		//resizing
		$bannertempname = $fileTempNmae;//file temp name
		$size = getimagesize($bannertempname);
		$type = $size['mime'];                        
		$width = $size[0];
		$height = $size[1];
		
		$newwidth = $compresswidth;
		$newheight = $compressheight;
		$tmp = imagecreatetruecolor($newwidth, $newheight);
		
		$resizefilename=$filepath;//"images/category/full/".$newFileName; path with file name and its extenstion
		$status = "0";
		if ($size[2] == IMAGETYPE_GIF) 
		{
			$src = imagecreatefromgif($bannertempname);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagegif($tmp, $resizefilename, 100);
			$status = "1";
		}
		elseif ($size[2] == IMAGETYPE_JPEG)
		{
			$src = imagecreatefromjpeg($bannertempname);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagejpeg($tmp, $resizefilename, 100);
			$status = "1";
		}
		elseif ($size[2] == IMAGETYPE_PNG)
		{
			$src = imagecreatefrompng($bannertempname);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagepng($tmp, $resizefilename, 9);
			$status = "1";
		}
		imagedestroy($src);
		imagedestroy($tmp);
		//resizing
		
		return $status;
	}
	
	function mailtemplate($message)
	{
		$html =" <style type='text/css'>
			img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
			a img { border: none; }
			table { border-collapse: collapse !important;}
			#outlook a { padding:0; }
			.ReadMsgBody { width: 100%; }
			.ExternalClass { width: 100%; }
			.backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
			table td { border-collapse: collapse; }
			.ExternalClass * { line-height: 115%; }
			.container-for-gmail-android { min-width: 600px; }

			* {
				font-family: Helvetica, Arial, sans-serif;
			}

			body {
				-webkit-font-smoothing: antialiased;
				-webkit-text-size-adjust: none;
				width: 100% !important;
				margin: 0 !important;
				height: 100%;
				color: #676767;
			}

			td {
				font-family: Helvetica, Arial, sans-serif;
				font-size: 14px;
				color: #777777;
				text-align: center;
				line-height: 21px;
			}

			a {
				color: #676767;
				text-decoration: none !important;
			}

			.pull-left {
				text-align: left;
			}

			.pull-right {
				text-align: right;
			}

			.header-lg,
			.header-md,
			.header-sm {
				font-size: 32px;
				font-weight: 700;
				line-height: normal;
				padding: 35px 0 0;
				color: #4d4d4d;
			}

			.header-md {
				font-size: 24px;
			}

			.header-sm {
				padding: 5px 0;
				font-size: 18px;
				line-height: 1.3;
			}

			.content-padding {
				padding: 20px 0 30px;
			}

			.mobile-header-padding-right {
				width: 290px;
				text-align: right;
				padding-left: 10px;
			}

			.mobile-header-padding-left {
				width: 290px;
				text-align: left;
				padding-left: 10px;
			}

			.free-text {
				width: 100% !important;
				padding: 10px 60px 0px;
			}

			.block-rounded {
				border-radius: 5px;
				border: 1px solid #e5e5e5;
				vertical-align: top;
			}

			.button {
				padding: 30px 0;
			}

			.info-block {
				padding: 0 20px;
				width: 260px;
			}

			.block-rounded {
				width: 260px;
			}

			.info-img {
				width: 258px;
				border-radius: 5px 5px 0 0;
			}

			.force-width-gmail {
				min-width:600px;
				height: 0px !important;
				line-height: 1px !important;
				font-size: 1px !important;
			}

			.button-width {
				width: 228px;
			}

		</style>

		<style type='text/css' media='screen'>
			@import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
		</style>

		<style type='text/css' media='screen'>
			@media screen {
				* {
					font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
				}
			}
		</style>

		<style type='text/css' media='only screen and (max-width: 480px)'>
			@media only screen and (max-width: 480px) {
				table[class*='container-for-gmail-android'] {
					min-width: 290px !important;
					width: 100% !important;
				}

				table[class='w320'] {
					width: 320px !important;
				}

				img[class='force-width-gmail'] {
					display: none !important;
					width: 0 !important;
					height: 0 !important;
				}

				a[class='button-width'],
				a[class='button-mobile'] {
					width: 248px !important;
				}

				td[class*='mobile-header-padding-left'] {
					width: 160px !important;
					padding-left: 0 !important;
				}

				td[class*='mobile-header-padding-right'] {
					width: 160px !important;
					padding-right: 0 !important;
				}

				td[class='header-lg'] {
					font-size: 24px !important;
					padding-bottom: 5px !important;
				}

				td[class='header-md'] {
					font-size: 18px !important;
					padding-bottom: 5px !important;
				}

				td[class='content-padding'] {
					padding: 5px 0 30px !important;
				}

				td[class='button'] {
					padding: 5px !important;
				}

				td[class*='free-text'] {
					padding: 10px 18px 30px !important;
				}

				td[class='info-block'] {
					display: block !important;
					width: 280px !important;
					padding-bottom: 40px !important;
				}

				td[class='info-img'],
				img[class='info-img'] {
					width: 278px !important;
				}
			}
		</style>
		<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%' style='background-color:#f7f7f7' >
			<tr>
				<td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
					<center>
						<img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
							<table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
								<tr>
									<td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
									 
										<center>
											<table cellpadding='0' cellspacing='0' width='600' class='w320'>
												<tr>
													<td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
														<a href=''><img width='137' height='47' src='http://demo.dupleit.com/weblister_v2/images/logo.png' alt='logo'></a>
													</td>
													<td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
														<a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
														<a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
														<a href=''><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
													</td>
												</tr>
											</table>
										</center>
									 
									</td>
								</tr>
							</table>
					</center>
				</td>
			</tr>
			<tr>
				<td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
					<center>
						<table cellspacing='0' cellpadding='0' width='600' class='w320'>
							<tr>
								<td class='header-lg'>
									The Weblisters!
								</td>
							</tr>
							<tr>
								<td style='height:100px;'></td>
							</tr>
							<tr>
								<td >
									<table>
									<tr>
									<td>'$message'</td></tr>
									</table>
								</td>
							</tr>
						</table>
					</center>
				</td>
			</tr>
			
			<tr>
				<td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
					<center>
						<table cellspacing='0' cellpadding='0' width='600' class='w320'>
							<tr>
								<td style='padding: 25px 0 25px'>
									<strong>The Weblisters</strong><br />
									Kolkata <br />
									India <br /><br />
								</td>
							</tr>
						</table>
					</center>
				</td>
			</tr>
		</table>";
		return $html;
	}
	
}
?>