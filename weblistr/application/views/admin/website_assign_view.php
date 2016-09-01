<div class="main-content">
    <div class="main-content-inner">
        <?php include 'breadcrumb_view.php';
        ?>

        <div class="page-content">
          

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
<input type="hidden" id="row_no" value="10">
                    <!--custom content start-->
                    <div class="row">
                        <div class="col-xs-12">

        <script>
		function selectWebPrd(){
			var baseHref = document.getElementsByTagName('base')[0].href;
			$.ajax({
				url: baseHref + "review/getcategoryProduct",
				type: "POST",
				data:  { cat_hidden : $("#subcategory").val() },
				success: function(data)
				{
					$('#product').html(data);
				},
				error: function() 
				{
					
				}             
			});
		}
		</script>
		
<form class="form_style assign_div col-md-6"   >
 <div class="widget-box">


<div class="widget-body">
	<div class="widget-main">
	
	 <div>
	 <h1>Assign users to company</h1>
	 </div>
	
	   <div>
		<label for="form-field-8">Select Category</label>

		<select name='subcategory' id='subcategory' onchange='selectWebPrd()' >
<option value="0" >Select Category</option>
<?php 
if(sizeof($getAllcat)>0)
{
	foreach($getAllcat as $cat)
	{
		?>
		<option value="<?php echo $cat['cat_id']; ?>" ><?php echo $cat['cat_name']; ?></option>
		<?php
	}
}
?>
</select>
		
		 <hr />
	</div>
	
	
	<div>
		<label for="form-field-8">Select Product</label>
		
	<select name='product' id='product'  >
	<option value="0" >Select product</option>
	</select>
	 <hr />
</div>
	
	
	<div >
<label for="form-field-8">Select User</label>
<select name='user' id='user'  >
<option value="0" >Select User</option>
<?php 
if(sizeof($getAllCompanyUsers)>0)
{
	foreach($getAllCompanyUsers as $user)
	{
		?>
		<option value="<?php echo $user['usr_id']; ?>" ><?php echo $user['usr_name']; ?></option>
		<?php
	}
}
?>
</select>	
 <hr />
</div>	
	<div>
	
 <a class="btn btn-xs btn-info" href="javascript:void(0)" onclick="productactive()" 
                                                       >Assign</a>
	</div>
	
	
	
</div>	


													    </div>
                                    </div>
       
</form>
                         
                        </div><!-- /.span -->
						
						
                            <table id="dynamic-table"  class="table table-striped table-bordered table-hover scroll tb_sc"  >
                                <thead>
                                    <tr>
                                        <th class='col-md-3'>Category </th>
										<th>Product </th>
                                        <th>User</th>
                                    </tr>
                                </thead>

                                <tbody id='all_rows'>
								<?php
								$this->product_model->loadAssignedContent();
								?>
								</tbody>
								</table>
						
                    </div><!-- /.row -->
                    <!--custom content end-->



                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script type="text/javascript" src="js/jquery.js"></script>

<script>


function productactive()
{
	var baseHref = document.getElementsByTagName('base')[0].href;
	var subcategory = $('#subcategory').val();	
	var product = $('#product').val();	
	var user = $('#user').val();	
	if(subcategory != 0)
	{
		if(product != 0)
		{
			if(user != 0)
			{
				var params = {subcategory: subcategory, prd_id: product, user: user}; //JSON ENCODED 
				path = baseHref + 'admin/weblist/assignpost'; //console.log(params); //json //$(this).serialize(),
				$.ajax({
					type: 'POST',
					url: path,
					data: params, //new FormData('#signup-form'),//
					success:
							function (data) {
								if(data == 1)
								{
									alert("Assigned successfully");
									location.reload();
								}
								else if(data == 0)
								{
									alert("Already assigned to other user");
								}
								else if(data == 2)
								{
									alert("User already assigned to other company");
								}
								//console.log(data); 
							}
				});
			}
			else{
				alert("Please select user");
			}
		}
		else{
			alert("Please select product first");
		}
	}
	else{
		alert("Please select category");
	}
}


    // $(".prd_id_right").click(function () {
        // // Holds the product ID of the clicked element
        // var prd_id = $(this).attr('data-id');
        // var stts = $(this).attr('data-stts');
		// ShowProgress();
		// setInterval(function(){  //Interval Start
			// //alert(productId); true case
			// postForm(prd_id, stts,'active');
		// }, 1000); //Interval End
    // });
	
	// $(".prd_id_right_featured_status").click(function () {
        // // Holds the product ID of the clicked element
        // var prd_id = $(this).attr('data-id');
        // var stts = $(this).attr('data-stts');
		// ShowProgress();
		// setInterval(function(){  //Interval Start
			// //alert(productId); true case
			// postForm(prd_id, stts,'feature');
		// }, 1000); //Interval End
    // });

    // function postForm(prd_id, stts,type)
    // {
		// var params = {prd_id: prd_id, stts: stts}; //JSON ENCODED 
		// if(type == 'active')
		// {
			// post("admin/weblist/ProductStatusUpdate", params, 'POST');
		// }
		// else
		// {
			// post("admin/weblist/FeatureStatusUpdate", params, 'POST');
		// }
    // }
    // function post(path, params, method)
    // {
        // var baseHref = document.getElementsByTagName('base')[0].href;
        // path = baseHref + path; //console.log(params); //json //$(this).serialize(),
        // $.ajax({
            // type: method,
            // url: path,
            // data: params, //new FormData('#signup-form'),//
            // success:
                    // function (data) {
                        // location.reload();
                        // //console.log(data); 
                    // }
        // });
    // }
</script>