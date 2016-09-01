<?php 

function overAllRating($getRatingSummaryresult)
{
	$contact_model =& get_instance(); 
$contact_model->load->model("contact_model");
	if((sizeof($getRatingSummaryresult) > 0) && ($getRatingSummaryresult != null)){
			
		$sum = 0;
		foreach($getRatingSummaryresult as $getRatingSummaryvalue)
		{
		   $sum += $getRatingSummaryvalue['service_rating'];
		}
		$checker = $sum ;/// 5;
		if(strpos($sum, '.') !== FALSE)
		{
			$splited =  explode(".",$sum);
			$splitersize = sizeof($splited);
			if($splitersize > 1)
			{
				$mainstar = $splited[0];
				$dotstar = $splited[1];
				// switch ($dotstar) {
					// case "1": writeStar($mainstar,'0');	break;
					// case "2": writeStar($mainstar,'0'); break; 
					// case "3": writeStar($mainstar,'0'); break; 
					// case "4": writeStar($mainstar,'0');	break;
					// case "5": writeStar($mainstar,'5'); break; 
					// case "6": writeStar($mainstar,'5'); break; 
					// case "7": writeStar($mainstar,'5');	break;
					// case "8": writeStar($mainstar,'8'); break; 
					// case "9": writeStar($mainstar,'9'); break; 
				// }
				$contact_model->contact_model->ratingNewWrite($mainstar,$dotstar);
				?>
				<div class='effect-julia'><span><?php echo  $mainstar.'.'.$dotstar;  ?></span></div>
			<?php
			}
		}
		else{
			$contact_model->contact_model->ratingNewWrite($checker,'0');
			?>
				<div class='effect-julia'><span><?php echo  $checker;  ?>.0</span></div>
			<?php
			//echo "N/A";
		}
	}
	else{
		$contact_model->contact_model->ratingNewWrite('0','0');
			//echo "N/A";
				?>
				<div class='effect-julia'><span>0.0</span></div>
			<?php
		}
}

?>


<section class="all_cat">
<div class="container">


<div class="col-md-8">

<div class="category pop">
<img src="images/msg-icon.png"  alt="msg-icon">Featured
</div>

<?php //var_dump($getFeaturedProduct); 

foreach($getFeaturedProduct as $feature)
{
	//var_dump($this->featured_model->getFeaturedLike());
	//$re = $this->featured_model->getFeaturedLike($feature['prd_id']);
	//var_dump($re);
?>

<div class="f_bg">
<div class="col-md-4 col-sm-4">

<a href="Review/detail/<?php echo $feature['prd_id']; ?>">
<div class="cat-prd-logo">

<?php
	$filename = $feature["prd_image"];

	if(strpos($filename, "http") !== false ) 
	{?>
		 <img src="<?php echo $feature['prd_image']; ?>" >
		 <?php
	}else{
		
		if (file_exists($filename)) {
			?><img src="<?php echo $feature['prd_image']; ?>" alt="food">
			<?php 
		} else {
			?>
			<img src="images/product/dummy_prd12.jpg">
			<?php
		}
	}
	?>

  </div>
</a>
</div>

<div class="col-md-8 col-sm-8 sp">

<div class="f_heading">
<a href="Review/detail/<?php echo $feature['prd_id']; ?>"><h2><?php echo substr($feature['prd_name'],0,25); ?></h2></a>
<span class="float_rt">

<?php echo overAllRating($this->write_review_model->getRatingSummary($feature['prd_id'])); ?>

</span>
<h4>Description</h4></div>
<div class="f_map">
<div class="add"><?php echo substr($feature['prd_info'],0,150); ?> <a href="Review/detail/<?php echo $feature['prd_id']; ?> ">view more</a></div>
<div class="r_mail"><ul><li><i class="fa fa-envelope"></i><a href="<?php echo $feature['prd_link']; ?>" target='_blank' ><?php echo $feature['prd_link']; ?></a></li>
</ul></div>
</div>
<div class="f_add sp">
<div class="write_rev">
<ul><li><a href="Review/detail/<?php echo $feature['prd_id'] ?>"><button type="submit" class="rev_btn" >
<?php 
echo $this->write_review_model->getCountofReview($feature['prd_id']);
?>

 Reviews</button></a></li>
<li><a href="Review/Write/<?php echo $feature['prd_id'] ?>"><button type="submit" class="write_btn_rev" >Write a Review</button></a></li>
</ul>
</div>
</div>
</div>
</div>



<?php
}
?>





</div>

<div class="col-md-4 padding">
<div class="r_rel_sch">
<div class="tag_head">
<h4>Recent Reviews</h4></div>


<?php 
//var_dump($getRecentReviewforfeatured);
if(sizeof($getRecentReviewforfeatured)>0){
foreach($getRecentReviewforfeatured as $recentReview)
{
	?>
	<div class="rel_body">
	<a href="Review/detail/<?php echo $recentReview['prd_id'] ?>">
	<div class="rel_pic">

	<?php
	$filename = $recentReview["prd_image"];

	if(strpos($filename, "http") !== false ) 
	{?>
		 <img src="<?php echo $recentReview['prd_image']; ?>" >
		 <?php
	}else{
		
		if (file_exists($filename)) {
			?><img src="<?php echo $recentReview['prd_image']; ?>" alt="food">
			<?php 
		} else {
			?>
			<img src="images/product/dummy_prd12.jpg">
			<?php
		}
	}
	?>
	

	</div></a>
	<div class="r_head top">
	<h6 class='categoryMain'><a href="Review/detail/<?php echo $recentReview['prd_id'] ?>"><?php echo substr($recentReview['prd_name'],0,25); ?></a></h6>
	<div class="new-r">
	
	<?php //echo $recentReview["rating_stars"];
	$contact_model =& get_instance(); 
$contact_model->load->model("contact_model");
$arrayData = explode(",",$recentReview['avg_ttl'] );
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
				// case "1": writeStar($mainstar,'0');	break;
				// case "2": writeStar($mainstar,'0'); break; 
				// case "3": writeStar($mainstar,'0'); break; 
				// case "4": writeStar($mainstar,'0');	break;
				// case "5": writeStar($mainstar,'5'); break; 
				// case "6": writeStar($mainstar,'5'); break; 
				// case "7": writeStar($mainstar,'5');	break;
				// case "8": writeStar($mainstar,'8'); break; 
				// case "9": writeStar($mainstar,'9'); break; 
			// }
			$contact_model->contact_model->ratingNewWrite($mainstar,$dotstar);
		}
	}
	else{
		$contact_model->contact_model->ratingNewWrite($arrayvalue,'0');
		//echo $arrayvalue;
		//writeStar($arrayvalue,'0');
	}
}
else{
	$contact_model->contact_model->ratingNewWrite('0','0');
	//echo "&nbsp;";
}
?>
	
	</div>
	<div class="r_description">
	<p><?php echo substr($recentReview["review_head"],0,100); ?></p>
	<div class="red_btn_select"><a href="Review/detail/<?php echo $recentReview['prd_id'] ?>">Read more Review</a></div>
	</div>
	</div>
	</div>
	<?php
}
}
else{
	?>
	No Reviews Yet
	<?php 
}
 ?>


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

?>

