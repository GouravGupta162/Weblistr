    
<script>
	


function updateProfile(){
	var name = $('#name').val();
	var email = $('#email').val();
	var bio = $('#bio').val();
	var mobile = $('#mobile').val();
	var addr = $('#addr').val();
	var city = $('#city').val();
	var state = $('#state').val();
	var country = $('#country').val();
	 
	//console.log();
	userProfileUpdate(name, email, bio, mobile, addr, city, state, country);
}

function userProfileUpdate(name, email, bio, mobile, addr, city, state, country)
{
	var baseHref = document.getElementsByTagName('base')[0].href;showloader();
	$.ajax({
		url: baseHref + "user/userProfileUpdate",
		type: "POST",
		data:  {name:name, email:email, bio:bio, mobile:mobile, addr:addr, city:city, state:state, country:country},//{ revId:revId },//new FormData(this),
		success: function(data)
		{
			console.log(data);
			if(data != '0')
			{
				hideloader();
				$("#statusModal #eventModelHtml").html('<center><span  class="infosuccess" >Voila! Changes saved successfully.</span></center>');
				$("#statusModal").modal('show');
				setTimeout(function(){ $("#statusModal").modal('hide'); $("#statusModal #eventModelHtml").html(''); location.reload(); }, 3000);
				
				//location.reload();
			}
			
		},
		  error: function() 
		{
			
		}             
	});
}

</script>
	
	
<section class="user_profile">
<div class="container">
<div class="col-md-3 b_rt">
<?php include 'user_profile_left_view.php'; ?>
</div>


<div style="min-height: 600px; padding:0 10px;" class="col-md-6 user__settings divider-l-fix  divider--left divider--right">
    <div data-edit-page="profile" class="user__settings--tab profile active">
<div class="u_rev_head">Edit Profile</div>
	<form  method="POST" class="user-profile-edit-form" action="<?php echo base_url(); ?>user/userProfile" id="userProfileform"  >
        
<div>
	<p>
		<label for="name" class="label">Your full name*</label>
		<input type="text" value="<?php echo $this->session->userdata('usr_name'); //profile name ?>"
		placeholder="<?php echo $this->session->userdata('usr_name'); //profile name ?>" class="zui-form-input " name="name" id="name">
		<label class="error  hidden " id="name_error">Please enter your name</label>
		<label class="error  hidden " id="edit-form-error-name" style="display: none;">These characters aren't allowed: <b># ; &gt; &lt; ! - = ? *</b></label>
               
		

			
   
	<?php 
		
	if(sizeof($getUserDetails) > 0)
	{
		$userprofile= $getUserDetails[0];
		//foreach($getUserDetails as $userprofile)
		{
		
			if(trim($this->session->userdata('register_method')) != trim('facebook'))
			{

				$email_id = $userprofile['email_id'];
				if($email_id != '')
				{
					?>
					<label for="exampleInputEmail1" class="label">Email address*</label>
					 <input disabled='true' type="email" class="zui-form-input" id="email" name="email" placeholder="<?php echo $email_id; ?>"  value="<?php echo $email_id; ?>">
					<?php 
				}
				else{
					?>
					<label for="exampleInputEmail1" class="label">Email address*</label>
					 <input type="email" class="zui-form-input" id="email" name="email" placeholder="Email">
					<?php 
				}
			}
			
			$bio = $userprofile['bio'];
				?>
						<label for="bio" class="label">A little bit about yourself</label>
						<textarea class="zui-form-textarea" rowspan="5"  style='min-height:108px' name="bio" id="bio" maxlength='300' ><?php echo $bio; ?></textarea>
						<label class="bio_message " id="bio_error">Bio can be a maximum of 300 characters</label>
						<label class="bio_message bio_message_count " id="character-count">300 characters remaining</label>
				<?php 
			
			
			$mobile = $userprofile['mobile'];
		
				?>
					<label for="mobile" class="label">Your mobile number</label>
					<input type="text" value="<?php echo $mobile; ?>" name="mobile" class="zui-form-input " id="mobile">
					<label class="error  hidden " id="mobile_error">Please check your mobile number</label>
				<?php 
		
			
			$address = $userprofile['address'];
			
				?>
					<label for="addr" class="label">Address</label>
					<textarea class="zui-form-textarea" name="addr" id="addr"><?php echo $address; ?></textarea>
					<label class="error  hidden " id="addr_error">Please enter your address</label>
				<?php 
			
			
			$city = $userprofile['city'];
			
				?>
					<label for="city" class="label">City</label>
					<input type="text" value="<?php echo $city; ?>" name="city" class="zui-form-input " id="city">
					<label class="error  hidden " id="city_error">Please enter your city</label>
				<?php 
			
			
			
			$state = $userprofile['state'];
			if($state != '0')
			{
			 $getSelectState = $this->user_model->getSelectState($state);
			 //var_dump($getSelectState);
			 $selected = $getSelectState[0]['state_id'];
				?>
					 <label for="state" class="label">State</label>
						<select name="state" id="state" class="state zui-form-input ">
							<option selected="selected">--Select State--</option>
							<?php
							//var_dump($getState);
							foreach($getState as $state)
							{
								$state_id = $state['state_id'];
								$state_name = $state['state_name'];
								if($selected == $state_id)
								{
								echo "<option value='$state_id' selected >$state_name</option>";
								}
								else {echo "<option value='$state_id' >$state_name</option>";}
							}
							?>
						</select>
						<label class="error  hidden " id="state_error">please select state</label>
				<?php 
			}
			else{
				?>
					 <label for="state" class="label">State</label>
						<select name="state" id="state" class="state zui-form-input ">
							<option selected="selected">--Select State--</option>
							<?php
							//var_dump($getState);
							foreach($getState as $state)
							{
								$state_id = $state['state_id'];
								$state_name = $state['state_name'];
								echo "<option value='$state_id' >$state_name</option>";
							}
							?>
						</select>
						<label class="error  hidden " id="state_error">please select state</label>
				<?php 
			}
		}
	}?>
                   
                    <label for="mobile" class="label">Country</label>
					<select name="country" id="country" class="state zui-form-input " disabled >
						<option >--Select Country--</option>
						<option selected="selected" value='1' >India</option>
					</select>
					<label class="error  hidden " id="country_error">please select country</label>
                
                <p class="mtop2 submit-container">
                    <input type="button" value="Save" onclick="updateProfile()" class="btn sub-btn" name="submit" id="submit">
                </p>
            </div>
            <div class="clear"></div>
            <!-- End Edit Profile -->
        </form>
    </div>


</div>



<div class="col-md-3">


<div class="user_con user_book">
<h3>Follow Us On</h3>
<?php include 'user_profile_right.php'; ?>
</div>

<div class="user_rev">
</div>

</div>
</div>
</section>

<script>
$(document).ready(function() {
    var text_max = 300;
    $('#character-count').html(text_max + ' characters remaining');

    $('#bio').keyup(function() {
        var text_length = $('#bio').val().length;
        var text_remaining = text_max - text_length;

        $('#character-count').html(text_remaining + ' characters remaining');
    });
});
</script>

