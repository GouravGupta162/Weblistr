   
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
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
	

	

<section class="user_profile">

<div class="container">

<div class="col-md-3 col-sm-5 b_rt">

<?php include 'user_profile_left_view.php'; ?>

</div>

<div class="col-md-6 col-sm-7 bdr">



<div>

<div class='main'>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs book-tab" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">My Weblist</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
	
	<div class="user_book">




<?php 

//var_dump($getBookmarkedProduct);


if(sizeof($getBookmarkedProduct)>0)
{
foreach($getBookmarkedProduct as $bookmarked)

{

	?>

<div class="book_body book-col" id="bookmark_remove_<?php echo $bookmarked['rev_id']; ?>" >

<ul>

<li class="b-logo"><img src="<?php echo $bookmarked['prd_image']; ?>" alt="profile-pic"></li>

<li class="b_lst"><a href="Review/detail/<?php echo $bookmarked['prd_id']; ?>" target='_blank' > <?php echo $bookmarked['prd_name']; ?></a>  




<span class="float_rt mg pull-left">

<?php 

$getRatingSummary = $this->write_review_model->getRatingSummary($bookmarked['prd_id']);

//getRatingSummary//
//var_dump($getRatingSummary);
if((sizeof($getRatingSummary) > 0) && ($getRatingSummary != null)){
	$sum = 0;
	foreach($getRatingSummary as $getRatingSummaryvalue)
	{
	   $sum += $getRatingSummaryvalue['service_rating'];
	}
	$checker = $sum ;/// 5;
//echo $checker;
	if(strpos($sum, '.') !== FALSE)
	{
		$splited =  explode(".",$sum);
		$splitersize = sizeof($splited);
		if($splitersize > 1)
		{
			$mainstar = $splited[0];
			$dotstar = $splited[1];
			$this->contact_model->ratingNewWrite($mainstar,$dotstar);
			
			?>
			<div class='effect-julia'><span><?php echo  $mainstar.'.'.$dotstar;  ?></span></div>
			<?php
		}
	}
	else{
		$this->contact_model->ratingNewWrite($sum,'0');
		//writeStar($sum,'0');
		?>
			<div class='effect-julia'><span><?php echo $checker ?>.0</span></div>
		<?php
	}
}
else{
		$this->contact_model->ratingNewWrite('0','0');
		//writeStar('0','0');
		?>
			<div class='effect-julia'><span>0.0</span></div>
		<?php
	}
?>

</span>

<!--<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>-->

 <span><?php echo substr($bookmarked['prd_info'],0,100); ?></span></li>
<?php 
if(($this->session->userdata('usr_id') != '')&&($profilechanger == true))
{
?>
<li class="book_rt">
<div class="b_rate deletebookmark" style='cursor:pointer;' id='<?php echo $bookmarked['rev_id']; ?>'  ><i aria-hidden="true" class="fa fa-trash"></i></div></li>
<?php 
}
?>


</ul>

</div>

	<?php

	

}
}
else{
	
	?>
	<div class="nocontent">
	No Bookmarks yet
	</div>
	<?php
	
}


?>



<script>

$(".deletebookmark").click(function(){

	// Holds the product ID of the clicked element

	var productId = $(this).attr('id');

	 if (confirm('Are you sure?')) {

		//alert(productId); true case

		 unbookmark(productId);

    }

});



function unbookmark(revId)

{

	var baseHref = document.getElementsByTagName('base')[0].href;

	$.ajax({

		url: baseHref + "Review/unbookmark",

		type: "POST",

		data:  { revId:revId },//new FormData(this),

		success: function(data)

		{

			//console.log(data);

			if(data == '0')

			{

				location.reload();

			}

			

		},

		  error: function() 

		{

			

		}             

	});

}

</script>





</div>

	
	</div>
    <div role="tabpanel" class="tab-pane" id="profile">
	




<!---------------->

<div class="user_book">
	<?php 

//var_dump($getUserReviews);

if(sizeof($getUserReviews)>0)
{
foreach($getUserReviews as $bookmarked)

{

	?>

	<div class="book_body book-col" id='rev_id_<?php echo $bookmarked['rev_id']; ?>'>

			<ul>

				<li class="b-logo">
					<a href="Review/detail/<?php echo $bookmarked['prd_id']; ?>"  > 

							<img src="<?php echo $bookmarked['prd_image']; ?>" alt="profile-pic"></a>
							</li>

							<li class="b_lst b-list-two">

								<a href="Review/detail/<?php echo $bookmarked['prd_id']; ?>"  > <?php echo $bookmarked['prd_name']; ?>
									</a>  

									  



										<span class="float_rt mg pull-left">

											<?php 

$getRatingSummary = $this->user_model->getreviewsStar($bookmarked['rev_id']);

//getRatingSummary//
//var_dump($getRatingSummary);
if((sizeof($getRatingSummary) > 0) && ($getRatingSummary != null)){
	$sum = 0;
	
   $sum = $getRatingSummary['rating_stars'];
	
	$checker = $sum ;/// 5;
//echo $checker;
	if(strpos($sum, '.') !== FALSE)
	{
		$splited =  explode(".",$sum);
		$splitersize = sizeof($splited);
		if($splitersize > 1)
		{
			$mainstar = $splited[0];
			$dotstar = $splited[1];
			
			$this->contact_model->ratingNewWrite($mainstar,$dotstar);
			?>
											<div class='effect-julia'>
												<span>
													<?php echo  $mainstar.'.'.$dotstar;  ?>
												</span>
											</div>
											<?php
		}
	}
	else{
		$this->contact_model->ratingNewWrite($sum,'0');
		
		?>
											<div class='effect-julia'>
												<span>
													<?php echo $checker ?>.0</span>
											</div>
											<?php
	}
}
else{
	$this->contact_model->ratingNewWrite('0','0');
		?>
											<div class='effect-julia'>
												<span>0.0</span>
											</div>
											<?php
	}
	
?>



										</span>

										<!--<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>-->

									</li>
                                    
                                    <li class="category-title"><span>Catagory: 
                                    <?php 
									//var_dump($bookmarked);
									?>
									
									<?php 
									$arrayData = explode(",",$bookmarked['cat_id']);
									foreach($arrayData as $ctid)
									{
										$catnames = $this->category_model->catname($ctid);
										if(sizeof($catnames)>0)
										{
											foreach($catnames as $cname)
											{
												?>
												 <a href="category/select/<?php echo $cname['cat_id']; ?>"  >
													<?php echo $cname['cat_name']; ?>
														</a>
												<?php
											}
										}
									}
									
									?>
										
                                    
                                    
                                    </span></li>
                                    
                                    <li><div class="bb">
                                    <?php
									if(($this->session->userdata('usr_id') != '')&&($profilechanger == true))
												{
												$approvestatus = $bookmarked['status'];
												if($approvestatus == "0")
												{
													?>
													<span class="revpendingstts"><b>Pending</b></span>
													<?php
												}
												else if($approvestatus == "1"){
													?>
													<span class="revapprovestts"><b>Approved</b></span>
													<?php
												}
												else if($approvestatus == "2"){
													?>
													<span class="revpendingstts"><b>Rejected</b></span>
													<?php
												}
												}
    
												if(($this->session->userdata('usr_id') != '')&&($profilechanger == true))
												{
													?>
													<span><a class="b_rate" href="review/edit/<?php echo $bookmarked['rev_id']; ?>" ><i aria-hidden="true" class="fa fa-pencil"></i></a></span>
													<span><a class="b_rate" href="javascript:deleteReview('<?php echo $bookmarked['rev_id']; ?>')" ><i aria-hidden="true" class="fa fa-trash-o"></i></a></span>
													<?php 
												}
												?>
                                    </div></li>
                                    
                                    
                                    

									<li class="b-des">
											<div class='review_head'>
												<?php echo $bookmarked['review_head']; ?>

												

											</div>

												<div class='review_body'>
													<?php echo $bookmarked['review_body']; ?>
													
													
												
												</div>
											
												
<?php
$revImages = $this->write_review_model->getReviewImages($bookmarked['rev_id']);
//var_dump($revImages);
if(sizeof($revImages)>0)
{
	?>
	<div class="r_thumbnails">
		<ul>
			<?php 
			//var_dump($revImages);
			foreach($revImages as $revimage){
			?>
				<li>

				<a class="fancybox" href="<?php echo $revimage['rev_image']; ?>" data-fancybox-group="gallery<?php echo $bookmarked['rev_id']; ?>" title="<?php echo $bookmarked['review_head']; ?>">
				<img src="<?php echo $revimage['thumbnail']; ?> " style="position: initial;" />
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
												
											</li>

											

	
											
										</ul>

									</div>

									<?php

	

}
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

<!-------------->




	
	
	
	
	
	
	</div>
    
  </div>

</div> 
</div> 


</div>

<div class="col-md-3 col-sm-12">
<div class="user_con user_book">
<h3>Follow Us On</h3>
<?php include 'user_profile_right.php'; ?>
</div>
<div class="user_rev">
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
<script>
function deleteReview(revid)
{
	$.ajax({
		type: "POST",
		url: baseHref+"review/deletereview",
		data: { revid: revid },
		success: function (data) {
			if(data == 0)
			{
				$("#loginModal .modalFrom").html('<center><span  class="infodanger" >Please logged in first</span></center>');
				$("#loginModal").modal('show');
			}
			else if (data == 1)
			{
				$("#rev_id_"+revid).remove();
				$("#statusModal #eventModelHtml").html('<span  class="infosuccess" >Review has been deleted.</span>');
			}
			setTimeout(function(){ $("#statusModal").modal('hide'); $("#statusModal #eventModelHtml").html('');   }, 3000);
		}
	})
}
</script>

