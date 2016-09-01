	<div class="main-content">
					<div class="main-content-inner">
						<?php include 'breadcrumb_view.php'; ?>

						<div class="page-content">
					

							<div class="row">
								<div class="col-xs-12">
									<!-- PAGE CONTENT BEGINS -->
	<div class="col-xs-12  col-md-4 col-sm-6 widget-container-col ui-sortable">
											<div class="widget-box ui-sortable-handle">
												<div class="widget-header">
													<h5 class="widget-title">Latest Products</h5>

												</div>

												<div class="widget-body">
													<div class="widget-main">
													<table class="table-hover alert-info">
													<tr>
													<th>user</th>
													<th>email</th>
													<th>Rating</th>
													</tr>
										<?php
	//var_dump($getAllProduct);       
	 $sql = "SELECT * FROM `product` order by prd_id desc limit 5 ";

			$getAllProduct = $this->db->query($sql);

			if ($getAllProduct->num_rows() > 0) {
										foreach ($getAllProduct->result_array() as $product) {
											$prd_id = $product['prd_id'];
											$cat_id = $product['cat_id'];
											$added_by = $product['added_by'];
											$usr_type = $product['usr_type'];
											$prd_name = $product['prd_name'];
											$prd_link = $product['prd_link'];
											$prd_info = $product['prd_info'];
											$prd_address = $product['prd_address'];
											$prd_image = $product['prd_image'];
											$status = $product['status'];
											$featured_status = $product['featured_status'];
											?>
														<!--<p class="alert alert-info">-->
														<tr><td><img width="30px" src='<?php echo $prd_image; ?>'  />
														<td><?php echo 	 $prd_name; ?></td>
		<td class="alert_mail"> <?php 
	
		$sql = "select round((sum(review_details.rating_stars) / (SELECT count(reviews.rev_id) FROM `reviews` where 
		prd_id = $prd_id and status = 1 )),1) as service_rating
				,review_details.rating_type 
				,(SELECT count(reviews.rev_id) FROM `reviews` where prd_id = $prd_id and status = 1 ) as num_usr 
				from review_details where review_details.rev_id in 
				(SELECT reviews.rev_id FROM `reviews` where reviews.prd_id = $prd_id and status = 1 )
				group by review_details.rating_type ";
				
		//$sql =  "select sum(review_details.rating_stars) as service_rating ,(SELECT count(rev_id)  FROM `reviews` where prd_id = $prdId and status = 1 )as numuser from review_details where rev_id in(SELECT rev_id FROM `reviews` where prd_id = $prdId and status = 1  ) "; 
		
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0)
		{
			$rat=$query->row_array();
			if($rat['service_rating']!='')
			{
					echo $rat['service_rating'];				
			}
			else
			{
echo "N/A";
			}
		} else  
		{
			echo "N/A";
		}
		?></td>
														
										<?php } 
			} else { ?>
			<p>No Products Found</p>
			<?php } ?></table>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-xs-12  col-md-4 col-sm-6 widget-container-col ui-sortable">
											<div class="widget-box ui-sortable-handle">
												<div class="widget-header">
													<h5 class="widget-title">Latest Reviews</h5>

						
												</div>

												<div class="widget-body">
													<div class="widget-main">
													<table class="table-hover alert-info">
													<tr>
													<th>user</th>
													<th>name</th>
													<th>email</th>
													</tr>
												<?php 
												$sql = "SELECT user_register.usr_name,category.cat_name,product.prd_name, ";
			$sql  .="reviews.* FROM `reviews` ";
			$sql .="inner join user_register on reviews.usr_id = user_register.usr_id ";
			$sql .="inner join category on reviews.cat_id = category.cat_id ";
			$sql .="inner join product on reviews.prd_id = product.prd_id   order by rev_id desc   limit 5";
			$RecentReview = $this->db->query($sql);
			if($RecentReview->num_rows()>0) { 
			foreach ($RecentReview->result_array() as $review) {
											
											$usr_name = $review['usr_name'];
											$cat_name = $review['cat_name'];
											$prd_name = $review['prd_name'];
											$rev_id = $review['rev_id'];
											$review_head = $review['review_head'];
											$review_body = $review['review_body'];
																			
											$prd_id = $review['prd_id'];
											$cat_id = $review['cat_id'];
											$status = $review['status'];
											
			 $ppqurd = $this->db->query("SELECT * FROM `product` where prd_id='".$prd_id."'");
			 
			 if($ppqurd->num_rows()>0)
			 {
				 $pdt=$ppqurd->row_array();
				 $pimg=$pdt['prd_image'];
			 }
			 else
			 {
				$pimg="No image found";
			 }
								

	?>
														<tr>
														<td><img width="30px" src='<?php echo $pimg; ?>'  />
														<?php 
																					
$sql = "select reviews.rev_id,reviews.review_head,reviews.review_body
			,reviews.date,product.prd_name,product.prd_image,user_register.usr_name,user_register.usr_id,user_register.country
			,reviews.prd_id
			,(select count(rev.rev_id) from reviews rev where rev.prd_id = reviews.prd_id and status = 1) as total_reviews
			,(select count(rev.rev_id) from review_stats rev where rev.like = 1 and rev.rev_id = reviews.rev_id) as like_count
			,(select count(rev.rev_id) from reviews rev where rev.bookmark = 1 and rev.prd_id = reviews.prd_id) as bookmark_count
			,(select avg(revdtl.rating_stars) from review_details revdtl where revdtl.rev_id = reviews.rev_id) as avg_ttl
			,product.cat_id
			from reviews,product,user_register,tbl_country  , category  
			where product.prd_id = reviews.prd_id
			and product.status = 1 and product.prd_id='".$prd_id."' and user_register.usr_id='".$review['usr_id']."'
			and user_register.usr_id = reviews.usr_id
			and reviews.review_head != '' and reviews.status = 1
			and category.status = 1
			and category.cat_id = product.cat_id
			order by date desc limit 1";
		$query = $this->db->query($sql);
		if($query->num_rows()>0)
		{
			$rqu=$query->row_array();
			 //echo $recentReviews['avg_ttl'] 
$arrayData = explode(",",$rqu['avg_ttl'] );
$arrayvalue = $arrayData[0];
$lenvalue = strlen($arrayvalue);
if($lenvalue > 0)
{
	if(strpos($arrayvalue, '.') !== FALSE)
	{
		$splited =  explode(".",$arrayvalue);
		$splitersize = sizeof($splited);
		if($splitersize > 1)
		{
			$mainstar = $splited[0];
			$dotstar = $splited[1];
				?>
				<span class="c-count"><?php echo $mainstar; ?>.<?php echo $dotstar; ?> </span>
				<?php
		}
	}
	else{
		//echo $arrayvalue;
		//writeStar($arrayvalue,'0');
		?>
		<span class="c-count"><?php echo $arrayvalue; ?>.0 </span>
		<?php
	}
}
else{

	echo "&nbsp;";

}
		}
								
														?></td>
														<td>
	<?php echo "".$usr_name; ?></td>
	<td class="alert_mail"><?php echo "".$prd_name; ?>				</td>										
														</tr>
			<?php }  } else  { ?>
			<p>Nothing Found</p>
			<?php } ?>
			</table>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-xs-12 col-md-4 col-sm-6 widget-container-col ui-sortable">
											<div class="widget-box ui-sortable-handle">
												<div class="widget-header">
													<h5 class="widget-title">Latest Users</h5>

			
												</div>

												<div class="widget-body">
													<div class="widget-main">
													<table class="table-hover alert-info">
													<tr>
													<th>User</th><th>name</th><th>email</th>
													</tr>
										<?php 
			$sql = "SELECT * FROM `user_register` order by usr_id desc  limit 5";

			$getAllUser = $this->db->query($sql);

			if($getAllUser->num_rows()>0) { 
										foreach ($getAllUser->result_array() as $user) {
											$usr_id = $user['usr_id'];
											$usr_name = $user['usr_name'];
											$email_id = $user['email_id'];
											$register_method = $user['register_method'];
											$register_date = $user['register_date'];
											$profile_image = $user['profile_image'];
											$bio = $user['bio'];
											$mobile = $user['mobile'];
											$address = $user['address'];
											$city = $user['city'];
											$state = $user['state'];
											$country = $user['country'];
											$status = $user['status'];
			
											?>
											<tr>
														<!--<p class="alert alert-info">-->
														<td>
				<?php
													if ($profile_image != '') {
														?>
														<img src='<?php echo $profile_image ?>' width='30px' />
													<?php
												} else {
													 ?>
													 <img src='images/about-icon-md.png' width='30px' />
													<?php
												}
												?></td>
	<td><?php echo $usr_name; ?></td>
<td class="alert_mail">	<?php echo "".$email_id; ?>			</td>					
</tr>	
													<!--	</p>-->
			<?php }  } else  { ?>
			<p>Nothing Found</p>
			<?php } ?>
			</table>
													</div>
												</div>
											</div>
										</div>
									<!-- PAGE CONTENT ENDS -->
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- /.page-content -->
					</div>
				</div><!-- /.main-content -->