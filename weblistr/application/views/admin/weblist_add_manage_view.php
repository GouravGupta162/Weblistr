<div class="main-content">
    <div class="main-content-inner">
        <?php include 'breadcrumb_view.php';
        ?>

        <div class="page-content">
            <div class="ace-settings-container" id="ace-settings-container">
                <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                    <i class="ace-icon fa fa-cog bigger-130"></i>
                </div>

                <div class="ace-settings-box clearfix" id="ace-settings-box">
                    <div class="pull-left width-50">
                        <div class="ace-settings-item">
                            <div class="pull-left">
                                <select id="skin-colorpicker" class="hide">
                                    <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                </select>
                            </div>
                            <span>&nbsp; Choose Skin</span>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                            <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                            <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                            <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                            <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                            <label class="lbl" for="ace-settings-add-container">
                                Inside
                                <b>.container</b>
                            </label>
                        </div>
                    </div><!-- /.pull-left -->

                    <div class="pull-left width-50">
                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
                            <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
                            <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                        </div>

                        <div class="ace-settings-item">
                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
                            <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                        </div>
                    </div><!-- /.pull-left -->
                </div><!-- /.ace-settings-box -->
            </div><!-- /.ace-settings-container -->

            <div class="row">
                <div class="col-xs-6">
                    <!-- PAGE CONTENT BEGINS -->

                    <!--custom content start-->
                    <div class="row">
                        <div class="col-xs-12">

                            
<form class="form_style"  
      action="<?php echo base_url(); ?>admin/weblist/PostAdd" 
      method="post" id="productaddForm"  enctype="multipart/form-data">
                            
<!--                            <form class="form_style"  

                                  id='productaddForm' >-->

                                <div class="widget-box">


                                    <div class="widget-body">
                                        <div class="widget-main">

									
<div class="form-group">
<label for="exampleInputEmail1">Category</label>
<select name='cat_hidden' id='cat_hidden' class='form-control' required >
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

                                            <div>

                                                <label for="form-field-8">Website Name</label>
                                                <input type="text" class="form-control" placeholder="Website Name" name="prd_name" id="prd_name"   >
                                            </div>

                                            <div>

                                                <label for="form-field-8">Url</label>

                                                <input type="text" class="form-control" placeholder="Website URL" name="prd_link"  >
                                            </div>



                                            <div>
                                                <label for="form-field-8">Address</label>
                                                <input type="text" class="form-control" placeholder="Website Address" name="prd_address"  >
                                            </div>

                                            <div>
                                                <label for="form-field-8">Tel</label>
                                                <input type="text" class="form-control" placeholder="Website Tel" name="prd_tel"   >
                                            </div>

                                            <div>
                                                <label for="form-field-9">Description <span class='small red'>(500 Character Limit)</span></label>
                                                <textarea class="form-control limited" id="prd_desc" name="prd_desc" maxlength="500"></textarea>
												<label  id="character-count">500 characters remaining</label>
                                            </div>


											
<div class="form-group">
<label for="exampleInputEmail1"><br>Windows App URL</label>
<input type="text" class="form-control" id="windowApp" name="windowApp" placeholder="Windows APP URL">
</div>

<div class="form-group">
<label for="exampleInputEmail1">iOS App URL</label>
<input type="text" class="form-control" id="iosApp" name="iosApp" placeholder="iOS APP URL">
</div>

<div class="form-group">
<label for="exampleInputEmail1">Android App URL</label>
<input type="text" class="form-control" id="androidApp" name="androidApp" placeholder="Android APP URL">
</div>

<div class="form-group">
<label for="exampleInputEmail1">Deals (URL)</label>
<input type="text" class="form-control" id="deallink" name="deallink" placeholder="Deals of the day URL">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Services Offered</label>
	<input type="text" class="form-control" id="servicesOffered" name="servicesOffered" placeholder="Services Offered">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Customer Support ID</label>
	<input type="text" class="form-control" id="custId" name="custId" placeholder="Customer Support ID">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Payment Options</label>
	<select name="payoption[]" multiple="multiple" class="form-control" id='payoption'>
   <option value='visa' >Visa</option>

  <option value='master' >Master</option>

<option value='paypal' >Paypal</option>
<option value='Credit Card' >Credit Card</option>
<option value='Banking' >Banking</option>
  <option value='Debit Card' >Debit Card</option>
  <option value='Debit Card' >Net Banking</option>
 <option value='Cash On Delivery' >Cash On Delivery</option>

</select>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Locations Covered </label>
	<input type="text" class="form-control" id="locations" name="locations" placeholder="Locations Covered">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Delivery Time </label>
	<input type="text" class="form-control" id="deliveryTime" name="deliveryTime" placeholder="Delivery Time">
</div>
											
											
                                            <div>
                                                <label for="form-field-8">Logo Image</label>
                                                <input type='file' name='file' id='file' />
                                                <div id="imagePreview"> </div>
                                                <br/>
                                            </div>
                                            <hr />


                                            <div class="form-group">
                                                <script type="text/javascript" src="js/jquery.js"></script>
                                                <script type="text/javascript" src="js/jquery.masterblaster.js"></script> 
                                                <link rel="stylesheet" type="text/css" href="css/jquery.masterblaster.css" />

                                                <label for="exampleInputFile">Tags</label>

                                                <input id="tags" placeholder="Enter tags here" style="width:87%" />
                                                <input type="hidden" id="hidden_tag" name="hidden_tag" />
                                                <div class="jquery-script-clear"></div>
                                                <script type="text/javascript">
                                                    $("#tags").masterblaster({
                                                        animate: true
                                                    });
                                                </script>
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



<script>


$(document).ready(function() {
    var text_max = 500;
    $('#character-count').html(text_max + ' characters remaining');

    $('#prd_desc').keyup(function() {
        var text_length = $('#prd_desc').val().length;
        var text_remaining = text_max - text_length;

        $('#character-count').html(text_remaining + ' characters remaining');
    });
});


    $(document).ready(function () {
        var baseHref = document.getElementsByTagName('base')[0].href;

        $("#webcategory").keyup(function () {
            $.ajax({
                type: "POST",
                url: baseHref + "category/getCategory_AutoComplete",
                data: {
                    keyword: $("#webcategory").val()
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    if (data.length > 0) {
                        $('#DropdownCategory').empty();
                        $('#webcategory').attr("data-toggle", "dropdown");
                        $('#DropdownCategory').dropdown('toggle');
                    } else if (data.length == 0) {
                        $('#webcategory').attr("data-toggle", "");
                    }
                    $.each(data, function (key, value) {
                        //console.log(value.value);
                        if (data.length >= 0)
                            $('#DropdownCategory').append('<li role="presentation" ><a role="menuitem dropdownnameli" class="dropdownlivalue" id=' + value.value + ' onClick="selectionAutoComplete(this.id);" >' + value.label + '</a></li>');
                    });
                }
            });
        });
        $('ul.txtCategory').on('click', 'li a', function () {
            //console.log($(this).text());
            $('#webcategory').val($(this).text());
            $('ul.txtCategory').hide();
        });
        
        
         $("#productaddForm").on('submit', (function (e) {
            e.preventDefault();
			var cat_hidden = $('#cat_hidden').val();
			var prd_name = $('#prd_name').val();
			var prd_desc = $('#prd_desc').val();
			var error = false;
			if((cat_hidden == "0")||(cat_hidden == "")||(cat_hidden == "null"))
			{
				$('#cat_hidden').focus();
				error = true;
				return false;
			}
			if(prd_name == "")
			{
				$('#prd_name').focus();
				error = true;
				return false;
			}
			if(prd_desc == "")
			{
				$('#prd_desc').focus();
				error = true;
				return false;
			}
			if(error == false)
			{
				//console.log(add_list_your_website());
				$.ajax({
					url: baseHref + "admin/weblist/PostAdd",
					type: "POST",
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					success: function (data)
					{
						if (data == 0)
						{
							$('#status').html('<span style=color:red; font-size:20px; >Please logged in first</span>');
						} else if (data == 1) {
							$('#status').html('<span style=color:green; font-size:20px; >your website submitted successfully. we will notify you after approve it</span>');
						} else if (data == 2) {
							$('#status').html('<span style=color:red; font-size:20px; >please try again later</span>');
						} else if (data == 3) {
							$('#status').html('<span style=color:red; font-size:20px; >please check website already listed</span>');
						}
						setTimeout(function () {
							$("#status").html('');
						}, 3000);
					},
					error: function ()
					{
					}
				});
			}
			
		}));
        
    });

    function selectionAutoComplete(id)
    {
        $('#cat_hidden').val(id);
    }

   

//*


    $(".tagremove").click(function (event)
    {
        event.preventDefault();
        //alert();

        var prd_tag_id = this.id;
        var baseHref = document.getElementsByTagName('base')[0].href;
        $.ajax({
            url: baseHref + "admin/weblist/tagRemove",
            type: 'POST',
            data: {prd_tag_id: prd_tag_id},
            success: function (returndata) {
                console.log(returndata);
                if (returndata == "1")
                {
                    alert("Tag Removed Succesfully");
                    $("#li_" + prd_tag_id).remove();
                } else
                {
                    alert("Please try again later");
                }

            }
        });

    }
    );
    
    //Class Click Event Jquery
    //$(".update00").click(function () {     });
    //*
    $("#file").on('change', function () {
        if (typeof (FileReader) != "undefined") {
            var image_holder = $("#imagePreview");
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image",
                    //"width": "100px",
                    "style": "width:100px; border:1px solid grey;"
                }).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    });
//*



</script>