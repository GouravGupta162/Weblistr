var baseHref = document.getElementsByTagName('base')[0].href;

function ShowSearchGifImage(control)
{
	var el = document.getElementById(control);
		
	//$('#'+control).addClass('searchloadergif');// .style.backgroundImage  = 'url(images/ajax-loader.gif)';
	 el.style.backgroundImage  = 'url(images/ajax-loader.gif)';
 
	// //$('#'+control).style.backgroundRepeat= 'no-repeat';
	 el.style.backgroundRepeat= 'no-repeat';
                    
	// //$('#'+control).style.backgroundPosition = 'right';
	 el.style.backgroundPosition = '98% 50%';
}
function HideSearchGifImage(control)
{
	var el = document.getElementById(control);
		
	
	//$('#'+control).removeClass('searchloadergif');
	//$('#'+control).style.backgroundImage= 'none';
	el.style.backgroundImage  = 'none';
} 

	function headerSearchClick()
	{
		if($('#search_txt_header').val() != '')
		{
			window.location.href= baseHref + "search/query/"+$("#search_txt_header").val();
		}
		else
		{
			window.location.href= baseHref + "search/query/";
		}
		
	}
	
	function headerSearchClicknew()
	{
		if($('#search_txt_header').val() != '')
		{
			window.location.href= baseHref + "search/query/"+$("#search_txt_header").val();
		}
		else
		{
			window.location.href= baseHref + "search/query/";
		}
		
	}

///////Search Start //search_param category id
	function search ()
	{
		//alert($('#search_txt').val());
		//alert($("#search_param").val());
		if($("#search_param").val() != 0){
			
			if($('#search_txt').val() != ''){
				window.location.href= baseHref + "search/queries/"+$('#search_txt').val()+'/'+$("#search_param").val();
			}
			else{
				window.location.href= baseHref + "search/queries/0/"+$("#search_param").val();
			}
		}
		else{
			window.location.href= baseHref + "search/query/"+$('#search_txt').val();
		}
	}
	
	function searchmore (val)
	{
		window.location.href= val;
	}
	
	$(document).ready(function () {
		
		//the min chars for username  
		var min_chars = 1;  
		//result texts  
		var characters_error = 'Minimum amount of chars is 3';  
		var checking_html = 'Checking...';  
		//when button is clicked  
		$('#search_txt').keyup(function(e){  
			
				var code = e.keyCode || e.which;
				console.log(code);
				if ((code != 32) && (code != 40) && (code != 38) && (code != 13)) //Deactivate on space
				{
					//Do something
				}
				else if (code === 40) { //Down arrow
					if($("#DropdownProduct li.selected").index()==$("#DropdownProduct li").length-1) return;
					if (!$("DropdownProduct li.selected")) { //if no li has the hovered class
						$("#DropdownProduct li").eq(0).addClass("selected");
					} else {
						$("#DropdownProduct li.selected").eq(0).removeClass("selected").next().addClass("selected");
					}
				}
				else if (code === 38) { //Up arrow
					if($("#DropdownProduct li.selected").index()==0) return;
					if (!$("#DropdownProduct li.selected")) { //if no li has the hovered class
						$("#DropdownProduct li.selected").eq(0).removeClass("selected");
					} else {                 $("#DropdownProduct li.selected").eq(0).removeClass("selected").prev().addClass("selected");
					}
				}
				else if (code === 13) {
					e.preventDefault();
					if ($("#DropdownProduct li.selected").length > 0) {
						$("#DropdownProduct li.selected a").click()
						console.log($("#DropdownProduct li.selected a").text());
						//$("#message_board").val($("li.hovered div").text());
					}
				}
				
					//run the character number check  
					if($('#search_txt').val().length < min_chars){  
						//if it's bellow the minimum show characters_error text '  
						//$('#search_txt_status').html(characters_error);  
						if((code != 38 )&&(code != 40)){
							$('#search_txt_status').html('');  
							$('#DropdownProduct').html('');  
							$('#DropdownProduct').empty();
						}
					}else{  
						//else show the cheking_text and run the function to check  
						//$('#search_txt_status').html(checking_html);  
						if((code != 38 )&&(code != 40)){
							$('#search_txt_status').html('');  
							$('#DropdownProduct').html('');  
							$('#DropdownProduct').empty();
							ShowSearchGifImage('search_txt');
							searchkey();
						}
					}  
			
		}); 
		$('ul.txtProduct').on('click', 'li a', function () {
			//console.log($(this).text());
			$('#search_txt').val($(this).text());
			$('ul.txtProduct').hide();
		});
		
		$('ul#DropdownProductHeader').on('click', 'li a', function () {
			//console.log($(this).text());
			$('#search_txt_header').val($(this).text());
			$('ul#DropdownProductHeader').hide();
		});
		
		
		//the min chars for username  
		var min_chars = 1;  
		//result texts  
		var characters_error = 'Minimum amount of chars is 3';  
		var checking_html = 'Checking...';  
		//when button is clicked  
		$('#search_txt_header').keyup(function(e){  
			
			
			
			var code = e.keyCode || e.which;
			console.log(code);
			if ((code != 32) && (code != 40) && (code != 38) && (code != 13)) //Deactivate on space
			{
				//Do something
			}
			else if (code === 40) { //Down arrow
				if($("#DropdownProductHeader li.selected").index()==$("#DropdownProductHeader li").length-1) return;
				if (!$("DropdownProductHeader li.selected")) { //if no li has the hovered class
					$("#DropdownProductHeader li").eq(0).addClass("selected");
				} else {
					$("#DropdownProductHeader li.selected").eq(0).removeClass("selected").next().addClass("selected");
				}
			}
			else if (code === 38) { //Up arrow
				if($("#DropdownProductHeader li.selected").index()==0) return;
				if (!$("#DropdownProductHeader li.selected")) { //if no li has the hovered class
					$("#DropdownProductHeader li.selected").eq(0).removeClass("selected");
				} else {                 $("#DropdownProductHeader li.selected").eq(0).removeClass("selected").prev().addClass("selected");
				}
			}
			else if (code === 13) {
				e.preventDefault();
				if ($("#DropdownProductHeader li.selected").length > 0) {
					$("#DropdownProductHeader li.selected a").click()
					console.log($("#DropdownProductHeader li.selected a").text());
					//$("#message_board").val($("li.hovered div").text());
				}
			}
		
			if($('#search_txt_header').val().length < min_chars){  
				if((code != 38 )&&(code != 40)){
					$('#DropdownProductHeader').html('');  
					$('#DropdownProductHeader').empty(); 
				}
			}else{  
				if((code != 38 )&&(code != 40)){
					ShowSearchGifImage('search_txt_header');
					$('#DropdownProductHeader').html('');  
					$('#DropdownProductHeader').empty();
					searchkeyHeader($('#search_txt_header').val());
				}
			}  
		});  
	});
	
	function searchkey()
	{
		//var counter = 0,v1 = 1;
		$val = $("#search_txt").val();
		$.ajax({
			type: "POST",
			url: baseHref+"search/getSearch_AutoComplete",
			data: {
				keyword: $("#search_txt").val(),category: $("#search_param").val(),
			},
			dataType: "json",
			success: function (data) {
				
				HideSearchGifImage('search_txt');
				if($('#search_txt').val()!= '')
				{
					if(data == '')
					{
						
						
								$('#DropdownProduct').html('<li class=selected ><a role="menuitem dropdownnameli" class="dropdownlivalue"  >Website not found</a></li>');	
								//$('#DropdownProduct').html('<li class=selected ><a role="menuitem dropdownnameli" class="dropdownlivalue"  >No Results for -'+$val+' </a></li>');	
						
						
					}
					
					if (data.length > 0) {
						$('#DropdownProduct').empty();
						$('#search_txt').attr("data-toggle", "dropdown");
						$('#DropdownProduct').dropdown('toggle');
						
						
					}
					else if (data.length == 0) {
						
						$('#search_txt').attr("data-toggle", "");
					}
					
					for(var i =0; i < data.length; i++)
					{
						if(i==0)
						{
							$('#DropdownProduct').append('<li class=selected ><a role="menuitem dropdownnameli" class="dropdownlivalue" id='+data[i].value+' onClick=SelectSearchAutoComplete(this.id); >' + data[i].label + '</a></li>');	
						}
						else if(i <= 5){
							$('#DropdownProduct').append('<li><a role="menuitem dropdownnameli" class="dropdownlivalue" id='+data[i].value+' onClick=SelectSearchAutoComplete(this.id); >' + data[i].label + '</a></li>');
						}
						
					}
					if(data.length > 5){
						$('#DropdownProduct').append('<li class="view-search-btn"><a onclick=searchmore("'+baseHref+'search/query/'+$val+'");   >View More</a></li>');
					}
				}
				else{
					$('#search_txt_status').html('');  
					$('#DropdownProduct').html('');  
					$('#DropdownProduct').empty();
				}
				//href="javascript:searchmore("'+$val+'");" 
				// $.each(data, function (key,value) {
					// //console.log(value.value);
					// // if (data.length >= 0)
	// // $('#DropdownProduct').append('<li role="presentation" ><a role="menuitem dropdownnameli" class="dropdownlivalue" id='+value.value+' onClick=SelectSearchAutoComplete(this.id); >' + value.label + '</a></li>');

				// if(v1 ==0){
				// $('#DropdownProduct').append('<li><a role="menuitem dropdownnameli" class="dropdownlivalue" id='+value.value+' onClick=SelectSearchAutoComplete(this.id); >' + value.label + '</a></li>');
				// }
					// if(counter == 0)
					// {
// $('#DropdownProduct').append('<li class=selected ><a role="menuitem dropdownnameli" class="dropdownlivalue" id='+value.value+' onClick=SelectSearchAutoComplete(this.id); >' + value.label + '</a></li>');					
// counter++;v1=0;
					// }
					
				// });
			}
		});
	}
	
	function SelectSearchAutoComplete(text)
	{
		if($(text+":contains(,)"))
		{
			var arr = text.split(',');
			if((arr[1] == 'prd')||(arr[1] == 'tag'))
			{
				window.location.href= baseHref + "Review/detail/"+arr[0];
				//console.log(arr[0]);	
			}
		}
	}
	
	function searchkeyHeader(val)
	{
		$val  = val;
		var counter = 0;
		$.ajax({
			type: "POST",
			url: baseHref+"search/getSearch_AutoComplete",
			data: {
				keyword: val
			},
			dataType: "json",
			success: function (data) {
				HideSearchGifImage('search_txt_header');
				if(data == '')
				{
					$('#DropdownProductHeader').html('<li class=selected ><a role="menuitem dropdownnameli" class="dropdownlivalue"  >Website not found</a></li>');	
					//$('#DropdownProductHeader').html('<li class=selected ><a role="menuitem dropdownnameli" class="dropdownlivalue"  >No Results for -'+$val+' </a></li>');	
				}
				if (data.length > 0) {
					$('#DropdownProductHeader').empty();
					$('#search_txt_header').attr("data-toggle", "dropdown");
					$('#DropdownProductHeader').dropdown('toggle');
				}
				else if (data.length == 0) {
					$('#search_txt_header').attr("data-toggle", "");
				}
				
				
				for(var i =0; i < data.length; i++)
				{
					if(i==0)
					{
						$('#DropdownProductHeader').append('<li class=selected ><a role="menuitem dropdownnameli" class="dropdownlivalue" id='+data[i].value+' onClick=SelectSearchAutoComplete(this.id); >' + data[i].label + '</a></li>');	
					}
					else if(i <= 5){
						$('#DropdownProductHeader').append('<li><a role="menuitem dropdownnameli" class="dropdownlivalue" id='+data[i].value+' onClick=SelectSearchAutoComplete(this.id); >' + data[i].label + '</a></li>');
					}
				}
				if(data.length>5){
					$('#DropdownProductHeader').append('<li class="view-search-btn"><a onclick=searchmore("'+baseHref+'search/query/'+$val+'");   >View More</a></li>');
				}
				
				
				// $.each(data, function (key,value) {
					// if(counter == 0)
					// {
	// $('#DropdownProductHeader').append('<li class=selected ><a role="menuitem dropdownnameli" class="dropdownlivalue" id='+value.value+' onClick=SelectSearchAutoComplete(this.id); >' + value.label + '</a></li>');					
						// counter++;
					// }
	// $('#DropdownProductHeader').append('<li><a role="menuitem dropdownnameli" class="dropdownlivalue" id='+value.value+' onClick=SelectSearchAutoComplete(this.id); >' + value.label + '</a></li>');
	
					
				// });
				
			
			}
		});
	}
	
//////////
//arrow work
// $(document).ready(function () {
    // window.displayBoxIndex = -1;
    // $('#DropdownProductHeader').on('click', 'a', function () {
        // //$('#city').val($(this).text());
        // $('#DropdownProductHeader').hide('');
        // $('#citygeonameid').val($(this).parent().attr('data-id'));
        // return false;
    // });
    // var Navigate = function (diff) {
        // displayBoxIndex += diff;
        // var oBoxCollection = $("#DropdownProductHeader li a");
        // if (displayBoxIndex >= oBoxCollection.length) {
            // displayBoxIndex = 0;
        // }
        // if (displayBoxIndex < 0) {
            // displayBoxIndex = oBoxCollection.length - 1;
        // }
        // var cssClass = "display_box_hover";
        // oBoxCollection.removeClass(cssClass).eq(displayBoxIndex).addClass(cssClass);
    // }
    // $(document).on('keypress keyup', function (e) {
        // if (e.keyCode == 13 || e.keyCode == 32) {
			// $('.display_box_hover').trigger('click');
            // return false;
        // }
        // if (e.keyCode == 40) {
            // //down arrow
            // Navigate(1);
        // }
        // if (e.keyCode == 38) {
            // //up arrow
            // Navigate(-1);
        // }
    // });
// });

///////Search End

//////////////////////////List your website script below Start
$(document).ready(function () {
	var baseHref = document.getElementsByTagName('base')[0].href;
	
    $("#webcategory").keyup(function () {
		$.ajax({
            type: "POST",
            url: baseHref+"category/getCategory_AutoComplete",
            data: {
                keyword: $("#webcategory").val()
            },
            dataType: "json",
            success: function (data) {
                if (data.length > 0) {
                    $('#DropdownCategory').empty();
                    $('#webcategory').attr("data-toggle", "dropdown");
                    $('#DropdownCategory').dropdown('toggle');
                }
                else if (data.length == 0) {
                    $('#webcategory').attr("data-toggle", "");
                }
                $.each(data, function (key,value) {
					//console.log(value.value);
                    if (data.length >= 0)
$('#DropdownCategory').append('<li role="presentation" ><a role="menuitem dropdownnameli" class="dropdownlivalue" id='+value.value+' onClick="selectionAutoComplete(this.id);" >' + value.label + '</a></li>');
                });
            }
        });
    });
    $('ul.txtCategory').on('click', 'li a', function () {
		//console.log($(this).text());
        $('#webcategory').val($(this).text());
		$('ul.txtCategory').hide();
    });
});

function selectionAutoComplete(id)
{
	$('#cat_hidden').val(id);
}


function add_list_your_website()
{
	resetListForm();
	//var baseHref = document.getElementsByTagName('base')[0].href;
	
	var weblink = $('#weblink').val();
	var webname = weblink;//$('#webname').val();
	var webcategory = $('#webcategory').val();
	var webinfo = $('#webinfo').val();
	var webnumber = $('#webnumber').val();
	var webaddress = $('#webaddress').val();
	var cat_hidden = $('#cat_hidden_val').val();
	
	var errormsg = false;
	if(weblink =="")
	{
		
		$('#weblinkmsg').html('please enter website of the business');
		$('#weblink').focus();
		setTimeout(function() { $('#weblinkmsg').html(''); },3000);
		errormsg  = true;
		return false;
	}
	if((cat_hidden == "") && (webcategory == "0"))
	{
		$('#webcategorymsg').html('please select category');
		$('#webcategory').focus();
		setTimeout(function() { $('#webcategorymsg').html(''); },3000);
		errormsg  = true;
		return false;
	}
	// if(webname =="")
	// {
		// $('#webnamemsg').html('please enter sub category');
		// $('#webname').focus();
		// setTimeout(function() { $('#webnamemsg').html(''); },3000);
		// errormsg  = true;
		// return false;
	// }
	
	// if(webaddress =="")
	// {
		// $('#webaddressmsg').html('please enter office Adress');
		// $('#webaddress').focus();
		// errormsg  = true;
		// return false;
	// }
	if(webnumber =="")
	{
		$('#webnumbermsg').html('please enter contact number');
		$('#webnumber').focus();
		setTimeout(function() { $('#webnumbermsg').html(''); },3000);
		errormsg  = true;
		return false;
	}
	if(webinfo =="")
	{
		$('#webinfomsg').html('please enter basic information');
		$('#webinfo').focus();
		setTimeout(function() { $('#webinfomsg').html(''); },3000);
		errormsg  = true;
		return false;
	}
	//data: { cat_id:cat_hidden, name:webname,link:weblink , address:webaddress,number:webnumber ,info:webinfo  }, //new FormData('#signup-form'),//
	if(errormsg == false)
	{
		return true;
	}
};



$(document).ready(function (e) {
	
	$('#editweblistform').on('submit',(function(e) {
		e.preventDefault();
		showloader();
		$.ajax({
				url: baseHref + "weblist/edit_list_your_website",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success: function(data)
				{
					hideloader();
					if(data == 1)
					{
$("#statusModal #eventModelHtml").html('<center><span class="infosuccess">your website updated successfully.</span></center>');
$("#statusModal").modal('show');
						
						
						
						//$('#status').html('<span class="infosuccess" >your website updated successfully.</span>');
					}
//setTimeout(function(){ $("#statusModal").modal('hide'); $("#statusModal #eventModelHtml").html('');   }, 10000);
setTimeout(function() {  $("#statusModal").modal('hide'); $("#statusModal #eventModelHtml").html(''); window.location.href = baseHref+"user/company"; },3000);
					//setTimeout(function(){ $("#status").html('');  }, 3000);
				},
				error: function() 
				{
				}             
			});
		
	}));
	
	//var baseHref = document.getElementsByTagName('base')[0].href;
	$("#weblistform").on('submit',(function(e) {
		e.preventDefault();
		//console.log(add_list_your_website());
		
		
		var webname = $('#webname').val();
		var weblink = $('#weblink').val();
		var webcategory = $('#webcategory').val();
		var webinfo = $('#webinfo').val();
		var cat_hidden = $('#cat_hidden').val();
		var file = $('#file').val();
		
		var errormsg = false;
		if(weblink =="")
		{
			$('#weblinkmsg').html('please enter website of the business');
			$('#weblink').focus();
			setTimeout(function() { $('#weblinkmsg').html(''); },3000);
			errormsg  = true;
			return false;
		}
		if((cat_hidden == "") && (webcategory == "0"))
		{
			$('#webcategorymsg').html('Please select category');
			$('#webcategory').focus();
			setTimeout(function() { $('#webcategorymsg').html(''); },3000);
			errormsg  = true;
			return false;
		}
		if(webname =="")
		{
			$('#webnamemsg').html('Please enter sub category');
			$('#webname').focus();
			setTimeout(function() { $('#webnamemsg').html(''); },3000);
			errormsg  = true;
			return false;
		}
		if(webinfo =="")
		{
			$('#webinfomsg').html('Please enter basic information');
			$('#webinfo').focus();
			setTimeout(function() { $('#webinfomsg').html(''); },3000);
			errormsg  = true;
			return false;
		}
		//if(file == "")
		//{
		//	$('#webfilemsg').html('Please select company logo');
		//	$('#file').focus();
		//	setTimeout(function() { $('#webfilemsg').html(''); },3000);
		//	errormsg  = true;
		//	return false;
		//}
		
		//!!!!!!!!!!!!!!!
		
		if(errormsg == false)
		{
			showloader();
			$.ajax({
				url: baseHref + "weblist/add_list_your_website",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success: function(data)
				{
					//Thank you for listing the company. We are verifying it. This will just take a few hours
					hideloader();
					if(data == 0)
					{
						$("#loginModal .modalFrom").html('<center><span  class="infodanger" >Please log in first</span></center>');
						$("#loginModal").modal('show');
					}
					else if((data != '0')&&(data != '-2')&&(data != '-3')&&(data != 'alreadysubmitted')){
						
						$("#statusModal #eventModelHtml").html('<center><span class="infosuccess" >Thank you for listing the company. We are verifying it. This will just take a few hours</span></center>');
						$("#statusModal").modal('show');
						setTimeout(function(){ 
						
							$("#statusModal").modal('hide'); 
							$("#statusModal #eventModelHtml").html('');  
							window.location.href = baseHref+'Review/Write/'+data;
						}, 3000);
						
					}
					else if(data == 'alreadysubmitted'){
						$("#statusModal #eventModelHtml").html('<center><span class="infodanger">Company is not allowed to list a website.</span></center>');
						//$("#statusModal #eventModelHtml").html('<center><span class="infodanger">You already listed a website.</span></center>');
						$("#statusModal").modal('show');
					}
					else if(data == '-2'){
						$("#statusModal #eventModelHtml").html('<center><span class="infodanger">please try again later</span></center>');
						$("#statusModal").modal('show');
					}
					else if(data == '-3'){
						$("#statusModal #eventModelHtml").html('<center><span class="infodanger" >please check website already listed</span></center>');
						$("#statusModal").modal('show');
					}
					setTimeout(function(){ $("#statusModal").modal('hide'); $("#statusModal #eventModelHtml").html('');   }, 10000);
					setTimeout(function(){ $("#liststatus").html('');  }, 3000);
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

function resetListForm()
{
	$('#webnamemsg').html('');
	$('#weblinkmsg').html('');	
	$('#webcategorymsg').html('');
	$('#webinfomsg').html('');	
	$('#webaddressmsg').html('');	
	$('#webnumbermsg').html('');
	$('#webfilemsg').html('');	
}


//////////////////////////List your website script below End



/////
/////feedback

function feedback()
{
	$('#feedback_recipient_name').val();
	$('#feedback_message_text').val();	
	var error = false;
	if($('#feedback_recipient_name').val() == '')
	{
		$('#feedback_recipient_name').focus()
		error = true;
		return false;
	}
	if($('#feedback_message_text').val() == '')
	{
		$('#feedback_message_text').focus()
		error = true;
		return false;
	}
	if(error == false){
		$.post(baseHref + "user/sendFeedback", { email: $('#feedback_recipient_name').val(),message: $('#feedback_message_text').val() },  
			function(result){  
				//if the result is 1  
				$('#feedbackbody').html("<div style='color: #009b97; font-size: 20px; font-weight: 400; text-align: center;'>"+result+"</div>");
				$('#feedbackfooter').html('');
				setTimeout(function() { $('#feedbackbody').html(''); },3000);
				setTimeout(function(){ $('.feedback .close').trigger('click'); }, 3000);
		});    
	}
}
/////