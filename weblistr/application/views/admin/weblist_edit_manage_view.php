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

                                  id='productupdateForm' >
                                      <?php
                                     //var_dump($getSelectedProduct);
                                      
                                      foreach ($getSelectedProduct as $productValue) {
                                          $prd_id = $productValue['prd_id'];
                                          $cat_id = $productValue['cat_id'];
                                          $added_by = $productValue['added_by'];
                                          $usr_type = $productValue['usr_type'];
                                          $prd_name = $productValue['prd_name'];
                                          $prd_link = $productValue['prd_link'];
                                          $prd_info = $productValue['prd_info'];
                                          $prd_address = $productValue['prd_address'];
                                          $prd_number = $productValue['prd_number'];
                                          $prd_image = $productValue['prd_image'];
                                          $status = $productValue['status'];
                                         
										  
										// $sql = "SELECT cat_name FROM `category`  where cat_id = $cat_id";

										// //$sql = "SELECT product.*,category.cat_name FROM `product` inner join category on product.cat_id = category.cat_id where product.prd_id = $prdId";

										// $query = $this->db->query($sql);
										// $cat_name =  ""$query->row_array()['cat_name'];
										   
										  $windows_app_url = $productValue['windows_app_url'];
										  $ios_app_url = $productValue['ios_app_url'];
										  $android_app_url = $productValue['android_app_url'];
										  $deal_link = $productValue['deal_link'];
										  $services_offered = $productValue['services_offered'];
										  $customer_support_id = $productValue['customer_support_id'];
										  $payment_option = $productValue['payment_option'];
										  $locations = $productValue['locations'];
										  $delivery_time = $productValue['delivery_time'];

                                          $usr_typeResult = $this->product_model->getProductAddedbyName($usr_type, $added_by);
                                          if (sizeof($usr_typeResult) > 0) {
                                              foreach ($usr_typeResult as $userValue) {
//                                                    var_dump($usr_typeResult);
                                                  $usr_name = $userValue['usr_name'];
                                              }
                                          }


                                          $getProductTag = $this->product_model->getProductTag($prd_id);
//                                            if(sizeof($getProductTag) > 0)
//                                            {
//                                                var_dump($getProductTag);
//                                            }
                                          ?>
                                    <div class="widget-box">


                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <div>
                                                    <input type='hidden' id='prd_id' name='prd_id' value='<?php echo $prd_id; ?>' />
                                                    <input type='hidden' id='cat_id' name='cat_id' value='<?php echo $cat_id; ?>' />
                                                    <label for="form-field-8">Name</label>
                                                    <!--<span class=' pull-right small red'>Added by <?php //echo $usr_name; ?></span>-->
                                                    <input type="text" class="form-control" placeholder="Website Name" name="prd_name" value='<?php echo $prd_name; ?>'  >
                                                </div>
                                                <hr />

<?php
    $allcategory = $this->admin_category_model->getAllcategoryForAdminNew();
	//$allcategory = $this->admin_category_model->getAllcategoryForAdmin();
	//echo $cat_id;
	?>
                                                <div >
                                                    <label for="form-field-8">Category Name</label>
												<select name="category" id="category" class="form-control">
													<?php
													foreach ($allcategory as $category) {

														if ($category['cat_id'] == $cat_id) {
															?>
                                                                <option value="<?php echo $category['cat_id'] ?>" selected  ><?php echo $category['cat_name'] ?></option>

                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $category['cat_id'] ?>" ><?php echo $category['cat_name'] ?></option>
															<?php
														}
													}
													?>
                                                    </select>

    <!--                                                    <input type="text" class="form-control" placeholder="Website Name" name="cat_name" value='<?php //echo $cat_name; ?>'  >-->
                                                </div>
                                                <hr />




                                                <div class="form-group">
                                                    <script type="text/javascript" src="js/jquery.js"></script>
                                                    <script type="text/javascript" src="js/jquery.masterblaster.js"></script> 
                                                    <link rel="stylesheet" type="text/css" href="css/jquery.masterblaster.css" />

                                                    <label for="exampleInputFile">Tags</label>

                                                    <div>
    <?php
    if (sizeof($getProductTag) > 0) {
        echo "<ul class='mb-taglist'>";
        foreach ($getProductTag as $value) {
            ?>
                                                                <li style="opacity: 1;" data-tag="tt" class="mb-tag" id="li_<?php echo $value['prd_tag_id']; ?>">
                                                                    <div class="mb-tag-content"><span class="mb-tag-text">
            <?php echo $value['tag_name']; ?></span>
                                                                        <a data-id="<?php echo $value['prd_tag_id']; ?>" id="<?php echo $value['prd_tag_id']; ?>" 
                                                                           data-value="<?php echo $value['tag_name']; ?>"  class="mb-tag-remove tagremove" style="cursor: pointer" >x</a></div></li>
                                                                <?php
                                                            }
                                                            echo "</ul>";
                                                        }
                                                        ?>
                                                    </div>

                                                    <input id="tags" placeholder="Enter tags here" style="width:87%" />
                                                    <input type="hidden" id="hidden_tag" name="hidden_tag" />
                                                    <div class="jquery-script-clear"></div>
                                                    <script type="text/javascript">
                                                        $("#tags").masterblaster({
                                                            animate: true
                                                        });
                                                    </script>
                                                </div>


                                                <div>
                                                    <br/><br/>
                                                    <label for="form-field-8">Url</label>

                                                    <input type="text" class="form-control" placeholder="Website Name" name="prd_link" value='<?php echo $prd_link; ?>'  >
                                                </div>

                                                <hr />


                                                <div>
                                                    <label for="form-field-8">Tel</label>
                                                    <input type="text" class="form-control" placeholder="Website Name" name="prd_tel" value='<?php echo $prd_number; ?>'  >
                                                </div>

                                                <hr />

                                                <div>
                                                    <label for="form-field-8">Address</label>
                                                    <input type="text" class="form-control" placeholder="Website Name" name="prd_address" value='<?php echo $prd_address; ?>'  >
                                                </div>

                                                <hr />

                                                <div>
                                                    <label for="form-field-9">Description <span class='small red'>(500 Character Limit)</span></label>
                                                    <textarea class="form-control limited" id="prd_desc" name="prd_desc" maxlength="500"><?php echo $prd_info; ?></textarea>
														<label  id="character-count">500 characters remaining</label>
                                                </div>

                                                <hr />
												
												
												
												<!---working here -->
												
																		
<div class="form-group">
<label for="exampleInputEmail1"><br>Windows App URL</label>
<input type="text" class="form-control" id="windowApp" name="windowApp" placeholder="Windows APP URL" value="<?php echo $windows_app_url; ?>" > 
</div>

<div class="form-group">
<label for="exampleInputEmail1">iOS App URL</label>
<input type="text" class="form-control" id="iosApp" name="iosApp" placeholder="iOS APP URL" value="<?php echo $ios_app_url; ?>">
</div>

<div class="form-group">
<label for="exampleInputEmail1">Android App URL</label>
<input type="text" class="form-control" id="androidApp" name="androidApp" placeholder="Android APP URL" value="<?php echo $android_app_url; ?>">
</div>

<div class="form-group">
<label for="exampleInputEmail1">Deals (URL)</label>
<input type="text" class="form-control" id="deallink" name="deallink" placeholder="Deals of the day URL" value="<?php echo $deal_link; ?>">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Services Offered</label>
	<input type="text" class="form-control" id="servicesOffered" name="servicesOffered" placeholder="Services Offered" value="<?php echo $services_offered; ?>">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Customer Support ID</label>
	<input type="text" class="form-control" id="custId" name="custId" placeholder="Customer Support ID" value="<?php echo $customer_support_id; ?>">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Payment Options</label>
	
	
	<select name="payoption[]" multiple="multiple" class="form-control" id='payoption'>
<?php 
$title = array(
    'visa' ,
    'master' ,
    'paypal' ,
    'Credit Card',
    'Banking' ,
    'Debit Card' ,
    'Cash On Delivery' ,
    'Net Banking'
);
$dbpaymentoptions = $payment_option;
$arrayData = explode(",",$dbpaymentoptions);
foreach ($title as $opt) {
    $sel = '';
    if (in_array($opt, $arrayData)) {
		$sel = ' selected="selected" ';
    }
    echo '<option ' . $sel . ' value="' . $opt . '">' . $opt . '</option>';
}
?>
</select>

	
	
	<!--<select name="payoption[]" multiple="multiple" class="form-control" id='payoption'>
   <option value='visa' >Visa</option>

  <option value='master' >Master</option>

<option value='paypal' >Paypal</option>
<option value='Credit Card' >Credit Card</option>
<option value='Banking' >Banking</option>
  <option value='Debit Card' >Debit Card</option>
  <option value='Debit Card' >Net Banking</option>
 <option value='Cash On Delivery' >Cash On Delivery</option>

</select>-->
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Locations Covered </label>
	<input type="text" class="form-control" id="locations" name="locations" placeholder="Locations Covered" value="<?php echo $locations; ?>">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Delivery Time </label>
	<input type="text" class="form-control" id="deliveryTime" name="deliveryTime" placeholder="Delivery Time" value="<?php echo $delivery_time; ?>">
</div>
					
												
												<!--working here-->
												
												
												

                                                <div>
                                                    <label for="form-field-8">Logo Image</label>
                                                    <input type='file' name='file' id='file' />
                                                    <div id="imagePreview"> </div>
                                                    <br/>
                                                    <img src='<?php echo $prd_image ?>' name='old_image' width='75px' />

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






    <?php
}
?>
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
    )

    $("form#productupdateForm").submit(function (event) {
        //disable the default form submission
        event.preventDefault();
        //grab all form data  
        var formData = new FormData($(this)[0]);
        var baseHref = document.getElementsByTagName('base')[0].href;
        $.ajax({
            url: baseHref + "admin/weblist/productUpdate",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {
                if (returndata == "1")
                {
                    alert("Website Updated Succesfully");
                    window.location.href = baseHref + "admin/weblist/index";//"http://localhost/code/";
                } else
                {
                    alert("Please try again later");
                }
                console.log(returndata);
            }
        });

        return false;
    });

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