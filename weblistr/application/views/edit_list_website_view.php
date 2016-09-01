 
<section class="all_cat">
<div class="container">
<div class="col-md-8 sss">
<div class="write_head">
<h2>Edit Your Website</h2>
</div>
<div class="review_form">
<form class="form_style"  action="<?php echo base_url(); ?>weblist/edit_list_your_website" method="post" id="editweblistform"  enctype="multipart/form-data">

   <!--<div class="form-group">
    <label for="exampleInputEmail1">Category*</label>
	<input type="text" class="form-control" id="webcategory"  autocomplete="off" name="webcategory" placeholder="Select a category"  />
	  <ul class="txtCategory c_list "  role="menu" aria-labelledby="dropdownMenu"  id="DropdownCategory"></ul>
	<input type="hidden" id="cat_hidden" name="cat_hidden" />
	<div id="webcategorymsg"> </div>
  </div>-->
  
  <input type='hidden' id='prd_id' name='prd_id' value='<?php echo $product['prd_id']; ?>' />
    <div class="form-group">
    <label for="exampleInputEmail1">Website of the business<span class="mandatorysymbol">*</span></label>
	<input type="text" class="form-control" id="weblink" name="weblink" placeholder="http://www.example.com" value="<?php echo  $product['prd_link'] ?>" disabled />
    <div id="weblinkmsg" class="infodanger"> </div>
  </div>
   

	<div class="form-group">
	<label for="exampleInputEmail1">Category<span class="mandatorysymbol">*</span></label>
	
	
<select name="webcategory[]" multiple="multiple" class="form-control" id='webcategory' disabled>
<?php 
$getAllSelectedCat = $getAllSelectedCat['cat_id'];
$arrayData = explode(",",$getAllSelectedCat);
foreach ($getAllCat as $opt) {
	//var_dump($opt);
    $sel = '';
    if (in_array($opt['cat_id'], $arrayData)) {
		$sel = ' selected="selected" ';
    }
    echo '<option ' . $sel . ' value="' . $opt['cat_id'] . '">' . $opt['cat_name'] . '</option>';
}
?>
</select>
<?php //echo $getAllSelectedCat['cat_id']; ?>
<?php //var_dump($getAllCat); ?>

		<!--<select name='webcategory0' id='webcategory0' class='form-control'  disabled >
		<option class="dropdownlivalue" value='<?php echo $getAllcat['cat_id']; ?>' id='<?php echo $getAllcat['cat_id']; ?>' ><?php echo $getAllcat['cat_name']; ?></option>
		</select>-->
	<input type="hidden" id="cat_hidden" name="cat_hidden" />
	<div id="webcategorymsg"  class="infodanger"> </div>
	</div>
  
 
  
 <div class="form-group">
    <label for="exampleInputEmail1">Website Name<span class="mandatorysymbol">*</span></label>
	 <input type="text" class="form-control" id="webname" name="webname" placeholder="Website Name" value="<?php echo  $product['prd_name'] ?>" disabled />
    <div id="webnamemsg" class="infodanger"> </div>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Office Address</label>
	<input type="text" class="form-control" id="webaddress" name="webaddress" placeholder="###, Address" value="<?php echo $product['prd_address'] ?>"  />
    <div id="webaddressmsg"> </div>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Contact Number</label>
	<input type="text" class="form-control" id="webnumber" name="webnumber" placeholder="##########"  value="<?php echo  $product['prd_number'] ?>"  />
    <div id="webnumbermsg" class="infodanger"> </div>
  </div>
  
  <div class="form-group">
    <label for="exampleInputFile">Basic Information<span class="mandatorysymbol">*</span></label>
   <textarea rows="3" class="form-control" id="webinfo" name="webinfo"  placeholder="Basic Information" ><?php echo  $product['prd_info'] ?></textarea>
   <div id="webinfomsg" class="infodanger"> </div>
  </div>

  <!--
   <div class="form-group">
<label for="exampleInputFile">Tags</label>

<input id="tags" placeholder="Enter tags here"/>

<input type="hidden" id="hidden_tag" name="hidden_tag" />
<div class="jquery-script-clear"></div>
<script type="text/javascript">
$("#tags").masterblaster({
	animate: true
});
</script>
</div>

-->

<div class="form-group">

<label for="exampleInputEmail1"><br/>Windows App URL</label>
<input type="text" class="form-control" id="windowApp" name="windowApp" placeholder="Windows APP URL"  value='<?php echo  $product['windows_app_url'] ?>'  />

</div>

<div class="form-group">
<label for="exampleInputEmail1">iOS App URL</label>
<input type="text" class="form-control" id="iosApp" name="iosApp" placeholder="iOS APP URL"  value='<?php echo  $product['ios_app_url'] ?>'  />
</div>

<div class="form-group">
<label for="exampleInputEmail1">Android App URL</label>
<input type="text" class="form-control" id="androidApp" name="androidApp" placeholder="Android APP URL" value='<?php echo  $product['android_app_url'] ?>'  />
</div>
  
<div class="form-group">
<label for="exampleInputEmail1">Deals (URL)</label>
<input type="text" class="form-control" id="deallink" name="deallink" placeholder="Deals of the day URL" value='<?php echo  $product['deal_link'] ?>' />
</div>


<div class="form-group">
    <label for="exampleInputEmail1">Services Offered</label>
	<input type="text" class="form-control" id="servicesOffered" name="servicesOffered" placeholder="Services Offered" value='<?php echo  $product['services_offered'] ?>' />
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Customer Support ID</label>
	<input type="text" class="form-control" id="custId" name="custId" placeholder="Customer Support ID" value='<?php echo  $product['customer_support_id'] ?>' />
</div>


<!--  
 <div class="form-group">
    <label for="exampleInputEmail1">Payment Options</label>
	<select class="form-control" name='payoption' id='payoption' >
	<option  value='<?php echo  $product['payment_option'] ?>' /><?php echo  $product['payment_option'] ?></option>
</select>
  </div>-->
  
 
  
  
   <div class="form-group">
    <label for="exampleInputEmail1">Payment Options</label>
	
	
<?php 
$payment=array(
	'Credit Card' ,
	'Debit Card' ,
    'Net Banking',
    'Cash On Delivery' ,
	'Payment Wallets' ,
	'Other Banking' 
);
$dbpaymentoptions = $product['payment_option'];
$arrayData = explode(",",$dbpaymentoptions);
//print_r($arrayData);
?>
<input type="checkbox" name="payoption[]"  value="Credit Card" <?php if(in_array("Credit Card",$arrayData)) { echo "checked"; } ?> >Credit Card
<input type="checkbox" name="payoption[]" value="Debit Card" <?php if(in_array("Debit Card",$arrayData)) { echo "checked"; } ?> >Debit Card
<input type="checkbox" name="payoption[]" value="Net Banking" <?php if(in_array("Net Banking",$arrayData)) { echo "checked"; } ?> >Net Banking
<input type="checkbox" name="payoption[]" value="Cash On Delivery" <?php if(in_array("Cash On Delivery",$arrayData)) { echo "checked"; } ?> >Cash On Delivery
<input type="checkbox" name="payoption[]" value="Payment Wallets" <?php if(in_array("Payment Wallets",$arrayData)) { echo "checked"; } ?> >Payment Wallets
<input type="checkbox" name="payoption[]" value="Other Banking" <?php if(in_array("Other Banking",$arrayData)) { echo "checked"; } ?> >Other Banking

<!--	
<select name="payoption[]" multiple="multiple" class="form-control" id='payoption'>
<?php 

// $title = array(
    // 'visa' ,
    // 'master' ,
    // 'paypal' ,
    // 'Credit Card',
    // 'Banking' ,
    // 'Debit Card' ,
    // 'Cash On Delivery' ,
    // 'Net Banking'
// );
// $dbpaymentoptions = $product['payment_option'];
// $arrayData = explode(",",$dbpaymentoptions);
// foreach ($title as $opt) {
    // $sel = '';
    // if (in_array($opt, $arrayData)) {
		// $sel = ' selected="selected" ';
    // }
    // echo '<option ' . $sel . ' value="' . $opt . '">' . $opt . '</option>';
// }
?>
</select>-->
  </div>
  
  
  
  <div class="form-group">
    <label for="exampleInputEmail1">Locations Covered </label>
	<input type="text" class="form-control" id="locations" name="locations" placeholder="Locations Covered" value='<?php echo  $product['locations'] ?>' />
  </div>
  
  
<div class="form-group">
    <label for="exampleInputEmail1">Delivery Time </label>
	<input type="text" class="form-control" id="deliveryTime" name="deliveryTime" placeholder="Delivery Time"  value='<?php echo  $product['delivery_time'] ?>' />
</div>
  
  
    <!--
  <div class="form-group">
    <label for="exampleInputFile">Website Images</label>
	<input type="file" id="file" name="file" />
	<div id="imagePreview"> </div>
   
   <div id="webinfomsg" class="infodanger"> </div>
  </div>-->
  
  
<div class="form-group">
	<div id="status"> </div>
</div>
  
<div class="form-group">
 <div class="bottom_btns pull-right"><button type="submit" class="submit_btn"  >Submit</button>
 
 <!--<div class="bottom_btns pull-right"><button type="submit" class="submit_btn" onClick="add_list_your_website()" >Submit</button>-->
  <button type="reset" class="submit_btn">Cancel</button></div></div>
</form>
</div>
</div>


</div>

</div>

</div>
</section>
<link rel="stylesheet" type="text/css" href="css/jquery.masterblaster.css">
<script>

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
					"width": "100px"
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