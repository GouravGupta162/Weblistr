<?php 
$prd_id = $getCompanyProfile['prd_id'];
$prd_name = $getCompanyProfile['prd_name'];
$prd_image = $getCompanyProfile['prd_image'];
$prd_info = $getCompanyProfile['prd_info'];
$prd_link = $getCompanyProfile['prd_link'];
$prd_number = $getCompanyProfile['prd_number'];

$stats = $this->write_review_model->getCompanyStats($prd_id);  

$likeModal = $this->write_review_model->getCompanylikeModalDetails($prd_id);  
$bookmarkModal = $this->write_review_model->getCompanybookmarkModalDetails($prd_id);  
$iUseModal = $this->write_review_model->getCompanyiuseModalDetails($prd_id); 

?>
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

<section class="com_reviews">
<div class="container">
<div class="row">
<div class="col-md-12 back-col">
<a href="user/company">Back</a>
</div>
</div>
 <div class="category pop profile"> <i aria-hidden="true" class="fa fa-pencil"></i> Reviews <span> <a href="javascript:void(0);" data-toggle="modal" data-target="#LikeModal">
        <?php  $likes = $stats['prd_like_count']; echo $likes = ($likes > 0 ?  $likes : '0'); ?>
        I use</a> 
		
		<!--| <a href="#" data-toggle="modal" data-target="#iuseModal">
        <?php  //$iuse = $stats['iuse_count']; echo $iuse = ($iuse > 0 ?  $iuse : '0'); ?>
        I use</a> -->
		
		| <a href="#" data-toggle="modal" data-target="#BookmarksModal">
        <?php  $bookmark = $stats['bookmark_count']; echo $bookmark = ($bookmark > 0 ? $bookmark : '0');  ?>
        Bookmarks</a> 
        <!-- | 
<a href="#" data-toggle="modal" data-target="#ShareModel">5 Shares</a> | 
<a href="#" data-toggle="modal" data-target="#ActivityModal">10 Recent Activities</a>--> 
        
        </span> </div>


<!-- Start Here -->
<input type='hidden' name='prdID' id='prdID' value='<?php echo $getCompanyReview[0]['prd_id'];?>' />
<div id='innerContent'>
<?php



$paginationCount;
if($paginationCount >0){
foreach($getCompanyReview as $rev)
{
	
	
$userdetails = $this->user_model->getUserDetailinRow($rev['usr_id']);

 ?>
<div class="rev_details company">
<div class="r_profile company">

<?php 
	if(trim($userdetails['register_method']) == trim('facebook')){
		?>
		<img src="http://graph.facebook.com/<?php echo $userdetails['social_id']; ?>/picture?type=square" alt="profile-pic" />
		<?php
	}
	else{
		if($userdetails['profile_image'] != ''){
			if (file_exists($userdetails['profile_image'])){ 
				?>
					<img src='<?php echo $userdetails['profile_image'] ?>' alt='profile-pic' />
				<?php
			}else{
				?>
				<img src="images/about-icon-md.png" alt="profile-pic">
				<?php 
			}
		}
		else{
			?>
				<img src="images/about-icon-md.png" alt="profile-pic" />
			<?php
		}
	}
	?>



</div>
<div class="r_info comp">
<div class="r_info_head">
<h4><?php echo $userdetails['usr_name']; ?></h4>
</div>

<div class="r_details info-para">
	<h1><?php echo $rev['review_head']; ?> </h1>
	

<?php echo substr($rev['review_body'],0,250); ?>  

</div>


<?php
$revImages = $this->write_review_model->getReviewImages($rev['rev_id']);
if(sizeof($revImages)>0)
{
	?>
	<div class="r_thumbnails">
		<ul>
			<?php 
			foreach($revImages as $revimage){
			?>
				<li>
				<a class="fancybox" href="<?php echo $revimage['rev_image'] ?>" data-fancybox-group="gallery<?php echo $rev['rev_id']; ?>" title="<?php echo $rev['review_head'] ?>">
				
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



<a class="reply_btn" role="button" data-toggle="collapse" href="#collapseExample_<?php echo $rev['rev_id'] ?>" aria-expanded="false" aria-controls="collapseExample">Reply</a>




<div class="collapse toggle" id="collapseExample_<?php echo $rev['rev_id'] ?>">
  <div class="well bg">
   <textarea class="form-control" rows="3" id='textbox_<?php echo $rev['rev_id'] ?>' placeholder="Your Message"></textarea>
   <button type="button" onclick='replyid(this.id)' id='<?php echo $rev['rev_id'] ?>' class="reply_btn snd">Send</button>
  </div>
</div>

</div>
<div class="rev_tmngs"><?php echo  date("d-m-Y", strtotime($rev['date'])); ?></div>


<div class="col-a">
<?php

$getReviewComment = $this->write_review_model->getReviewComment($rev['rev_id']);
if(sizeof($getReviewComment) > 0) //Comments of Review
{
?>

<div class="com-rev" id="commentslist_<?php echo $rev['rev_id'] ?>">
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

</div>



	<div class="view-commt"><a href="javascript:commentmodalread('<?php echo $rev['rev_id'] ?>')" class="view-commt">View All</a></div>

<?php

}

?>

</div>


</div>
<!-- End Here -->
<?php }
} 
else {
	echo "No Review";
} ?>

</div>

</div>

</section>
<!---Pagingnation--->
<section>
<div class="container">
<nav class="paging">
<?php 
if($paginationCount > 0){
  ?>
 <ul class="pagination page-pagi">
    <li>
      <a href="javascript:void(0)" onclick="changePagination('0','first')">F i r s t</a>
    </li>
	<?php  
	for($i=0;$i<$paginationCount;$i++){ 
		?>
			<li id="<?php echo $i."_no"; ?>" class="link"><a  href="javascript:void(0)" onclick="changePagination('<?php echo $i; ?>','<?php echo $i.'_no'; ?>')"><?php echo $i+1; ?></a></li>
		<?php
	}
	?>
    <li >
      <a href="javascript:void(0)" onclick="changePagination('<?php echo $paginationCount-1; ?>','last')">L a s t</a>
    </li>
	<li class="flash"></li>
  </ul>
 <?php
}
?>
 
</nav>
</div>
</section>

<script type="text/javascript">
var baseHref = document.getElementsByTagName('base')[0].href;
function replyid($rev_id)
{
	var text = $('#textbox_'+$rev_id).val();
	if(text!=""){
		$.ajax({
			url: baseHref + "review/InsertCommentOnReview",
			type: "POST",
			data:  { revID : $rev_id, text:text },
			success: function(data)
			{
				//console.log(data);
				if(data == 0)
				{
					$("<span style='color:red; font-size:14px; float:left; margin-left:15px; margin-top:9px;' >Please logged in first</span>").insertAfter($('#'+$rev_id)).fadeOut(3000);
				}
				else {
					$("<span style='color:green; font-size:14px; float:left; margin-left:15px; margin-top:9px;' >your reply sent..</span>").insertAfter($('#'+$rev_id)).fadeOut(3000);
					$('#textbox_'+$rev_id).val('');
					$('#commentslist_'+$rev_id).html(data);
					
				}
			},
			error: function() 
			{
				
			}             
		});
	}
	else{
		$("<span style=color:red; font-size:14px; float:left; margin-top:5px; margin-left:15px; >comment can't be blank</span>").insertAfter($('#'+$rev_id)).fadeOut(3000);
	}
}

function changePagination(pageId,liId){
	
	//$(".flash").show();
	//$(".flash").fadeIn(400).html('Loading <img src="images/ajax-loader.gif" />');
	$.ajax({
           type: "POST",
           url: baseHref + "user/fetchpagingcontent",
           data: { pageId:pageId,prdID:$('#prdID').val() },
           cache: false,
           success: function(result){
				//console.log(result);
				//$(".flash").hide();
				$(".link a").removeClass("In-active current") ;
				$("#"+liId+" a").addClass( "In-active current" );
				$("#innerContent").html(result);
		   }
      });
}
</script>


<!----like modal start---->
<div class="modal fade" id="LikeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog mdl" role="document">
    <div class="modal-content">
      <div class="modal-header mdl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title mdl" id="myModalLabel">
          <?php  $likes = $stats['prd_like_count']; echo $likes = ($likes > 0 ?  $likes : '0'); ?>
		  I use
          <!--Likes--></h4>
      </div>
      <div class="modal-body mdl">
        <?php //var_dump($likeModal);
		foreach($likeModal as $liker){
		$userdetails = $this->user_model->getUserDetailinRow($liker['usr_id']);
	?>
        <div class="rev_details company mdl">
          <div class="r_profile company mdl">
            <?php 
	if(trim($userdetails['register_method']) == trim('facebook')){
		?>
            <img src="http://graph.facebook.com/<?php echo $userdetails['social_id']; ?>/picture?type=square" alt="profile-pic" />
            <?php
	}
	else{
		if($userdetails['profile_image'] != ''){
			if (file_exists($userdetails['profile_image'])){ 
				?>
					<img src='<?php echo $userdetails['profile_image'] ?>' alt='profile-pic' />
				<?php
			}else{
				?>
				<img src="images/about-icon-md.png" alt="profile-pic">
				<?php 
			}
		}
		else{
			?>
            <img src="images/about-icon-md.png" alt="profile-pic" />
            <?php
		}
	}
	?>
          </div>
          <div class="r_info comp mdl">
            <div class="r_details comp">
                <h6><a href="user/profile/<?php echo $userdetails['usr_id'];?>" ><?php echo $userdetails['usr_name'];?></a></h6>
              <span><?php echo  date("d-m-Y", strtotime($liker['date'])); ?></span> </div>
          </div>
        </div>
        <?php
		}
		?>
      </div>
      <div class="modal-footer"> </div>
    </div>
  </div>
</div>
<!---like modal end--->

<div class="modal fade" id="BookmarksModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> |
  <div class="modal-dialog mdl" role="document">
    <div class="modal-content">
      <div class="modal-header mdl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title mdl" id="myModalLabel">
          <?php  $bookmark = $stats['bookmark_count']; echo $bookmark = ($bookmark > 0 ? $bookmark : '0');  ?>
          Bookmarks</h4>
      </div>
      <div class="modal-body mdl">
        <?php 
//var_dump($bookmarkModal );
foreach($bookmarkModal as $liker){
	$userdetails = $this->user_model->getUserDetailinRow($liker['usr_id']);
	?>
        <div class="rev_details company mdl">
          <div class="r_profile company mdl">
            <?php 
	if(trim($userdetails['register_method']) == trim('facebook')){
		?>
            <img src="http://graph.facebook.com/<?php echo $userdetails['social_id']; ?>/picture?type=square" alt="profile-pic" />
            <?php
	}
	else{
		if($userdetails['profile_image'] != ''){
			if (file_exists($userdetails['profile_image'])){ 
				?>
					<img src='<?php echo $userdetails['profile_image'] ?>' alt='profile-pic' />
				<?php
			}else{
				?>
				<img src="images/about-icon-md.png" alt="profile-pic">
				<?php 
			}
		}
		else{
			?>
            <img src="images/about-icon-md.png" alt="profile-pic" />
            <?php
		}
	}
	?>
          </div>
          <div class="r_info comp mdl">
            <div class="r_details comp">
               <h6><a href="user/profile/<?php echo $userdetails['usr_id'];?>" ><?php echo $userdetails['usr_name'];?></a></h6>
              <span><?php echo  date("d-m-Y", strtotime($liker['date'])); ?></span> </div>
          </div>
        </div>
        <?php
}
?>
      </div>
      <div class="modal-footer"> </div>
    </div>
  </div>
</div>
<div class="modal fade" id="iuseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> |
  <div class="modal-dialog mdl" role="document">
    <div class="modal-content">
      <div class="modal-header mdl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title mdl" id="myModalLabel">
          <?php  $bookmark = $stats['iuse_count']; echo $bookmark = ($bookmark > 0 ? $bookmark : '0');  ?>
          I Use </h4>
      </div>
      <div class="modal-body mdl">
        <?php 
//var_dump($bookmarkModal );


foreach($iUseModal as $liker){
	
	$userdetails = $this->user_model->getUserDetailinRow($liker['usr_id']);
	?>
        <div class="rev_details company mdl">
          <div class="r_profile company mdl">
            <?php 
	if(trim($userdetails['register_method']) == trim('facebook')){
		?>
            <img src="http://graph.facebook.com/<?php echo $userdetails['social_id']; ?>/picture?type=square" alt="profile-pic" />
            <?php
	}
	else{
		if($userdetails['profile_image'] != ''){
			
			if (file_exists($userdetails['profile_image'])){ 
				?>
					<img src='<?php echo $userdetails['profile_image'] ?>' alt='profile-pic' />
				<?php
			}else{
				?>
				<img src="images/about-icon-md.png" alt="profile-pic">
				<?php 
			}
		}
		else{
			?>
            <img src="images/about-icon-md.png" alt="profile-pic" />
            <?php
		}
	}
	?>
          </div>
          <div class="r_info comp mdl">
            <div class="r_details comp">
              <h6><a href="user/profile/<?php echo $userdetails['usr_id'];?>" ><?php echo $userdetails['usr_name'];?></a></h6>
              <span><?php echo  date("d-m-Y", strtotime($liker['date'])); ?></span> </div>
          </div>
        </div>
        <?php
}
?>
      </div>
      <div class="modal-footer"> </div>
    </div>
  </div>
</div>