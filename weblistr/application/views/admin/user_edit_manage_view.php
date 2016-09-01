<div class="main-content">
    <div class="main-content-inner">
        <?php include 'breadcrumb_view.php';
        ?>

        <div class="page-content">
          
            <div class="row">
                <div class="col-xs-6">
                    <!-- PAGE CONTENT BEGINS -->

                    <!--custom content start-->
                    <div class="row">
                        <div class="col-xs-12">

                            <form class="form_style"  
                                  
                                 id='userEditUpdateForm' >
                                      <?php
//var_dump($getSelectedUser);
                                      
                                          $usr_id = $getSelectedUser['usr_id'];
                                          $usr_name = $getSelectedUser['usr_name'];
                                          $email_id = $getSelectedUser['email_id'];
                                          $usr_password = $getSelectedUser['usr_password'];
                                          $register_method = $getSelectedUser['register_method'];
                                          $social_id = $getSelectedUser['social_id'];
                                          $register_date = $getSelectedUser['register_date'];
                                          $status = $getSelectedUser['status']; //active status
                                          $profile_image = $getSelectedUser['profile_image'];
										  $bio = $getSelectedUser['bio'];
										  $mobile = $getSelectedUser['mobile'];
										  $address = $getSelectedUser['address'];
										  $city = $getSelectedUser['city'];
										  $state = $getSelectedUser['state'];
										  $country = $getSelectedUser['country'];
										  $admin_status = $getSelectedUser['admin_status'];
										  $super_admin_status = $getSelectedUser['super_admin_status'];
										  
                                          ?>
                                    <div class="widget-box">


                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <div>
													<input type='hidden' id='usr_id' name='usr_id' value='<?php echo $usr_id; ?>' />
                                                    <label for="form-field-8">Name</label>
								
						<input type="text" class="form-control" placeholder="Username" name="usr_name" value='<?php echo $usr_name; ?>' >
                                                </div>

                                                <hr />

                                                <div>
                                                    <label for="form-field-9">Bio <span class='small red'>(500 Character Limit)</span></label>
                                                    <textarea class="form-control limited" id="bio" name="bio" maxlength="500"><?php echo $bio; ?></textarea>
													<label  id="character-count">500 characters remaining</label>
                                                </div>

                                                <hr />

                                                <div>
                                                    <label for="form-field-8">Mobile</label>
                                                    <br/>
                                                    <input type='text'class="form-control" name='mobile' id='mobile'  value='<?php echo $mobile ?> '/>
                                                </div>
                                                <hr />
												
                                                <div>
                                                    <label for="form-field-8">Address</label>
                                                    <br/>
                                                    <input type='text'class="form-control" name='address' id='address'  value='<?php echo $address ?> '/>
                                                </div>
                                                <hr />
												<div>
                                                    <label for="form-field-8">City</label>
                                                    <br/>
                                                    <input type='text'class="form-control" name='city' id='city'  value='<?php echo $city ?> '/>
                                                </div>
                                                <hr />
												<div>
                                                    <label for="form-field-8">State</label>
                                                    <br/>
													<select name="state" id="state" class="state zui-form-input ">
													<option selected="selected">--Select State--</option>
													<?php	

													foreach($getState as $statear)
													{
														$state_id = $statear['state_id'];
														$state_name = $statear['state_name'];
														if($state == $state_id)
														{
														echo "<option value='$state_id' selected >$state_name</option>";
														}
														else {echo "<option value='$state_id' >$state_name</option>";}
													}
													?>
													</select>
                                                    
                                                </div>
                                                <hr />
												<div>
                                                    <label for="form-field-8">Country</label>
                                                    <br/>
                                                   <select name="country" id="country" class="state zui-form-input "  >
														<option >--Select Country--</option>
														<option  <?php echo $var_is_greater_than_two = ($country == 1 ? 'Selected' : ''); ?>  value='1' >India</option>
													</select>
                                                </div>
                                                <hr />
												
												
												 <div>
												<label for="form-field-8">User Type</label>
												<select name="admin_status" id="admin_status" class="form-control" >
<?php $var =  $admin_status; ?>
<option class="dropdownlivalue" value="0" id="0" <?php echo $var_is_greater_than_two = ($var == 0 ? 'Selected' : ''); ?>>Normal User </option>
<option class="dropdownlivalue" value="1" id="1" <?php echo $var_is_greater_than_two = ($var == 1 ? 'Selected' : ''); ?> >Company</option>
												</select>

												</div>
												<hr />
												<div>
												<label for="form-field-8">Super Admin</label>
												<select name="super_admin_status" id="super_admin_status" class="form-control" >
<?php $var = $super_admin_status; ?>
<option class="dropdownlivalue" value="0" id="0" <?php echo $var_is_greater_than_two = ($var == 0 ? 'Selected' : ''); ?>>Normal User </option>
<option class="dropdownlivalue" value="1" id="1" <?php echo $var_is_greater_than_two = ($var == 1 ? 'Selected' : ''); ?> >Super Admin</option>
												</select>

												</div>
												 <hr />

												<div>
                                                    <div id='status'> </div> 
                                                    <button type="submit" class="btn btn-sm btn-success update">
                                                        Submit
                                                        <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                                    </button>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                            </form>
                        </div><!-- /.span -->
                    </div><!-- /.row -->
                    <!--custom content end-->



                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script type="text/javascript" src="js/jquery.js"></script>

<script>

$(document).ready(function() {
    var text_max = 500;
    $('#character-count').html(text_max + ' characters remaining');

    $('#bio').keyup(function() {
        var text_length = $('#bio').val().length;
        var text_remaining = text_max - text_length;

        $('#character-count').html(text_remaining + ' characters remaining');
    });
});

    $( "form#userEditUpdateForm" ).submit(function(event){
    //disable the default form submission
    event.preventDefault();
    //grab all form data  
    var formData = new FormData($(this)[0]);
    var baseHref = document.getElementsByTagName('base')[0].href;
        $.ajax({
          url: baseHref + "admin/user/userEditUpdateForm",
          type: 'POST',
          data: formData,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          success: function (returndata) {
              if(returndata == "1")
              {
                  alert("User Updated Succesfully");
                   window.location.href = baseHref + "admin/user/index";//"http://localhost/code/";
              }else
              {
                  alert("Please try again later");
              }
            //console.log(returndata);
          }
        });

        return false;
      });
    
   
</script>