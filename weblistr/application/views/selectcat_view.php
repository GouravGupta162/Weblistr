<script>


function favBookmark(catId,prdId,stts)

{

	
	var baseHref = document.getElementsByTagName('base')[0].href;

	$.ajax({

		url: baseHref + "review/favBookmark",

		type: "POST",

		data:  { catId : catId, prdId : prdId, stts:stts },

		success: function(data)
		{
			console.log(data);
			if(data == 0)
			{
				$("#loginModal .modalFrom").html('<center><span  class="infodanger" >Please logged in first</span></center>');
				$("#loginModal").modal('show');
				//$('#status').html('<span style=color:red; font-size:20px; >Please logged in first</span>');

			}
			else if(data == "1"){
				
				$("#bookmark_img_"+prdId).attr('src','images/bookmarkpending.png' );
				$("#bookmark_a_"+prdId).attr('onclick','favBookmark("'+catId+'","'+prdId+'","1")' );
				//$("#statusModal #eventModelHtml").html('<center><span class="infosuccess" >Bookmark removed</span></center>');
				//$("#statusModal").modal('show');
			}
			else if(data == "2"){
				$("#bookmark_img_"+prdId).attr('src','images/bookmarkdone.png' );
				$("#bookmark_a_"+prdId).attr('onclick','favBookmark("'+catId+'","'+prdId+'","0")' );
				
				//$("#statusModal #eventModelHtml").html('<center><span class="infosuccess" >Bookmarked successfully</span></center>');
				//$("#statusModal").modal('show');
			}
			
			

		
			setTimeout(function(){ $("#statusModal").modal('hide'); $("#statusModal #eventModelHtml").html('');   }, 10000);
			setTimeout(function(){ $("#status").html('');  }, 3000);

		},

		  error: function() 

		{

			

		}             

	});

	

}

</script>
<section class="all_cat">
<div class="container">

<div class="col-md-8 pd">

<div class="category pop">


<img src="images/msg-icon.png"  alt="msg-icon">
<?php 
foreach ($category as $value) {
	echo substr($value->cat_name,0,25);
}
?>
</div>
<!--Start-->

<?php 
if(sizeof($product)>0){
foreach ($product as $value) {


//$value->prd_name
	//var_dump($value);
echo "<div class='f_bg'><div class='col-md-4 col-sm-4'><div class='cat-prd-logo'>";


?>



<?php 
if($this->session->userdata('usr_id') != '')//user logged in
{
	$bookmarkstatus = $this->category_model->checkprd_bookmarked($value->prd_id,$this->session->userdata('usr_id'));
	if($bookmarkstatus == 0)
	{
		?>
		<a href="javascript:void(0)" onclick="favBookmark('<?php echo $value->cat_id; ?>','<?php echo $value->prd_id; ?>','1')" id='bookmark_a_<?php echo $value->prd_id; ?>' >
<div class="add-bookmark" style='background-color:#F1C40F'>
<img src="images/bookmarkpending.png" style="width: 21px;" id='bookmark_img_<?php echo $value->prd_id; ?>' >		
</div>
</a>
		<?php
	}
	else{
		?>
		<a href="javascript:void(0)" onclick="favBookmark('<?php echo $value->cat_id; ?>','<?php echo $value->prd_id; ?>','0')" id='bookmark_a_<?php echo $value->prd_id; ?>' >
<div class="add-bookmark"style='background-color:#F1C40F'>
<img src="images/bookmarkdone.png" style="width: 21px;" id='bookmark_img_<?php echo $value->prd_id; ?>' >				
</div>
</a>
		<?php
	}
	
}
else 
{
	?>
	
	<a href="javascript:void(0)" onclick="favBookmark('<?php echo $value->cat_id; ?>','<?php echo $value->prd_id; ?>','1')" id='bookmark_a_<?php echo $value->prd_id; ?>' >
<div class="add-bookmark" style='background-color:#F1C40F'>
<img src="images/bookmarkpending.png" style="width: 21px;" id='bookmark_img_<?php echo $value->prd_id; ?>' >				
</div>
</a>
	<?php
}
?>


<!--
<div>


<?php 
if($this->session->userdata('usr_id') != '')//user logged in
{
	$bookmarkstatus = $this->category_model->checkprd_bookmarked($value->prd_id,$this->session->userdata('usr_id'));
	//var_dump($bookmarkstatus);
	if($bookmarkstatus == 0)
	{
		?>
	<a href="javascript:void(0)" onClick="favBookmark('<?php echo $value->cat_id ?>','<?php echo $value->prd_id ?>','1')" ><i aria-hidden="true" class="fa fa-bookmark"></i></a>

	<?php } else { ?>

	<a href="javascript:void(0)" onClick="favBookmark('<?php echo $value->cat_id ?>','<?php echo $value->prd_id ?>','0')" ><i aria-hidden="true" class="fa fa-bookmark"></i></a>

	<?php 
	} 
}
else 
{
	?>
	<a href="javascript:void(0)" onClick="favBookmark('<?php echo $value->cat_id ?>','<?php echo $value->prd_id ?>','1')" ><i aria-hidden="true" class="fa fa-bookmark"></i></a>
	<?php
}
?>
</div>-->


<?php
if(strpos($value->prd_image, "http") !== false ) 
{?>
	 <img src="<?php echo $value->prd_image; ?>" >
	 <?php
}
else{
if(file_exists($value->prd_image)) {
    echo "<img src='$value->prd_image' alt='food'>";
} else {
    echo "<img src='images/product/dummy_prd12.jpg' alt='food'>";
}
}


echo "</div><div class='rate-right full setting'>";
// echo "<div class='likes'><a href='#'><i class='fa fa-thumbs-up'></i></a>";
// echo "10";
// echo "</div><div class='whatsapp'><a href='#'><i class='fa fa-share-alt'></i></a>";
// echo "5";
// echo "</div><div class='str'><a href='#'><i class='fa fa-star'></i></a>";
// echo "5";
// echo "</div>";
echo "</div></div>";

echo "<div class='col-md-8 col-sm-8 sp'>";
echo "<div class='f_heading' >";
echo "<a href=".base_url()."Review/detail/$value->prd_id ><h2>".substr($value->prd_name,0,25)."</h2></a>";

echo "<span class='float_rt'>";
echo overAllRating($this->write_review_model->getRatingSummary($value->prd_id));
echo "</span>";
//echo "<span class='float_rt'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></span>";


echo "<h4>Description</h4></div>";
echo "<div class='f_map sel'>";
echo "<div class='add'>"; 

if(strlen($value->prd_info) > 150){
	echo substr($value->prd_info,0,150).'...';
	?>
	<a href="Review/detail/<?php echo $value->prd_id; ?> ">view more</a>
	<?php
}
else{
	echo $value->prd_info;
	?>
	<a href="Review/detail/<?php echo $value->prd_id; ?> ">view more</a>
	<?php
}
//echo "<div class='add'>$value->prd_info ";
//echo " <a href=".base_url()."Review/detail/$value->prd_id >read more</a>";
echo "</div>";
echo "<div class='r_mail rtop'><ul><li><a href=http://$value->prd_link target='_blank' ><i class='fa fa-globe'></i>$value->prd_link</a></li>";
//echo "<li><i class='fa fa-map-marker'></i><a href='#'>$value->prd_address</a></li>";
echo "</ul></div>";
echo "</div>";


echo "<div class='f_add sp'>";
echo "<div class='write_rev mtop'>";
echo "<ul><li><a href=".base_url()."Review/detail/$value->prd_id><button type='submit' class='rev_btn' >";
//Total Review Count
echo $this->write_review_model->getCountofReviewNew($value->prd_id);
//Total Review Count
echo " Reviews</button></a></li>";
echo "<li><a href=".base_url()."Review/Write/$value->prd_id ><button type='submit' class='write_btn_rev' >Write a Review</button></a></li>";
echo "</ul></div></div></div></div>";

}
}
else
{
	?>
	<div class="nocontent" style="height: 200px;">
	oops! no website listed in this category
	</div>
	<?php 
	
}
?>
<!--End-->



</div>

<div class="col-md-4 padding">

<div class="r_rel_sch">
<div class="tag_head">
<h4>Recent Reviews</h4></div>

<?php 

if(sizeof($getRecentReviewbyCategory)>0){
foreach($getRecentReviewbyCategory as $recentReview)
{
	//var_dump($recentReview);
	?>
	<div class="rel_body">
	<div class="rel_pic">
	
	<?php 
	
	if(strpos($recentReview['prd_image'], "http") !== false ) 
	{
		?>
			<img src="<?php echo $recentReview["prd_image"]; ?>">
		<?php
	}
	else{
		if(file_exists($recentReview["prd_image"])) {
			?>
				<img src="<?php echo $recentReview["prd_image"]; ?>">
			<?php
		} else {
			?>
				<img src='images/product/dummy_prd12.jpg'>
			<?php
		}
	}
 
	?>
	
	</div>
	<div class="r_head top">
	<h6 class='categoryMain'><a href="Review/detail/<?php echo $recentReview['prd_id'] ?>"><?php echo substr($recentReview['prd_name'],0,25); ?></a></h6>
	<div class="new-r">
	
	<?php //echo $recentReview["rating_stars"];
$arrayData = explode(",",$recentReview['rating_stars'] );
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
			
		}
	}
	else{
		$this->contact_model->ratingNewWrite($arrayvalue,'0');
	}
}
else{
	$this->contact_model->ratingNewWrite('0','0');
	//echo "&nbsp;";
}
?>
	
	
	
	
	</div>
	<div class="r_description">
	
	<p><?php echo substr($recentReview["review_head"],0,100); ?></p>
	<div class="red_btn_select"><a href="Review/revdetail/<?php echo $recentReview['prd_id'] ?>/<?php echo $recentReview['rev_id'] ?>">Read more Review</a></div>
	</div>
	</div>
	</div>
	<?php
}
}
else{
	
	?>
	<div class='nocontent'> 
	No review has been added yet!</div>
	<?php 
	
}
 ?>
 
	

</div>



</div>

</div>

</div>
</section>



<?php 
//var_dump($getRatingSummary);

function overAllRating($getRatingSummaryresult)
{
$contact_model =& get_instance(); 
$contact_model->load->model("contact_model");
//echo $getRatingSummaryresult[0]['service_rating'];
$checker = $getRatingSummaryresult[0]['service_rating'];

if(strpos($checker , '.') !== FALSE)
{

	$splited =  explode(".",$checker );
	$splitersize = sizeof($splited);
	if($splitersize > 1)
	{
		$mainstar = $splited[0];
		$dotstar = $splited[1];
		
		//Notification Model Loading and calling it Start
		// $contact_model =& get_instance(); 
		// $contact_model->load->model("contact_model");
		// $this->contact_model->ratingNewWrite($mainstar,$dotstar);
		//Notification Model Loading and calling it End
		
		$contact_model->contact_model->ratingNewWrite($mainstar,$dotstar);
		
		// switch ($dotstar) {
			// case "0": writeStar($mainstar,'0');	break;
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
		?>
			<div class='effect-julia'><span><?php echo $mainstar.'.'.$dotstar;  ?></span></div>
		<?php
	}
	else
	{
	$contact_model->contact_model->ratingNewWrite($checker,'0');
		//writeStar($checker,'0');
		?>
			<div class='effect-julia'><span><?php echo $checker ;?>.0</span></div>
		<?php
	}
}
else
{
	$contact_model->contact_model->ratingNewWrite('0','0');
		//writeStar('0','0');
	?>
		<div class='effect-julia'><span>0.0</span></div>
	<?php
}

}

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