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
       id="useraddForm" >
                            
<!--                            <form class="form_style"  

                                  id='productaddForm' >-->

                                <div class="widget-box">


                                    <div class="widget-body">
                                        <div class="widget-main">


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">User Name</label>
                                                <input type="text" class="form-control" id="user_name"  autocomplete="off" name="user_name" placeholder="User Name" required  />
                                            </div>

                                            <div>

                                                <label for="form-field-8">Email</label>
                                                <input type="text" class="form-control" autocomplete="off" placeholder="Email" name="email_address" id="email_address"   >
                                            </div>

                                            <div>

                                                <label for="form-field-8">Password</label>

                                                <input type="password" class="form-control" autocomplete="off"  placeholder="Password" id="password" name="password" value="">
                                            </div>

                                            <div>
											<label for="form-field-8">User Type</label>
											<select name="userType" id="userType" class="form-control" >
												<option class="dropdownlivalue" value="0" id="0">Normal User </option>
												<option class="dropdownlivalue" value="1" id="1">Company</option>
											</select>

                                            </div>

                                            <div><br/>
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

  $("form#useraddForm").submit(function (event) {
        //disable the default form submission
        event.preventDefault();
        //grab all form data  
        var formData = new FormData($(this)[0]);
        var baseHref = document.getElementsByTagName('base')[0].href;
        $.ajax({
                url: baseHref + "admin/user/PostAdd",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
                    if (data != 0)
                    {
                        $('#status').html('<span style=color:red; font-size:20px; >User Created Succesfylly</span>');
                    } 
					else if (data == 0)
                    {
                        $('#status').html('<span style=color:red; font-size:20px; >Email Already In our Db</span>');
                    } 
                    setTimeout(function () {$("#status").html(''); }, 3000);
                },
                error: function ()
                {
                }
            });
        return false;
    });

    // $(document).ready(function () {
        // var baseHref = document.getElementsByTagName('base')[0].href;

         // $("#useraddForm").on('submit', (function (e) {
            // e.preventDefault();
            // //console.log(add_list_your_website());
            // $.ajax({
                // url: baseHref + "admin/user/PostAdd",
                // type: "POST",
                // data: new FormData(this),
                // contentType: false,
                // cache: false,
                // processData: false,
                // success: function (data)
                // {
                    // if (data != 0)
                    // {
                        // $('#status').html('<span style=color:red; font-size:20px; >User Created Succesfylly</span>');
                    // } 
					// else if (data == 0)
                    // {
                        // $('#status').html('<span style=color:red; font-size:20px; >Email Already In our Db</span>');
                    // } 
                    // setTimeout(function () {$("#status").html(''); }, 3000);
                // },
                // error: function ()
                // {
                // }
            // });
            // }));
    // });

</script>