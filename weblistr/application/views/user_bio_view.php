
	
	
<section class="user_profile">
<div class="container">
<div class="col-md-3 b_rt">
<?php include 'user_profile_left_view.php';


$query = $this->db->query("SELECT * from user_register where usr_id =  $bioid ");
$servicesfee = $query->row_array();

if((sizeof($servicesfee)>0) && ($servicesfee['bio'] != ''))
{
$bio  = $servicesfee['bio']; 
}
else
{
$bio = "Not Available";	
}

 ?>
</div>


<div style="min-height: 600px; padding:0 10px;" class="col-md-6 user__settings divider-l-fix  divider--left divider--right">
    <div data-edit-page="profile" class="user__settings--tab profile active">
<div style="margin-top: 30px;" class="u_rev_head">About</div>
	
        
<div>
	<p>
		<label for="name" class="label">Bio</label>
		<p>
		<?php echo $bio; ?>
</p>		
		

			
            <div class="clear"></div>
            <!-- End Edit Profile -->
        
    </div>


</div>
</div>



<div class="col-md-3">


<div class="user_con user_book">
<h3>Follow Us On</h3>
<?php include 'user_profile_right.php'; ?>
</div>

<div class="user_rev">
</div>

</div>
</div>
</section>


