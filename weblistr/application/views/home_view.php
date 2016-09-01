<?php 
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
?>






		
 <section class="search-top">

    <div class="container">

    <div class="main-text">

      <h1>Find the best websites and apps in India</h1>

      <!--<h4>Find Trustworthy Sites, Avoid Scams</h4>-->

     

    </div>

    <div class="col-xs-12">
		<div class="s_all">
		    <div class="input-group t-search">
                <div class="input-group-btn search-panel">
					<span class="select">
                    <select class="select-style" id='searchFilter' >
					<!--<select class="selectpicker"  id='searchFilter' >-->
					<option value='0'><span>All Categories</span></option>
					<?php 
					$getAllcat=$this->category_model->getAllcat();
					foreach($getAllcat as $cat) { ?>
						<option value='<?php echo $cat['cat_id'] ?>' ><?php echo $cat['cat_name'] ?></option>
					<?php } ?>			
					</select>
                    </span>
					<!--<div class='select'>
					<select id='searchFilters' class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<option value='0' ><span>All Categories</span></option>
					<?php //foreach($getAllcat as $cat) { ?>
					<option value='<?php //echo $cat['cat_id'] ?>' ><?php //echo $cat['cat_name'] ?></option>
					<?php //} ?></select></div>-->
                </div>
                <input type="hidden" name="search_param" value="0" id="search_param">         			
                <input type="text" class="form-control" name="search_txt" id="search_txt" placeholder="Search for websites">
				<div id='search_txt_status'></div>
				<ul class="txtProduct ui-autocomplete"  role="menu" aria-labelledby="dropdownMenu"  id="DropdownProduct"></ul>
                <span class="input-group-btn sr-btn">
                    <button class="btn btn-default" type="button" onclick="search()" ><span class="glyphicon glyphicon-search icon"></span><span class="ser">Search</span></button>
                </span>
            </div>
		</div>
	</div> 
</div>



	

	

    </section>



	</section>

	<section class="pop_cat">

<div class="container">









<div class="upper">



<div class="col-md-9" >

<div class="category">

<h4><i class="fa fa-windows"></i>Popular Categories</h4>

</div>

<div id="pop-cate">

<?php 



//var_dump($getAllcategoryHome); 



foreach ($getAllcategoryHome as $value) {

// echo "<div class='section'>";

// echo "<img src=".$value['cat_image']."  alt='section-pic' style='width:100%;' />";

// echo "<a href='#'><div class='block1' style='background-color:".$value['bg_color']."' ><div class='car'><img src='".$value['icon']."' alt='car' style='width:100px;' /></div></div></a>";

// echo "<div class='text'><a href='#'>".$value['cat_name']."</a></div>";

// echo "</div>";











echo "<div class='section'>";

echo "<a href='".base_url()."category/select/".$value['cat_id']."' class='section-a'><img src=".$value['cat_image']."  alt='section-pic' style='height: 100%; width: 100%;' ><div class='block1' id='hov_class".$value['cat_id']."'>";

?>

<style>

#hov_class<?php echo $value['cat_id']; ?>

{

	background-color:<?php echo $value['bg_color']; ?>

}

</style>

<?php

echo "<div class='car'><img src='".$value['icon']."' alt='car'></div>";

echo "</div></a><div class='text'>";

echo "<a href='".base_url()."category/select/".$value['cat_id']."'>".$value['cat_name']."</a></div>";

echo "</div>";



}











?>

</div>

</div>



<div class=" col-md-3">





<div class="category">

<h4><span>Follow Us</span></h4>

</div>


<div class="foll">
<iframe src="http://www.weblistr.com/socialiframe.php" scrolling="no">

</iframe>

<!--<iframe src="<?=base_url('welcome/home_follow')?>" scrolling="no">

</iframe>-->

</div>


<!--<iframe  name="myIframe" frameborder="0" 
src="<?php //echo site_url('welcome/home_follow'); ?>" 
></iframe>-->


<?php //include 'home_follow.php' ?>

</div>



</div> 





</div>

</section>



<section class="all_cat">

<div class="container">

<div class="col-md-3">

<div class="category">

<h4><i class="fa fa-windows"></i>All Categories</h4>

</div>



<div class="item-list">

<ul>



<?php 



//var_dump($getAllCategory); 



foreach ($getAllcatForhomepage as $value) {

echo "<a href='".base_url()."category/select/".$value['cat_id']."' ><li attr='".$value['cat_id']."'>".$value['cat_name']."</li></a>";

}

echo "<a href='".base_url()."category '><li >More Category</li></a>";



?>

</ul>

</div>



</div>

<div>

<div class="col-md-6 padding">

<div class="category pop">





<input type="hidden" id="row_no" value="2">

   









<img src="images/msg-icon.png"  alt="msg-icon">Recent Reviews

</div>


<div id="all_rows">

<?php 

//$getRecentReviews = $this->write_review_model->getRecentReviews();

//var_dump($getRecentReviews);
if(sizeof($getRecentReviews)>0)
{
	
foreach ($getRecentReviews as $recentReviews) {

$getReviewCountStats = $this->write_review_model->getReviewCountStats($recentReviews['rev_id']); 
//var_dump($recentReviews);
//var_dump($getReviewCountStats);

$stat = count($getReviewCountStats);
/*
$lmsg=$this->db->query("select count(reviews.rev_id) as 'total_reviews' from reviews where rev_id ='".$recentReviews['rev_id']."' ");
	$llms=$lmsg->row_array();
*/
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
				
echo $total_reviews; //$recentReviews['total_reviews'] ?> Reviews</a></li>

<li><i><img src="images/time.png" alt="time"></i><?php echo time_elapsed_string($recentReviews['date']); ?></li>
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
					if (file_exists($pimag)){ 
						?>
							<img src='<?php echo $pimag ?>' alt='profile-pic' width="100%"/>
						<?php
					}
					else 
					{
					?>
						<img src="images/about-icon-md.png" width="100%"alt="profile-pic" />
					<?php
					}
				}
				else 
				{
				?>
					<img src="images/about-icon-md.png" width="100%"alt="profile-pic" />
				<?php
				}
			}
		}
	}
	else 
	{
	?>
		<img src="images/about-icon-md.png"width="100%" alt="profile-pic" />
	<?php
	}
  
  ?>

  </div>
<div class="name reviewAtag">

<h5> <a href="user/profile/<?php echo $recentReviews['usr_id']  ?>"/> <?php echo substr($recentReviews['usr_name'],0,25);?></a></h5>

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

  <?php //echo $recentReviews['avg_ttl'] 

  

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

			$this->contact_model->ratingNewWrite($mainstar,$dotstar);
				?>
				<span class="c-count"><?php echo $mainstar; ?>.<?php echo $dotstar; ?> </span>
				<?php

		}

	}

	else{
		//echo $arrayvalue;
		$this->contact_model->ratingNewWrite($arrayvalue,'0');
		//writeStar($arrayvalue,'0');
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

<?php //var_dump($recentReviews);?>


<div class="r-bg">
  <div class="info-para">
	<a href="Review/revdetail/<?php echo $recentReviews['prd_id']; ?>/<?php echo $recentReviews['rev_id']; ?>"><h1><?php echo $recentReviews['review_head']; ?></h1></a>
	<?php  
	
	if(strlen($recentReviews['review_body']) > 150){
		echo substr($recentReviews['review_body'],0,150).'...';
		?>
		<a href="Review/revdetail/<?php echo $recentReviews['prd_id']; ?>/<?php echo $recentReviews['rev_id']; ?>">view more</a>
		<?php
	}
	else{
		echo $recentReviews['review_body'];
	}
	?>

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

<!--was this helpful end-->
<div class="rate-right">

   <?php

if($stat!=0) {

$countvalue = $getReviewCountStats[0];
 //foreach ($getReviewCountStats as $countvalue) 
 {  ?>



<!--likeReview(revID,likeStats,favStats,likedislike 1:0) UnderProcess-->

<?php 
//echo $recentReviews['like_count'];
$likecount = $this->db->query("SELECT count(rev_id) as like_count FROM `review_stats` where rev_id = ".$recentReviews['rev_id']." and `like` = '1' ")->row_array();
$countvalue['like_count'] =  $likecount['like_count'];
	if($countvalue['like_status']==0) { ?>

		<a href="javascript:void(0);" onClick="likeReview('<?php echo $recentReviews['rev_id'] ?>','1')" id='rev_a_like_<?php echo $recentReviews['rev_id'] ?>' >
<div class="likes">
 <i class="fa fa-thumbs-up"  id='thumb_<?php echo $recentReviews['rev_id'] ?>' ></i><span id='rev_like_counter_<?php echo $recentReviews['rev_id'] ?>'><?php echo $recentReviews['like_count'] ?></span>	 </div></a> 

	  

	<?php }

	else if($this->session->userdata('usr_id') == "") { ?>

<a href="javascript:void(0);" onClick="likeReview('<?php echo $recentReviews['rev_id'] ?>','1')" id='rev_a_like_<?php echo $recentReviews['rev_id'] ?>' >
<div class="likes">
<i class="fa fa-thumbs-up"  id='thumb_<?php echo $recentReviews['rev_id'] ?>'  ></i><span id='rev_like_counter_<?php echo $recentReviews['rev_id'] ?>'><?php echo $recentReviews['like_count'] ?></span> </div></a> 
  
	<?php } else { ?>

	 <!--Dislike-->

		<a href="javascript:void(0);" onClick="likeReview('<?php echo $recentReviews['rev_id'] ?>','0')" id='rev_a_like_<?php echo $recentReviews['rev_id'] ?>'>
<div class="likes fb-like">
		<i class="fa fa-thumbs-up" style="color:#FFF;" id='thumb_<?php echo $recentReviews['rev_id'] ?>'

		></i><span id='rev_like_counter_<?php echo $recentReviews['rev_id'] ?>'><?php echo $recentReviews['like_count'] ?></span> </div> </a>  

	<?php } ?>



 

  

<?php } } else {  ?>


<a href="javascript:void(0);" onClick="likeReview('<?php echo $recentReviews['rev_id']; ?>','1')" id='rev_a_like_<?php echo $recentReviews['rev_id'] ?>'>

<div class="likes">
<i class="fa fa-thumbs-up " id='thumb_<?php echo $recentReviews['rev_id']; ?>' ></i><span id='rev_like_counter_<?php echo $recentReviews['rev_id'] ?>'><?php echo $recentReviews['like_count'] ?></span> </div></a>



<?php } 

 ?>

  


		

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
				</li>
		<?php } ?>
</ul>



	<div class="view-commt"><a href="javascript:void(0)"  onclick="commentmodalread('<?php echo $recentReviews['rev_id'] ?>')" class="view-commt">View All</a></div>

<?php

}
else{
	?>No Comments<?php
}
?>
</div>



<div class="text-box">
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

} 
  ?>
</div>

</div>


  </div>

  

  

</div>





<?php }
}
else{
	?>
		<div class="nocontent">
	No Reviews yet
	</div>
	<?php
	
}

 ?>

</div>



<!--

  <button type="submit" class="review-btn">View All Reviews</button>

-->

</div>













<div class="col-md-3 mrg">

<div class="blog">

<div class="category blog">

<img src="images/blog.png"  alt="msg-icon">Blog

</div>




<div class="blog-block">

<iframe  name="myIframe" marginwidth="0"
 marginheight="0"
 hspace="0"
 vspace="0"
 frameborder="0"
 scrolling="no"
src="http://www.weblistr.com/blogiframe.php" 
></iframe>

<!--<iframe  name="myIframe" marginwidth="0"
 marginheight="0"
 hspace="0"
 vspace="0"
 frameborder="0"
 scrolling="no"
src="
<?php 
//echo site_url('welcome/wpblog'); 
?>" 
></iframe>-->
</div>



<?php //include 'blog_view.php'; ?>



<a href='http://www.theweblisters.com/blog/' target="_blank" > <button type="button" class="blog-btn">View Blog</button></a>



</div>

</div>



</div>



</div>

</section>



<?php 
function writeStar($main,$dot)
{
	if($dot == 5)
	{
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



?>
<script type="text/javascript" src="js/jquery.fancybox.js" async="async"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
	$('.fancybox').fancybox();
});
</script>
<style type="text/css">

.fancybox-custom .fancybox-skin {

	box-shadow: 0 0 50px #222;

}
</style>
<script>

$(document).ready(function() {

$('#searchFilter').on('change', function(){

    //alert();

	$('#search_param').val($(this).val())

})//end change function

})//end ready

</script>

<script>

$(document).ready(function()

{

var baseHref = document.getElementsByTagName('base')[0].href;

	function loadmore()

	{

		var val = document.getElementById("row_no").value;

		

		$.ajax({

		type: 'post',

		url: baseHref+'User/getRecentReviewScroll',

		data: {       getresult:val },

		success: function (response) {

		  console.log(response);

		  

		var content = document.getElementById("all_rows");

		content.innerHTML = content.innerHTML+response;



		// We increase the value by 10 because we limit the results by 10

		document.getElementById("row_no").value = Number(val)+2;

		}

		});

	} 



	$(window).scroll(function(){

		if ($(window).scrollTop() == $(document).height() - $(window).height()){

			loadmore();

		}

	}); 

});

</script>
<script>

function commentToggle($id)

{

	//alert($id);

	//$('#cmtDiv_'+$id).toggle();

	$('#form_div_'+$id).toggle();

}



function reviewCMTsubmit($rev_id)

{

	//	comment_reviews insert into 

	var text = $('#textarea_'+$rev_id).val();

	if(text!=""){

	var baseHref = document.getElementsByTagName('base')[0].href;

	$.ajax({

		url: baseHref + "review/InsertCommentOnReview",

		type: "POST",

		data:  { revID : $rev_id, text:text },

		success: function(data)
		{

			if(data == 0)
			{
				$("#loginModal .modalFrom").html('<center><span  class="infodanger" >Please logged in first</span></center>');
				$("#loginModal").modal('show');
			}
			else{
				var counterDiv = '#comment_counter_'+$rev_id;
				var counterDivinput = '#comment_counter_input_'+$rev_id;
				var htmlString = $(counterDivinput).val();
				$(counterDiv).html(parseInt(htmlString) + 1);
				$(counterDivinput).val(parseInt(htmlString) + 1);
				
				$('#form_div_inner_'+$rev_id).html(data);
				$('#textarea_'+$rev_id).val('');
			}
			//setTimeout(function(){ $("#status"+$rev_id).html('');  }, 3000);

		},

		  error: function() 

		{

			

		}             

	});

	}

	else{

		alert("comment can't be blank");

	}

}





</script>