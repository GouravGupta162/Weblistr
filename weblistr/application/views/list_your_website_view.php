 
<section class="all_cat">
<div class="container">
<div class="col-md-8 sss">
<div class="write_head">
<h2>List a Website</h2>
</div>
<div class="review_form">
<form class="form_style"  action="<?php echo base_url(); ?>weblist/add_list_your_website" method="post" id="weblistform"  enctype="multipart/form-data">


   <!--<div class="form-group">
    <label for="exampleInputEmail1">Category*</label>
	<input type="text" class="form-control" id="webcategory"  autocomplete="off" name="webcategory" placeholder="Select a category"  />
	  <ul class="txtCategory c_list "  role="menu" aria-labelledby="dropdownMenu"  id="DropdownCategory"></ul>
	<input type="hidden" id="cat_hidden" name="cat_hidden" />
	<div id="webcategorymsg"> </div>
  </div>-->
  
    <div class="form-group">
    <label for="exampleInputEmail1">Website of the business<span class="mandatorysymbol">*</span></label>
	<input type="text" class="form-control" id="weblink" name="weblink" autocomplete='off'  placeholder="http://www.example.com" value="<?php echo set_value('weblink'); ?>" />
    <div id="weblinkmsg" class="infodanger"> </div>
  </div>
  
  <script type='text/javascript'>
  function selectionAutoCompletenew()
{
//alert('start');
	var x = $('#webcategory').val();
	//alert(x);
	if(x != 0){
	//alert(x);
		$('#cat_hidden_val').val(x);
	}
	else{
		$('#cat_hidden_val').val('');
		alert('please select category');
	}
}
  </script>
  <div class="form-group">
    <label for="exampleInputEmail1">Category<span class="mandatorysymbol">*</span></label>
	<select name='webcategory'  id='webcategory' class='form-control' onchange='selectionAutoCompletenew()' >
	<option class="dropdownlivalue" value="0" id="0">Select a Category</option>
	<?php 
		foreach($getAllcat as $cat)
		{
			?>
			<option class="dropdownlivalue" value='<?php echo $cat['cat_id']; ?>' id='<?php echo $cat['cat_id']; ?>' ><?php echo $cat['cat_name']; ?></option>
			<?php
		}
	?>
	</select>
	<input type="hidden" id="cat_hidden_val" name="cat_hidden"  />
	<div id="webcategorymsg"  class="infodanger"> </div>
  </div>
  
  <!--
 <div class="form-group">
    <label for="exampleInputEmail1">Website Name<span class="mandatorysymbol">*</span></label>
	 <input type="text" class="form-control" id="webname" name="webname" autocomplete='off'  placeholder="Website Name" value="<?php echo set_value('webname'); ?>" />
    <div id="webnamemsg" class="infodanger"> </div>
  </div> -->

  <!--<div class="form-group">
    <label for="exampleInputEmail1">Office Address</label>
	<input type="text" class="form-control" id="webaddress" name="webaddress" autocomplete='off' placeholder="###, Address" value="<?php echo set_value('webaddress'); ?>" />
    <div id="webaddressmsg"> </div>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Contact Number*</label>
	<input type="text" class="form-control" id="webnumber" name="webnumber" autocomplete='off'  placeholder="##########" value="<?php echo set_value('webnumber'); ?>" />
    <div id="webnumbermsg" class="infodanger"> </div>
  </div>-->
  
  <div class="form-group">
    <label for="exampleInputFile">Basic Information<span class="mandatorysymbol">*</span></label>
   <textarea rows="3" class="form-control" id="webinfo" name="webinfo"  autocomplete='off'  placeholder="Basic Information" ><?php echo set_value('webinfo'); ?></textarea>
   <div id="webinfomsg" class="infodanger"> </div>
  </div>

  
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


<!--
<div class="form-group">

<label for="exampleInputEmail1"><br/>Windows App URL</label>
<input type="text" class="form-control" id="windowApp" name="windowApp" placeholder="Windows APP URL" />

</div>

<div class="form-group">
<label for="exampleInputEmail1">iOS App URL</label>
<input type="text" class="form-control" id="iosApp" name="iosApp" placeholder="iOS APP URL" />
</div>

<div class="form-group">
<label for="exampleInputEmail1">Android App URL</label>
<input type="text" class="form-control" id="androidApp" name="androidApp" placeholder="Android APP URL" />
</div>-->
  
  <!--
<div class="form-group">
<label for="exampleInputEmail1">Deals (URL)</label>
<input type="text" class="form-control" id="deallink" name="deallink" placeholder="Deals of the day URL" />
</div>


<div class="form-group">
    <label for="exampleInputEmail1">Services Offered <span class='small-red-text'>(please enter comma between services)</span></label>
	<input type="text" class="form-control" id="servicesOffered" name="servicesOffered" placeholder="Services Offered" />
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Customer Support ID</label>
	<input type="text" class="form-control" id="custId" name="custId" placeholder="Customer Support ID" />
</div>
  
 <div class="form-group">
    <label for="exampleInputEmail1">Payment Options</label>
	<select name="payoption[]" multiple="multiple" class="form-control" id='payoption'>
  <option value='visa' >Visa</option>
  <option value='master' >Master</option>
<option value='paypal' >Paypal</option><option value='Credit Card' >Credit Card</option><option value='Banking' >Banking</option>  <option value='Debit Card' >Debit Card</option>  <option value='Debit Card' >Net Banking</option> <option value='Cash On Delivery' >Cash On Delivery</option>
</select>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Locations Covered </label>
	<input type="text" class="form-control" id="locations" name="locations" placeholder="Locations Covered" />
  </div>
  
  
<div class="form-group">
    <label for="exampleInputEmail1">Delivery Time </label>
	<input type="text" class="form-control" id="deliveryTime" name="deliveryTime" placeholder="Delivery Time" />
</div>
  -->
  
    
  <div class="form-group">
    <label for="exampleInputFile">Website Images</label>
	<input type="file" id="file" name="file" />
	<div id="imagePreview"> </div>
   
   <div id="webfilemsg" class="infodanger"> </div>
  </div>
  
  
<div class="form-group">
	<div id="liststatus"> </div>
</div>
  
<div class="form-group">
 <div class="bottom_btns pull-right"><button type="submit" class="submit_btn" onClick="add_list_your_website()" >Submit</button>
  <button type="reset" class="submit_btn">Reset</button></div></div>
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
			$('#webfilemsg').html('');
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    });
//*
</script>