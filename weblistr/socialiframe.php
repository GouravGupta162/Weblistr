<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  

<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

<style type="text/css">
body{ margin:0px;}



</style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="margin:0px;">




<?php 
function restyle_text($input){
    $input = number_format($input);
    $input_count = substr_count($input, ',');
    if($input_count != '0'){
        if($input_count == '1'){
            return substr($input, 0, -4).'k';
        } else if($input_count == '2'){
            return substr($input, 0, -8).'mil';
        } else if($input_count == '3'){
            return substr($input, 0,  -12).'bil';
        } else {
            return;
        }
    } else {
        return $input;
    }
}
?>





<div class="followers">



<div class="col-md-6 col-sm-4 col-lg-6 left">


<a href='https://www.facebook.com/theweblisters' target='_blank'>
<div class="f_left">
<i class="fa fa-facebook-f"></i>
<div class="f_fb">
<h5>Facebook</h5>

<h6><span>


<?php 
function facebook_count(){
$fql  = "SELECT share_count, like_count, comment_count  FROM link_stat WHERE url = 'https://www.facebook.com/theweblisters' ";
$fqlURL = "https://api.facebook.com/method/fql.query?format=json&query=" . urlencode($fql);
$response = file_get_contents($fqlURL);
return json_decode($response);
}
$fb = facebook_count();
echo $fb[0]->like_count;
//echo restyle_text($fb[0]->like_count);
?>
</span> Followers</h6>



</div>



</div>
</a>


</div>



<div class="col-md-6 col-sm-4 col-lg-6 right">


<a href='https://twitter.com/TheWeblistersIN' target='_blank'>
<div class="f_right">



<i class="fa fa-twitter"></i>



<div class="f_tweet">



<h5>Twitter</h5>



<h6><span>



<?php 



$tw_username = 'TheWeblistersIN'; 



$data = file_get_contents('https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names='.$tw_username); 



$parsed =  json_decode($data,true);



$tw_followers =  $parsed[0]['followers_count'];

echo restyle_text($tw_followers);



?>







</span> Followers</h6>



</div>



</div>
</a>



</div>







<div class="col-md-6 col-sm-4 col-lg-6 left bot">


<a href='http://pinterest.com/theweblisters' target='_blank'>
<div class="f_pin">



<i class="fa fa-pinterest-p"></i>



<div class="f_pinterest">



<h5>Pinterest</h5>



<h6><span>



<?php 



$metas = get_meta_tags('http://pinterest.com/theweblisters/');

echo restyle_text($metas['pinterestapp:followers']);





?>



</span> Followers</h6>



</div>



</div>
</a>



</div>







<div class="col-md-6 col-sm-4 col-lg-6 right">


<a href='#' target='_blank'>
<div class="f_gp">



<i class="fa fa-google-plus"></i>



<div class="f_google">



<h5>googleplus</h5>



<h6><span>



<?php 







function googleplus_follower_count() {      



    global $social_counter_settings;



    $settings = $social_counter_settings;



    $count = -1;                



    $gUrl = "https://www.googleapis.com/plus/v1/people/100288914951683398279?key=AIzaSyCexEzh5eh960omlsHyZwHzBcJ-ZbLHteo";            



     



    $response = file_get_contents($gUrl);           



    $fb = json_decode($response);



    if ( isset( $fb->circledByCount)) {              



                $count = intval($fb->circledByCount);                    



    }                   



    return $count ;



}



echo restyle_text(googleplus_follower_count());







?>







</span> Followers</h6>



</div>



</div>

</a>



</div>







<div class="col-md-6 col-sm-4 col-lg-6 left bot">


<a href='https://www.linkedin.com/company/10347357' target="_blank">
<div class="f_lk">



<i class="fa fa-linkedin"></i>


<div class="f_linked">



<h5>linkedin</h5>



<h6><span>

0
</span> Followers</h6>



</div>



</div>
</a>


</div>







<div class="col-md-6 col-sm-4 col-lg-6 right">


<a href='https://www.youtube.com/channel/UCtxPrcSp5NeynRlOGgu8THw' target='_blank'>
<div class="f_gp">



<i class="fa fa-youtube"></i>



<div class="f_google">



<h5>You Tube</h5>



<h6><span>







<?php 







$id = "UCtxPrcSp5NeynRlOGgu8THw";



$key = "AIzaSyAl5Bm1eCy4ep6UE2eIZ-Ocg4YzTpph53w";



$subscribers = file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$id.'&key='.$key.'');



$response = json_decode($subscribers, true );



$count = intval($response['items'][0]['statistics']['subscriberCount']);

echo restyle_text($count);





?>



















</span> Followers</h6>



</div>



</div>

</a>



</div>







</div>



  </body>
</html>