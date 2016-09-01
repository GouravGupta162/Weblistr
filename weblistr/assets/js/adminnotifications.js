var baseHref = document.getElementsByTagName('base')[0].href;

$(document).ready(function (e) {
	notificationcounterload();
	setInterval( function() { 	notificationcounterload();},5000);	
});


function notificationcounterload()
{
	var method = "GET";

	var path = baseHref  + 'notification/countAllNotification';
	$.ajax({
	type: method,
	url: path,
	success:
		function (data) {	
			$('#notificationCounter').html(data);
		}
	});
}

notifications = { 
	pageload: function() 
	{ 
		notificationsload(0) ;
	},
	scroller: function(startlimit) 
	{ 
		notificationsload(startlimit);
	}
} 

//Read all notification
function markallreadnotification()
{
	$.ajax({
		type: "POST",
		url: baseHref + "notification/readallnotification",
		success:
			function (data) {
				if(data=='done')
				{
					location.reload();
				}
			}
		});
}


//Read notification
function readnotification(id)
{
	$.ajax({
		type: "POST",
		url: baseHref + "notification/readit",
		data: { notificationId:id},
		success:
			function (data) {
				
			}
		});
}


//Binding By Default Notifications
$(document).ready(function(){
	//$("#notificationscroller").bind('scroll',chk_scroll);
	
	setInterval( function() { 	notifications.pageload(); },5000);	
	
});


//Main Notification Loading Function
function notificationsload(startlimit)
{
	$.ajax({
		type: "POST",
		url: baseHref + "notification/fetchcontent",
		data: { getresult:startlimit }, //new FormData('#signup-form'),//
		success:
			function (data) {
				if(data != 0)
				{
					if(startlimit == 0)
					{
						$("#notificationscroller").html(data);
						$('#limitrow').val($('#limitrow').val()+7);
					}
					else{
						$("#notificationscroller").append(data);
						$('#limitrow').val($('#limitrow').val()+7);
					}
				}
				else
				{ 
					$("#notificationscroller").append("<li><a href='javascript:void(0);'><div class='clearfix'><span>No More Notification</span></div></a></li>");
					$('#limitrow').val(0);
				}
			}
		});
}

//Div Scroll Checking Position At Bottom
function chk_scroll(e)
{
	var elem = $(e.currentTarget);
    if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight())
    {
        var startlimit = $('#limitrow').val();
		if(startlimit != 0){
			notifications.scroller(startlimit);
		}	
    }
}