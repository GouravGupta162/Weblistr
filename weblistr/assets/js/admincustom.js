var baseHref = document.getElementsByTagName('base')[0].href;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 function modalreadclose()
 {
	$('#modalreadReview .content').html('');
	$('#modalreadReview').removeClass('in');
	$('#modalreadReview').css("display","none");
	$('#modalreadReview .close').click();
 }
 
function modalread(revid)
{
	
	$.ajax({
        url: baseHref + "admin/weblist/GetReviewDetail",
        type: "POST",
        data:{revid:revid},
        success: function (data)
        {
			$('#modalreadReview .content').html(data);
			$('#modalreadReview').addClass('in');
			$('#modalreadReview').css("display","block");
        }
    });
	
	//reviewTitle
	//reviewBody
	//reviewImage
	//acceptReview
	
	//modalreadReview
}
 
 
function updateCategory()
{
  
    //var cat_id = $('#cat_id');
    //var cat_name = $('#cat_name');
    //var cat_desc = $('#cat_desc');
    //var file = $('#file');
    // $( "#categoryupdateForm" ).submit();
    //console.log(cat_id.val()); console.log(cat_name.val()); console.log(cat_desc.val()); console.log(file.val());
    $.ajax({
        url: baseHref + "admin/category/categoryupdate",
        type: "POST",
        data: new FormData(this),
        success: function (data)
        {
            console.log(data);
        }
    });
}


function login()
{
    var usrname = $('#usrname').val();
    var pwd = $('#pwd').val();
    
    $.ajax({
        type: "POST",
        url: baseHref + "admin/login/postlogin",
        data: { usrname:usrname,pwd:pwd }, //new FormData('#signup-form'),//
        success:
            function (data) {
                if (data == '1') {
                    //location.reload();
                    window.location.href = baseHref + "admin/dashboard";//"http://localhost/code/";
                }
                else if (data == '0') {
                    //location.reload();
                    alert('Please enter corrent login details');
                }
            }
    });// you have missed this bracket
}

function logout()
{
    $.ajax({
        type: "POST",
        url: baseHref + "admin/login/logout",
        //data: { email_id:email,password:pwd }, //new FormData('#signup-form'),//
        success:
                function (data) {
                    if (data == '0') {
                        //location.reload();
                        window.location.href = baseHref + "admin/";//"http://localhost/code/";
                    }
                }
    });// you have missed this bracket
}


function logo()
{
    window.location.href = baseHref + "admin/dashboard/";//"http://localhost/code/";
}

function ShowProgress() {
	setTimeout(function () {
		var modal = $('<div />');
		modal.addClass("modal");
		$('body').append(modal);
		var loading = $(".loading");
		loading.show();
		var top = Math.max($(window).height() / 2 - loading[0].offsetHeight / 2, 0);
		var left = Math.max($(window).width() / 2 - loading[0].offsetWidth / 2, 0);
		loading.css({ top: top, left: left });
	}, 200);
}


function HideProgress() {
	setTimeout(function () {
		var modal = $('<div />');
		modal.addClass("modal");
		$('body').append(modal);
		var loading = $(".loading");
		loading.hide();
		var top = Math.max($(window).height() / 2 - loading[0].offsetHeight / 2, 0);
		var left = Math.max($(window).width() / 2 - loading[0].offsetWidth / 2, 0);
		loading.css({ top: top, left: left });
	}, 200);
}



