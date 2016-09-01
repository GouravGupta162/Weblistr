<link href="css/raterater.css0" rel="stylesheet" type="text/css" />
<script src="js/raterater.jquery.js0" ></script>


<style>
	
	@import url(http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

	fieldset, label { margin: 0; padding: 0; }
	h1 { font-size: 1.5em; margin: 10px; }

	.newrating { 
		border: none;
		float: left;
	}

	.newrating > input { display: none; } 
	.newrating > label:before { 
		margin: 5px;
		font-size: 1.25em;
		font-family: FontAwesome;
		display: inline-block;
		content: "\f005";
	}

	.newrating > .half:before { 
		content: "\f089";
		position: absolute;
	}

	.newrating > label { 
		color: #ddd; 
		float: right; 
	}

	.newrating > input:checked ~ label, 
	.newrating:not(:checked) > label:hover,  
	.newrating:not(:checked) > label:hover ~ label { color: #FFD700;  }

	.newrating > input:checked + label:hover, 
	.newrating > input:checked ~ label:hover,
	.newrating > label:hover ~ input:checked ~ label, 
	.newrating > input:checked ~ label:hover ~ label { color: #FFED85;  }     
</style>
		
<script>

	
$(document).ready(function () {
	$("#demo2 .stars").click(function () {
		//alert($(this).val());
		$('#rate1').val($(this).val());
		$(this).attr("checked");
		$('#starcountindiv').html($(this).val());
	});
	$("#demo2 ").mouseout(function () {
		$('#starcountindiv').html($('#rate1').val());
	});
});
function hovers(par)
{
	$('#starcountindiv').html(par);
	//alert(par);
}
</script>


<script>


$(document).ready(function () {
	var baseHref = document.getElementsByTagName('base')[0].href;
    $("#webproduct").keyup(function () {
		
        $.ajax({
            type: "POST",
            url: baseHref+"Review/getProduct_AutoComplete",
            data: {
                keyword: $("#webproduct").val()
            },
            dataType: "json",
            success: function (data) {
                if (data.length > 0) {
                    $('#DropdownProduct').empty();
                    $('#webproduct').attr("data-toggle", "dropdown");
                    $('#DropdownProduct').dropdown('toggle');
                }
                else if (data.length == 0) {
                    $('#webproduct').attr("data-toggle", "");
                }
                $.each(data, function (key,value) {
					//console.log(value.value);
                    if (data.length >= 0)
$('#DropdownProduct').append('<li role="presentation" ><a role="menuitem dropdownnameli" class="dropdownlivalue" id='+value.value+' onClick="SelectAutoComplete(this.id);" >' + value.label + '</a></li>');
                });
            }
        });
    });
    $('ul.txtProduct').on('click', 'li a', function () {
		//console.log($(this).text());
        $('#webproduct').val($(this).text());
		$('ul.txtProduct').hide();
    });
});
function SelectAutoComplete(id)
{
	$('#prd_hidden').val(id);
}
function write_review()
{
	
	resetListForm();
	var baseHref = document.getElementsByTagName('base')[0].href;
	var prd_hidden = $('#prd_hidden').val(),
	title = $('#webTitle').val(),
	webBody = 	$('#webBody').val(),
	rate1 = 	$('#rate1').val();
	// rate2 = 	$('#rate2').val(),
	// rate3 = 	$('#rate3').val(),
	// rate4 = 	$('#rate4').val(),
	// rate5 = 	$('#rate5').val();
	
	var errormsg = false;
	if(document.getElementById("webcategory")){
	var x = document.getElementById("webcategory").value;
		if(x == 0){
			$('#cat_hidden').val('');
			$('#subcategory').html('<option class="dropdownlivalue" value="0" id="0">Select company name</option>');
			$('#webcategorymsg').html('<span class="infodanger">Please select category</span>');
			errormsg  = true;
			return false;
		}
	}
	
	// if(document.getElementById("subcategory").value == 0){
		// $('#Tempwebproductmsg').html('<span class="infodanger">Please select category</span>');
		// errormsg  = true;
		// return false;
	// }
	
	if(prd_hidden == "")
	{
		$('#webproductmsg').html('Please select company name');
		$('#webproduct').focus();
		errormsg  = true;
		return false;
	}
	if(title == "")
	{
		$('#webTitlemsg').html('Please enter review title');
		$('#webTitle').focus();
		errormsg  = true;
		return false;
	}
	if(webBody == "")
	{
		$('#webBodymsg').html('Please enter review message');
		$('#webBody').focus();
		errormsg  = true;
		return false;
	}
	
	if(errormsg == false)
	{
		//
		return true;
	}
}
function resetListForm()
{
	$('#webproductmsg').html('');
	$('#ratingmessage').html('');
	$('#webTitlemsg').html('');
	$('#webBodymsg').html('');
}


$(document).ready(function (e) {
	var baseHref = document.getElementsByTagName('base')[0].href;
	$("#updatereviewform").on('submit',(function(e) {
		e.preventDefault();
		
		//console.log(add_list_your_website());
		if(write_review() == true)
		{
			showloader();	
			$.ajax({
				url: baseHref + "Review/UpdateReview",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success: function(data)
				{
					hideloader();
					console.log(data);
					//console.log("d");
					if(data == 0)
					{
						
						$("#loginModal .modalFrom").html('<center><span  class="infodanger" >Please logged in first</span></center>');
						$("#loginModal").modal('show');
						
						//alert('pending');
						//$('#finalstatus').html('<span  class="infodanger" >Please logged in first</span>');
					}
					else if(data == 1){
					
						$("#statusModal #eventModelHtml").html('<span  class="infosuccess" >your review updated successfully.</span>');
						
						// $("#statusModal").modal('show');
						// $('#webcategory').val('0');
						// $('#subcategory').val('0');
						// $('#webTitle').val('');
						// $('#odrnum').val('');
						// $('#webBody').val('');
						
						
						var baseHref = document.getElementsByTagName('base')[0].href;
						window.location.href=baseHref+"user/bookmark";
	
						
						
						//$('#finalstatus').html('<span  class="infosuccess" >your review submitted successfully. we will notify you after approve it</span>');
					}
					//setTimeout(function(){ $("#statusModal").modal('hide'); $("#statusModal #eventModelHtml").html('');   }, 10000);
				},
				  error: function() 
				{
					
				}             
			});
		}
		else{
			//Validation occured
		}
	}));
});

function freshReview()
{
	var baseHref = document.getElementsByTagName('base')[0].href;
	window.location.href = baseHref + "review/write";
	//location.reload();
}

function homeredirect()
{
	var baseHref = document.getElementsByTagName('base')[0].href;
	window.location.href=baseHref;
}
</script>

<section class="all_cat">
<div class="container">
<div class=" col-md-8">
<div class="write_head">
<h2>Review an online Website</h2>
</div>
<div class="review_form">


<form class="form_style"  action="<?php echo base_url(); ?>Review/UpdateReview" method="post" id="updatereviewform"  enctype="multipart/form-data">
  <div class="form-group">
    
	<input type='hidden' id='rev_hidden' name='rev_hidden' value='<?php echo $reviews['rev_id']; ?>' />
	
<?php 
if($autocom != null) {
foreach ($autocom as $value) {
?>
<label for="exampleInputEmail1">Company name</label>
<?php
echo "<input type='text' class='form-control' disabled='disabled'  id='webproduct'  autocomplete='off'  name='webproduct'  value='$value->prd_name' />";
echo "<ul class='txtProduct c_list'  role='menu' aria-labelledby='dropdownMenu'  id='DropdownProduct'></ul>";
echo "<input type='hidden' id='prd_hidden' name='prd_hidden' value='$value->prd_id,$value->cat_id' />";
echo "<div id='webproductmsg'  class='infodanger'> </div>";
}
	

} else {
	
//var_dump($getAllcat);
?>
<script>
function selectWebcat()
{
	var x = document.getElementById("webcategory").value;
	if(x != 0){
		$('#cat_hidden').val(x);
		
		$('#webcategorymsg').html('');
		
		$.ajax({
			url: baseHref + "review/getcategoryProduct",
			type: "POST",
			data:  { cat_hidden : x },
			success: function(data)
			{
				$('#subcategory').html(data);
			},
			error: function() 
			{
				
			}             
		});
	}
	else{
		$('#cat_hidden').val('');
		$('#subcategory').html('<option class="dropdownlivalue" value="0" id="0">Select Company</option>');
		$('#webcategorymsg').html('<span class="infodanger">Please select category</span>');
		
	}
}
function selectWebPrd()
{
	var prd = document.getElementById("subcategory").value;
	if(prd != 0){
		$('#prd_hidden').val(prd+','+$('#cat_hidden').val());
		$('#Tempwebproductmsg').html('');
	}
	else{
		
		$('#Tempwebproductmsg').html('<span class="infodanger">Please select company name</span>');
		//alert('Please select product');
	}
}
</script>
	
<div class="form-group">
    <label for="exampleInputEmail1">Category<span class='mandatorysymbol'>*</span></label>
	<select name='webcategory' id='webcategory' class='form-control' onchange='selectWebcat()' >
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
	<input type="hidden" id="cat_hidden" name="cat_hidden" />
	<div id="webcategorymsg"> </div>
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Company name<span class='mandatorysymbol'>*</span></label>
	<select name='subcategory' id='subcategory' class='form-control' onchange='selectWebPrd()' >
		<option class="dropdownlivalue" value='0' id='0' >Select company name</option>
	</select>
	<div id="Tempwebproductmsg"  class='infodanger'> </div>
</div>

	<!--
<input type="text" class="form-control" id="webproduct"  autocomplete="off" name="webproduct" placeholder="Select a Website" value="<?php //echo set_value('webproduct'); ?>" />
<ul class="txtProduct c_list"  role="menu" aria-labelledby="dropdownMenu"  id="DropdownProduct"></ul> -->
<input type="hidden" id="prd_hidden" name="prd_hidden" />
<div id="webproductmsg"  class='infodanger'> </div>
<?php  }?>
  </div>
 

  <div class="form-group">
    <label for="exampleInputPassword1">Title of your review<span class='mandatorysymbol'>*</span></label>
	<input type="text" class="form-control" id="webTitle"  maxlength='40'  autocomplete="off" name="webTitle" placeholder="If you could say t in one sentence, what would you say?" value="<?php echo $reviews['review_head']; ?>" />
	<span  style="float:right" id="character-count">40 characters remaining</span>
	<div id="webTitlemsg"  class='infodanger'> </div>
	
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Order Number</label>
	<input type="text" class="form-control" id="odrnum"  autocomplete="off" name="odrnum" placeholder="Your Order Number" value="<?php echo $reviews['odrnum']; ?>" />
	
	<div id="ordNumbermsg" class='infodanger' > </div>
	
  </div>
  
<div class="online-review">
<span>Your current rating</span>
<?php
	if(sizeof($review_details)>0)
	{
		if(strpos($review_details['rating_stars'], '.') !== FALSE)
		{
			$splited =  explode(".",$review_details['rating_stars']);
			$splitersize = sizeof($splited);
			if($splitersize > 1)
			{
				$mainstar = $splited[0];
				$dotstar = $splited[1];
				$this->contact_model->ratingNewWrite($mainstar,$dotstar);
			}
		}
		else{
			$this->contact_model->ratingNewWrite($review_details['rating_stars'],'0');
		}
	}
	else{
		$this->contact_model->ratingNewWrite('0','0');
	}
?>
</div>

<div class="form-group">
  
<style>
.form_style label {
    color: #333;
    font-size: 15px;
	width: 15.%;
}
</style>
   
    <label for="exampleInputEmail1">Overall Rating<span class='mandatorysymbol'>*</span></label>
<fieldset id="demo2" class="newrating">
	<input onMouseover="hovers('5.0')" class="stars" type="radio" id="star53" name="newrating" value="5">
	<label onMouseover="hovers('5.0')" class="full" for="star53" title="Awesome - 5 stars"></label>
	<input onMouseover="hovers('4.5')" class="stars" type="radio" id="star4half3" name="newrating" value="4.5">
	<label onMouseover="hovers('4.5')" class="half" for="star4half3" title="Pretty good - 4.5 stars"></label>
	
	<input onMouseover="hovers('4.0')" class="stars" type="radio" id="star43" name="newrating" value="4">
	<label onMouseover="hovers('4.0')" class="full" for="star43" title="Pretty good - 4 stars"></label>
	<input onMouseover="hovers('3.5')" class="stars" type="radio" id="star3half3" name="newrating" value="3.5">
	<label onMouseover="hovers('3.5')" class="half" for="star3half3" title="Meh - 3.5 stars"></label>
	
	<input onMouseover="hovers('3.0')" class="stars" type="radio" id="star33" name="newrating" value="3">
	<label onMouseover="hovers('3.0')" class="full" for="star33" title="Meh - 3 stars"></label>
	<input onMouseover="hovers('2.5')" class="stars" type="radio" id="star2half3" name="newrating" value="2.5">
	<label onMouseover="hovers('2.5')" class="half" for="star2half3" title="Kinda bad - 2.5 stars"></label>
	
	<input onMouseover="hovers('2.0')" class="stars" type="radio" id="star23" name="newrating" value="2">
	<label onMouseover="hovers('2.0')" class="full" for="star23" title="Kinda bad - 2 stars"></label>
	<input onMouseover="hovers('1.5')" class="stars" type="radio" id="star1half3" name="newrating" value="1.5">
	<label onMouseover="hovers('1.5')" class="half" for="star1half3" title="Meh - 1.5 stars"></label>
	
	<input onMouseover="hovers('1.0')" class="stars" type="radio" id="star13" name="newrating" value="1">
	<label onMouseover="hovers('1.0')" class="full" for="star13" title="Sucks big time - 1 star"></label>
	<input onMouseover="hovers('0.5')" class="stars" type="radio" id="starhalf3" name="newrating" value="0.5">
	<label onMouseover="hovers('0.5')" class="half" for="starhalf3" title="Sucks big time - 0.5 stars"></label>
</fieldset>

 <div id='starcountindiv'> </div>
  
  
  <input type="hidden" id="rate1" name="rate1" value="0" />
  </div>
  
  <!--
<div class="form-group">
  
    <label for="exampleInputEmail1">Overall Rating<span class='mandatorysymbol'>*</span></label>

 <div class="ratebox" data-id="1" data-rating="0"></div></br></br></br>
 <div id="ratingmessage" class='infodanger' > </div>
 <input type="hidden" id="rate1" name="rate1" value="0" />
 <div id='starcountindiv'> </div>

  </div>
-->
  
  
  
  <div class="form-group">
    <label for="exampleInputFile">Your Review<span class='mandatorysymbol'>*</span></label>
   <textarea class="form-control" id="webBody" name="webBody"  maxlength='400'  style="min-height: 150px;" rowspan="5" ><?php echo $reviews['review_body']; ?></textarea>
   <span  style="float:right" id="character-count_body">400 characters remaining</span>
   <div id="webBodymsg"  class='infodanger'> </div>
  </div>
  
     
<div id="formdiv" class="form-group">
  
  <div id="filediv"><input name="my_file[]" type="file" id="my_file"/></div>
 <div class="add_file_field"> 
<input type="button" id="add_more" class="upload" value="Add More Files"/></div>
  <input type="hidden" id='maximg' name='maximg' value='1' />
  <!--
  <div id="filediv">
    <input type="file" id="my_file" name="my_file[]" multiple="multiple" accept="image/*" title="Select Images To Be Uploaded">
    <br>
  </div>-->
  
  <?php 
if(sizeof($review_images)>0)
{
	?>
	<span class="fieldRevimg">
	<?php
	foreach($review_images as $revimg)
	{
		?>
		<img src='<?php echo $revimg['thumbnail']; ?>' />
		<?php
	}
	?>
	</span>
	<?php
}
else{
	?><div class="no_img">
		No images</div> 
	<?php
}
?>

</div>

 
  
  <!--
<div class="form-group">
<label for="exampleInputFile">Attachment(s)</label>
<div id="imagemsg" > </div>
<div class="imgPreview">
<input type="file" class="multi with-preview" name='my_file[]' id="my_file"  multiple />
</div>


<?php /*
if(sizeof($review_images)>0)
{
	foreach($review_images as $revimg)
	{
		?>
		<img src='<?php echo $revimg['thumbnail']; ?>' />
		<?php
	}
}
else{
	?>
		No images 
	<?php
}
*/
?>


</div>
-->

<div class="form-group">
<div id="finalstatus" >
</div>

<div class="bottom_btns pull-right"><button type="submit" class="submit_btn"  >Submit</button>
<!--<button type="reset" class="submit_btn">Reset</button>-->
</div>
</div>
</form>
</div>
</div>

<div class="col-md-4">
<div class="rev-right">
<h2>Why Write A Review</h2>
<p>Weblistr is a one of its kind platform in India dedicated solely to online businesses. You must make use of it to voice your opinion and share your pleasant or unpleasant online shopping experiences with the online businesses and others consumers. This lets startups know how you feel and take necessary actions. Also, by writing a review, you contribute to our community and help others make a more informed buying decisions.</p>
</div>
<div class="guidelines">
<h2>Guidelines</h2>
<ul>
<li>Please write genuine reviews only. Share your true experiences with the community. If you had a good experience, do appreciate and you had a bad experience do not hesitate. </li>
<li>Rating is on a scale of 1-5, 5 being the best.</li>
<li>Kindly ensure your review is atleast 80characters and a max of 300 characters.</li>
<li>Please know that no foul / abusive language, threats, and lewdness shall be accepted through your reviews.</li>
<li>Please use a review title, a review title is like a summary of your review.</li>
<li>Please mention your order number it helps in easier verification of your review.</li>
<li>Insert images if and when necessary. The images should be of HDquality. </li>
<li>Avoid duplicate review submissions. </li>
</ul>
</div>
</div>

</div>
</div>
</div>
</section>
<style>
@import "http://fonts.googleapis.com/css?family=Droid+Sans";

#formdiv{
width:100%;
float:left;
text-align:center
}
form{
width:100%;
float:left;
}
h2{
margin-left:30px
}
.upload{
background-color:#999;
border:none;
color:#fff;
border-radius:0px;
padding:8px;
text-shadow:1px 1px 0 green;
float:left;
margin-top:20px;
}
.upload:hover{
cursor:pointer;
background:#6f6f6f;
}
#my_file{
color:green;
padding:5px;
}
#upload{
margin-left:45px
}
#noerror{
color:green;
text-align:left
}
#error{
color:red;
text-align:left
}
#img {
    border: medium none;
    border-radius: 50%;
    height: 20px;
    margin-bottom: 73px;
    margin-left: -22px;
    padding: 0;
    width: 20px;
}
.abcd {
    text-align: left;
    width: 100%;
}
.abcd img {
    border: 1px solid #e8debd;
    float: left;
    height: 100px;
    padding: 5px;
    width: 100px;
margin-right:5px;
margin-bottom:5px;
}


</style>
<!--
<script type="text/javascript" src="js/jquery.MultiFile.js"></script>-->



<script>


var abc = 0;      // Declaring and defining global increment variable.
$(document).ready(function() {
	//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
	$('#add_more').click(function() {
		if($('#maximg').val() <=3)
		{	
$('#maximg').val(parseInt($('#maximg').val()) + 1);
$('.add_file_field').before($("<div/>", {
				id: 'filediv'
			}).fadeIn('slow').append($("<input/>", {
				name: 'my_file[]',
				type: 'file',
				id: 'my_file'
			}), $("")));
		}
		else{
			alert("Maximum 4 Image can attach");
		}
	});
	// Following function will executes on change event of file input to select different file.
	$('body').on('change', '#my_file', function() {
	if (this.files && this.files[0]) {
		abc += 1; // Incrementing global variable by 1.
			var z = abc - 1;
			var x = $(this).parent().find('#previewimg' + z).remove();
			$(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
			$(this).hide();
			$("#abcd" + abc).append($("<img/>", {
				id: 'img',
				src: 'http://www.aorank.com/tutorial/multiple_image_upload_demo/x.png',
				alt: 'delete'
			}).click(function() {
$('#maximg').val(parseInt($('#maximg').val()) - 1);
			$(this).parent().parent().remove();
		}));
	}
	});
	// To Preview Image
	function imageIsLoaded(e) {
		$('#previewimg' + abc).attr('src', e.target.result);
	};
	$('#upload').click(function(e) {
	var name = $(":file").val();
		if (!name) {
			alert("First Image Must Be Selected");
			e.preventDefault();
		}
	});
});

/*

$('#add_more').click(function() {
      "use strict";
      $(this).before($("<div/>", {
        id: 'filediv'
      }).fadeIn('slow').append(
        $("<input/>", {
          name: 'my_file[]',
          type: 'file',
          id: 'my_file',
          multiple: 'multiple',
          accept: 'image/*'
        })
      ));
    });

    $('#upload').click(function(e) {
      "use strict";
      e.preventDefault();

      if (window.filesToUpload.length === 0 || typeof window.filesToUpload === "undefined") {
        alert("No files are selected.");
        return false;
      }
        
    });

    function deletePreview(ele, i) {
      "use strict";
      try {
        $(ele).parent().remove();
        window.filesToUpload.splice(i, 1);
      } catch (e) {
        console.log(e.message);
      }
    }

    $("#my_file").on('change', function() {
      "use strict";
      window.filesToUpload = [];

      if (this.files.length <= 4) {
	  //if ((this.files.length >= 1)&&(this.files.length <= 4)) {
        $("[id^=previewImg]").remove();
        $.each(this.files, function(i, img) {
          var reader = new FileReader(),
            newElement = $("<div id='previewImg" + i + "' class='abcd'><img /></div>"),
            deleteBtn = $("<span class='delete' onClick='deletePreview(this, " + i + ")'>delete</span>").prependTo(newElement),
            preview = newElement.find("img");

          reader.onloadend = function() {
            preview.attr("src", reader.result);
            preview.attr("alt", img.name);
          };

          try {
            window.filesToUpload.push(document.getElementById("file").files[i]);
          } catch (e) {
            console.log(e.message);
          }

          if (img) {
            reader.readAsDataURL(img);
          } else {
            preview.src = "";
          }

          newElement.appendTo("#filediv");
        });
      }else{
		  alert("you can select maximum 4 files");
		  $('#my_file').val('');
		  $('.abcd').html('');
		  return false;
	  }
    });


*/


$(document).ready(function() {
    var text_max = 40;
    $('#character-count').html(text_max + ' characters remaining');

    $('#webTitle').keyup(function() {
        var text_length = $('#webTitle').val().length;
        var text_remaining = text_max - text_length;

        $('#character-count').html("("+text_length+") "+text_remaining + ' characters remaining');
    });
	
	var text_max1 = 400;
    $('#character-count_body').html(text_max1 + ' characters remaining');

    $('#webBody').keyup(function() {
        var text_length = $('#webBody').val().length;
        var text_remaining = text_max1 - text_length;

        $('#character-count_body').html("("+text_length+") "+text_remaining + ' characters remaining');
    });
});
</script>
