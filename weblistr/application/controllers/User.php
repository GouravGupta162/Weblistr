<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('user_model','category_model','list_model','contact_model','featured_model','write_review_model'));  //Open 
		$this->load->library(array('session','email'));  // Session on each controller
		$this->load->database(); // db 
		$this->load->helper(array('url','form','file','date')); // form action basic things
		
		$autoload['libraries'] = array('globals');
		//$this->load->library('../controllers/Category');// another controler Category
		 
	}

	function bio($id = 0)
	{
		//echo $id;
		$data['title']= 'About Me';
		$this->load->view('header_view',$data);
		$data['bioid'] = $id;
		
		if($id == 0)
		{
			$userid = $this->session->userdata('usr_id');
			$data['getBookmarkedProduct'] = $this->user_model->getBookmarkedProduct($userid);//user bookmark content
						
			$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
			$data['getUserImage'] = $this->user_model->getUserImage($userid);//user details for profile image and other things
			$data['getUserName'] = $this->user_model->getUserName($userid);//user details for profile image and other things
			$data['getUserAddress'] = $this->user_model->getUserAddress($userid);//user details for profile image and other things
			$data['profilechanger'] = true;
			
			$data['getUserReviews'] = $this->user_model->getUserReviews($userid);
			
			$data['usrID'] = $userid;
			
		}
		else{
			if($id == $this->session->userdata('usr_id'))
			{
				$userid = $id;
				$data['getBookmarkedProduct'] = $this->user_model->getBookmarkedProduct($userid);//user bookmark content
							
				$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
				$data['getUserImage'] = $this->user_model->getUserImage($userid);//user details for profile image and other things
				$data['getUserName'] = $this->user_model->getUserName($userid);//user details for profile image and other things
				$data['getUserAddress'] = $this->user_model->getUserAddress($userid);//user details for profile image and other things
				$data['profilechanger'] = true;
				
				$data['getUserReviews'] = $this->user_model->getUserReviews($userid);
				
				$data['usrID'] = $id;
			}
			else{
			$userid = $id;
			$data['getBookmarkedProduct'] = $this->user_model->getBookmarkedProduct($userid);//user bookmark content
						
			$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
			$data['getUserImage'] = $this->user_model->getUserImage($userid);//user details for profile image and other things
			$data['getUserName'] = $this->user_model->getUserName($userid);//user details for profile image and other things
			$data['getUserAddress'] = $this->user_model->getUserAddress($userid);//user details for profile image and other things
			$data['profilechanger'] = false;
			
			$data['getUserReviews'] = $this->user_model->getUserReviews($userid);
			
			$data['usrID'] = $id;
			}
		}
		
 		$this->load->view("user_bio_view", $data);//$this->load->view("registration_view.php", $data);
		
		$this->load->view('footer_view',$data);
			
	}
	public function index()
	{
		//echo $this->session->userdata('usr_id');
		if(($this->session->userdata('usr_id')!=""))
		{   
			/*
			$data['title'] = $this->session->userdata('usr_id');
			$this->load->view('header_view',$data);
			//$data["fetchup"] = $this->user_model->fetchup();
			$this->load->view("home_view", $data);//$this->load->view("registration_view.php", $data);
			$this->load->view('footer_view',$data);
			*/
			 
			$this->welcome();
			
			
			
		}
		else{
			$data['title']= 'Home';
			
			//$data["fetchup"] = $this->user_model->fetchup();
			$data['getAllcategoryHome'] =  $this->category_model->getAllcategoryHomeNew();
			
			
			$data['getRecentReviews'] = $this->write_review_model->getRecentReviews();//$this->getReviews($id);
			
			$data['getAllcat'] = $this->category_model->getAllcat();
			$data['getAllcatForhomepage'] = $this->category_model->getAllcatForhomepage();
			$this->load->view('header_view',$data);
			$this->load->view("home_view", $data);//$this->load->view("registration_view.php", $data);
			
			$this->load->view('footer_view',$data);
		}
	}
	
	
	
	//After login first Screen for user
	public function welcome()
	{
		$data['title']= 'Welcome '. $this->session->userdata('usr_name') ;
		//$data['fname']="<div class='pagetext' >Please upload image file.</div>";
		$this->load->view('header_view',$data);
		$data['getAllcategoryHome'] =  $this->category_model->getAllcategoryHomeNew();
		
		$data['getRecentReviews'] = $this->write_review_model->getRecentReviews();//$this->getReviews($id);
		
		$data['getAllcat'] = $this->category_model->getAllcat();
		$data['getAllcatForhomepage'] = $this->category_model->getAllcatForhomepage();
		$this->load->view('home_view', $data); //$this->load->view('welcome_view.php', $data);
		$this->load->view('footer_view',$data);
	}
	
	public function notification()
	{
		$data['title']= 'Welcome '. $this->session->userdata('usr_name') ;
		//$data['fname']="<div class='pagetext' >Please upload image file.</div>";
		$this->load->view('header_view',$data);
		
		//Working here
		$userid = $this->session->userdata('usr_id');
		$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
		$data['getUserImage'] = $this->user_model->getUserImage($userid);//user details for profile image and other things
		$data['getUserName'] = $this->user_model->getUserName($userid);//user details for profile image and other things
		$data['getUserAddress'] = $this->user_model->getUserAddress($userid);//user details for profile image and other things
		
		$data['profilechanger'] = true;
		
		$this->load->view('user_notification_view', $data); //$this->load->view('welcome_view.php', $data);
		$this->load->view('footer_view',$data);
	}
	
	
	public function company()
	{
		if(($this->session->userdata('admin_status') == '1'))
		{ 
			$data['getCompanyProfile'] = $this->user_model->getCompanyProfile();
			$data['title']= 'Welcome '. $data['getCompanyProfile']['prd_name'] ;

			$this->load->view('header_view',$data);


			$this->load->view('company_profile_view', $data); //$this->load->view('welcome_view.php', $data);
			$this->load->view('footer_view',$data);
		}
	}
	
	
	
	function com_signup()
	{
		$this->user_model->com_signup();
	}
	
	
	
	//profile page my profile
	public function profile($id=0)
	{
	
		$data['title']= 'Welcome '. $this->session->userdata('usr_name');
		
	  // if(($this->session->userdata('admin_status') == '1') && ($id == 0))
	   // { 
			// $data['getCompanyProfile'] = $this->user_model->getCompanyProfile();
			// $data['title']= 'Welcome '. $data['getCompanyProfile']['prd_name'] ;
			
			// $this->load->view('header_view',$data);
			
			
			// $this->load->view('company_profile_view', $data); //$this->load->view('welcome_view.php', $data);
			// $this->load->view('footer_view',$data);
	   // }
	   // else {
		   
		   
		   //$this->bookmark();
			$data['title']= 'My Weblist';
			//$data['fname']="<div class='pagetext' >Please upload image file.</div>";
			$this->load->view('header_view',$data);
				
		   if($id == 0)
		   {
			   $userid = $this->session->userdata('usr_id');
				
				//$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
				$data['getBookmarkedProduct'] = $this->user_model->getBookmarkedProduct($userid);//user bookmark content
							
				$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
				$data['getUserImage'] = $this->user_model->getUserImage($userid);//user details for profile image and other things
				$data['getUserName'] = $this->user_model->getUserName($userid);//user details for profile image and other things
				$data['getUserAddress'] = $this->user_model->getUserAddress($userid);//user details for profile image and other things
				$data['profilechanger'] = true;
				
				$data['getUserReviews'] = $this->user_model->getUserReviews($userid);
				
				$data['usrID'] = $userid;
				$this->load->view('user_bookmark_view', $data); //$this->load->view('welcome_view.php', $data);
				$this->load->view('footer_view',$data);
		   }
		   else{
			   
			   if($this->session->userdata('usr_id') != $id)
			   {
			   $userid = $id;
			
				//$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
				$data['getBookmarkedProduct'] = $this->user_model->getBookmarkedProduct($userid);//user bookmark content
				$data['usrID'] = $id;
				
				$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
				$data['getUserImage'] = $this->user_model->getUserImage($userid);//user details for profile image and other things
				$data['getUserName'] = $this->user_model->getUserName($userid);//user details for profile image and other things
				$data['getUserAddress'] = $this->user_model->getUserAddress($userid);//user details for profile image and other things
				$data['profilechanger'] = false;
				
				
				$data['getUserReviews'] = $this->user_model->getUserReviews($userid);
				
				$data['usrID'] = $userid;
				$this->load->view('user_bookmark_view', $data); //$this->load->view('welcome_view.php', $data);
				$this->load->view('footer_view',$data);
			   }
			   else{		   
					$userid = $this->session->userdata('usr_id');
					//$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
					$data['getBookmarkedProduct'] = $this->user_model->getBookmarkedProduct($userid);//user bookmark content
					$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
					$data['getUserImage'] = $this->user_model->getUserImage($userid);//user details for profile image and other things
					$data['getUserName'] = $this->user_model->getUserName($userid);//user details for profile image and other things
					$data['getUserAddress'] = $this->user_model->getUserAddress($userid);//user details for profile image and other things
					$data['profilechanger'] = true;

					/////User Reviews
					$data['getUserReviews'] = $this->user_model->getUserReviews($userid);
					$data['usrID'] = $userid;
					$this->load->view('user_bookmark_view', $data); //$this->load->view('welcome_view.php', $data);
					$this->load->view('footer_view',$data);
			   }
		   }
		   
		   
			// if($id == 0){
				// if(($this->session->userdata('usr_id')!=""))
				// {   
					// $userid = $this->session->userdata('usr_id');
					// $data['title']= 'Welcome '. $this->session->userdata('usr_name') ;
					// //$data['fname']="<div class='pagetext' >Please upload image file.</div>";
					// $this->load->view('header_view',$data);
					// $data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
					// $data['getUserImage'] = $this->user_model->getUserImage($userid);//user details for profile image and other things
					// $data['getUserName'] = $this->user_model->getUserName($userid);//user details for profile image and other things
					// $data['getUserAddress'] = $this->user_model->getUserAddress($userid);//user details for profile image and other things
					
					// $data['profilechanger'] = true;
					
					// $this->load->view('user_profile_view', $data); //$this->load->view('welcome_view.php', $data);
					// $this->load->view('footer_view',$data);
				// }
			// }
			// else 
			// {
				// if($id == $this->session->userdata('usr_id'))
				// {
					// $data['profilechanger'] = true;
				// }
				// else {
					// $data['profilechanger'] = false;	
				// }
				
				// $userid = $id;//$this->session->userdata('usr_id');
				
				
				// $data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
				// $data['getUserImage'] = $this->user_model->getUserImage($userid);//user details for profile image and other things
				// $data['getUserAddress'] = $this->user_model->getUserAddress($userid);//user details for profile image and other things
				
				// $getUserName = $this->user_model->getUserName($userid);//user details for profile image and other things
				
				// $data['getUserName'] = $getUserName;
				// $data['title']= 'Welcome '. $getUserName[0]['usr_name'];//$this->session->userdata('usr_name') ;			
				// $this->load->view('header_view',$data);
				
				// $this->load->view('user_profile_view', $data); //$this->load->view('welcome_view.php', $data);
				// $this->load->view('footer_view',$data);
				
			// }
		//}
	}
	
	//profile page my profile
	public function editprofile()
	{
		if(($this->session->userdata('usr_id')!=""))
		{   
	
			$userid = $this->session->userdata('usr_id');
			
			$data['title']= 'Edit Profile' ;
			//$data['fname']="<div class='pagetext' >Please upload image file.</div>";
			$this->load->view('header_view',$data);
			
			//$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
			
			$countryID = 1; //India Static
			$data['getState'] = $this->user_model->getState($countryID);//all state from tbl_state table
			
			
			$sql = "select user_register.* from user_register  where user_register.usr_id = ".$this->session->userdata('usr_id');
		
			$data['getUserDetails'] = $this->db->query($sql)->result_array();
			$data['usrID'] = $userid;
			
			//$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
			$data['getUserImage'] = $this->user_model->getUserImage($userid);//user details for profile image and other things
			$data['getUserName'] = $this->user_model->getUserName($userid);//user details for profile image and other things
			$data['getUserAddress'] = $this->user_model->getUserAddress($userid);//user details for profile image and other things
			$data['profilechanger'] = true;
			
			$this->load->view('user_edit_profile_view', $data); //$this->load->view('welcome_view.php', $data);
			$this->load->view('footer_view',$data);
		}
	}
	
	public function changePassword()
	{
		//$userid = $this->session->userdata('usr_id');
		$this->user_model->changePassword();
	}
	
	//profile page bookmark
	public function bookmark()
	{
		if(($this->session->userdata('usr_id')!=""))
		{   
	
			$userid = $this->session->userdata('usr_id');
			
			$data['title']= 'Bookmark';
			//$data['fname']="<div class='pagetext' >Please upload image file.</div>";
			$this->load->view('header_view',$data);
			
			//$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
			$data['getBookmarkedProduct'] = $this->user_model->getBookmarkedProduct($userid);//user bookmark content
			$data['usrID'] = $userid;
			
			$data['getUserDetails'] = $this->user_model->getUserDetails($userid);//user details for profile image and other things
			$data['getUserImage'] = $this->user_model->getUserImage($userid);//user details for profile image and other things
			$data['getUserName'] = $this->user_model->getUserName($userid);//user details for profile image and other things
			$data['getUserAddress'] = $this->user_model->getUserAddress($userid);//user details for profile image and other things
			$data['profilechanger'] = true;
			
			$data['getUserReviews'] = $this->user_model->getUserReviews($userid);
			
			
			$this->load->view('user_bookmark_view', $data); //$this->load->view('welcome_view.php', $data);
			$this->load->view('footer_view',$data);
		}
	}
	
	public function updateProfileImage()
	{
		if(($this->session->userdata('usr_id')!=""))
		{   
			$userid = $this->session->userdata('usr_id');
			$this->user_model->updateProfileImage($userid);
		}
	}
	
	
	public function getRecentReviewScroll()
	{
		$getresult = $_POST['getresult'];
		$reviews = $this->write_review_model->getRecentReviewScroll($getresult);
		//$select = mysql_query("select comment from sample_comment limit $no,10");
		if($reviews != null){
		foreach($reviews as $recentReviews){
			
			
			?>
			
<div class="review">
<div class="name-det"> 
<div class="pull-left">
<h4 class='reviewAtag'><a href='Review/detail/<?php echo $recentReviews['prd_id']; ?>'><?php echo substr($recentReviews['prd_name'],0,25); ?></a></h4>
</div>

<div class="pull-right">
<div class="r-list">
<ul>


<li>
<a href='Review/detail/<?php echo $recentReviews['prd_id']; ?>'>

<i><img src="images/review-icon.png" alt="review-icon"></i>
<?php 


$revprdid =  $recentReviews['prd_id']; 

$query = $this->db->query("SELECT count(reviews.rev_id)  as 'total_reviews' from reviews,review_details where reviews.prd_id =  $revprdid  and reviews.review_head <> '' and review_details.rev_id = reviews.rev_id and reviews.status = 1 ");
$total_reviews = $query->row_array()['total_reviews'];
				
echo $total_reviews;


// $revprdid =  $recentReviews['prd_id']; 

// $query = $this->db->query("SELECT count(reviews.rev_id)  as 'total_reviews' from reviews,review_details where reviews.prd_id =  $revprdid  and reviews.review_head <> '' and review_details.rev_id = reviews.rev_id ");
// $total_reviews = $query->row_array()['total_reviews'];
				
// echo $total_reviews; //$recentReviews['total_reviews'];
 ?> Reviews</a></li>

<li><i><img src="images/time.png" alt="time"></i><?php echo $this->time_elapsed_string($recentReviews['date']); ?></li>
</ul>


</div>
</div>
  </div>
  
			
			
  <div class="info-det">
  
  
   <div class="profile-pic">

  
  <?php 
  $getUserDetails = $this->user_model->userimage($recentReviews['usr_id']);
  if(sizeof($getUserDetails) > 0)
	{
		//foreach($getUserDetails as $userprofile)
		{
			if($getUserDetails['register_method']== 'facebook')
			{
				?>
					<img src="http://graph.facebook.com/<?php echo $getUserDetails['social_id'] ?>/picture?type=large" alt='profile-pic' >
				<?php
			}
			else{
				$pimag = $getUserDetails['profile_image'];
				if(($pimag != '') && ($pimag != null))
				{
					
					if (file_exists($pimag)) 
					{
						?>
							<img src='<?php echo $pimag ?>' alt='profile-pic' width="100%"/>
						<?php
					}
					else{
						?>
							<img src="http://www.clker.com/cliparts/M/o/W/d/C/j/about-icon-md.png" width="100%"alt="profile-pic" />
						<?php
					}
				}
				else 
				{
				?>
					<img src="http://www.clker.com/cliparts/M/o/W/d/C/j/about-icon-md.png" width="100%"alt="profile-pic" />
				<?php
				}
			}
		}
	}
	else 
	{
	?>
		<img src="http://www.clker.com/cliparts/M/o/W/d/C/j/about-icon-md.png"width="100%" alt="profile-pic" />
	<?php
	}
  
  ?>

  </div>
  

  <div class="name reviewAtag">
<h5> <a href="user/profile/<?php echo $recentReviews['usr_id']  ?>"/> <?php echo substr($recentReviews['usr_name'],0,25); ?></a></h5>

<h6><?php 
$result = $this->user_model->getCountryName($recentReviews['country']); 
//var_dump($result);
if(sizeof($result) > 0)
{
	echo $result[0]['country_name'];
}
?></h6>


</div>

 <div class="stars pull-right">
  
  
   <?php 
  
$arrayData = explode(",",$recentReviews['avg_ttl'] );
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
			// switch ($dotstar) {
				// case "1": $this->writeStar($mainstar,'0');	break;
				// case "2": $this->writeStar($mainstar,'0'); break; 
				// case "3": $this->writeStar($mainstar,'0'); break; 
				// case "4": $this->writeStar($mainstar,'0');	break;
				// case "5": $this->writeStar($mainstar,'5'); break; 
				// case "6": $this->writeStar($mainstar,'5'); break; 
				// case "7": $this->writeStar($mainstar,'5');	break;
				// case "8": $this->writeStar($mainstar,'8'); break; 
				// case "9": $this->writeStar($mainstar,'9'); break;
				
			$this->contact_model->ratingNewWrite($mainstar,$dotstar);
				
				?>
				<span class="c-count"><?php echo $mainstar; ?>.<?php echo $dotstar; ?> </span>
				<?php				
			//}
		}
	}
	else{
		//echo $arrayvalue;
		$this->contact_model->ratingNewWrite($arrayvalue,'0');
		//$this->writeStar($arrayvalue,'0');
		?>
		<span class="c-count"><?php echo $arrayvalue; ?>.0 </span>
		<?php
	}
}
else{
	echo "&nbsp;";
}
?>
  </div>


<div class="r-bg">
  <div class="info-para">
  <a href="Review/revdetail/<?php echo $recentReviews['prd_id']; ?>/<?php echo $recentReviews['rev_id']; ?>"><h1><?php echo $recentReviews['review_head']; ?></h1></a>
	<?php if(strlen($recentReviews['review_body']) > 150){
		echo substr($recentReviews['review_body'],0,150).'...';
		?>
		<a href="Review/revdetail/<?php echo $recentReviews['prd_id']; ?>/<?php echo $recentReviews['rev_id']; ?>">view more</a>
		<?php
	}
	else{
		echo $recentReviews['review_body'];
	} ?>
  </div>
  
  
  
<!--Images Thumbnail in review section LIST-->
<?php
$revImages = $this->write_review_model->getReviewImages($recentReviews['rev_id']);
if(sizeof($revImages)>0)
{
	?>
	<div class="r_thumbnails">
		<ul>
			<?php 
			foreach($revImages as $revimage){
			?>
				<li>
				<a class="fancybox" href="<?php echo $revimage['rev_image'] ?>" data-fancybox-group="gallery<?php echo $recentReviews['rev_id']; ?>" title="<?php echo $recentReviews['review_head'] ?>">
				
				<img src="<?php echo $revimage['thumbnail'] ?>" />
				</a>
				</li>
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
  
  <!--<div class="col-md-7 col-xs-12">-->
  
  <!--was this helpful start-->
  
  
<div class="rtl-count">

<ul><li>Was This Helpful?</li>

<?php
$getReviewCountStats = $this->write_review_model->getReviewCountStats($recentReviews['rev_id']); 

//var_dump($getReviewCountStats);

$stat = count($getReviewCountStats);

if($stat!=0) {
$countvalue = $getReviewCountStats[0];
	//foreach ($getReviewCountStats as $countvalue) 
 	if($countvalue['helpfull_status']==0) 
	{ ?>
	<li><span><a href='javascript:void(0);' id="help_atag_<?=$recentReviews['rev_id']; ?>" onclick="helpfull('<?php echo $recentReviews['rev_id']  ?>','1')" > Yes</a></span>
	<span id="help_full_counter_<?php echo $recentReviews['rev_id']; ?>" ><?php echo $this->write_review_model->helpfullCountNew($recentReviews['rev_id']); ///$countvalue['helpfull_count'] ?></span> </li>
	<?php 
	}
	else if ($this->session->userdata('usr_id')!= "")
	{
	?>
	<li><span class='washelpfulldone' ><a href="javascript:void(0);" id='help_atag_<?php echo $recentReviews['rev_id'];  ?>'  onclick="helpfull('<?php echo $recentReviews['rev_id']  ?>','0')"  >Yes</a></span>
	<span id="help_full_counter_<?php echo $recentReviews['rev_id'];  ?>" ><?php echo $this->write_review_model->helpfullCountNew($recentReviews['rev_id']); ///$countvalue['helpfull_count'] ?></span> </li>
	<?php
	}
	else 
	{ ?>
	<li><span  ><a href="javascript:void(0);" id='help_atag_<?php echo $recentReviews['rev_id'] ; ?>'  onclick="helpfull('<?php echo $recentReviews['rev_id']  ?>','1')"  >Yes</a></span>
	<span id="help_full_counter_<?php echo $recentReviews['rev_id'];  ?>" ><?php echo $this->write_review_model->helpfullCountNew($recentReviews['rev_id']); ///$countvalue['helpfull_count'] ?></span> </li>
	<?php
	}
}
else 
{
	?>
	<li><span><a href="javascript:void(0);" id='help_atag_<?php echo $recentReviews['rev_id']  ?>' onclick="helpfull('<?php echo $recentReviews['rev_id']  ?>','1')" >Yes</a></span>
	<span id='help_full_counter_<?php echo $recentReviews['rev_id']  ?>' ><?php echo $this->write_review_model->helpfullCountNew($recentReviews['rev_id']); ?><!--0--></span> </li>
	<?php
}
?>

 </ul>

</div>
  
  
  <!--
<div class="rtl-count">
<ul><li>Was This Helpful?</li>
<?php
$getReviewCountStats = $this->write_review_model->getReviewCountStats($recentReviews['rev_id']);  
$stat = count($getReviewCountStats);
if($stat!=0) {
$countvalue = $getReviewCountStats[0];
 	if($countvalue['helpfull_status']==0) { ?>
	<li><span><a href="javascript:void(0);"  id='help_atag_<?php echo $recentReviews['rev_id']  ?>' onclick="helpfull('<?php echo $recentReviews['rev_id']  ?>','1')" id='<?php echo $recentReviews['rev_id'] ?>' >Yes</a></span><span id='help_full_counter_<?php echo $recentReviews['rev_id']  ?>' >
	<?php echo $this->write_review_model->helpfullCountNew($recentReviews['rev_id']); ?></span> </li>
	
	<?php }
	
	else if ($this->session->userdata('usr_id')!= "")
	{
	?>
	<li><span class='washelpfulldone' ><a href="javascript:void(0);" id='help_atag_<?php echo $recentReviews['rev_id'];  ?>'  onclick="helpfull('<?php echo $recentReviews['rev_id']  ?>','1')"  >Yes</a></span>
	<span id='help_full_counter_<?php echo $recentReviews['rev_id']  ?>' ><?php echo $this->write_review_model->helpfullCountNew($recentReviews['rev_id']); ?></span> </li>
	<?php
	}
	
	else { ?>
	<li><span class='washelpfulldone' ><a href="javascript:void(0);"  id='help_atag_<?php echo $recentReviews['rev_id']  ?>' onclick="helpfull('<?php echo $recentReviews['rev_id']  ?>','1')" id='<?php echo $recentReviews['rev_id'] ?>' >Yes</a></span><span id='help_full_counter_<?php echo $recentReviews['rev_id']  ?>' >
	<?php echo $this->write_review_model->helpfullCountNew($recentReviews['rev_id']); ?></span> </li>
	<?php
		}
	
 }
 else 
 {
	 ?>
 	 <li><span><a href="javascript:void(0);"  id='help_atag_<?php echo $recentReviews['rev_id']  ?>' onclick="helpfull('<?php echo $recentReviews['rev_id']  ?>','1')" id='<?php echo $recentReviews['rev_id'] ?>' >Yes</a></span><span id='help_full_counter_<?php echo $recentReviews['rev_id']  ?>' ><?php echo $this->write_review_model->helpfullCountNew($recentReviews['rev_id']);?></span> </li>
	 <?php
 }
 ?>
 </ul>
</div>-->
<!--was this helpful end-->
  
   
  
  
  <div class="rate-right">
    <?php

if($stat!=0) {
	$countvalue = $getReviewCountStats[0];
 //foreach ($getReviewCountStats as $countvalue) 
 //{  
 ?>
 
 
 
 <?php  //var_dump($recentReviews);
 $likecount = $this->db->query("SELECT count(rev_id) as like_count FROM `review_stats` where rev_id = ".$recentReviews['rev_id']." and `like` = '1' ")->row_array();
$countvalue['like_count'] =  $likecount['like_count'];

	if($countvalue['like_status']==0) { ?>
		<a href="javascript:void(0);" onClick="likeReview('<?php echo $recentReviews['rev_id'] ?>','1')" id='rev_a_like_<?php echo $recentReviews['rev_id'] ?>'><div class="likes">
 <i class="fa fa-thumbs-up"   id='thumb_<?php echo $recentReviews['rev_id'] ?>' ></i><span id='rev_like_counter_<?php echo $recentReviews['rev_id'] ?>'><?php echo $countvalue['like_count'] ?></span>		</div></a>
	 
	<?php }
	else if($this->session->userdata('usr_id') == "") { ?>
<a href="javascript:void(0);" onClick="likeReview('<?php echo $recentReviews['rev_id'] ?>','1')" id='rev_a_like_<?php echo $recentReviews['rev_id'] ?>' ><div class="likes">
<i class="fa fa-thumbs-up"  id='thumb_<?php echo $recentReviews['rev_id'] ?>' ></i><span id='rev_like_counter_<?php echo $recentReviews['rev_id'] ?>'><?php echo $countvalue['like_count'] ?></span>	</div></a>
	<?php } else { ?>
	 <!--Dislike-->
		<a href="javascript:void(0);" onClick="likeReview('<?php echo $recentReviews['rev_id'] ?>','0')" id='rev_a_like_<?php echo $recentReviews['rev_id'] ?>' ><div class="likes fb-like">
		<i class="fa fa-thumbs-up " style="color:#fff;" id='thumb_<?php echo $recentReviews['rev_id'] ?>'
		></i><span id='rev_like_counter_<?php echo $recentReviews['rev_id'] ?>'><?php echo $countvalue['like_count'] ?></span> </div></a>
	<?php } 
	//} 
}
 else {  ?>

<a href="javascript:void(0);" onClick="likeReview('<?php echo $recentReviews['rev_id']; ?>','1')" id='rev_a_like_<?php echo $recentReviews['rev_id'] ?>' ><div class="likes">
<i class="fa fa-thumbs-up " id='thumb_<?php echo $recentReviews['rev_id']; ?>' ></i><span id='rev_like_counter_<?php echo $recentReviews['rev_id'] ?>'><?php echo $recentReviews['like_count'] ?></span></div></a>


<?php } ?>



		
			<!--<a href="javascript:void(0);" style="color:#fff; text-decoration:none " onclick="commentToggle('<?php echo $recentReviews['rev_id']; ?>')"><div class="str" data-toggle="modal" data-target=".bs-example-modal-lg">
			
			<i aria-hidden="true" class="fa fa-comment"></i> 
			<?php //echo $this->write_review_model->getCountofTotalCommentsReview($recentReviews['rev_id']); ?>
			</div></a>-->
			
			<a href="javascript:void(0);" style="color:#fff; text-decoration:none" onclick="commentToggle('<?php echo $recentReviews['rev_id']; ?>')">
			<div class="str" data-toggle="modal" data-target=".bs-example-modal-lg">
			<!--Reply-->
			<i aria-hidden="true" class="fa fa-comment"></i> 
			
				<input type='hidden' id='comment_counter_input_<?php echo $recentReviews['rev_id']; ?>'  
					value='<?php echo $this->write_review_model->getCountofTotalCommentsReview($recentReviews['rev_id']); ?>' />
				<span id='comment_counter_<?php echo $recentReviews['rev_id']; ?>' class='comment_counter' >
				<?php echo $this->write_review_model->getCountofTotalCommentsReview($recentReviews['rev_id']); ?>
				</span>
			</div>
			</a>



 </div>
 
  </div>
  
 

<!--<div class="comm" style="display: none;" id="form_div_<?php echo $recentReviews['rev_id']; ?>">-->
<div style='display:none;'  id="form_div_<?php echo $recentReviews['rev_id']; ?>" >
<div class="comm comment-list" id="form_div_inner_<?php echo $recentReviews['rev_id']; ?>" >

<!----->
<?php
$getReviewComment = $this->write_review_model->getReviewComment($recentReviews['rev_id']);
//var_dump($getReviewComment);
if(sizeof($getReviewComment) > 0) //Comments of Review
{
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
                    
                    <span class="user-n"><a href="user/profile/<?php  echo $cmtValue['usr_id']; ?>"><?php echo $cmtValue['usr_name']; ?><a/></span>
				
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

<div class="view-commt"><a href="javascript:commentmodalread('<?php echo $recentReviews['rev_id'] ?>')" class="view-commt">View All</a>
</div>


<?php

}
else{
	//echo "No Comments";
}
?>
</div>

<div>
<?php
if($this->session->userdata('usr_id') == $recentReviews['usr_id']  )//if($this->session->userdata('admin_status') == '1')
{ 
?>
<div class="form-group" >

<textarea class="form-control" id="textarea_<?php echo $recentReviews['rev_id']; ?>" name="textarea_<?php echo $recentReviews['rev_id']; ?>" rows="1" placeholder="Write a comment here..."></textarea>

</div>

<div id="status<?php echo $recentReviews['rev_id'];?>" ></div>

<a href="javascript:void(0)" class="btn btn-default pull-right red" onclick="reviewCMTsubmit('<?php echo $recentReviews['rev_id']; ?>')">Post</a>

<?php   
}
else{
	//No Company Profile

}   ?>
</div>

</div>
  
  
  
  
  
  </div>
    
</div>
<?php } 
		}	
			
		
	}
	
		
	function writeStar($main,$dot)
	{
		//echo '-'.$main.'--------'.$dot;
		if($dot == 5)
		{
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

		
		
//echo get_ago_time('2016-03-23 13:43:19');
function time_elapsed_string($datetime, $full = false) {
		$today = time();    
                 $createdday= strtotime($datetime); 
                 $datediff = abs($today - $createdday);  
                 $difftext="";  
                 $years = floor($datediff / (365*60*60*24));  
                 $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
                 $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
                 $hours= floor($datediff/3600);  
                 $minutes= floor($datediff/60);  
                 $seconds= floor($datediff);  
                 //year checker  
                 if($difftext=="")  
                 {  
                   if($years>1)  
                    $difftext=$years." yrs ago";  
                   elseif($years==1)  
                    $difftext=$years." yr ago";  
                 }  
                 //month checker  
                 if($difftext=="")  
                 {  
                    if($months>1)  
                    $difftext=$months." mnts ago";  
                    elseif($months==1)  
                    $difftext=$months." mnth ago";  
                 }  
                 //month checker  
                 if($difftext=="")  
                 {  
                    if($days>1)  
                    $difftext=$days." days ago";  
                    elseif($days==1)  
                    $difftext=$days." day ago";  
                 }  
                 //hour checker  
                 if($difftext=="")  
                 {  
                    if($hours>1)  
                    $difftext=$hours." hrs ago";  
                    elseif($hours==1)  
                    $difftext=$hours." hr ago";  
                 }  
                 //minutes checker  
                 if($difftext=="")  
                 {  
                    if($minutes>1)  
                    $difftext=$minutes." mins ago";  
                    elseif($minutes==1)  
                    $difftext=$minutes." min ago";  
                 }  
                 //seconds checker  
                 if($difftext=="")  
                 {  
                    if($seconds>1)  
                    $difftext=$seconds." secs ago";  
                    elseif($seconds==1)  
                    $difftext=$seconds." sec ago";  
                 }  
                 return $difftext;  
	}

	function timeDifference($timestamp)
	{
		$otherDate=$timestamp;
		$now = date("Y-m-d H:i:s");

		$secondDifference=@strtotime($now)-@strtotime($otherDate);
		$extra="";
		if ($secondDifference == 2592000) { 
		// months 
		$difference = $secondDifference/2592000; 
		$difference = round($difference,0); 
		if ($difference>1) { $extra="s"; } 
		$difference = $difference." month".$extra." ago"; 
		}else if($secondDifference > 2592000)
			{$difference=timestamp($timestamp);} 
		elseif ($secondDifference >= 604800) { 
			// weeks 
			$difference = $secondDifference/604800; 
			$difference = round($difference,0); 
			if ($difference>1) { $extra="s"; } 
			$difference = $difference." week".$extra." ago"; 
		} 
		elseif ($secondDifference >= 86400) { 
			// days 
			$difference = $secondDifference/86400; 
			$difference = round($difference,0); 
			if ($difference>1) { $extra="s"; } 
			$difference = $difference." day".$extra." ago"; 
		} 
		elseif ($secondDifference >= 3600) { 
			// hours 

			$difference = $secondDifference/3600; 
			$difference = round($difference,0); 
			if ($difference>1) { $extra="s"; } 
			$difference = $difference." hour".$extra." ago"; 
		} 
		elseif ($secondDifference < 3600) { 
			// hours 
			// for seconds (less than minute)
			if($secondDifference<=60)
			{       
				if($secondDifference==0)
				{
					$secondDifference=1;
				}
				if ($secondDifference>1) { $extra="s"; }
				$difference = $secondDifference." second".$extra." ago"; 

			}
			else
			{

		$difference = $secondDifference/60; 
				if ($difference>1) { $extra="s"; }else{$extra="";}
				$difference = round($difference,0); 
				$difference = $difference." minute".$extra." ago"; 
			}
		} 

		$FinalDifference = $difference; 
		return $FinalDifference;
	}


	
	public function login()
	{
		$email=$this->input->post('email_id');
		$password=$this->input->post('password');

		$result=$this->user_model->login($email,$password);
		if($result == 'loggedin'){ 
			echo "loggedin";
			//$this->welcome();
		}
		else if($result == 'notloggedin'){ 
			echo "notloggedin";
			//$this->index();
		}
		else if($result == 'banned'){ 
			echo "banned";
			//$this->index();
		}
	}
	
	public function companylogin()
	{
		$email=$this->input->post('email_id');
		$password=$this->input->post('password');

		$result=$this->user_model->companylogin($email,$password);
		if($result == 'loggedin'){ 
			echo "loggedin";
			//$this->welcome();
		}
		else if($result == 'notloggedin'){ 
			echo "notloggedin";
			//$this->index();
		}
		else if($result == 'banned'){ 
			echo "banned";
			//$this->index();
		}
	}
	
	public function thank()
	{
		$data['title']= 'Thank';
		$this->load->view('header_view',$data);
		$this->load->view('thank_view', $data); //$this->load->view('thank_view.php', $data);
		$this->load->view('footer_view',$data);
	}
	public function registration()
	{
		$data["register_status"] = $this->user_model->add_user();
		//$this->user_model->add_user();
	}
	
	public function fb_registration()
	{
		$data["register_status"] = $this->user_model->fb_add_user();
	}
	public function logout()
	{
		// $newdata = array(
		// 'user_id'   =>'',
		// 'user_name'  =>'',
		// 'user_email'     => '',
		// 'logged_in' => FALSE,
		// );
		
		$this->session->unset_userdata('usr_id','');
		$this->session->unset_userdata('usr_name','');
		$this->session->unset_userdata('email_id','');
		$this->session->unset_userdata('logged_in','FALSE');
				  
		//$this->session->unset_userdata($newdata );
		$this->session->sess_destroy();
		echo "0";
		//$this->index();
	}
	
	public function change_password()
	{
		$user_id=$this->input->post('user_id');
		$password=md5($this->input->post('pass'));

		$result=$this->user_model->change_password($user_id,$password);
		if($result) $this->welcome();
		else        $this->index();
	}
	
	public function cpassword()
	{
		$data['title']= 'Change Password';
		$data['fname']="<div class='pagetext' >Change Password.</div>";
		$this->load->view('header_view',$data);
		$this->load->view('cpassword',$data);
		$this->load->view('footer_view');
		
	}
	
	public function add_image()
	{	
		if($this->input->post('upload'))
		{
			$user_id=$this->input->post('user_id');
			//$this->input->post('userfile');
			
			$config['upload_path'] = './files/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '1000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->load->library('upload', $config);
			//$this->upload->do_upload();
			//$data = $this->upload->data();

			if (!$this->upload->do_upload())
				{
				$error = array('error' => $this->upload->display_errors());
				//print_r($error);  // getting file error due to file size
				$data['title']= 'Image Change';
				$data['fname']="<div class='errortext' >".$error["error"]."</div>";
				$this->load->view('header_view',$data);
				$this->load->view('welcome_view',$data); //$this->load->view('welcome_view.php',$data);
				$this->load->view('footer_view');
				}
				else
				{
				$data =  $this->upload->data();
				$this->user_model->add_image($user_id,$data);
				
				$base = base_url();
				$file_name =$data["file_name"];
				$data['title']= 'Image Change';
				$data['fname']="<div class='successtext'><img src='$base/files/$file_name' title='$file_name' width='50px' height='35px' /> has been uploaded successfully.</div>";
				
				/*$data['fname']="<div class='successtext'>". "<img src=".<?php echo base_url();?>."/files/".$data["file_name"]." width='50px' height='35px' />"."has been uploaded successfully.</div>";*/
				$data['filename']=$data["file_name"];
				$this->load->view('header_view',$data);
				$this->load->view('welcome_view',$data); //$this->load->view('welcome_view.php',$data);
				$this->load->view('footer_view');
				
				//print_r($data);full_path	 
				// uploading successfull, now do your further actions
				}
		}
	}
	
	
	public function userProfileUpdate()
	{
		if(($this->session->userdata('usr_id')!=""))
		{   
			$user = $this->session->userdata('usr_id');
			$this->user_model->userProfileUpdate($user);
		}
	}
	
	public function sendFeedback()
	{
		$user = $this->session->userdata('usr_id');
		$this->user_model->feedback($user);
	}
	function companyReview($prdId)
	{
		$data['title']='Company Review';
		$this->load->view('header_view',$data);
		
		$data['getCompanyReview'] = $this->user_model->getCompanyReview($prdId);
		
		$data['paginationCount'] = $this->user_model->getPagination($prdId);
		
		$data['getCompanyProfile'] = $this->user_model->getCompanyProfile();
		
		$this->load->view('company_review_view',$data); 
		$this->load->view('footer_view');
	}
	function fetchpagingcontent()
	{
		$id=$this->input->post('pageId');
		$prdID=$this->input->post('prdID');
		
		$data['paginationCount'] = $this->user_model->fetchpagingcontent($id,$prdID);
	}
	function forgot()
	{
		$email_id = $this->input->post('email_id');
		
		$this->user_model->forgot($email_id);
		
		
	}
	function reset_pass($param)
	{
		$data['reset']=$this->user_model->reset_pass($param);
		
		$data['title']= 'Home';
		$this->load->view('header_view',$data);
		//$data["fetchup"] = $this->user_model->fetchup();
		$data['getAllcategoryHome'] =  $this->category_model->getAllcategoryHome();
		
		$data['getRecentReviews'] = $this->write_review_model->getRecentReviews();//$this->getReviews($id);
		
		$data['getAllcat'] = $this->category_model->getAllcat();
		$this->load->view("home_view", $data);//$this->load->view("registration_view.php", $data);
		$this->load->view('footer_view',$data);
		
	}
	function reset_got($teck)
	{
		$this->user_model->set_pass($teck);
	}
}
?>