

<section class="all_cat">
  <div class="container">
    <div class="col-md-12">
      <?php 
	  
	  if(sizeof($getCompanyProfile)>0)
	  {
	  
//var_dump($getCompanyProfile);
$prd_id = $getCompanyProfile['prd_id'];
$prd_name = $getCompanyProfile['prd_name'];
$prd_image = $getCompanyProfile['prd_image'];
$prd_info = $getCompanyProfile['prd_info'];
$prd_link = $getCompanyProfile['prd_link'];
$prd_number = $getCompanyProfile['prd_number'];

$stats = $this->write_review_model->getCompanyStats($prd_id);  

//var_dump($stats);

$likeModal = $this->write_review_model->getCompanylikeModalDetails($prd_id);  
$bookmarkModal = $this->write_review_model->getCompanybookmarkModalDetails($prd_id);  
$iUseModal = $this->write_review_model->getCompanyiuseModalDetails($prd_id);  
?>
      <div class="category pop profile"> <i aria-hidden="true" class="fa fa-user"></i> Company Profile <span><a href="user/companyReview/<?php echo $prd_id; ?>"><?php echo $this->write_review_model->getCountofReview($prd_id); ?> Reviews</a> | <a href="javascript:void(0);" data-toggle="modal" data-target="#LikeModal">
        <?php  $likes = $stats['prd_like_count']; echo $likes = ($likes > 0 ?  $likes : '0'); ?>
        I use</a> 

<!--		| <a href="#" data-toggle="modal" data-target="#iuseModal">
        <?php  //$iuse = $stats['iuse_count']; echo $iuse = ($iuse > 0 ?  $iuse : '0'); ?>
        I use</a>-->

		| <a href="#" data-toggle="modal" data-target="#BookmarksModal">
        <?php  $bookmark = $stats['bookmark_count']; echo $bookmark = ($bookmark > 0 ? $bookmark : '0');  ?>
        Bookmarks</a> 
        <!-- | 
<a href="#" data-toggle="modal" data-target="#ShareModel">5 Shares</a> | 
<a href="#" data-toggle="modal" data-target="#ActivityModal">10 Recent Activities</a>--> 
        
        </span> </div>
      <div class="cat-block">
         <div class="cart-header">
             <div class="pull-left">
             <span class="edit-form"><a href='weblist/edit/<?php echo $prd_id ?>'>edit <i class='fa fa-pencil'></i></a></span>
            <h1 class='h1catname'><?php echo $prd_name; ?></h1>
          </div>
        <div class="pull-right">
           <div class="cart-rating">
           <ul>
          
         
        
              <?php 
			  
			  $contact_model =& get_instance(); 
$contact_model->load->model("contact_model");
			  
			  
$getRatingSummary = $this->write_review_model->getRatingSummary($prd_id);
if((sizeof($getRatingSummary) > 0) && ($getRatingSummary != null)){
		
	$sum = 0;
	foreach($getRatingSummary as $getRatingSummaryvalue)
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
			?>
			<div class='effect-julia'><span><?php echo  $mainstar.'.'.$dotstar;  ?></span></div>
			<?php
			
		}
	}
	else{
		$contact_model->contact_model->ratingNewWrite($sum,'0');
			//writeStar($sum,'0');
			?>
			<div class='effect-julia'><span><?php echo  $sum.'.0';  ?></span></div>
			<!--<li><span class="c-count"><?php //echo $sum; ?>.0</span></li>-->
			<?php 
	}
}
else{
	$contact_model->contact_model->ratingNewWrite('0','0');
		//writeStar('0','0');
		?>
		<div class='effect-julia'><span><?php echo  '0.0';  ?></span></div>
		 <!--<li><span class="c-count">0.0</span></li>-->
		  <?php 
	}
?>
    </ul>        
          </div>
        </div>
        
         <div class="cat-des">
    <div class="row">
      <div class="col-md-4">      
      <div class="cat-prd-logo">
	  
	  <?php
	  if($prd_image != "")
	  {
		  if (file_exists($prd_image)){ 
			  ?>
			  <img src="<?php echo $prd_image; ?>" alt="food">
			  <?php
		  }else{
		   ?>
			  <img src="images/about-icon-md.png" >
			  <?php
		  }
	  }else{
		   ?>
		  <img src="images/about-icon-md.png" alt="food">
		  <?php
	  }
	  ?>
         
        </div>
      
      <div class="cart-app-list">
          <ul>
		  
		  
		  
   <li><a href="<?php echo $getCompanyProfile['ios_app_url'] = ($getCompanyProfile['ios_app_url'] != '' ? $getCompanyProfile['ios_app_url'] : 'javascript:void(0)');   ?>" title='<?php echo $getCompanyProfile['ios_app_url'] = ($getCompanyProfile['ios_app_url'] != 'javascript:void(0)' ? '' : 'Not Available');   ?>' target="_blank" class="apple"><i aria-hidden="true" class="fa fa-apple"></i></a></li>

  

     <li><a href="<?php echo $getCompanyProfile['android_app_url'] = ($getCompanyProfile['android_app_url']!= '' ? $getCompanyProfile['android_app_url'] : 'javascript:void(0)'); ?>" target="_blank" class="android" title='<?php echo $getCompanyProfile['android_app_url'] = ($getCompanyProfile['android_app_url'] != 'javascript:void(0)' ? '' : 'Not Available');   ?>'><i aria-hidden="true" class="fa fa-android"></i></a></li>

    <li><a href="<?php echo $getCompanyProfile['windows_app_url'] = ($getCompanyProfile['windows_app_url'] != '' ? $getCompanyProfile['windows_app_url'] : 'javascript:void(0)');  ?>" target="_blank"

  title='<?php echo $getCompanyProfile['windows_app_url'] = ($getCompanyProfile['windows_app_url'] != 'javascript:void(0)' ? '' : 'Not Available');   ?>' class="window"><i aria-hidden="true" class="fa fa-windows"></i></a></li>
  
		 
          </ul>
        </div>
            
      </div>
      
       <div class="col-md-8">
       <div class="cat-info">
       <h2>Description</h2>
          
        <div class="cart-add-des">
        <p><?php echo substr($prd_info,0,250); ?></p>
        </div> 
        
        <div class="cart-details">
          <ul>
            
            <!-- <li><strong>Customer support Id:</strong>  hello@zovi.com </li>-->
            
			<?php //echo $value->ios_app_url = ($value->ios_app_url != '' ? $value->ios_app_url : 'javascript:void(0)');   ?>
			
			<!--delivery_time-->
			
            <li><strong>Location:</strong><?php echo $getCompanyProfile['locations'] = ($getCompanyProfile['locations'] != '' ? $getCompanyProfile['locations'] : 'N/A');   ?>  </li>
            <li><strong>Delivery Time:</strong> <?php echo $getCompanyProfile['delivery_time'] = ($getCompanyProfile['delivery_time'] != '' ? $getCompanyProfile['delivery_time'] : 'N/A');   ?> </li>
          </ul>
        </div>
        
		  <div class="r_mail profile">
                <li><i class="fa fa-envelope"></i><a href="javascript:void(0)"><?php echo $prd_link; ?></a></li>
				
				
				<?php 
				
				if($prd_number != '')
				{
				?>
					<li><i class="fa fa-phone"></i><?php echo $prd_number; ?></li>
				<?php				
				}
				?>
				
				
                
              </div>
          
       </div>
       
          
       </div>
       
       
       <div class="col-md-12">
       <div class="m">
       <div class="row">
        <div class="col-md-6">
         <div class="service-col">
          <div class="svr-c">
            <h1>Services Offered</h1>
            <ul>
              <li><?php echo $getCompanyProfile['services_offered'] = ($getCompanyProfile['services_offered'] != '' ? $getCompanyProfile['services_offered'] : 'N/A');   ?> </li>
            </ul>
          </div>
          </div>
          </div>
             <div class="col-md-6">
              <div class="service-col">
          <div class="svr-c">
            <h1>Payment</h1>
            <ul>
              <li><?php echo $getCompanyProfile['payment_option'] = ($getCompanyProfile['payment_option'] != '' ? $getCompanyProfile['payment_option'] : 'N/A');   ?> </li>
            </ul>
          </div>
          </div>
          </div>
          
          

  
       </div>
       </div>
      </div>
      
      
      </div>
      </div>
        
        
       <!-- 
        <div class="col-md-8 col-sm-8 sp">
          <div class="f_add">
            <h4>Description</h4>
            <div class="f_map">
              <div class="add profile"><?php echo substr($prd_info,0,250); ?> </div>
              <div class="r_mail profile">
                <li><i class="fa fa-envelope"></i><a href="javascript:void(0)"><?php echo $prd_link; ?></a></li>
                <li><i class="fa fa-phone"></i><?php echo $prd_number; ?></li>
                <li><i class="fa fa-map-marker"></i><a href="javascript:void(0)"><?php echo $prd_link; ?></li>
              </div>
              <div class="r_mail"></div>
            </div>
          </div>
        </div>
        -->
        
        
        
        <div class="col-md-12">
          <div class="rate-right full profile">
            <div class="modal fade" id="ShareModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog mdl" role="document">
                <div class="modal-content">
                  <div class="modal-header mdl">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title mdl" id="myModalLabel">5 Shares</h4>
                  </div>
                  <div class="modal-body mdl">
                    <div class="rev_details company mdl">
                      <div class="r_profile company mdl"> <img alt="profile-pic" src="images/p3.jpg"> </div>
                      <div class="r_info comp mdl">
                        <div class="r_details comp">
                          <h6>John Smith</h6>
                          <span>7thApr,2016 | 11:20:20</span> </div>
                      </div>
                    </div>
                    <div class="rev_details company mdl">
                      <div class="r_profile company mdl"> <img alt="profile-pic" src="images/p3.jpg"> </div>
                      <div class="r_info comp mdl">
                        <div class="r_details comp">
                          <h6>John Smith</h6>
                          <span>7thApr,2016 | 11:20:20</span> </div>
                      </div>
                    </div>
                    <div class="rev_details company mdl">
                      <div class="r_profile company mdl"> <img alt="profile-pic" src="images/p3.jpg"> </div>
                      <div class="r_info comp mdl">
                        <div class="r_details comp">
                          <h6>John Smith</h6>
                          <span>7thApr,2016 | 11:20:20</span> </div>
                      </div>
                    </div>
                    <div class="rev_details company mdl">
                      <div class="r_profile company mdl"> <img alt="profile-pic" src="images/p3.jpg"> </div>
                      <div class="r_info comp mdl">
                        <div class="r_details comp">
                          <h6>John Smith</h6>
                          <span>7thApr,2016 | 11:20:20</span> </div>
                      </div>
                    </div>
                    <div class="rev_details company mdl">
                      <div class="r_profile company mdl"> <img alt="profile-pic" src="images/p3.jpg"> </div>
                      <div class="r_info comp mdl">
                        <div class="r_details comp">
                          <h6>John Smith</h6>
                          <span>7thApr,2016 | 11:20:20</span> </div>
                      </div>
                    </div>
                    <div class="rev_details company mdl">
                      <div class="r_profile company mdl"> <img alt="profile-pic" src="images/p3.jpg"> </div>
                      <div class="r_info comp mdl">
                        <div class="r_details comp">
                          <h6>John Smith</h6>
                          <span>7thApr,2016 | 11:20:20</span> </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer"> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  <?php 
	  }
	  else{
		  ?>
		  <style>
.dummyheight{
	height:170px;
}
</style>

		  <div class="nocontent dummyheight">
		  <h2>
			Wait for company approval
		  </h2>
		  </div>
		  <?php
	  }
	  ?>
    </div>
  </div>
</section>

<!----like modal start---->
<div class="modal fade" id="LikeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog mdl" role="document">
    <div class="modal-content">
      <div class="modal-header mdl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title mdl" id="myModalLabel">
          <?php  $likes = $stats['prd_like_count']; echo $likes = ($likes > 0 ?  $likes : '0'); ?> I use
          <!--Likes-->
		  </h4>
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
			?>
            <img src='<?php echo $userdetails['profile_image'] ?>' alt='profile-pic' />
            <?php
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
			?>
            <img src='<?php echo $userdetails['profile_image'] ?>' alt='profile-pic' />
            <?php
		}
		else{
			?>
            <img src="http://www.clker.com/cliparts/M/o/W/d/C/j/about-icon-md.png" alt="profile-pic" />
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
			?>
            <img src='<?php echo $userdetails['profile_image'] ?>' alt='profile-pic' />
            <?php
		}
		else{
			?>
            <img src="http://www.clker.com/cliparts/M/o/W/d/C/j/about-icon-md.png" alt="profile-pic" />
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
<div class="modal fade" id="ActivityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> |
  <div class="modal-dialog mdl act" role="document">
    <div class="modal-content">
      <div class="modal-header mdl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title mdl" id="myModalLabel">10 Recent Activities</h4>
      </div>
      <div class="modal-body mdl">
        <div class="rev_details company mdl act">
          <div class="r_profile company mdl"> <img alt="profile-pic" src="images/p3.jpg"> </div>
          <div class="r_info comp mdl act">
            <div class="r_details comp act">
              <h6>John Smith
                <p>Phasellus viverra nulla ut metus varius laoreet</p>
              </h6>
              <span> 11:20:20</span> </div>
          </div>
          <div class="p_activity"><img src="images/p4.jpg"></div>
        </div>
        <div class="rev_details company mdl act">
          <div class="r_profile company mdl"> <img alt="profile-pic" src="images/p3.jpg"> </div>
          <div class="r_info comp mdl act">
            <div class="r_details comp act">
              <h6>John Smith
                <p>Phasellus viverra nulla ut metus varius laoreet</p>
              </h6>
              <span> 11:20:20</span> </div>
          </div>
          <div class="p_activity"></div>
        </div>
        <div class="rev_details company mdl act">
          <div class="r_profile company mdl"> <img alt="profile-pic" src="images/p3.jpg"> </div>
          <div class="r_info comp mdl act">
            <div class="r_details comp act">
              <h6>John Smith
                <p>Phasellus viverra nulla ut metus varius laoreet</p>
              </h6>
              <span> 11:20:20</span> </div>
          </div>
          <div class="p_activity"><img src="images/p4.jpg"></div>
        </div>
        <div class="rev_details company mdl act">
          <div class="r_profile company mdl"> <img alt="profile-pic" src="images/p3.jpg"> </div>
          <div class="r_info comp mdl act">
            <div class="r_details comp act">
              <h6>John Smith
                <p>Phasellus viverra nulla ut metus varius laoreet</p>
              </h6>
              <span> 11:20:20</span> </div>
          </div>
          <div class="p_activity"></div>
        </div>
        <div class="rev_details company mdl act">
          <div class="r_profile company mdl"> <img alt="profile-pic" src="images/p3.jpg"> </div>
          <div class="r_info comp mdl act">
            <div class="r_details comp act">
              <h6>John Smith
                <p>Phasellus viverra nulla ut metus varius laoreet</p>
              </h6>
              <span> 11:20:20</span> </div>
          </div>
          <div class="p_activity"><img src="images/p4.jpg"></div>
        </div>
        <div class="rev_details company mdl act">
          <div class="r_profile company mdl"> <img alt="profile-pic" src="images/p3.jpg"> </div>
          <div class="r_info comp mdl act">
            <div class="r_details comp act">
              <h6>John Smith
                <p>Phasellus viverra nulla ut metus varius laoreet</p>
              </h6>
              <span> 11:20:20</span> </div>
          </div>
          <div class="p_activity"><img src="images/p4.jpg"></div>
        </div>
        <div class="rev_details company mdl act">
          <div class="r_profile company mdl"> <img alt="profile-pic" src="images/p3.jpg"> </div>
          <div class="r_info comp mdl act">
            <div class="r_details comp act">
              <h6>John Smith
                <p>Phasellus viverra nulla ut metus varius laoreet</p>
              </h6>
              <span> 11:20:20</span> </div>
          </div>
          <div class="p_activity"><img src="images/p4.jpg"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="signup_btn">View more</button>
      </div>
    </div>
  </div>
</div>
<?php 

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
<li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li>
<?php 
		}
		else if($main == '3'){
			?>
<li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li>
<?php 
		}
		else if($main == 4){
			?>
<li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li>
<?php 
		}		
		else if($main == 5){
			?>
<li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li>
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
<li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li>
<?php 
		}
		else if($main == 3){
			?>
<li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li>
<?php 
		}
		else if($main == 4){
			?>
<li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li>
<?php 
		}		
		else if($main == 5){
			?>
<li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li>
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
<li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li>
<?php 
		}
		else if($main == 3){
			?>
<li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li>
<?php 
		}
		else if($main == 4){
			?>
<li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li>
<?php 
		}		
		else if($main == 5){
			?>
<li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li><li><i class="fa fa-star"></i></li>
<?php 
		}	
		}
	}
}
?>
