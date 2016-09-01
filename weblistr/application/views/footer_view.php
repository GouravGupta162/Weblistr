	

<footer class="footer">

<div class="container">

<div class="f_top">

<div class="col-md-6 col-sm-6 col-xs-12">

  <div class="f-logo"><img src="images/footer-logo.png" alt="footer-logo"></div>

  </div>

  <div class="col-md-6 col-sm-6 col-xs-12">
  <div class="rtl-footer-col">
<div class="f_icons">
<ul>
<li><i class="fa fa-phone"></i>033 4003 7545</li>
<li><i class="fa fa-envelope"></i> <a href="mailto:info@theweblisters.com">info@theweblisters.com</a></li>
</ul>
</div>

<div class="top-social inner">
      <ul>
      <li>
      <a href="https://www.facebook.com/theweblisters" target='_blank' ><img src="images/facebook.png" alt="facebook"></a>
      </li>
      <li>
      <a href="https://twitter.com/TheWeblistersIN" target='_blank' ><img src="images/twitter.png" alt="twitter"></a>
      </li>
       <li>
      <a href="#" target='_blank' ><img src="images/google-plus.png" alt="twitter"></a>
      </li>
      
      </ul>

</div>
</div>


  <!--<div class="f_icons">

  <a href="https://www.facebook.com/WebListers" target='_blank' ><i class="fa fa-facebook-f"></i></a>

  <a href="https://twitter.com/theweblistersin"target='_blank' ><i class="fa fa-twitter"></i></a>

  <a href="https://plus.google.com/+Weblisters"target='_blank' > <i class="fa fa-google-plus"></i></a>
  
  </div>-->

  </div>

  

</div>



<div class="f_mid">

<a href="<?php echo base_url(); ?>"> Home</a>

<a href="About"> About us</a>

<a href="howitworks"> How it works</a>

<!--<a href="Faq"> FAQ</a>-->

<a href="Privacyterms"> Privacy </a>

<a href="terms"> Terms </a>

<a href="javascript:void(0);" data-toggle="modal" data-target="#feedback" > Feedback</a>

<a href="<?php echo base_url(); ?>contact"> Contact Us</a>


</div>

<div class="f_btm">
<div class="pull-left">
<h5>&copy;2016-theweblisters All Rights reserved</h5>

</div>
<div class="pull-right">
<h6>Design By - <a href="http://www.dupleit.com/" target="_blank">Duple IT Solutions</a></h6>

</div>

</div>
</div>
</footer>







<div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="feedback">

  <div class="modal-dialog fd_bk" role="document">

    <div class="modal-content feedback">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="exampleModalLabel">Send us Feedback</h4>

      </div>

      <div class="modal-body" id='feedbackbody'>

        <form>

         <!---<div class="form-group">

            <label for="recipient-name" class="control-label">Your email address</label>

            <input type="email" class="form-control" id="feedback_recipient_name">

          </div>

          	  <div class="form-group">

            <label for="message-text" class="control-label">Please tell us what we can do better</label>

            <textarea class="form-control" id="feedback_message_text"></textarea>

          </div>--->
          
          <div class="form-group">

            <label for="recipient-name" class="control-label">Name:</label>

             <input type="text" class="form-control" id="feedback_recipient_name">

          </div>
          
          <div class="form-group">

            <label for="recipient-name" class="control-label">Email Id:</label>

             <input type="email" class="form-control" id="feedback_recipient_name">

          </div>
          
          <div class="form-group">

            <label for="message-text" class="control-label">How was your experience using Weblistr:</label>

           
  				<textarea class="form-control" rows="2" id="comment"></textarea>

          </div>
          
          <div class="form-group">

            <label for="message-text" class="control-label">Rate Us :</label>

			<div class="rate_us">
            	<ul>
                	<li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star-half-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                </ul>
            </div>

          </div>
          
          <div class="form-group">

            <label for="message-text" class="control-label">How often do you use our service?</label>
  				<select class="form-control" id="sel1">
                	<option value="0"></option>
    				<option value="1">Everyday </option>
    				<option value="2">Weekly </option>
    				<option value="3">Monthly</option>
    				<option value="4">Never used it before</option>
  				</select>
          </div>
          
          <div class="form-group">
			<label for="message-text" class="control-label">Do you find Weblistr helpful?</label>
             <label class="radio-inline"><input type="radio" name="optradio">Yes</label>
			<label class="radio-inline"><input type="radio" name="optradio">No</label>
          </div>
          
          <div class="form-group">

            <label for="message-text" class="control-label">Things you love about Weblistr:</label>

            <textarea class="form-control" rows="2" id="feedback_message_text"></textarea>

          </div>
          
          <div class="form-group">

            <label for="message-text" class="control-label">Things you do not like about Weblistr:</label>

            <textarea class="form-control" rows="2" id="feedback_message_text"></textarea>

          </div>
          
          <div class="form-group">

            <label for="message-text" class="control-label">How did come across Weblistr</label>

            <select class="form-control" id="sel1">
                	<option value="0"></option>
    				<option value="1">Social Media</option>
    				<option value="2">Email</option>
    				<option value="3">By Friend</option>
                    <option value="4">Google Search</option>
  				</select>

          </div>
          
          <div class="form-group">

            <label for="message-text" class="control-label">Suggestions from you to improve our service:</label>

            <textarea class="form-control" rows="2" id="feedback_message_text"></textarea>

          </div>

        </form>

      </div>

      <div class="modal-footer" id='feedbackfooter'>

	    <button type="submit" class="submit_btn" onclick='feedback()'>Submit</button>

      </div>

    </div>

  </div>

</div>



<!--Facebook SDK Start-->

<!--<script src="js/facebook.login.js"></script>-->

<!--Facebook SDK End-->


<script>
function commentmodalread(revid)
{
	var baseHref = document.getElementsByTagName('base')[0].href;
	$.ajax({
        url: baseHref + "review/getCommentsListofReview",
        type: "POST",
        data:{revid:revid},
        success: function (data)
        {
			$('#Reviewcomment .content').html(data);
			$('#Reviewcomment').modal('show');
        }
    });
	
	//reviewTitle
	//reviewBody
	//reviewImage
	//acceptReview
	
	//Reviewcomment
}
</script>


<div class="modal fade" id="Reviewcomment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h2>Comments</h2>
      </div>
      
	<div class="modal-body n-modal">
	
	<div class="content comm comment-list">
	
	</div>
	</div>
     
      <div class="modal-footer">
		<!--<div class='pull-left' id='pwdchangestatus' >  </div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary acceptReview" onclick='ReviewAccept()'>Update</button>-->
      </div>
    </div>
  </div>
</div>



<!--<script src="http://cdn.jsdelivr.net/jquery/3.0.0-beta1/jquery.min.js"></script>-->
<script src="waitme/waitMe.js" defer ></script>
<link type="text/css" rel="stylesheet" href="waitme/waitMe.css">
<script>
 $('[data-toggle="tooltip"]').tooltip()

var baseHref = document.getElementsByTagName('base')[0].href;
	var current_effect = 'bounce';//$('#waitMe_ex_effect').val();

	function showloader()
	{
		run_waitMe('bounce');
	}
	function hideloader()
	{
		//$('form').waitMe('hide');$('
		$('body').waitMe('hide');
	}
	
	function run_waitMe(effect){
		$('body').waitMe({
			effect: effect,
			text: 'Please wait...',
			bg: 'rgba(255,255,255,0.7)',
			color: '#000',
			maxSize: '',
			source: baseHref+'waitme/img.svg',
			onClose: function() {}
		});
		// $('form').waitMe({
			// effect: effect,
			// text: 'Please wait...',
			// bg: 'rgba(255,255,255,0.7)',
			// color: '#000',
			// maxSize: '',
			// source: baseHref+'waitme/img.svg',
			// onClose: function() {}
		// });
	}
	
	var current_body_effect = 'progress';//$('#waitMe_ex_body_effect').val();
	
	
	
	function showloaderwithbody()
	{
		run_waitMe_body(current_body_effect);
	}
	function hideloaderwithbody()
	{
		run_waitMe_body(current_body_effect);
	}
	
	
	function run_waitMe_body(effect){
		$('body').addClass('waitMe_body');
		var img = '';
		var text = '';
		if(effect == 'img'){
			img = 'background:url(\'waitme/img.svg\')';
		} else if(effect == 'text'){
			text = 'Loading...'; 
		}
		var elem = $('<div class="waitMe_container ' + effect + '"><div style="' + img + '">' + text + '</div></div>');
		$('body').prepend(elem);
		
		setTimeout(function(){
			$('body.waitMe_body').addClass('hideMe');
			setTimeout(function(){
				$('body.waitMe_body').find('.waitMe_container:not([data-waitme_id])').remove();
				$('body.waitMe_body').removeClass('waitMe_body hideMe');
			},200);
		},4000);
	}
	
window.onload=function expandTextarea() {
    var $element = $('textarea').get(0);  
    
    $element.addEventListener('keyup', function() {
        this.style.overflow = 'hidden';
        this.style.height = 0;
        this.style.height = this.scrollHeight + 'px';
    }, false);
}



</script>
</body>

</html>