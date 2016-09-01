var base_url = document.getElementsByTagName('base')[0].href ;

function likeMainProduct(catId,prdID,stts) //working on check review page in details
{
	//alert(catId);
	$.ajax({
		url: base_url + "review/likeMainProduct",
		type: "POST",
		data:  { catID : catId, prdID: prdID, stts:stts },
		success: function(data)
		{
			if(data == 'nologin')
			{
				$("#loginModal .modalFrom").html('<center><span  class="infodanger" >Please log in first</span></center>');
				$("#loginModal").modal('show');
				setTimeout(function(){ $("#loginModal .modalFrom").html(''); $("#loginModal").modal('hide');  }, 10000);
			}
			else if(data!='nologin')
			{				
				$('#main_like_count_' + prdID).html(data);
				if(stts == '1'){
					//$('#main_thumb_'+prdID).removeClass('fa fa-thumbs-up').addClass('fa fa-thumbs-down');
					$('#mainlike_'+prdID+' div').addClass('fb-like');
					$('#mainlike_'+prdID).attr('onclick',"likeMainProduct('"+catId+"','"+prdID+"','0')");		
				}
				else{
					$('#mainlike_'+prdID+' div').removeClass('fb-like');
					//$('#main_thumb_'+prdID).removeClass('fa fa-thumbs-down').addClass('fa fa-thumbs-up');
					$('#mainlike_'+prdID).attr('onclick',"likeMainProduct('"+catId+"','"+prdID+"','1')");		
				}
			}
			setTimeout(function(){ $("#status").html('');  }, 3000);
		},
		error: function() 
		{

		}             

	});
}

function likeReview(revID,stts) //working on home view and check review page for reviews likes (recent review home page)
{
	
	$.ajax({
		url: base_url + "review/likeReview",
		type: "POST",
		data:  { revID : revID, stts:stts },
		success: function(data)
		{
			if(data == 'nologin')
			{
				$("#loginModal .modalFrom").html('<center><span  class="infodanger" >Please log in first</span></center>');
				$("#loginModal").modal('show');
				setTimeout(function(){ $("#loginModal .modalFrom").html(''); $("#loginModal").modal('hide');  }, 10000);
			}
			else if(data!='nologin')
			{				
				if(stts == '1'){
					$('#rev_like_counter_'+revID).html(data);	
					//$('#thumb_'+revID).removeClass('fa fa-thumbs-up').addClass('fa fa-thumbs-down');
					$('#rev_a_like_'+revID).attr('onclick',"likeReview('"+revID+"','0')");	
					$('#rev_a_like_'+revID+ ' div').addClass('fb-like');		
				}
				else{
					$('#rev_like_counter_'+revID).html(data);	
					//$('#thumb_'+revID).removeClass('fa fa-thumbs-down').addClass('fa fa-thumbs-up');
					$('#rev_a_like_'+revID).attr('onclick',"likeReview('"+revID+"','1')");		
					$('#rev_a_like_'+revID+ ' div').removeClass('fb-like');		
				}
			}
		},
		error: function() 
		{	

		}             
	});
}



function helpfull(id,stts) //working for home page recent reviews and check review page 
{
	var rev_id = id;
	var stts = stts;
	var baseHref = document.getElementsByTagName('base')[0].href;
	$.ajax({
		url: baseHref + "Review/helpfull",
		type: "POST",
		data:  { rev_id:rev_id,stts:stts },//new FormData(this),
		success: function(data)
		{
			
			if(data == 'nologin')
			{
				$("#loginModal .modalFrom").html('<center><span  class="infodanger" >Please log in first</span></center>');
				$("#loginModal").modal('show');
				setTimeout(function(){ $("#loginModal .modalFrom").html(''); $("#loginModal").modal('hide');  }, 10000);
			}
			else{
				if(stts == 1)
				{
					var click = $("#help_atag_"+rev_id);
					$(click).parent('span').addClass('washelpfulldone');
					//helpfull('<?php echo $recentReviews['rev_id']  ?>','0'
					$("#help_atag_"+rev_id).attr('onClick',"helpfull('"+rev_id+"','0')");
					//$("#help_atag_"+rev_id).attr('onClick','javascript:void(0)');
					$("#help_full_counter_"+rev_id).html(data);
				}
				else if(stts == 0)
				{
					var click = $("#help_atag_"+rev_id);
					$("#help_atag_"+rev_id).parent().removeClass("washelpfulldone");
					
					//helpfull('<?php echo $recentReviews['rev_id']  ?>','0'
					$("#help_atag_"+rev_id).attr('onClick',"helpfull('"+rev_id+"','1')");
					
					//$("#help_atag_"+rev_id).attr('onClick','javascript:void(0)');
					$("#help_full_counter_"+rev_id).html(data);
				}
			}
			
		},
		error: function() 
		{		

		}             
	});
}