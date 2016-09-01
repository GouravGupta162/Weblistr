/*  <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>
*/
  
  
  
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
	   	testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  

  
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
		if($.cookie("fbchecker") != 1)
		{	
			 statusChangeCallback(response);
			//ajaxdb(response.id,response.name);
		}
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1043892665684730',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
	  
	  
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log(response);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';		
		
		//ajaxdb(response.id,response.name);
		//$pp = '<?=$_SESSION['fb_status'];?>';
		
		//console.log($.cookie("fbchecker"));
		if($.cookie("fbchecker") != 1)
		{	
			ajaxdb(response.id,response.name);
		}
    });
  }
function ajaxdb(fb_id,fb_name){	//data: { uname:uname,email:email,pwd:pwd,con_pwd:con_pwd }, //new FormData('#signup-form'),//	

	var baseHref = document.getElementsByTagName('base')[0].href;
	
	$.post(baseHref + "index.php/user/fb_registration", { fbid:fb_id, fbname:fb_name },  
		function(result){
			$.cookie("fbchecker", 1);			
			//if the result is 1  
			//console.log(result);
			if(result == 1){
				$('#status').html('<span class="infodanger" >your website updated successfully.</span>');			
			} 
			location.reload();			
	});    
	
	// $.ajax({		
	// url: baseHref + "index.php/user/fb_registration"
		// ,type: "POST"
		// ,data: { 'fbid':fb_id,'fbname':fb_name }
		// ,contentType: false
		// ,cache: false
		// ,processData:false
		// ,success: function(data)		{			
			// if(data != 0){
				// $.cookie("fbchecker", 1);
				// $('#status').html('<span class="infodanger" >your website updated successfully.</span>');			
				// location.reload();
			// }			
			// else {				
				// location.reload(); 			
			// }			
			// },		
			// error: function() 		
			// {
			// }             	
		// });
}  
 
/*
  window.fbAsyncInit = function() {
	FB.init({
	  appId      : '1043892665684730',
	  xfbml      : true,
	  version    : 'v2.5'
	});
  };
  (function(d, s, id){
	 var js, fjs = d.getElementsByTagName(s)[0];
	 if (d.getElementById(id)) {return;}
	 js = d.createElement(s); js.id = id;
	 js.src = "//connect.facebook.net/en_US/sdk.js";
	 fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
*/