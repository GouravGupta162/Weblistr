<link href="css/hover.css" rel="stylesheet" type="text/css">
<section class="all_cat">
<div class="container">
<div class="col-md-2 padding">
<div class="category pop">
<h4><i class="fa fa-windows"></i>All Categories</h4>
</div>

<div class="item-list">
<ul>
<?php 
//var_dump($getAllCategory); 
//getPopularCategory
foreach ($getAllCategory as $value) {	
echo "<a href=".base_url()."category/select/".$value['cat_id']."><li attr='".$value['cat_id']."'>".substr($value['cat_name'],0,20)."</li></a>";
}
?>

</ul>
</div>

</div>
<div class="col-md-10 cat_m">
<div class="category pop">
<h4><i class="fa fa-windows"></i>Most Popular</h4>
</div>

<?php 
//var_dump($getAllCategory); 
//getPopularCategory
foreach ($getPopularCategory as $value) {	
//echo "<a href='#'><li attr='".$value['cat_id']."'>".$value['cat_name']."</li></a>";
$getPopularProduct = $result=$this->category_model->getPopularProduct($value['cat_id']);
//var_dump($result);
//$ULvar;

if((sizeof($getPopularProduct)==3))
{
	echo "<div class='col-md-4 col-sm-4 col-xs-6'>";
	echo "<div class='content'>";
	echo "				<div class='grid'>";
	echo "					<figure class='effect-julia'>";
	echo "						<img src='".base_url().$value['cat_image']."' alt='shop'/>";
	echo "						<figcaption >";
	echo "							<h2 class='categoryMain'><a href=".base_url()."category/select/".$value['cat_id']."  >".$value['cat_name']."</a></span></h2>";
	echo "							<div>";
	echo "                            <ul>";
		foreach ($getPopularProduct as $value) {	
			echo "<li><a href=".base_url()."Review/detail/".$value['prd_id']." > <p style='text-transform: lowercase;' attr='".$value['prd_id']."'>".substr($value['prd_name'],0,15)."<span>";
			
			overAllRating($this->write_review_model->getRatingSummary($value['prd_id']));
			//$value['prd_id']
			
			echo "</span></p></a></li>";
		}
	echo "                                </ul>";
	echo "							</div>";
	//echo "							<a href='#'>View more</a>";
	echo "						</figcaption>			";
	echo "					</figure>";
	echo "				</div>			";	
	echo "</div>";
	echo "</div>";
}
}
?>

</div>
</div>
</div>
</section>


    
<?php 
//getRatingSummary//
//var_dump($getRatingSummary);
function overAllRating($getRatingSummaryresult)
{
	if(sizeof($getRatingSummaryresult) > 0)
	echo $getRatingSummaryresult[0]['service_rating'];
	else 
	echo '0.0';
	//$getRatingSummaryresult = $getRatingSummaryresult[0]['service_rating'];
	// if((sizeof($getRatingSummaryresult) > 0) && ($getRatingSummaryresult != null)){
			
		// $sum = 0;
		// foreach($getRatingSummaryresult as $getRatingSummaryvalue)
		// {
		   // $sum += $getRatingSummaryvalue['service_rating'];
		// }
		// $checker = $sum ;/// 5;
	
		// if(strpos($sum, '.') !== FALSE)
		// {
			// $splited =  explode(".",$sum);
			// $splitersize = sizeof($splited);
			// if($splitersize > 1)
			// {
				// $mainstar = $splited[0];
				// $dotstar = $splited[1];
				// // switch ($dotstar) {
					// // case "1": writeStar($mainstar,'0');	break;
					// // case "2": writeStar($mainstar,'0'); break; 
					// // case "3": writeStar($mainstar,'0'); break; 
					// // case "4": writeStar($mainstar,'0');	break;
					// // case "5": writeStar($mainstar,'5'); break; 
					// // case "6": writeStar($mainstar,'5'); break; 
					// // case "7": writeStar($mainstar,'5');	break;
					// // case "8": writeStar($mainstar,'8'); break; 
					// // case "9": writeStar($mainstar,'9'); break; 
				// // }
				// echo $mainstar.'.'.$dotstar; 
			// }
		// }
		// else{
			// echo "0.0"; 
			// //writeStar($sum,'0');
		// }
	// }
	// else{
			// echo "0.0"; 
		// }
}
?>
    
    <script type="text/javascript">
	$(document).ready(function(e){
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
		e.preventDefault();
		var param = $(this).attr("href").replace("#","");
		var concept = $(this).text();
		$('.search-panel span#search_concept').text(concept);
		$('.input-group #search_param').val(param);
	});
});
    </script>
    