<section class="all_cat">
<div class="container">

<div class="col-md-8">

<div class="category pop">


<img src="images/msg-icon.png" alt="msg-icon">
Results for - <?php  echo $searchfor; ?> </div>




<?php  

if($result_status == 'result'){

foreach($searchresult as $resultValue){ 
//var_dump($resultValue);
?>

<!---
<div class="cat-prd-logo">
<img src="images/product/5398faballey-coupon-logo.jpg">
<div class="add-bookmark">
<a href="javascript:void(0)" onclick="favBookmark('2','4','0')"><i aria-hidden="true" class="fa fa-bookmark"></i></a>
</div>
</div>
--->
<div class="f_bg">
<div class="col-md-4 col-sm-4">


<div class="cat-prd-logo">
<img src="<?php echo $resultValue->prd_image; ?>">


<!--<a href="javascript:void(0)" onclick="favBookmark('1','1','1')" >
<div class="add-bookmark">
<img src="images/bookmarkpending.png" style="width: 21px;">		
</div>
</a>-->

<?php 
if($this->session->userdata('usr_id') != '')//user logged in
{
	$bookmarkstatus = $this->category_model->checkprd_bookmarked($resultValue->prd_id,$this->session->userdata('usr_id'));
	if($bookmarkstatus == 0)
	{
		?>
		<a href="javascript:void(0)" onclick="favBookmark('<?php echo $resultValue->cat_id; ?>','<?php echo $resultValue->prd_id; ?>','1')" id='bookmark_a_<?php echo $resultValue->prd_id; ?>' >
<div class="add-bookmark" style='background-color:#F1C40F'>
<img src="images/bookmarkpending.png" style="width: 21px;" id='bookmark_img_<?php echo $resultValue->prd_id; ?>' >		
</div>
</a>
		<?php
	}
	else{
		?>
		<a href="javascript:void(0)" onclick="favBookmark('<?php echo $resultValue->cat_id; ?>','<?php echo $resultValue->prd_id; ?>','0')" id='bookmark_a_<?php echo $resultValue->prd_id; ?>' >
<div class="add-bookmark"style='background-color:#F1C40F'>
<img src="images/bookmarkdone.png" style="width: 21px;" id='bookmark_img_<?php echo $resultValue->prd_id; ?>' >				
</div>
</a>
		<?php
	}
	
}
else 
{
	?>
	
	<a href="javascript:void(0)" onclick="favBookmark('<?php echo $resultValue->cat_id; ?>','<?php echo $resultValue->prd_id; ?>','1')" id='bookmark_a_<?php echo $resultValue->prd_id; ?>' >
<div class="add-bookmark" style='background-color:#F1C40F'>
<img src="images/bookmarkpending.png" style="width: 21px;" id='bookmark_img_<?php echo $resultValue->prd_id; ?>' >				
</div>
</a>
	<?php
}
?>

<!--
<div class="add-bookmark">


<?php 
if($this->session->userdata('usr_id') != '')//user logged in
{
	$bookmarkstatus = $this->category_model->checkprd_bookmarked($resultValue->prd_id,$this->session->userdata('usr_id'));
	if($bookmarkstatus == 0)
	{
		?>
		<a href="javascript:void(0)" onclick="favBookmark('<?php echo $resultValue->cat_id; ?>','<?php echo $resultValue->prd_id; ?>','1')"><i aria-hidden="true" class="fa fa-bookmark"></i></a>
		<?php
	}
	else{
		?>
		<a href="javascript:void(0)" onclick="favBookmark('<?php echo $resultValue->cat_id; ?>','<?php echo $resultValue->prd_id; ?>','0')"><i aria-hidden="true" class="fa fa-bookmark"></i></a>
		<?php
	}
	?>

	
<?php 
}
else 
{
	?>
	<a href="javascript:void(0)" onclick="favBookmark('<?php echo $resultValue->cat_id; ?>','<?php echo $resultValue->prd_id; ?>','1')"><i aria-hidden="true" class="fa fa-bookmark"></i></a>
	<?php
}
?>

</div>
-->
</div>

<!--- old code
<div class="food_img">
<div>

<?php 
if($this->session->userdata('usr_id') != '')//user logged in
{
	$bookmarkstatus = $this->category_model->checkprd_bookmarked($resultValue->prd_id,$this->session->userdata('usr_id'));
	if($bookmarkstatus == 0)
	{
		?>
		<a href="javascript:void(0)" onclick="favBookmark('<?php echo $resultValue->cat_id; ?>','<?php echo $resultValue->prd_id; ?>','1')"><i aria-hidden="true" class="fa fa-bookmark"></i></a>
		<?php
	}
	else{
		?>
		<a href="javascript:void(0)" onclick="favBookmark('<?php echo $resultValue->cat_id; ?>','<?php echo $resultValue->prd_id; ?>','0')"><i aria-hidden="true" class="fa fa-bookmark"></i></a>
		<?php
	}
}
else 
{
	?>
	<a href="javascript:void(0)" onclick="favBookmark('<?php echo $resultValue->cat_id; ?>','<?php echo $resultValue->prd_id; ?>','1')"><i aria-hidden="true" class="fa fa-bookmark"></i></a>
	<?php
}
?>
</div>
<img src="<?php echo $resultValue->prd_image; ?>" alt="food">
</div> -->


<div class="rate-right full setting">
</div>
</div>
<div class="col-md-8 col-sm-8 sp">
<div class="f_heading">
<a href="Review/detail/<?php echo $resultValue->prd_id ?>"><h2><?php echo substr($resultValue->prd_name,0,25); ?></h2></a>
<span class="float_rt">	
<?php 
echo overAllRating($this->write_review_model->getRatingSummary($resultValue->prd_id));
?>
</span><h4>Description</h4></div>
<div class="f_map sel">
<div class="add">
	<?php 
		if(strlen($resultValue->prd_info) > 215){
			echo substr($resultValue->prd_info,0,213).'...';
			?>
			<a href="Review/detail/<?php echo $resultValue->prd_id; ?> ">view more</a>
			<?php
		}
		else{
			echo $resultValue->prd_info;
			?>
			<a href="Review/detail/<?php echo $resultValue->prd_id; ?> ">view more</a>
			<?php
		}
		//echo substr($resultValue->prd_info,0,215)
	?>
</div>
<div class="r_mail rtop">
<ul><li><i class="fa fa-envelope"></i><a href="<?php echo $resultValue->prd_link; ?>" target="_blank"><?php echo $resultValue->prd_link; ?></a></li></ul>
</div>
</div>
<div class="f_add sp">
<div class="write_rev mtop">
<ul>
<li><a href="Review/detail/<?php echo $resultValue->prd_id ?>"><button type="submit" class="rev_btn">

<?php echo $this->write_review_model->getCountofReview($resultValue->prd_id); ?>

 Reviews</button></a></li>
<li><a href="Review/Write/<?php echo $resultValue->prd_id ?>"><button type="submit" class="write_btn_rev">Write a Review</button></a></li>
</ul>
</div>
</div>
</div>
</div>


<?php } 
} else {
	?>
	<div class="ops_dscrptn">oops! No Result for "<strong><?php  echo $searchfor; ?></strong>"</div>
	<?php 
	}  ?>
<!--End-->





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
			<div class='effect-julia'><span><?php echo  $mainstar.'.'.$dotstar;  ?></span></div>
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
{	$contact_model->contact_model->ratingNewWrite('0','0');
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