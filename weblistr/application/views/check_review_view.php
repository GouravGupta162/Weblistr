  


<link href="css/raterater.css" rel="stylesheet" type="text/css" />

<script src="js/raterater.jquery.js" ></script>



<script type="text/javascript" src="js/jquery.fancybox.js"></script>

<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" media="screen" />

<script type="text/javascript">

$(document).ready(function() {

	//$.noConflict();

	$('.fancybox').fancybox();

});

</script>

<style type="text/css">



.fancybox-custom .fancybox-skin {



	box-shadow: 0 0 50px #222;



}

</style>



<script>







function write_review()

{

	resetListForm();



	var baseHref = document.getElementsByTagName('base')[0].href;



	var title = $('#webTitle').val(),



	webBody = 	$('#webBody').val(),



	rate1 = 	$('#rate1').val();



	// rate2 = 	$('#rate2').val(),



	// rate3 = 	$('#rate3').val(),



	// rate4 = 	$('#rate4').val(),



	// rate5 = 	$('#rate5').val();



	



	var errormsg = false;



	



	if(title == "")



	{



		$('#webTitlemsg').html('please enter review title');



		$('#webTitle').focus();



		errormsg  = true;



		return false;



	}



	if(webBody == "")



	{



		$('#webBodymsg').html('please enter review message');



		$('#webBody').focus();



		errormsg  = true;



		return false;



	}



	if(errormsg == false)



	{



		return true;



	}



}



function resetListForm()



{



	$('#webTitlemsg').html('');



	$('#webBodymsg').html('');



}











$(document).ready(function (e) {



	var baseHref = document.getElementsByTagName('base')[0].href;



	$("#reviewform").on('submit',(function(e) {



		e.preventDefault();



		//console.log(add_list_your_website());



		if(write_review() == true)



		{



			$.ajax({



				url: baseHref + "Review/InsertReview",



				type: "POST",



				data:  new FormData(this),



				contentType: false,



				cache: false,



				processData:false,



				success: function(data)



				{



					//console.log(data);



					if(data == 0)



					{



						$('#status').html('<span style=color:red; font-size:20px; >Please log in first</span>');



					}



					else if(data == 1){



					$('#status').html('<span style=color:green; font-size:20px; >your review submitted successfully. we will notify you after approve it</span>');



					}



					setTimeout(function(){ $("#status").html('');  }, 3000);



				},



				  error: function() 



				{

				}             

			});

		}

	else{

		//Validation occured

	}
	}));
});

</script>

<?php //var_dump($product); 



foreach ($product as $value) {



?>



<section class="all_cat">

  <div class="container">
<div class="row">
<div class="col-md-12">
    <div class="category pop"> <img src="images/msg-icon.png"  alt="msg-icon">
	<?php 
	$catnames = $this->category_model->catname($value->cat_id);
	if(sizeof($catnames)>0)
	{
		$string = "";
		foreach($catnames as $cname)
		{
			?>
			<a href="category/select/<?php echo $cname['cat_id'] ?>" >
			<?php
				echo $cname['cat_name'];
			?>
			</a>
			<?php
			//$string .= $cname['cat_name'].',';
		}
		//echo substr($string,0,-1);
	}
	?>
	</div>
</div>   

    



<div class="col-md-8">    

<!-----------------Start New HTML ----------------->

 <div class="cat-block">

  <div class="cart-header">

  <div class="pull-left">

  <h1><?php echo substr($value->prd_name,0,40); ?></h1>  

  </div>

  

  <div class="pull-right">

  
  
  
  <div class="cart-rating">

  <?php 
  $access = $this->session->userdata('admin_status');
  if($access == 1)
  {
	if($active == 0)
	{
	?>
	<script>
		function productactive(prd_id)
		{
			var baseHref = document.getElementsByTagName('base')[0].href;
			//ShowProgress();
			setInterval(function(){  //Interval Start
				//alert(productId); true case
				var params = {prd_id: prd_id, stts: 1}; //JSON ENCODED 
				path = baseHref + 'admin/weblist/ProductStatusUpdate'; //console.log(params); //json //$(this).serialize(),
				$.ajax({
					type: 'POST',
					url: path,
					data: params, //new FormData('#signup-form'),//
					success:
							function (data) {
								location.reload();
								//console.log(data); 
							}
				});
			}, 1000); //Interval End
		}

	</script>
	
		<a href="javascript:void(0);" id="active" onclick="productactive('<?php echo $value->prd_id; ?>')" class="pull-left" > Activate </a>
	<?php 
	} 
  }
  else if($active == 1)
  {
	  //echo "show d";
  }
  else{
	  //if not active and logged person is not a super admin
	  redirect(base_url());
	  //echo "hide";
  }
?>
  
  
  <ul>

  

  

<?php 

//getRatingSummary//

if((sizeof($getRatingSummary) > 0) && ($getRatingSummary != null)){

	$sum = 0;

	foreach($getRatingSummary as $getRatingSummaryvalue)

	{

	   $sum += $getRatingSummaryvalue['service_rating'];

	}

	//$checker = $sum ;/// 5;

	//echo $checker;

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
			
			$this->contact_model->ratingNewWrite($mainstar,$dotstar);
			?>

			<li><span class="c-count"><?php echo  $mainstar.'.'.$dotstar;  ?></span></li>
			<?php
		}
	}
	else{
		//writeStar($sum,'0');
		$this->contact_model->ratingNewWrite($sum,'0');
		?>
			<li><span class="c-count"><?php echo $sum ?>.0</span></li>
		<?php
	}
}
else{
		//writeStar('0','0');
		$this->contact_model->ratingNewWrite('0','0');
		?>
			<li><span class="c-count">0.0</span></li>
		<?php
	}
	
//$arrayvalue = $sum;
?>

<!--
<fieldset class="rating323">
    <input type="radio"  <?php if($arrayvalue==5){ ?> checked="checked" <?php } ?> id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    
    <input type="radio"  <?php if($arrayvalue==4.5){ ?> checked="checked" <?php } ?> id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
    
    <input type="radio"  <?php if($arrayvalue==4){ ?> checked="checked" <?php } ?> id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    
    <input type="radio"  <?php if($arrayvalue==3.5){ ?> checked="checked" <?php } ?> id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
    
    <input type="radio"  <?php if($arrayvalue==3){ ?> checked="checked" <?php } ?> id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    
    <input type="radio"  <?php if($arrayvalue==2.5){ ?> checked="checked" <?php } ?> id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
    
    <input type="radio"  <?php if($arrayvalue==2){ ?> checked="checked" <?php } ?> id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    
    <input type="radio"  <?php if($arrayvalue==1.5){ ?> checked="checked" <?php } ?> id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
    
    <input type="radio"  <?php if($arrayvalue==1){ ?> checked="checked" <?php } ?> id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    
    <input type="radio"  <?php if($arrayvalue==.5){ ?> checked="checked" <?php } ?> id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
</fieldset>-->
  

  

  

  </ul>

  </div>

  

  </div>

  </div>

  

  <div class="cat-des">

  <div class="row">

  <div class="col-md-4">

  <div class="cat-prd-logo">

  <?php
  
  if(strpos($value->prd_image, "http") !== false ) 
	{?>
		 <img src="<?php echo $value->prd_image; ?>" >
		 <?php
	}else{
					
	  if($value->prd_image != "")
	  {
		  if (file_exists($value->prd_image)){ 
			  ?>
			  <img src="<?php echo $value->prd_image; ?>" >
			  <?php
		  }else{
		   ?>
			  <img src="images/product/dummy_prd12.jpg" >
			  <?php
		  }
	  }else{
		   ?>
		  <img src="images/product/dummy_prd12.jpg" >
		  <?php
	  }
	}
	  ?>
  
  <!--
  <img src="<?php //echo $value->prd_image ?>" />-->

  <div class="add-bookmark">

  

  

  <?php 



if($value->user_bookmarked == 0){?>


<a href="javascript:void(0)" onclick="favBookmark('<?php echo $value->cat_id; ?>','<?php echo $value->prd_id; ?>','1')" id='bookmark_a_<?php echo $value->prd_id; ?>' >
<div class="add-bookmark" style='background-color:#F1C40F'>
<img src="images/bookmarkpending.png" style="width: 21px;" id='bookmark_img_<?php echo $value->prd_id; ?>' >		
</div>
</a>

 



<?php } else { ?>



<a href="javascript:void(0)" onclick="favBookmark('<?php echo $value->cat_id; ?>','<?php echo $value->prd_id; ?>','0')" id='bookmark_a_<?php echo $value->prd_id; ?>' >
<div class="add-bookmark" style='background-color:#F1C40F'>
<img src="images/bookmarkdone.png" style="width: 21px;" id='bookmark_img_<?php echo $value->prd_id; ?>' >		
</div>
</a>

  

<?php } ?>



  



  </div>

  </div>

  <div class="cart-app-list">

  <ul>

  

   <li><a href="<?php echo $value->ios_app_url = ($value->ios_app_url != '' ? $value->ios_app_url : 'javascript:void(0)');   ?>" title='<?php echo $value->ios_app_url = ($value->ios_app_url != 'javascript:void(0)' ? '' : 'Not Available');   ?>' target="_blank" class="apple"><i aria-hidden="true" class="fa fa-apple"></i></a></li>

  

     <li><a href="<?php echo $value->android_app_url = ($value->android_app_url != '' ? $value->android_app_url : 'javascript:void(0)'); ?>" target="_blank" class="android" title='<?php echo $value->android_app_url = ($value->android_app_url != 'javascript:void(0)' ? '' : 'Not Available');   ?>'><i aria-hidden="true" class="fa fa-android"></i></a></li>



 



  

  

    <li><a href="<?php echo $value->windows_app_url = ($value->windows_app_url != '' ? $value->windows_app_url : 'javascript:void(0)');  ?>" target="_blank"

  title='<?php echo $value->windows_app_url = ($value->windows_app_url != 'javascript:void(0)' ? '' : 'Not Available');   ?>' class="window"><i aria-hidden="true" class="fa fa-windows"></i></a></li>

  </ul>

  </div> 

  

  </div>

  

  <div class="col-md-8">

  <div class="cat-info">

  <h2>Description</h2>

  <div class="cart-add-des">

  <p><?php echo substr($value->prd_info,0,1200); ?> </p>

  </div>

  </div>

  

  <div class="cart-details">

  <ul>

 <!-- <li><strong>Customer support Id:</strong>  <?php echo $value->customer_support_id = ($value->customer_support_id != '' ? $value->customer_support_id : 'Not Available');   ?> </li>-->

<li><strong>Location:</strong>    <?php echo $value->locations = ($value->locations != '' ? $value->locations : 'Not Available');   ?> </li>

<li><strong>Delivery Time:</strong>   <?php echo $value->delivery_time = ($value->delivery_time != '' ? $value->delivery_time : 'Not Available');   ?> </li>

<li><strong>Payment Option:</strong>   <?php echo $value->payment_option = ($value->payment_option != '' ? $value->payment_option : 'Not Available');   ?></li>

  </ul>

  </div>

  

  </div>

  

  <div class="col-md-12">

  <div class="service-col">

  <div class="svr-c">

  <h1>Services Offered</h1>

  <ul>

  <li><?php echo $value->services_offered = ($value->services_offered != '' ? $value->services_offered : 'Not Available');   ?> </li>

   </ul>

  

  </div>

  

  <!--

  <div class="svr-c no-border no-margin">

  <h1>Payment Options</h1>

  <ul>

   <li><?php echo $value->payment_option = ($value->payment_option != '' ? $value->payment_option : 'Not Available');   ?></li>

  </ul>

  

  </div>
-->
  

  

  

  </div>

  </div>

  

  <div class="col-md-12">

  <div class="b-one">

  <div class="list_inline">



 <?php if($value->user_liked == "0") { ?>



 <a href="javascript:void(0);" id='mainlike_<?php echo $value->prd_id ?>' onClick="likeMainProduct('<?php echo $value->cat_id ?>','<?php echo $value->prd_id ?>','1')" >

 <div class="likes">

 <i class="fa fa-arrows" id='main_thumb_<?php echo $value->prd_id ?>' ></i> I use this

 <span id='main_like_count_<?php echo $value->prd_id ?>'>

 <?php echo $value->prd_like_count ;?>

 </span>

 

 </div>



 </a>

 <?php  } else { ?>



   <a href="javascript:void(0);" id='mainlike_<?php echo $value->prd_id ?>' onClick="likeMainProduct('<?php echo $value->cat_id ?>','<?php echo $value->prd_id ?>','0')" ><div class="likes fb-like">

 <i class="fa fa-arrows" id='main_thumb_<?php echo $value->prd_id ?>' ></i>I use this 

 <span id='main_like_count_<?php echo $value->prd_id ?>'>

 <?php echo $value->prd_like_count ;?>

 </span>

 </div>

 



 

 

 </a>

 <?php } ?>



 



<script type="text/javascript">

$(document).ready(function(){

var baseHref = document.getElementsByTagName('base')[0].href;

	

$('#share_button').click(function(e){

	e.preventDefault();

		FB.ui(

		{

			method: 'feed',

			name: '<?php echo $value->prd_name ?>',

			link: baseHref + "Review/detail/<?php echo $value->prd_id ?>",

			picture: baseHref+'<?php echo $value->prd_image ?>',

			caption: '<?php echo $value->prd_name ?>',

			description: '<?php echo str_replace("'","%27",substr($value->prd_info,0,250));  ?>',

			message: ''

		}

		,function(response) {

			if(response && response.post_id)

			{

				var catid = <?php echo $value->cat_id ?>;

				var prd_id = <?php echo $value->prd_id ?>;

				$.ajax({

				url: baseHref + "Review/IncreaseShareCount",

				type: "POST",

				data: { catid: catid,prd_id:prd_id },

				

				success: function(data)

					{

						$('#share_counter_'+prd_id).html(data);

					},

				error: function() 

					{

						

					}             

				});

			}

			else{ 



			}

		});

		

		

	});

});







</script>



<a href="javascript:void(0)" id='share_button'>

  <div class="whatsapp">  <i class="fa fa-share-alt"></i>Share

  

  <input type='hidden' id='cat_id_hidden' value='<?php echo $value->cat_id ?>' >

<span id='share_counter_<?php echo $value->prd_id ?>'>

<?php  echo $value->prd_share_count; ?>

</span>

  </div>

</a>

  



  <!--Website i use it-->



  




<!--


<a href="javascript:void(0);" title='i use this' id='iusedatag_<?php echo $value->prd_id ?>' onClick="iused('<?php echo $value->cat_id ?>','<?php echo $value->prd_id ?>','1')" >

<div class="likes iuse">

<i aria-hidden="true" class="fa fa-arrows"></i>

<span  id='iusedcount_<?php echo $value->prd_id ?>'>

<?php echo $value->iused;  ?>

</span>

 



 </div>

</a>
-->
  



  <!--



  <div class="str"  data-toggle="modal" data-target=".bs-example-modal-lg">



  <a href="javascript:void(0);"  ><i class="fa fa-comment"></i></a><?php echo $value->prd_comment_count ?>



  </div>-->



  <!--Website i use it end -->



<div class="write_rev mgn">



<a href="http://<?php echo $value->prd_link ?>" target="_blank" ><button type="submit" class="visit_btn" >Visit Website</button></a>



<a href="Review/Write/<?php echo $value->prd_id ?>"  >



<button type="submit" class="wr_rev" >Write A review</button></a>







<!--<button type="submit" class="wr_rev" onclick="write_rev();" >Write A review</button> popup-->







<!--Stars Popup Start-->



<div class="rev_toggle">



<div  class="review_form">



<form class="form_style"  action="<?php echo base_url(); ?>Review/InsertReview" method="post" id="reviewform"  enctype="multipart/form-data">







<input type="hidden" id="prd_hidden" name="prd_hidden" value="<?php echo $value->prd_id .','. $value->cat_id ?>" />







<div class="form-group">



  <label for="exampleInputPassword1">Rating</label>



  



 <div class="ratebox" data-id="1" data-rating="0"></div>



 <input type="hidden" id="rate1" name="rate1" value="0" />



 <br/><br/>



 



<!--



 <div class="wr_txt">Services



 <div class="ratebox" data-id="1" data-rating="0"></div>



 <input type="hidden" id="rate1" name="rate1" value="0" />



 </div>







<div class="wr_txt">Values



<div class="ratebox" data-id="2" data-rating="0"></div>



<input type="hidden" id="rate2" name="rate2"  value="0" />



</div>



<div class="wr_txt">Shiping



 <div class="ratebox" data-id="3" data-rating="0"></div>



 <input type="hidden" id="rate3" name="rate3"  value="0" />



 </div>



  <div class="wr_txt">Support



<div class="ratebox" data-id="4" data-rating="0"></div>



<input type="hidden" id="rate4" name="rate4"  value="0" />



</div>



 <div class="wr_txt">Other



<div class="ratebox" data-id="5" data-rating="0"></div>



<input type="hidden" id="rate5" name="rate5"  value="0" />



</div>-->



  </div>











  <div class="form-group">



    <label for="exampleInputPassword1">Title of your review</label>



 



	<input type="text" class="form-control" id="webTitle"  autocomplete="off" name="webTitle" placeholder="If you could say t in one sentence, what would you say?" value="<?php echo set_value('webTitle'); ?>" />



	<div id="webTitlemsg" > </div>



  </div>



  



  <div class="form-group">



    <label for="exampleInputFile">Your Review</label>



     <textarea class="form-control" id="webBody" name="webBody" rows="3"></textarea>



	  <div id="webBodymsg" > </div>



  </div>



   <div class="form-group">



   <div id="status"> </div>



  </div>



 <div class="bottom_btns pull-right"><button type="submit" class="submit_btn"  onClick="write_review()" >Submit</button>



  <button type="reset" class="submit_btn">Cancel</button></div>



</form>



</div>



</div>







<!--Stars Popup End-->







</div>





 </div>

 

 

 

 </div>

 </div>

  

  </div>  

  </div>

  

  

 </div> 

 

 
<div class="m">
<div class="col-md-12">

<div class="row">







<div class="bottom_review">



<div class="r_tabs">



<!--<ul class="nav nav-tabs" role="tablist">



    <li role="presentation" class="active modern"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Review</a></li>



  </ul>-->



<h1>Reviews</h1>



  <!-- Tab panes -->



  <div class="tab-content mgn">



    <div role="tabpanel" class="tab-pane active" id="home">



   



  <input type="hidden" id="row_no" value="2">

  
  
<input type="hidden" value="<?php echo $value->prd_id ?>" name="scroll_prd_id" id="scroll_prd_id" />

   



   



    



   



<script>



$(document).ready(function()



{



var baseHref = document.getElementsByTagName('base')[0].href;



	function loadmore()



	{



		var val =document.getElementById("row_no").value;



		var prd = document.getElementById("scroll_prd_id").value;



		//console.log(prd);



		$.ajax({



		type: 'post',



		url: baseHref+'Review/getScrollReviews',



		data: {       getresult:val,prd_id:prd      },



		success: function (response) {

			if(response != 0){

				var content = document.getElementById("all_rows");

				

				content.innerHTML = content.innerHTML+response;

				// We increase the value by 10 because we limit the results by 10

				document.getElementById("row_no").value = Number(val)+2;

			}

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











<div id="all_rows">

<?php 

//var_dump($reviews); 



if(sizeof($reviews)>0)

{

foreach ($reviews as $value) { 

$getReviewCountStats = $this->write_review_model->getReviewCountStats($value->rev_id); //other stats

$stat=sizeof($getReviewCountStats);

$getReviewComment = $this->write_review_model->getReviewComment($value->rev_id); //comment

$countComment=sizeof($getReviewComment);

?>



<!--single review start-->

<div class="review">

<div class="info-det">

<div class="profile-pic">





<?php 
//var_dump($value);
//var_dump($review);
if(trim($value->register_method) == trim('facebook')){

	?>

	<img width="100%" src="http://graph.facebook.com/<?php echo $value->social_id; ?>/picture?type=square" alt="profile-pic" />

	<?php

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
		//writeStarForReview($arrayvalue,'0');//echo $arrayvalue;
		?><span class="c-count"><?php echo $arrayvalue?>.0 </span> <?php
	}
}
?>



<!---->



</div>
<div class="r-bg">

<div class="info-para">

<h1><?php echo $value->review_head; ?></h1>

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

if($stat>0) {

$countvalue = $getReviewCountStats[0];



	if($countvalue['helpfull_status']==0) { ?>

	<li><span><a href="javascript:void(0);" onclick="helpfull('<?php echo $value->rev_id;  ?>','1')" id='help_atag_<?php echo $value->rev_id; ?>' >Yes</a></span>

		<span id='help_full_counter_<?php echo $value->rev_id; ?>' ><?php echo $countvalue['helpfull_count'] ?></span> 

	</li>

	<?php }

	else if ($this->session->userdata('usr_id')!= "") { ?>

	<li><span class='washelpfulldone' ><a href="javascript:void(0);" onclick="helpfull('<?php echo $value->rev_id;  ?>','0')" id='help_atag_<?php echo $value->rev_id; ?>' >Yes</a></span>

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

	 <li><span><a href="javascript:void(0);" onclick="helpfull('<?php echo $value->rev_id;  ?>','1')" id='help_atag_<?php echo $value->rev_id; ?>' >Yes</a></span><span id='help_full_counter_<?php echo $value->rev_id; ?>' >
	 <?php 
	 $this->write_review_model->helpfullCountNew($value->rev_id);
	 ?>
	 
	 </span> </li>

	 <?php

 } 

 ?>

</ul>

</div>

<!--was this helpful end-->



<div class="rate-right">

<!--likeReview(revID,likeStats,favStats,likedislike 1:0) UnderProcess-->

<!--like start-->



<?php 

//var_dump($countvalue);

if($stat>0) {

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
		  </span>



	  </div></a>

	<?php

}

	?>

<!--like end-->




<!--
  <a href="javascript:void(0);" data-toggle="modal" data-target=".bs-example-modal-lg" onClick="CmtToggle(<?php echo $value->rev_id; ?>)" >

  <div class="str"  >

  <i class="fa fa-comment"></i><?php //echo $this->write_review_model->getCountofTotalCommentsReview($value->rev_id); ?>

  </div>

  </a>
-->

  
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
  
  
  

</div>

</div>











  

  <div id="form_div_<?php echo $value->rev_id; ?>" style="display: none;" class="comm">

  

 <div style='display:none;' id="cmtDiv_<?php echo $value->rev_id; ?>" class="comment-list">
<?php 
//Comments of Reviews
if($countComment >0) //Comments of Review
{
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
								<img src="<?php echo $cmtValue['profile_image']; ?>" alt="profile-pic">
							<?php 
						}
						else{
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
                    <span class="user-n"><a href="user/profile/<?php echo $cmtValue['usr_id']  ?>"><?php echo $cmtValue['usr_name']; ?></a></span>
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



}   

   



?>



</div>

</div>	



</div>

<!--single review end-->



<?php 

}

}

else{

	?>

		<div class="nocontent">

	No Reviews Yet 

	</div>

	<?php

}

?>





</div>







    </div>



   



  </div>











</div> 











</div>

</div>



</div> 
</div>

 

   

    

<!-----------------End New HTML ----------------->

    



 </div>

 

    

  

  

  

  

  <div class="col-md-4"> 

      

      <!-- RATING SUMMARY End -->

      

      <div class="r_tags">

        <div class="tag_head">

          <h4>Contact Customer care</h4>

        </div>

        <div class="t_btns">

        <div class="side-contact-info">

        <ul>

        <li><i class="fa fa-envelope"></i>

		<?php 

		if(sizeof($product)>0){

		

		$value = $product[0]; echo $value->customer_support_id;

		}

		else{

			echo "Not Available";

		}

		?></li>

        <li><i class="fa fa-phone"></i> 

		<?php 
		if(sizeof($product)>0){
			$value = $product[0]; 
			if($value->prd_number != ''){
				echo $value->prd_number;
			}
			else{
				echo "Not Available";
			}
		}
		else{
			echo "Not Available";
		}

		?>

		

		</li>

        </ul>

        </div>

        

        

       

        </div>

      </div>

	  
	  
	  
	  
     <!-- <div class="r_tags">

        <div class="tag_head">

          <h4>Payment Options:</h4>

        </div>

        <div class="t_btns">

          <?php 



foreach ($product as $value) {



	echo $value->payment_option = ($value->payment_option != '' ? $value->payment_option : 'N/A');  



}



?>

        </div>

      </div>-->

     

      <div class="r_tags">

        <div class="tag_head">

          <h4>Ratings Distribution:</h4>

        </div>

         <div class="n-rating">

        <div class="t_btns">

          <div class="r_rate">

            <div class="effect-julia"><span><?php echo $getRatingSummaryByGrouping['grouper5']; ?></span></div>

            <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

          <div class="r_rate">

            <div class="effect-julia"><span><?php echo $getRatingSummaryByGrouping['grouper4']; ?></span></div>

            <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

          <div class="r_rate">

            <div class="effect-julia"><span><?php echo $getRatingSummaryByGrouping['grouper3']; ?></span></div>

            <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

          <div class="r_rate">

            <div class="effect-julia"><span><?php echo $getRatingSummaryByGrouping['grouper2']; ?></span></div>

            <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

          <div class="r_rate">

            <div class="effect-julia"><span><?php echo $getRatingSummaryByGrouping['grouper1']; ?></span></div>

            <i class="fa fa-star"></i> </div>

        </div>

        </div>

        

        

        

        <div class="n-rating-des">

      <ul>

      <li>5 Stars: Excellent</li>

      <li>4 Stars: Very Good </li>

     <li>3 Stars: Good </li>

     <li>2 Stars: Fair </li>

     <li>1 Stars: Poor </li>

 

      </ul>

      

      </div>

      </div>

    

      

      

      <div class="r_tags">

        <div class="tag_head">

          <h4>Tags</h4>

        </div>

        <div class="t_btns">

          <?php 

//var_dump($getAllTags);

if(sizeof($getAllTags)>0){
	foreach ($getAllTags as $tagValue)
	{
		if($tagValue['tag_name'] != '')
		{
		echo "<a href=search/query/".$tagValue['tag_name']." class='tag_btn' style='text-decoration:none'  attr='".$tagValue['tag_id']."' >".$tagValue['tag_name']."</a> ";
		}
		else{
			?>
			<div class='nocontent'>No Tags </div>
			<?php
		}
	}
	
}
else{
	?>
	<div class='nocontent'>No Tags </div>
	<?php
}










?>

          

          <!--<button type="submit" class="tag_btn">Dummy</button> --> 

          

        </div>

      </div>

      <div class="r_rel_sch">

        <div class="tag_head">

          <h4>Deals of the day</h4>

        </div>

        <div class="rel_body day_deal" style='border-bottom:0px;'>

          <div class="r_head top deal">

            <?php 



$var = $getDealProduct['deal_link'];



$var_is_greater_than_two = ($var != '' ? $var : 'javascript:void(0)'); 



?>

            <h6 class="categoryMain"><a style='padding: 0px 6px;' href="<?php echo $var_is_greater_than_two; ?>" target="_blank" > <img src='images/deals.png' alt='<?php echo $getDealProduct['prd_name']; ?>' /> </a></h6>

          </div>

        </div>

        

      

        

      </div>

	  
	   <div class="r_blogs">

        <div class="tag_head">

          <h4>Related Search</h4>

        </div>

        <?php //var_dump($relatedSearch);





if(sizeof($relatedSearch)>0)

{

foreach($relatedSearch as $search)



{



	

	?>

        <div class="rel_body">

          <div class="rel_pic">
		  
		  
		  <?php
			$filename = $search["prd_image"];

			if (file_exists($filename)) {
				?><img src="<?php echo $search['prd_image']; ?>">
				<?php 
			} else {
				?>
				<img src="images/product/dummy_prd12.jpg">
				<?php
			}
			?>
	

            

          </div>

          <div class="r_head top">

            <h6 class='categoryMain'><a href="Review/detail/<?php echo $search['prd_id'] ?>"><?php echo substr($search['prd_name'],0,250); ?></a></h6>

            <div class="r_description">

              <?php 



		overAllStars($this->write_review_model->getRatingSummary($search['prd_id']));



		?>

            
              <p><?php echo substr($search['prd_info'],0,125); ?></p>

              <div class="red_btn"><a href="Review/detail/<?php echo $search['prd_id'] ?>">view</a></div>

            </div>

          </div>

        </div>

        <?php

}

}

else{

	?>

		<div class="nocontent">

	No Recent Search 

	</div>

	<?php

}

?>

      </div>
	  
      <div class="r_blogs">

        <div class="tag_head">

          <h4>Blogs</h4>

        </div>

		
		
		<div class="blog-block">

<iframe  name="myIframe" marginwidth="0"
 marginheight="0"
 hspace="0"
 vspace="0"
 frameborder="0"
 scrolling="no"
src="http://demo.dupleit.com/weblister_v6/blogiframe.php" 
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

<?php } ?>

<script>



function write_rev()







{



	$(".rev_toggle").toggle();



}







function cncl()



{



	$(".rev_toggle").toggle();



}







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

				$("#loginModal .modalFrom").html('<center><span  class="infodanger" >Please log in first</span></center>');

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















function iused(catId,prdID,stts)



{



	//  <!--iused(prdID,stts) UnderProcess-->



	var baseHref = document.getElementsByTagName('base')[0].href;



	$.ajax({



		url: baseHref + "review/iusedthis",



		type: "POST",



		data:  { catID: catId, prdID: prdID, stts:stts },



		success: function(data)

		{

			//console.log(data);

			if(data == 0)

			{

				$("#loginModal .modalFrom").html('<center><span  class="infodanger" >Please log in first</span></center>');

				$("#loginModal").modal('show');

				

				//$('#status').html('<span style=color:red; font-size:20px; >Please logged in first</span>');



			}



			else {

				

				// iusedatag_

				// iusedcount_

				

				$('#iusedatag_' + prdID).attr('onclick','javascript:void(0)');

				$('#iusedcount_' + prdID).html(data-1);

				//id='main_thumb_<?php echo $value->prd_id ?>'



				// if(stts == '1'){

					// $('#main_thumb_'+prdID).removeClass('fa fa-thumbs-up').addClass('fa fa-thumbs-down');

					// $('#mainlike_'+prdID).attr('onclick',"likeMainProduct('"+catId+"','"+prdID+"','0')");		

				// }

				// else{

					// $('#main_thumb_'+prdID).removeClass('fa fa-thumbs-down').addClass('fa fa-thumbs-up');

					// $('#mainlike_'+prdID).attr('onclick',"likeMainProduct('"+catId+"','"+prdID+"','1')");		

				// }

				//alert("Commented"); //Success Returns

			}

			setTimeout(function(){ $("#loginModal .modalFrom").html(''); $("#loginModal").modal('hide');  }, 10000);



			//setTimeout(function(){ $("#status").html('');  }, 3000);



		},



		  error: function() 



		{



			



		}             



	});



	



}

















function CmtToggle($id)



{



	$('#cmtDiv_'+$id).toggle();



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



			console.log(data);



			if(data == 0)



			{

				$("#loginModal .modalFrom").html('<center><span  class="infodanger" >Please log in first</span></center>');

				$("#loginModal").modal('show');

				setTimeout(function(){ $("#loginModal .modalFrom").html('');  }, 10000);
	

				//$('#status'+$rev_id).html('<span style=color:red; font-size:20px; >Please logged in first</span>');



			}



			else{


				var counterDiv = '#comment_counter_'+$rev_id;
				var counterDivinput = '#comment_counter_input_'+$rev_id;
				var htmlString = $(counterDivinput).val();
				$(counterDiv).html(parseInt(htmlString) + 1);
				$(counterDivinput).val(parseInt(htmlString) + 1);
				
			

				$('#cmtDiv_'+$rev_id).html(data);

				$('#textarea_'+$rev_id).val('');

				// if(stts == 1){

					// $('#rev_status_'+$rev_id).html('<span style=color:green; font-size:20px; >Commented</span>');

				// }else {

					// //alert("un-liked");

				// }



			}

			//setTimeout(function(){ $("#rev_status_"+$rev_id).html('');  }, 3000);



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









function readmoretoggle(id){



	$('#'+id).toggle();



}



</script>

<?php 



//var_dump($getRatingSummary);







function overAllRating($getRatingSummaryresult)



{



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



				switch ($dotstar) {



					case "1": writeStar($mainstar,'0');	break;



					case "2": writeStar($mainstar,'0'); break; 



					case "3": writeStar($mainstar,'0'); break; 



					case "4": writeStar($mainstar,'0');	break;



					case "5": writeStar($mainstar,'5'); break; 



					case "6": writeStar($mainstar,'5'); break; 



					case "7": writeStar($mainstar,'5');	break;



					case "8": writeStar($mainstar,'8'); break; 



					case "9": writeStar($mainstar,'9'); break; 



				}



				?>

<div class='effect-julia'><span><?php echo  $mainstar.'.'.$dotstar;  ?></span></div>

<?php



			}



		}



		else{



			?>

<div class='effect-julia'><span><?php echo $sum;?>.0</span></div>

<?php



		}



	}



	else{



			?>

<div class='effect-julia'><span>0.0</span></div>

<?php



		}



}











function overAllStars($getRatingSummaryresult)



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

$contact_model->contact_model->ratingNewWrite($mainstar,$dotstar);


			}



		}



		else{



			$contact_model->contact_model->ratingNewWrite($checker,'0');



		}



	}




	else{



$contact_model->contact_model->ratingNewWrite('0','0');



		}



}











?>

<?php 







function writeRatingSummary($main,$dot,$ratingType)



{



	//echo '-'.$main.'--------'.$dot;



	if($dot == 5)



	{



		if($main == 1){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star-half"></i> </div>

</li>

<?php 



		}



		else if($main == 2){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half"></i> </div>

</li>

<?php 



		}



		else if($main == 3){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half"></i> </div>

</li>

<?php 



		}



		else if($main == 4){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half"></i> </div>

</li>

<?php 



		}		



	}



	else if($dot == 0)



	{



		if($main == 1){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star-half"></i> </div>

</li>

<?php 



		}



		else if($main == 2){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

</li>

<?php 



		}



		else if($main == '3'){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

</li>

<?php 



		}



		else if($main == 4){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

</li>

<?php 



		}		



		else if($main == 5){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

</li>

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

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> </div>

</li>

<?php 



		}



		else if($main == 2){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

</li>

<?php 



		}



		else if($main == 3){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

</li>

<?php 



		}



		else if($main == 4){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

</li>

<?php 



		}		



		else if($main == 5){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

</li>

<?php 



		}	



		}



		else {



			if($main == 1){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> </div>

</li>

<?php 



		}



		else if($main == 2){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

</li>

<?php 



		}



		else if($main == 3){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

</li>

<?php 



		}



		else if($main == 4){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

</li>

<?php 



		}		



		else if($main == 5){



			?>

<li>

  <div class="rate_label"><?php echo $ratingType; ?></div>

  <div class="ratng_stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>

</li>

<?php 



		}	



		}



	}



}











function writeStar($main,$dot)
{
	if($dot == 5)
	{
		if($main == 0){
			?>
<li><i class="fa fa-star-half"></i></li>
<?php 
		}
		if($main == 1){
			?>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star-half"></i></li>
<?php 
		}
		else if($main == 2){
			?>
			<li><i class="fa fa-star"></i></li>
			<li><i class="fa fa-star"></i></li>
			<li><i class="fa fa-star-half"></i></li>
<?php 
		}
		else if($main == 3){
			?>
			<li><i class="fa fa-star"></i></li>
			<li><i class="fa fa-star"></i></li>
			<li><i class="fa fa-star"></i></li>
			<li><i class="fa fa-star-half"></i></li>
<?php 
		}
		else if($main == 4){
			?>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star-half"></i></li>
<?php 
		}		
	}
	else if($dot == 0)
	{
		if($main == 1){
			?>
<li><i class="fa fa-star"></i></li>
<?php 
		}
		else if($main == 2){
			?>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<?php 
		}
		else if($main == '3'){
			?>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<?php 
		}
		else if($main == 4){
			?>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<?php 
		}		
		else if($main == 5){
			?>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
<li><i class="fa fa-star"></i></li>
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
<li><i class="fa fa-star"></i></li>
<?php 
		}
		else if($main == 2){
			?>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>



<?php 



		}



		else if($main == 3){



			?>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>



<?php 



		}



		else if($main == 4){



			?>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>


<li><i class="fa fa-star"></i></li>



<?php 



		}		



		else if($main == 5){



			?>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>



<?php 



		}	



		}



		else {



			if($main == 1){



			?>

<li><i class="fa fa-star"></i></li>

<?php 



		}



		else if($main == 2){



			?>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>



<?php 



		}



		else if($main == 3){



			?>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>



<?php 



		}



		else if($main == 4){



			?>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>



<?php 



		}		



		else if($main == 5){



			?>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>

<li><i class="fa fa-star"></i></li>



<?php 



		}	



		}



	}



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



?>
