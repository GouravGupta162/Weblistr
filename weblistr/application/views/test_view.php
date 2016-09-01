<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title><?php echo $title; ?> </title>
<base href="<?php echo base_url(); ?>" />
<!-- Bootstrap -->


<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/jquery.js"></script>


<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<script>
(function ($) {
    $.fn.showDialog = function (options, callback) {
		$('#loginModal').modal();
        $('#loginModal .action_button').on('click', function () {
		var baseHref = document.getElementsByTagName('base')[0].href;
		
		$('#modaltext').val();
		if($('#modaltext').val() != ''){
			$.ajax({
				type: "POST",
				url: baseHref + "welcome/login", 
				success: 
				  function(data){
					if(data == 0)
					{
						$('#loginModal').modal('hide');
						$('#login_password').val('ddsdfsf');
						callback();
					}
				  }
				});// you have missed this bracket	
		}
		else{
			$( "<p>No value is there</p>" ).insertAfter( "#modaltext" ).fadeOut(3000);
			
		}
    });
    }
}(jQuery));

function abc(xyz)
{
	if(($('#login_email_address').val() == '') || ($('#login_password').val() == ''))
	{
		$(xyz).showDialog(null, function () {
			abc(this);
		});
	}
	else
	{
		console.log("Hitted");
		alert("d");
	}
}
</script>



<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
 <div class="modal-dialog padding" role="document">
   <div class="modal-content">
     <div class="modal-header">
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4>Login With Username</h4>
      
   
   
	   <div class="col-sm-10">
    <input type="text" class="form-control" id="modaltext" name="modaltext"  placeholder="Email" />
	 
   </div>
 <button type="button"  name="submit" class="login_btn action_button">LOGIN</button>
     </div>
     

   </div>
 </div>
</div>



<form class="form-horizontal" action="<?php echo base_url(); ?>user/login" method="post" id="login-form">
       
 <div class="form-group">
   <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
   <div class="col-sm-10">
    <input type="text" class="form-control" id="login_email_address" name="login_email_address"  placeholder="Email" value="<?php echo set_value('email_address'); ?>" />
	 <div id="loginemailmsg"></div>
   </div>
 </div>
 <div class="form-group">
   <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
   <div class="col-sm-10">
   <input type="password" class="form-control"  placeholder="Password" id="login_password" name="login_password" value="<?php echo set_value('password'); ?>" />
    <div id="loginpwdmsg"></div>
   </div>
 </div>

 <div class="form-group">
   <div class="col-sm-offset-2 col-sm-10">
     <button type="button" onclick="abc(this)" name="submit" class="login_btn">LOGIN</button>
	   
   </div>
 </div>
</form>



