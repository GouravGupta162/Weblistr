    
<script>
$(document).ready(function (e) {
	var baseHref = document.getElementsByTagName('base')[0].href;
	$("#profileImageform").on('submit',(function(e) {
		e.preventDefault();
		
		$('#profileloader').show();
		$('#profilepicstatusChange').html("");
		
		$.ajax({
			url: baseHref + "user/updateProfileImage",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data)
			{
				
				if(data != 0)
				{
					$('#profileloader').hide();
					$('#profilepicstatusChange').html("<center><span class='infosuccess' >Profile picture changed successfully</span></center>");
					location.reload();
				}
				else{
					$('#profilepicstatusChange').html("<center><span class='infodanger' >Please try again later!!!</span></center>");
				}
			},
			error: function() 
			{
				
			}             
		});
	}));


	$("#changePasswordForm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: baseHref + "user/changePassword",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data)
			{
				//console.log(data);
				if(data == 'newpwdmatch')
				{
					$('#passwordChgStatus').html("<center><span class='infodanger' >New password and confirm password not matched</span></center>");
					//location.reload();
					setTimeout(function()
					{ $('#passwordChgStatus').html(""); },3000);
				}
				if(data == 'nosamepwd')
				{
					$('#passwordChgStatus').html("<center><span class='infodanger' >Please try again with correct values</span></center>");
					//location.reload();
					setTimeout(function()
					{ $('#passwordChgStatus').html(""); },3000);
				}
				else if((data != 'nosamepwd')&&(data != 'newpwdmatch')){
					$('#passwordChgStatus').html("<center><span class='infosuccess' >Password changed successfully</span></center>");
					setTimeout(function()
					{ $('#passwordChgStatus').html(""); $('#changepassword .close').click();
					window.location.href=baseHref;
					},3000);
				}
				
			},
			error: function() 
			{
				
			}             
		});
	}));
});
</script>
	
	

<div class="usr_options">
<div class="user-left">

<a href="javascript:void(0);">
<?php 
if($profilechanger == true)
{
	if(trim($this->session->userdata('register_method')) == trim('facebook'))
	{
		
	?>
	   <img src="http://graph.facebook.com/<?php echo $this->session->userdata('fb_profile'); ?>/picture?type=large" alt="profile-pic" />
	   <?php
	}
	else
	{
		if(sizeof($getUserImage) > 0)
		{
			$userprofile = $getUserImage[0];	
			//foreach($getUserImage as $userprofile)
			{
				$pimag = $userprofile['profile_image'];
				if(($pimag != '') && ($pimag != null))
				{
					$pimag = str_replace(" ","%20",$pimag);
					if($profilechanger == true){
						
						echo "<img src=$pimag alt='profile-pic' data-toggle='modal' data-target='#profileImage'>";
					}
					else
					{	echo "<img src=$pimag alt='profile-pic' >";
					}
				}
				else 
				{
					if($profilechanger == true){ 
					?>
					<img src="images/about-icon-md.png" alt="profile-pic" data-toggle="modal" data-target="#profileImage">
					<?php
					}
					else
					{	
						?>
						<img src="images/about-icon-md.png" alt="profile-pic" />
						<?php
					}
				}
			}
		}
		else 
		{
			if($profilechanger == true){				
			?>
				<img src="images/about-icon-md.png" alt="profile-pic" data-toggle="modal" data-target="#profileImage">
			<?php
			}
			else
			{
				?>
					<img src="images/about-icon-md.png" alt="profile-pic" />
				<?php
			}
		}
	}
}
else{
	if($getUserImage[0]['register_method']== 'facebook')
	{
		?>
			<img src="http://graph.facebook.com/<?php echo $getUserImage[0]['social_id'] ?>/picture?type=large" alt='profile-pic' >
		<?php
	}
	else{
		$pimag = $getUserImage[0]['profile_image'];
		if(($pimag != '') && ($pimag != null))
		{
			$pimag = str_replace(" ","%20",$pimag);
			if($profilechanger == true){
				
				echo "<img src=$pimag alt='profile-pic' data-toggle='modal' data-target='#profileImage'>";
			}
			else
			{	echo "<img src=$pimag alt='profile-pic' >";
			}
		}
		else 
		{
			if($profilechanger == true){ 
			?>
			<img src="images/about-icon-md.png" alt="profile-pic" data-toggle="modal" data-target="#profileImage">
			<?php
			}
			else
			{	
				?>
				<img src="images/about-icon-md.png" alt="profile-pic" />
				<?php
			}
		}
	}
}
 ?>


</a>
<div class="modal fade" id="profileImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog psd" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="loginModalLabel">Change Profile Image</h4>
      </div>
      <div class="modal-body psd">
       
<form class="form_style"  action="<?php echo base_url(); ?>user/updateProfileImage" method="post" id="profileImageform"  enctype="multipart/form-data">
          <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="file" name="file" />
	<div id="imagePreview"> </div>
    <!--<div class="browse_det"> JPG/PNG formats only<br>
Maximum size 5 MB<br>
Greater than 400px in height and width</div>-->
      </div>
	  
	  <div><button type='submit' value='Update' id="imagechange" name="imagechange" >UPLOAD</button>
	  <img id="profileloader" src="images/ajax-loader.gif" style="   display:none; width: 16px;    height: 16px;">

	   <div id='profilepicstatusChange'>
	  
	  </div>
	  <!--<input type="submit" text="Update" id="imagechange" name="imagechange" />-->
	  </div>
	  
</form>

      </div>
      
      <div class="modal-footer psd">
      
      </div>
    </div>
  </div>
</div>
</div>
<div class="usr_nm">
<h3>
<?php 
foreach($getUserName as $UserName)
{
	echo $UserName['usr_name'] ;
}

//echo $profilename;//$this->session->userdata('usr_name'); //profile name 

?></h3>

<?php 
//var_dump($getUserDetails);
foreach($getUserAddress as $address)
{
	$state = $address['state'];
	$country = $address['country'];
	 
	if (($state != '')&&($state != '0')&&($state != 'null')) {
		$resultstate = $this->user_model->getStateName($state);
		if (sizeof($resultstate) > 0) {
			?>
			<i class="fa fa-map-marker"></i><span>
			<?php
			echo  $resultstate[0]['state_name'];
		}
		}
		if (($country != '')&&($country != '0')&&($country != 'null')) {
		$resultcountry = $this->user_model->getCountryName($country);
		if (sizeof($resultcountry) > 0) {
			echo ', ' . $resultcountry[0]['country_name'];
		}
		}
	 
	//echo $address['city'] .','. $address['state_name'];
}
?>

</span>
</div>
<?php 
if(($this->session->userdata('usr_id') != '')&&($profilechanger == true))
//if($this->session->userdata('usr_id') != '')
{
	
?>
<div class="user_tabs">
<ul>
 <!--<li class="menu-left"><a href="user/profile"><i class="fa fa-bookmark-o"></i><span>Recent Activities</span><i class="fa fa-angle-right"></i></a></li>-->
 <?php
 if($this->session->userdata('admin_status') == '1')
		   {
			echo '<li><a href="user/company"><i class="fa fa-bookmark-o"></i><span>Company profile</span><i class="fa fa-angle-right"></i></a></li>';
						   
		   }
		   else{
  echo '<li><a href="user/bookmark"><i class="fa fa-bookmark-o"></i><span>My Weblist</span><i class="fa fa-angle-right"></i></a></li>';
  }
  ?>
<li><a href="user/editprofile"><i class="fa fa-pencil"></i><span>Edit Profile</span><i class="fa fa-angle-right"></i></a></li>
<!--<li class="menu-left"><a href="user/notification"><i class="fa fa-bell"></i><span>Notification</span><i class="fa fa-angle-right"></i></a></li>-->


<?php if(trim($this->session->userdata('register_method')) != trim('facebook'))
{
	?>
	  <li><a href="#"  data-toggle="modal" data-target="#changepassword"><i class="fa fa-pencil"></i><span>Change Password</span><i class="fa fa-angle-right"></i></a></li>  
	<?php 
}
?>

 <li><a href="user/bio/<?php echo $usrID; ?>" ><span><i class="fa fa-info-circle" aria-hidden="true"></i>About </span><i class="fa fa-angle-right"></i></a></li>  
</ul>
</div>
<?php 
}
else{
	?>
	<div class="user_tabs">
<ul>
 <li><a href="user/bio/<?php echo $usrID; ?>" ><i class="fa fa-info-circle" aria-hidden="true"></i>
<span>About </span><i class="fa fa-angle-right"></i></a></li>  
</ul>
</div>
	<?php
}
?>


</div>

<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog padding" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="loginModalLabel">Change Password</h4>
      </div>
	  
	  
	  <form class="form_style"  action="<?php echo base_url(); ?>user/changePassword" method="post" id="changePasswordForm" >

	  
      <div class="modal-body pwd">
      <div class="form-group pswrd">
		<label for="exampleInputPassword1">Current Password</label>
		<input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password"></div>
	  <div class="form-group pswrd">
		<label for="exampleInputPassword1">New Password</label>
		<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
	  </div>
	  <div class="form-group pswrd">
	  <label for="exampleInputPassword1">Confirm Password</label>
		<input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
	  </div>
      </div>
      
      <div class="modal-footer pwd">
       <div id='passwordChgStatus'></div>
      <p>  <button type="submit" class="chnge_btn">Save</button></p>
        
      </div>
	  </form>
    </div>
  </div>
</div>

