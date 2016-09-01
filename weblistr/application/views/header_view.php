<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<title><?php echo $title; ?> </title>
<base href="<?php echo base_url(); ?>" />
<!-- Bootstrap -->

<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="googlefonts/OpenSans.css" rel="stylesheet" type="text/css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap-select.min.css">
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">


<script type="text/javascript" src="js/jquery.js" async></script>
<script type="text/javascript" src="js/jquery.min.js" async></script>

<script type="text/javascript" src="js/jquery.masterblaster.js" async></script> 
<link rel="stylesheet" type="text/css" href="css/jquery.masterblaster.css" />

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js" async></script>
<script src="js/bootstrap-select.min.js" async></script>
<script src="js/customscript.js" async></script>
<script src="js/working.js" async></script>


<script src="https://connect.facebook.net/en_US/all.js" async></script> 

<script>
$(document).ready(function() {
 

var fbchecker = localStorage.getItem("fbchecker");
	  
if(!fbchecker)	  
{
	localStorage.setItem("fbchecker",'0');
	//$.cookie("fbchecker",0);
	}
});  
	  
function fbAsyncInit() {
	FB.init({
		appId      : '1043892665684730',
		status     : true, // check login status
		cookie     : true, // enable cookies to allow the server to access the session
		xfbml      : true  // parse XFBML
	});
}
	
	
function fblogIn() {
	fbAsyncInit();  
	FB.login(
		function(response) {
			if (response.status== 'connected') {
				FB.api('/me', function(response) {
					//console.log(response);
					//console.log('Good to see you, ' + response.name + '.');
					
					var baseHref = document.getElementsByTagName('base')[0].href;
					$.post(baseHref + "user/fb_registration", { fbid:response.id, fbname:response.name  },  
						function(result){
							var fbchecker = localStorage.getItem("fbchecker");
							
							if(fbchecker != 1)
							{	
								localStorage.setItem("fbchecker", "1");
								location.reload();
							}
					});    
				});

				FB.api("/me/picture?width=200&redirect=0&type=normal&height=200", function (response) {
					if (response && !response.error) {
						/* handle the result */
						console.log('PIC ::', response);
						$('#userPic').attr('src', response.data.url);
					}
				});
			}
		}
	);
};
 
</script>


<script type="text/javascript">



function companysignupvalidation()
{
	email=$('#com_uname').val();
	phone=$('#com_phone').val();
	comname=$('#com_name').val();
	url=$('#com_url').val();
	cat=$('#com_cat').val();
	pass=$('#com_pass').val();
	var error = false;
	var msg = 'msg';
	if(email == "")
	{
		$('#com_uname'+msg).html('please enter email');
		$('#com_uname').focus();
		errormsg  = true;
		setTimeout(function() { $('#com_uname'+msg).html(''); },3000);
		return false;
	}
	else if(!isValidEmailAddress(email)){
		$('#com_uname'+msg).html('please enter valid email');
		$('#com_uname').focus();
		setTimeout(function() { $('#com_uname'+msg).html(''); },3000);
		errormsg  = true;
		return false;
	}
	if(phone == "")
	{
		$('#com_phone'+msg).html('please enter phone number');
		$('#com_phone').focus();
		errormsg  = true;
		setTimeout(function() { $('#com_phone'+msg).html(''); },3000);
		return false;
	}
	if(comname == "")
	{
		$('#com_name'+msg).html('please enter company name');
		$('#com_name').focus();
		errormsg  = true;
		setTimeout(function() { $('#com_name'+msg).html(''); },3000);
		return false;
	}
	if(url == "")
	{
		$('#com_url'+msg).html('please enter company url');
		$('#com_url').focus();
		errormsg  = true;
		setTimeout(function() { $('#com_url'+msg).html(''); },3000);
		return false;
	}
	if((cat == "")||(cat == "0")||(cat == "null"))
	{
		$('#com_cat'+msg).html('please select company category');
		$('#com_cat').focus();
		errormsg  = true;
		setTimeout(function() { $('#com_cat'+msg).html(''); },3000);
		return false;
	}
	if(pass == "")
	{
		$('#com_pass'+msg).html('please enter your password');
		$('#com_pass').focus();
		errormsg  = true;
		setTimeout(function() { $('#com_pass'+msg).html(''); },3000);
		return false;
	}
	else if(error == false)
	{
		showloader();
		var baseHref = document.getElementsByTagName('base')[0].href;
		$.ajax({
			type: "POST",
			url: baseHref+"user/com_signup", 
			data: { uname:comname,email:email,pwd:pass,cat:cat,url:url,phone:phone }, //new FormData('#signup-form'),//
			success: 
              function(data){
				  hideloader();
                console.log(data);  //as a debugging message.
					if(data == "someonealloted"){
						
						$("#statusModal #eventModelHtml").html('<center><span  class="infodanger" >Website already listed please contact customer care</span></center>');
						$("#statusModal").modal('show');
						
						setTimeout(function()
						{ 
							$("#statusModal #eventModelHtml").html('');
							$("#statusModal").modal('hide');
						},6000);
					}
					else if((data != "noregister")&&(data != "someonealloted")){
						//comsignup-form
					
					$('form').each(function() { this.reset() }); // all forms reseting if user click on close button
					
					//$("#signup_modal_header1").show();
					$("#com_bannedStatus_signup").html('<h4 class="infosuccess" class="modal-title" >'+data+'</h4>');
					$("#com_bannedStatus_signup").show();
					//$("#comsignup-form").reset();
					//document.getElementById("signup-form").reset();
					
					setTimeout(function()
					{ 
						$("#com_bannedStatus_signup").html('');
						$("#CompanysignupModal").modal('hide');
						$('#CompanysignupModal .close').click();
						$("#statusModal .close").click();
						//$("#signupModal").hide();
						$("#statusModal #eventModelHtml").html('<center><span  class="infosuccess" >Yaay! You’re one step closer to be onboard. Please check your registered email id.</span></center>');
						
						//$("#statusModal #eventModelHtml").html('<center><span  class="infosuccess" >We sent you a verification mail, Please verify to enjoy our services.</span></center>');
						$("#statusModal").modal('show');
					},3000);
					
					setTimeout(function()
					{ 
						$("#statusModal #eventModelHtml").html('');
						$("#statusModal").modal('hide');
					},6000);
				}
				else if (data == 'noregister'){
					
						$("#comsignup-form #com_bannedStatus_signup").html('<h4 class="infodanger modal-title" >email already in our db</h4>');
						//$("#msg_response").show();
						setTimeout(function()
						{ 
						$("#comsignup-form #com_bannedStatus_signup").html(''); 
						//$("#msg_response").hide();
					},3000);
					
				}
              }
          });
	} // you have missed this bracket
		return false;
		
	 	//$("#submit_signup").trigger("click");
}

$( document ).ready(function() {
  $('form').each(function() { this.reset() });
});

function validation()
{
	//resetForm();
	$('#fnamemsg').html('');
	$('#emailmsg').html('');
	$('#pwdmsg').html('');
	$('#conpwdmsg').html('');
	
	var uname =  $('#user_name').val(), email =	$('#email_address').val(), pwd = $('#password').val(), con_pwd = $('#con_password').val();
	var errormsg  = false;
	if(uname != "")
	{
		
	}
	else
	{
		$('#fnamemsg').html('please enter Full Name');
		$('#user_name').focus();
		errormsg  = true;
		setTimeout(function() { $('#fnamemsg').html(''); },3000);
		return false;
	}
	if(email != "")
	{
		if(isValidEmailAddress(email))
		{
			
			
		}
		else{
			$('#emailmsg').html('please enter valid email');
			$('#email_address').focus();
			setTimeout(function() { $('#emailmsg').html(''); },3000);
			errormsg  = true;
			return false;
		}
	}
	else 
	{
		$('#emailmsg').html('please enter email');
		$('#email_address').focus();
		setTimeout(function() { $('#emailmsg').html(''); },3000);
		errormsg  = true;
		return false;
	}
	if(pwd != "")
	{
		
	}
	else
	{
		$('#pwdmsg').html('please enter password');
		$('#password').focus();
		setTimeout(function() { $('#pwdmsg').html(''); },3000);
		errormsg  = true;
		return false;
	}
	if(con_pwd != "")
	{
		
	}
	else
	{
		$('#conpwdmsg').html('please enter confirm password');
		$('#con_password').focus();
		setTimeout(function() { $('#conpwdmsg').html(''); },3000);
		errormsg  = true;
		return false;
	}
	if(con_pwd != pwd)
	{
		$('#conpwdmsg').html('password not matched');
		$('#con_password').focus();
		setTimeout(function() { $('#conpwdmsg').html(''); },3000);
		errormsg  = true;
		return false;
	}
	if(errormsg == false)
	{
		showloader();
		var baseHref = document.getElementsByTagName('base')[0].href;
		$.ajax({
         type: "POST",
         url: baseHref+"user/registration", 
         data: { uname:uname,email:email,pwd:pwd,con_pwd:con_pwd }, //new FormData('#signup-form'),//
		 success: 
              function(data){
				  hideloader();
                //console.log(data);  //as a debugging message.
				if(data != "noregister"){
					$("#signup-form").hide();
					//$("#signup_modal_header1").show();
					$("#msg_response").html('<h4 class="infosuccess" class="modal-title" >'+data+'</h4>');
					$("#msg_response").show();
					$("#signup-form .modal-footer").hide();
					
					//$("#signup-form").reset();
					//document.getElementById("signup-form").reset();
					
					setTimeout(function()
					{ 
					// $("#signup-form").show();
					// $("#signup_modal_header1").hide();
					// $("#msg_response").html('');
					// $("#signup_modal_header2").show();
					// $("#signupModal").show();
					// $(".modal-footer").show();				
						$("#signupModal .close").click();
					//$("#signupModal").hide();
						$("#statusModal #eventModelHtml").html('<center><span  class="infosuccess" >We sent you a verification mail, Please verify to enjoy our services.</span></center>');
						$("#statusModal").modal('show');
						$("#msg_response").hide();
						$("#msg_response").html('')
						$("#signup-form").show();
					},3000);

					setTimeout(function()
					{ 
						$("#statusModal #eventModelHtml").html('<center><span  class="infosuccess" >We sent you a verification mail, Please verify to enjoy our services.</span></center>');
						$("#statusModal").modal('hide');
					},6000);
				}
				else{
						$("#msg_response").html('<h4 class="infodanger modal-title" >This email id has already been registered.</h4>');
						$("#msg_response").show();
						setTimeout(function()
						{ 
						$('#msg_response').html(''); 
						$("#msg_response").hide();
					},3000);
					
				}
              }
          });// you have missed this bracket
		return false;
	 	//$("#submit_signup").trigger("click");
	}
	else{
	     return false;
	}
}
function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}
function resetForm()
{
	$('#fnamemsg').html('');
	$('#emailmsg').html('');
	$('#pwdmsg').html('');
	$('#conpwdmsg').html('');
}
</script>





</head>
<body>
<?php 
//echo $this->config->item('web_title');  
//echo $web_title; ?>

	<header>
    <div class="container">
    <div class="top-header">
    <div class="row">
    <div class="col-lg-3 col-sm-3 col-xs-12">
    <div class="logo">
	<a href="<?php echo base_url(); ?>">
      <img src="images/logo.png"  alt="logo"></a></div>
      </div>
      <div class="col-md-9 col-sm-9 col-xs-12 top-rt">
	   <?php 
	   if($this->session->userdata('usr_id') == '')
	   {
	   ?><div class="top-login">
			<button type="submit" class="login-btn" data-toggle="modal" data-target="#loginModal" >login</button>
			<button type="submit" data-toggle="modal" data-target="#signupModal" class="signup-btn">signup</button>
			<button type="submit" class="login-btn" data-toggle="modal" data-target="#CompanyModal" >Company Account</button>
	   </div>
	   <?php 
	   }
	   else{
		   //user profile showing start here
		   ?>
		   <div class="user_pro">
		   
		  <!--<span><?php echo $this->session->userdata('usr_name'); //profile name ?></h3>
		  </span>-->
		  </a>
		  <div class="top-login drop">
          <?php 
		    if($this->session->userdata('admin_status') == '1')
		   {
			?>
				<a href="user/company" class="user-top-pic" style="text-decoration:none" >
			<?php 			   
		   }
		   else{
		   ?>
				<a href="user/bookmark" class="user-top-pic" style="text-decoration:none" >
			<?php 
		   }
		   //echo trim($this->session->userdata('register_method'));
			if(trim($this->session->userdata('register_method')) == trim('facebook')){
			   ?>
			   <img src="http://graph.facebook.com/<?php echo $this->session->userdata('fb_profile'); ?>/picture?type=square" alt="profile-pic" />
			   <?php
			}
			else 
			{
				if($this->session->userdata('usr_id') != ''){
					//$getUserDetails = $this->user_model->getUserDetails($this->session->userdata('usr_id'));
					$getUserDetails = $this->user_model->userimage($this->session->userdata('usr_id'));
					//var_dump($getUserDetails);
					if(sizeof($getUserDetails) > 0)
					{
						//foreach($getUserDetails as $userprofile)
						{
							$pimag = $getUserDetails['profile_image'];
							if(($pimag != '') && ($pimag != null))
							{
								if (file_exists($pimag)){ 
								?>
									<img src='<?php echo $pimag ?>' alt='profile-pic' />
								<?php
								}
								else 
								{
								?>
									<img src="images/about-icon-md.png" alt="profile-pic" />
								<?php
								}
							}
							else 
							{
							?>
								<img src="images/about-icon-md.png" alt="profile-pic" />
							<?php
							}
						}
					}
					else 
					{
					?>
						<img src="images/about-icon-md.png" alt="profile-pic" />
					<?php
					}
				}
				else 
				{
				?>
					<img src="images/about-icon-md.png" alt="profile-pic" />
				<?php
				}
				
			}
			?> 
			<span class="profile-name">
			<?php //echo substr($this->session->userdata('usr_name'),0,10); 
			  
				$str = $this->session->userdata('usr_name');
				$unameraay = explode(" ",$str);
				echo substr($unameraay[0],0,11)
			?>
			</span>
		   <ul class="nav navbar-nav pro-drop">
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle a-user" data-toggle="dropdown"><i class="fa fa-bars"></i></span></a>
			  <ul class="dropdown-menu pdn">
			  
		<!--<li class="menu-mgn"><a href="user/profile"><i class="fa fa-bookmark-o"></i><span>Recent Activities</span></a></li>
		<li class="divider"></li>-->
		<?php if($this->session->userdata('admin_status') == '0')
		{
		?>
		<li class="menu-mgn"><a href="user/bookmark"><i class="fa fa-bookmark-o"></i><span>My Weblist</span></a></li>
		<?php
		}
		?>
		<?php if($this->session->userdata('admin_status') == '1')
	   {
		   ?>
		  <!-- <li class="menu-mgn"><a href="user/company"><i aria-hidden="true" class="fa fa-user"></i><span>Company Profile</span></a></li>-->
		  
		   <?php
	   }
		   ?>


		<li class="menu-mgn"><a href="user/editprofile"><i class="fa fa-pencil"></i><span>Edit Profile</span></a></li>

		 <!--<li class="menu-mgn"><a href="user/notifiation"><i class="fa fa-bell"></i>Notifications</a></li>
		<li class="divider"></li>-->
		<li class="menu-mgn"><a href="javascript:void(0);" id="logout" onclick="logout()"><i class="fa fa-user"></i>Log Out</a></li>

			  </ul>
			</li>
		  </ul>
		  </div>
		  </div>
	   
	   <?php 
		   //User profile showing end here
	   }
	   ?>
       <!--<div class="top-login">
	   <?php 
	   if($this->session->userdata('usr_id') == '')
	   {
	   ?>
       <button type="submit" class="login-btn" data-toggle="modal" data-target="#loginModal" >login</button>
	   <button type="submit" data-toggle="modal" data-target="#signupModal" class="signup-btn">signup</button>
	   <?php 
	   }
	   else{
		   ?>
	   <button type="submit" id="logout" onclick="logout()" class="signup-btn">logout</button>
	   <?php 
		   
	   }
	   ?>
      </div>-->
      
     
      
      </div>
      
    </div>
    </div>
    </div>
    <div class="nav-bg">
   <div class="container">
   
   <nav class="navbar navbar-default menu">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed color" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     
    </div>
<?php //echo $this->uri->rsegments['1'];?>
 <div class="collapse navbar-collapse pd" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav" style="float: left;">	  <!--<script src="js/jquery.cookie.js"></script>-->
  <li class="<?php if(($this->uri->rsegments['1'] == "user")&&($this->uri->rsegments['2'] != "company")&&($this->uri->rsegments['2'] != "companyReview")) { echo 'active'; } ?>"><a href="" >Home</a></li>
  <li class="<?php if($this->uri->rsegments['1'] == 'category') { echo 'active'; } ?>"><a href="<?php echo base_url().('category'); ?>">Category</a></li>
  <li class="<?php if($this->uri->rsegments['1'] == 'review') { echo 'active'; } ?>" ><a href="<?php echo base_url().('review/write'); ?>" >Write a Review</a></li>
  <li class="<?php if($this->uri->rsegments['1'] == 'featured') { echo 'active'; } ?>"><a href="<?php echo base_url().('featured'); ?>" >Featured</a></li>
  <li class="<?php if($this->uri->rsegments['1'] == 'weblist') { echo 'active'; } ?>"><a href="<?php echo base_url().('weblist'); ?>" >List a company</a></li>
  <li><a href="http://www.theweblisters.com/blog/">Blog</a></li>
	  
</ul>
<?php if ($this->uri->rsegments['1'] != "user") {
			if(
				($this->uri->rsegments['2'] != "write") && ($this->uri->rsegments['1'] != "review")
			)
			{  include 'search_header.php';  }
			
			
		}
		if ($this->uri->rsegments['1'] == "user") {
		if(($this->uri->rsegments['2'] == "bookmark")||($this->uri->rsegments['2'] == "profile"))
			{  include 'search_header.php';  }
		}
	?>
	  
      </ul>
    </div>
</nav>
   </div>
    </div>
    
    </header>
	
	<!--Signup Popup HTML Start-->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
 <div class="modal-dialog width" role="document">
   <div class="modal-content">
     <div class="modal-header" style="display:none" id="signup_modal_header1">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      
     </div>
     <div class="modal-header" id="signup_modal_header2">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title" id="loginModalLabel">Sign Up below. It's absolutely FREE!</h4>
     </div>
	 <div id="signup_modal_content">
     <div class="modal-body">
 <!-- login with fb Start-->	 	 

 <button type="button" class="fb_btn" onclick='fblogIn()'><span><i class="fa fa-facebook-f"></i></span> Login With Facebook </button>
	
	
	
	
       <p class="legal_copy">Don't worry, we never post without your permission.</p>
       <div class="s_text">
   
     
     <h3>
     <span class="">OR</span></h3></div>
	 <center id="msg_response"> </center>
    <form action="<?php echo base_url(); ?>user/registration" method="post" id="signup-form" onsubmit='return false'>
	 <div class="form-group">
           <label for="recipient-name" class="control-label">Full Name</label>
           <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Full Name" value="<?php echo set_value('user_name'); ?>" />
		     <div id="fnamemsg" class='infodanger'></div>
	</div>
	 <div class="form-group">
   <label for="exampleInputEmail1">Email address</label>
   <input type="text" class="form-control" id="email_address" name="email_address"  placeholder="Email" value="<?php echo set_value('email_address'); ?>" />
   <div id="emailmsg" class='infodanger'></div>
 </div>
 <div class="form-group">
   <label for="exampleInputPassword1">Password</label>
   <input type="password" class="form-control"  placeholder="Password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
   <div id="pwdmsg" class='infodanger'></div>
   
 </div>
 <div class="form-group">
   <label for="exampleInputPassword1">Confirm Password</label>
   <input type="password" class="form-control"  placeholder="Confirm Password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" />
   <div id="conpwdmsg" class='infodanger'></div>
 </div>
 <p class="legal_copy">By signing up, you agree to Terms of Service and Privacy Policy.</p>  
     </div>
     <div class="modal-footer">
	
       <button type="submit" onclick="validation()" name="submit" class="signup_btn">Sign Up</button>
	   <!--<input type="submit" style="display:none"  name="submit_signup" id="submit_signup" />-->
     </div> 
	 </form><?php //echo form_close(); ?>
	 </div>
   </div>
 </div>
</div>  




<!--forgot pwd-->
<div class="modal fade" id="forgotpwd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
 <div class="modal-dialog padding" role="document">
   <div class="modal-content">
     <div class="modal-header">
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4>Forgot Password</h4>
      
     </div>
     <div class="modal-body">
     <div class="row">
     <div class="col-md-12">
     
	 <center id="forgot_response"> </center>
<form class="form-horizontal" action="<?php echo base_url(); ?>user/forgot" method="post" id="forgot-form" onsubmit='return false'>
 <div class="form-group">
   <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
   <div class="col-sm-10">
    <input type="text" class="form-control" id="forgot_email_address" name="forgot_email_address"  placeholder="Email" autocomplete='off' />
   </div>
 </div>

 <div class="form-group">
   <div class="col-sm-offset-2 col-sm-9">
     <button type="submit" onclick="forgotvalidation()" name="submit" class="login_btn">Recover</button>
	 <!--<button type="button" onclick="forgotvalidation()" name="submit" class="login_btn">forg</button>-->
   </div>
 </div>
</form>
     </div></div></div>
     
    
   </div>
 </div>
</div>
<!--Signip Popup HTML End-->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
 <div class="modal-dialog padding" role="document">
   <div class="modal-content">
     <div class="modal-header">
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4>Login With Username</h4>
      
     </div>
     <div class="modal-body">
	 
 <!-- login with fb Start-->	 	 

 <button type="button" class="fb_btn" onclick='fblogIn()'><span><i class="fa fa-facebook-f"></i></span> Login With Facebook </button>
	
	
	
	  <p class="legal_copy">Dont worry, we never post without your permission.</p>
       <div class="s_text">
   
     
     <h3>
     <span class="">OR</span></h3></div>
	 
	 <center id="login_response"> </center>
<form class="form-horizontal" action="<?php echo base_url(); ?>user/login" method="post" id="login-form" onsubmit='return false'>
       
 <div class="form-group">
   <label for="inputEmail3" class="col-sm-3 control-label">Username</label>
   <div class="col-sm-9">
    <input type="text" class="form-control" id="login_email_address" name="login_email_address" autocomplete="off"  placeholder="Email" value="<?php echo set_value('email_address'); ?>" />
	 <div id="loginemailmsg"></div>
   </div>
 </div>
 <div class="form-group">
   <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
   <div class="col-sm-9">
   <input type="password" class="form-control"  placeholder="Password" id="login_password" name="login_password"  autocomplete="off" value="<?php echo set_value('password'); ?>" />
    <div id="loginpwdmsg"></div>
   </div>
 </div>
 <div class="form-group">
<div class='modalFrom'> </div>
</div>
 <div class="form-group">
   <div class="col-sm-offset-3 col-sm-10">
   <div id='bannedStatus'></div>
     <button type="submit" onclick="loginvalidation()" name="submit" class="mainlogin login_btn">LOGIN</button>
	   <!--<input type="submit" style="display:none"  name="login_signup" id="login_signup" />-->
   </div>
 </div>
</form>
     </div>
     
     <div class="modal-footer">
     <p><button class="reset_btn" onclick="show_forgotModal();">Forgot Password ?
     
     </button>
      | <button class="sh_btn"  onclick="show_signupModal();">Sign Up</button></p>
       
     </div>
   </div>
 </div>
</div>



<div class="modal fade" id="CompanyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
 <div class="modal-dialog padding" role="document">
   <div class="modal-content">
     <div class="modal-header">
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4>Login With Username</h4>
      
     </div>
     <div class="modal-body"> 
	 <center id="login_response"> </center>
<form class="form-horizontal" action="<?php echo base_url(); ?>user/companylogin" method="post" id="comlogin-form" onsubmit='return false'>
       
 <div class="form-group">
   <label for="inputEmail3" class="col-sm-3 control-label">Username</label>
   <div class="col-sm-9">
    <input type="text" class="form-control" id="com_login_email_address" name="com_login_email_address" autocomplete="off"  placeholder="Email" value="<?php echo set_value('email_address'); ?>" />
	 <div id="com_loginemailmsg"></div>
   </div>
 </div>
 
 <div class="form-group">
   <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
   <div class="col-sm-9">
   <input type="password" class="form-control"  placeholder="Password" id="com_login_password" name="com_login_password"  autocomplete="off" value="<?php echo set_value('password'); ?>" />
    <div id="com_loginpwdmsg"></div>
   </div>
 </div>
 <div class="form-group">
<div class='modalFrom'> </div>
</div>
 <div class="form-group">
   <div class="col-sm-offset-3 col-sm-10">
   <div id='com_bannedStatus_login'></div>
     <button type="submit" onclick="loginvalidationascompany()" name="submit" class="mainlogin login_btn">LOGIN</button>
	   <!--<input type="submit" style="display:none"  name="login_signup" id="login_signup" />-->
   </div>
 </div>
</form>
     </div>
     
     <div class="modal-footer">
     <p><button class="reset_btn" onclick="show_cmpforgotModal();">Forgot Password ?
     
     </button>
	 
      | <button class="sh_btn"  onclick="show_cmpsignupModal();">Sign Up</button></p>
       
     </div>
   </div>
 </div>
</div>







<div class="modal fade" id="CompanysignupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
 <div class="modal-dialog padding" role="document">
   <div class="modal-content">
     <div class="modal-header">
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4>Sign up With Username</h4> 
      
     </div>
     <div class="modal-body"> 
	 <center id="login_response"> </center>
<form class="form-horizontal" action="<?php echo base_url(); ?>user/companysignup" method="post" id="comsignup-form" onsubmit='return false'>
       
 <div class="form-group"> 
   <label for="inputEmail3" class="col-sm-3 control-label">Username</br>(email id) <span class="mandatorysymbol">*</span></label>
   <div class="col-sm-9">
    <input type="text" class="form-control" id="com_uname" name="com_uname" autocomplete="off"  placeholder="Email" value="<?php echo set_value('email_address'); ?>" />
	 <div id="com_unamemsg"></div>
   </div>
 </div>
 <div class="form-group">
   <label for="inputEmail3" class="col-sm-3 control-label">Phone number<span class="mandatorysymbol">*</span></label>
   <div class="col-sm-9">
    <input type="text" class="form-control" id="com_phone" name="com_phone" autocomplete="off"  placeholder="Phone number" value="<?php echo set_value('email_address'); ?>" />
     <div id="com_phonemsg"></div>
   </div>
 </div>
 <div class="form-group">
   <label for="inputEmail3" class="col-sm-3 control-label">Company name<span class="mandatorysymbol">*</span></label>
   <div class="col-sm-9">
    <input type="text" class="form-control" id="com_name" name="com_name" autocomplete="off"  placeholder="Company name" value="<?php echo set_value('email_address'); ?>" />
     <div id="com_namemsg"></div>
   </div>
 </div>
 <div class="form-group">
    <label for="exampleInputEmail1" class="col-sm-3 control-label">Category<span class="mandatorysymbol">*</span></label>
    <div class="col-sm-9">
    <select name='com_cat' id='com_cat' class='form-control' onchange='selectionAutoCompletenew()' >
    <option class="dropdownlivalue" value='0' id='0' >Select a Category</option>
    <?php
        foreach($getAllcat as $cat)
        {
            ?>
            <option class="dropdownlivalue" value='<?php echo $cat['cat_id']; ?>' id='<?php echo $cat['cat_id']; ?>' ><?php echo $cat['cat_name']; ?></option>
            <?php
        }
    ?>
    </select>
    </div>
    <input type="hidden" id="cat_hidden" name="cat_hidden" />
    <div id="com_catmsg"  class="infodanger"> </div>
  </div>
 <div class="form-group">
   <label for="inputEmail3" class="col-sm-3 control-label">Company URL<span class="mandatorysymbol">*</span></label>
   <div class="col-sm-9">
    <input type="text" class="form-control" id="com_url" name="com_url" autocomplete="off"  placeholder="Company URL" value="<?php echo set_value('email_address'); ?>" />
     <div id="com_urlmsg"></div>
   </div>
 </div>
 <div class="form-group">
   <label for="inputPassword3" class="col-sm-3 control-label">Password<span class="mandatorysymbol">*</span></label>
   <div class="col-sm-9">
   <input type="password" class="form-control"  placeholder="Password" id="com_pass" name="com_password"  autocomplete="off" value="<?php echo set_value('password'); ?>" />
    <div id="com_passmsg"></div>
   </div>
 </div>
 <div class="form-group">
<div class='modalFrom'> </div>
</div>
 <div class="form-group">
   <div class="col-sm-offset-3 col-sm-10">
   <div id='com_bannedStatus_signup'></div>
     <button type="submit" onclick="companysignupvalidation()" name="submit" class="mainlogin login_btn">Register</button>
	   <!--<input type="submit" style="display:none"  name="login_signup" id="login_signup" />-->
   </div>
 </div>
</form>
     </div>
     
     <div class="modal-footer">
     <p><!--<button class="reset_btn" onclick="show_forgotModal();">Forgot Password ?
     
     </button>
	 
      | <button class="sh_btn"  onclick="show_signupModal();">Sign Up</button></p>-->
       
     </div>
   </div>
 </div>
</div>







<!---event status modal ---->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
 <div class="modal-dialog padding" role="document">
   <div class="modal-content">
     <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<div id='eventModelHtmlheader'>     </div>
     </div>
     <div class="modal-body" id='eventModelHtml'>
     </div>
     
    
   </div>
 </div>
</div>

<!----->

<script>


$(document).ready(function(){
	$('.modal').on('show.bs.modal', function () {
	  if ($(document).height() > $(window).height()) {
		// no-scroll
		$('body').addClass("modal-open-noscroll");
	  }
	  else { 
		$('body').removeClass("modal-open-noscroll");
	  }
	})
	$('.modal').on('hide.bs.modal', function () {
		$('body').removeClass("modal-open-noscroll");
	})
	
	$('.close').on('click',function ()
	{
		$('form').each(function() { this.reset() }); // all forms reseting if user click on close button
	});
	
})

function forgotvalidation()
{
	$('#forgot_response').html('');
	if($('#forgot_email_address').val() != '')
	{
		
		if(!isValidEmailAddress($('#forgot_email_address').val()))
		{
			$('#forgot_response').html("<span class='infodanger'>Please enter valid email</span>");
			setTimeout(function() { $('#forgot_response').html(''); },3000);
			return false;
		}
		else{				
			var baseHref = document.getElementsByTagName('base')[0].href;
			showloader();
			$.ajax({
				type: "POST",
				url: baseHref + "user/forgot", 
				data: { email_id:$('#forgot_email_address').val() }, //new FormData('#signup-form'),//
				success: 
				  function(data){
					  
					  hideloader();
					  $('#forgot_response').html(data);//.fadeOut(3000);
					  //$('#forgot_response').html("<span class='infosuccess'>A reset link has been sent to the registered email Id</span>");//.fadeOut(3000);
					  
						setTimeout(function()
						{ 
							$('#forgot_response').html('');
							$("#forgotpwd .close").click();
						},3000);
					
				  },
				  error: function(){
					  hideloader();
					  $('#forgot_response').html('<span class="infodanger">Error Occur</span>').fadeOut(3000);
				  }
				});// you have missed this bracket
		}
	}
	else{
		$('#forgot_response').html('<span class="infodanger">Please enter your email</span>');
		setTimeout(function() { $('#forgot_response').html(''); },3000);
		return false;
	}
	
}
function show_forgotModal()
{
	
	$("#loginModal").modal('hide');//'.show();
	$("#forgotpwd").modal('show');//'.show();
}

function show_signupModal()
{
	$("#loginModal").modal('hide');//'.show();
	$("#CompanyModal").modal('hide');//'.show();
	$("#signupModal").modal('show');//'.show();
	
	
}

function show_cmpforgotModal()
{
	
	$("#CompanyModal").modal('hide');//'.show();
	$("#forgotpwd").modal('show');//'.show();
}


function show_cmpsignupModal()
{
	//$("#loginModal").modal('hide');//'.show();
	$("#CompanyModal").modal('hide');//'.show();
	$("#CompanysignupModal").modal('show');//'.show();
	
	
}

function contactForm()
{
	$('#contactname').html('');
	$('#contactemail').html('');
	$('#contactmessage').html('');
	$('#contact_name').val();
	$('#contact_email').val();
	$('#contact_phone').val();
	$('#contact_message').val();
	
	if($('#contact_name').val() == '')
	{
		$('#contact_name').focus();
		$('#contactname').html('<span class="infodanger" >Please fill your name</span>');
		setTimeout(function() { $('#contactname').html(''); },3000);
		return false;
	}
	if($('#contact_email').val() == '')
	{
		$('#contact_email').focus();
		$('#contactemail').html('<span class="infodanger" >Please fill your email address</span>');
		setTimeout(function() { $('#contactemail').html(''); },3000);
		return false;
	}
	if($('#contact_message').val() == '')
	{
		$('#contact_message').focus();
		$('#contactmessage').html('<span class="infodanger" >Please fill your message</span>');
		setTimeout(function() { $('#contactmessage').html(''); },3000);
		return false;
	}
	else{
		showloader();
		$.ajax({
         type: "POST",
         url: baseHref + "contact/PostContact", 
		 data: { name:$('#contact_name').val(),email:$('#contact_email').val(),phone:$('#contact_phone').val(),message:$('#contact_message').val() }, //new FormData('#signup-form'),//
		 success: 
              function(data){
				  hideloader();
				  if(data == 0)
				  {
					$('#contactstatus').html('<span class="infosuccess" >Your query has been submitted successfully, Shortly our representative will contact you.</span>').fadeOut(3000);
					setTimeout(function() { location.reload(); },3000);
				  }
				  else{
					$('#contactstatus').html('<span class="infodanger" >Please try again later.</span>').fadeOut(3000);
				}
              }
          });// you have missed this bracket
		return true;
	}
	
	//alert("d");
}

function logout()
{   
	var baseHref = document.getElementsByTagName('base')[0].href;
	//alert(baseHref);
	$.ajax({
         type: "POST",
         url: baseHref + "user/logout", 
         //data: { email_id:email,password:pwd }, //new FormData('#signup-form'),//
		 success: 
              function(data){
				  if(data == '0'){	

					FB.logout(function(response) {
					  // user is now logged out
					});
				 	localStorage.setItem("fbchecker", "0");
					  //location.reload();
					window.location.href = baseHref;//"http://localhost/code/";
				  }
              }
          });// you have missed this bracket
}

function loginvalidation()
{
	$('#bannedStatus').html('');
	$('#loginemailmsg').html('');
	$('#loginpwdmsg').html('');	
	$("#loginModal .modalFrom").html('');
	var baseHref = document.getElementsByTagName('base')[0].href;
	
	var email =	$('#login_email_address').val().trim(), pwd = $('#login_password').val();
	var errormsg = false;
	
	
	if(email != "")
	{
		
		if(!isValidEmailAddress(email))
		{
			$('#loginemailmsg').html("<span class='infodanger'>Please enter valid email</span>");
			$('#login_email_address').focus();
			setTimeout(function() { $('#loginemailmsg').html(''); },3000);
			errormsg  = true;
			return false;
		}
	}
	else 
	{
		$('#loginemailmsg').html("<span class='infodanger'>Please enter email</span>");
		$('#login_email_address').focus();
		setTimeout(function() { $('#loginemailmsg').html(''); },3000);
		errormsg  = true;
		return false;
	}
	if(pwd == "")
	{		
		$('#loginpwdmsg').html("<span class='infodanger'>Please enter password</span>");
		$('#login_password').focus();
		setTimeout(function() { $('#loginpwdmsg').html(''); },3000);
		errormsg  = true;
		return false;
	}
	
	if(errormsg == false)
	{
		showloader();
		$.ajax({
         type: "POST",
         url: baseHref + "user/login", 
         data: { email_id:email.trim(),password:pwd }, //new FormData('#signup-form'),//
		 success: 
			function(data){
				console.log(data);
				  hideloader();
					if(data == 'loggedin'){
						$('#bannedStatus').html("<span class='infosuccess' >Howdy, Welcome to Weblistr Community.</span>"); 
						$('#loginModal .close').click();
						location.reload();
					}
					else if (data == 'banned')
					{
						$('.mainlogin').attr('disabled',false);
						$('.mainlogin').html('Login');
						$('#bannedStatus').html("<span class='infodanger' >Your account is not activate.</span>");
					}
					else if (data == 'notloggedin')
					{
						$('.mainlogin').attr('disabled',false);
						$('.mainlogin').html('Login');
						$('#bannedStatus').html("<span class='infodanger' >Oops! Username / Password is incorrect.</span>");
					}
					setTimeout(function() { $('#bannedStatus').html(''); },3000);
				}			  
          });// you have missed this bracket
		return false;
	 	//$("#submit_signup").trigger("click");
	}
	else{
	     return false;
	}
}


function loginvalidationascompany()
{
	$('#com_bannedStatus').html('');
	$('#com_loginemailmsg').html('');
	$('#com_loginpwdmsg').html('');	
	$("#com_loginModal .modalFrom").html('');
	var baseHref = document.getElementsByTagName('base')[0].href;
	
	var email =	$('#com_login_email_address').val().trim(), pwd = $('#com_login_password').val();
	var errormsg = false;
	
	
	if(email != "")
	{
		
		if(!isValidEmailAddress(email))
		{
			$('#com_loginemailmsg').html("<span class='infodanger'>Please enter valid email</span>");
			$('#com_login_email_address').focus();
			setTimeout(function() { $('#loginemailmsg').html(''); },3000);
			errormsg  = true;
			return false;
		}
	}
	else 
	{
		$('#com_loginemailmsg').html("<span class='infodanger'>Please enter email</span>");
		$('#com_login_email_address').focus();
		setTimeout(function() { $('#loginemailmsg').html(''); },3000);
		errormsg  = true;
		return false;
	}
	if(pwd == "")
	{		
		$('#com_loginpwdmsg').html("<span class='infodanger'>Please enter password</span>");
		$('#com_login_password').focus();
		setTimeout(function() { $('#loginpwdmsg').html(''); },3000);
		errormsg  = true;
		return false;
	}
	
	if(errormsg == false)
	{
		showloader();
		$.ajax({
         type: "POST",
         url: baseHref + "user/companylogin", 
         data: { email_id:email.trim(),password:pwd }, //new FormData('#signup-form'),//
		 success: 
			function(data){
				console.log(data);
				  hideloader();
					if(data == 'loggedin'){
						$('#com_bannedStatus_login').html("<span class='infosuccess' >Howdy, Welcome to Weblistr Community.</span>");
						$('#CompanyModal .close').click();
						location.reload();
					}
					else if (data == 'banned')
					{
						$('.mainlogin').attr('disabled',false);
						$('.mainlogin').html('Login');
						$('#com_bannedStatus_login').html("<span class='infodanger' >Oops!Your Company is not registered with us. Please register here.</span>");
					}
					else if (data == 'notloggedin')
					{
						$('.mainlogin').attr('disabled',false);
						$('.mainlogin').html('Login');
						$('#com_bannedStatus_login').html("<span class='infodanger' >Oops! Username / Password is incorrect.</span>");
					}
					setTimeout(function() { $('#bannedStatus').html(''); $('#com_bannedStatus_login').html(''); },3000);
				}			  
          });// you have missed this bracket
		return false;
	 	//$("#submit_signup").trigger("click");
	}
	else{
	     return false;
	}
}
function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}

</script><!--Start of Zopim Live Chat Script--><script type="text/javascript">window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set._.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");$.src="//v2.zopim.com/?3rTemtBLLrwXuCgaoRRoRtyVeFDFvKap";z.t=+new Date;$.type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");</script><!--End of Zopim Live Chat Script-->




<script>

/**********************************                              reset password                  ******************************************/
function reset_submit()
{
	var baseHref = document.getElementsByTagName('base')[0].href;
	
	var pass=$("#rpass").val();
	var teck=$("#bootstrap_mod_id").val();
	if(pass=='')
	{
		$("#rpass").css("background","#ff0000");
		$("#rpass").css("color","#fff");
		$("#rpass").addClass("animated");
		$("#rpass").addClass("shake");
		$("#rpass").attr("placeholder","Enter Password");
	}
	else 
	{	
		$.ajax({
			url:baseHref+"user/reset_got/"+teck,
			type:"POST",
			data:{ pass:pass },
			success:function(data)
			{
				$("#reset_cont").hide();
				$("#freges").hide();
				$("#reset_message").show();
				$("#reset_response").html("");
				$("#reset_response").html(data);
				setTimeout(function()
				{
					$("#reset_cont").hide();
					$("#freges").hide();
					$("#rpass").val("");
					$("#reset_message").hide();
					$("#reset_response").html("");
					$("#resetModal").modal("hide");
					window.location.href=baseHref;
				},4000);
			}
		});
	}
}
</script>

<?php
  if(isset($reset) &&  $reset!='')  { 
  ?>
			 <!-------------                      reset password modal                      -------------------->
			 
<script>
// all jQuery events are executed within the document ready function
$(document).ready(function() {
	$("#resetModal").bind("keydown", function(event) {
		var keycode = (event.keyCode ? event.keyCode : (event.which ? event.which : event.charCode));
		if (keycode == 13) {
			document.getElementById('resetpwdforgotpwd').click();
			return false;
		} else  {
			return true;
		}
	});
}); 
// end of document ready
</script>

  <div class="modal fade in"  id="resetModal" style="display:block" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog reg-model" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 id="register_h4" class="modal-title" id="exampleModalLabel">Reset Password</h4>
      </div>
      <div class="modal-body">
	  


        <form method="post"  >
  <input type="hidden" id="bootstrap_mod_id" value="<?php echo $reset; ?>">
          <div style="display:none;" id="reset_message" class="form-group text-center">
            <label id="reset_response" for="recipient-name" class="control-label"></label>
          </div>
		  <br />
		            <div id="reset_cont" class="form-group">
            <label for="recipient-name" class="control-label">Enter Password </label>
            <input type="password"  id="rpass" class="form-control" required >
          </div> 
		  <div id="rreges" class="modal-footer">
		  <button type="button" onclick="reset_submit();" id="resetpwdforgotpwd" class="btn btn-primary">Submit</button>
		  
        <!--<span onclick="reset_submit();" class="btn btn-primary">Submit</span>-->
		
		<!--<button type="submit" id="" onclick="reset_submit();" class="btn btn-primary">Submit</button>-->
		<!--<button type="button" id="" onclick="reset_submit();" class="btn btn-primary">Submit</button>-->
      </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php } 
  
  //$this->user_model->add_user('gouravgupta162@gmail.com','gouravgupta162','123');
  ?>
