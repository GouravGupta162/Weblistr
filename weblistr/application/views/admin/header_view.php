<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $title; ?> </title>
                <base href="<?php echo base_url(); ?>" />

		<meta name="description" content="Mailbox with some customizations as described in docs" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>
                
                

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
             
                <style>
				.notification li{
					
				}
				.notification img {
    float: left;
    margin-right: 7px;
    width: 30px;
}
				.notification p{
					margin-left: 30px !important;
					margin-top: -5px;
				}
				.ScrollStyle
				{
					max-height: 150px;
					overflow-y: scroll;
				}
				</style>
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
                                    <a href="javascript:void(0);" onclick="logo()" class="navbar-brand">
						<img src="images/logo.png" style="height: 25px;">
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important">
									<div id='notificationCounter'> 
										<?php
											$this->notificationmodel->countAllNotification();
										?>
									</div>
								</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									<span class='notificationCounter'> 
									
									</span> Notifications
								</li>

								<li class="dropdown-content">
								<input type='hidden' id='limitrow' value='8' />
									<ul class="dropdown-menu dropdown-navbar navbar-pink notification ScrollStyle" id='notificationscroller' >
										<?php //$this->notificationmodel->fetchcontent('0'); ?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="javascript:void(0)" onclick='markallreadnotification()'>
										mark all view
										<i class="fa fa-eye"></i>
									</a>
								</li>
							</ul>
						</li>

					
						<li class="light-blue">
							<a data-toggle="dropdown" href="javascript:void(0)" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
<input type='hidden' id='usr_id' name='usr_id' value='<?php echo $this->session->userdata('usr_id'); ?>' />
									<?php echo $this->session->userdata('usr_name'); //profile name 
									
									if($this->session->userdata('usr_id') == "")
									{
										redirect(base_url().'admin');
									}
									?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="javascript:void(0)" data-toggle="modal" data-target="#chgpwd" >
										<i class="ace-icon fa fa-cog"></i>
										Change Password
									</a>
								</li>

								

								<li class="divider"></li>

								<li>
                                                                    <a href="javascript:void(0)" onclick="logout()" >
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
													
<!-- Change Password Modal Start -->

<script type="text/javascript" src="js/jquery.js"></script>
			
<script>
function updatepwd()
{
	
	var oldpwd = $('#oldpwd').val();
	var newpwd = $('#newpwd').val();
	var conpwd = $('#conpwd').val();
	var usr_id = $('#usr_id').val();
	
	var error = false;
	var message = '';
	var ctrl = '';
	if(oldpwd == '')
	{
		error = true;
		message = 'Please enter current password';
		ctrl = "oldpwd";
		errormesg(message,ctrl);
		return false;
	}
	if(newpwd == '')
	{
		error = true;
		message = 'Please enter new password';
		ctrl = "newpwd";
		errormesg(message,ctrl);
		return false;
	}
	if(conpwd == '')
	{
		error = true;
		message = 'Please enter confirm password';
		ctrl = "conpwd";
		errormesg(message,ctrl);
		return false;
	}
	if((newpwd != '') && (conpwd != ''))
	{
		if(newpwd != conpwd)
		{
			error = true;
			message = 'Password not matched';
			ctrl = "conpwd";
			errormesg(message,ctrl);
			return false;
		}
	}
	if(error == false)
	{
		postchangwpwdForm(oldpwd, newpwd,conpwd,usr_id);
	}

}
function errormesg(message,ctrl)
{
	$('#pwdchangestatus').html("<span class='infodanger'>"+message+"<span>");
	$('#'+ctrl).focus();
					
}
function postchangwpwdForm(oldpwd, newpwd,conpwd,usr_id)
{
	var params = {oldpwd: oldpwd, newpwd: newpwd, conpwd: conpwd, usr_id: usr_id}; 
	postpwd("admin/login/AdminPwdUpdate", params, 'POST');
}
function postpwd(path, params, method)
{
	var baseHref = document.getElementsByTagName('base')[0].href;
	path = baseHref + path; 
	$.ajax({
		type: method,
		url: path,
		data: params, 
		success:
			function (data) {
				if(data == 'done')
				{
					$('#pwdchangestatus').html("<span class='infosuccess'>Password changed successfully<span>");
					
					$('#oldpwd').val('');
					$('#newpwd').val('');
					$('#conpwd').val('');
					
					
				}
				setInterval(function(){
					$('#pwdchangestatus').html("");
				}, 3000);
			}
	});
}
</script>	
			

<div class="modal fade" id="chgpwd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Current Password:</label>
            <input type="password" class="form-control" id="oldpwd">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">New Password:</label>
            <input type="password" class="form-control" id="newpwd">
          </div>
		  <div class="form-group">
            <label for="message-text" class="control-label">Confirm Password:</label>
            <input type="password" class="form-control" id="conpwd">
          </div>
        </form>
      </div>
      <div class="modal-footer">
		<div class='pull-left' id='pwdchangestatus' >  </div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary " onclick='updatepwd()'>Update</button>
      </div>
    </div>
  </div>
</div>
<!-- Change Password Modal End -->
							
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<!--<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div>--><!-- /.sidebar-shortcuts -->

				<?php 
				include 'left_menu_view.php';
				?>
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>