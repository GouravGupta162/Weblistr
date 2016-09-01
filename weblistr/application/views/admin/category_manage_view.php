<div class="main-content">
    <div class="main-content-inner">
        <?php include 'breadcrumb_view.php';
        ?>

        <div class="page-content">
           
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
<input type="hidden" id="row_no" value="8">
<a class="btn btn-xs btn-danger pull-right" href="admin/category/add" >Add New Category</a>
                    <!--custom content start-->
                    <?php /*<div class="row">
                        <div class="col-xs-12">
                            
                             <a class="btn btn-xs btn-danger pull-right" href="admin/category/add" 
                                                       >Add New Category</a>
                            
                            <table id="simple-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Category Name </th>
                                        <th>Image</th>
                                        <th class="hidden-480">Description</th>

                                        <th>
                                            
                                            Created on 
                                        </th>
                                        <th class="hidden-480">Status</th>

                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody id='all_rows'>

                                    <?php
//var_dump($getAllcategoryForAdmin);
                                    foreach ($getAllcategoryForAdmin as $categoryValue) {
                                        $cat_id = $categoryValue['cat_id'];
                                        $cat_name = $categoryValue['cat_name'];
                                        $adm_id = $categoryValue['adm_id'];
                                        $cat_image = $categoryValue['cat_image'];
                                        $cat_desctiption = $categoryValue['cat_desctiption'];
                                        $catedate = $categoryValue['date'];
                                        $status = $categoryValue['status'];
										$popular_status = $categoryValue['popular_status']; //1 pop / 0 normal
                                        ?>

                                        <tr>


                                            <td><input type='hidden' id='cat_id' value='<?php echo $cat_id ?>' />
                                                <a href="category/select/<?php echo $cat_id ?>" target='_blank' >

                                                    <?php echo $cat_name ?>
                                                </a>
                                            </td>
                                            <td><img src='<?php echo $cat_image ?>' width='75px' /></td>
                                            <td class="hidden-480">
                                                <?php echo substr($cat_desctiption, 0, 50); ?>
                                            </td>
                                            <td>
                                                <?php echo date("d-m-Y", strtotime($catedate)); ?>
                                            </td>

                                            <td >

                                               											  
<span  
class="label label-sm  cat_id_right cursor <?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? 'label-warning' : 'label-success'); ?>"
data-id="<?php echo $cat_id ?>" 
data-stts="<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>" 

onclick="catactive('<?php echo $cat_id ?>','<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>')"


>
<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? 'In-Active' : 'Active'); ?>
</span>

<span  
class="label label-sm  cat_id_popular cursor <?php  echo $var_is_greater_than_two = ($popular_status == 0 ? 'label-warning' : 'label-success'); ?>"
data-id="<?php echo $cat_id ?>" 
data-stts="<?php  echo $var_is_greater_than_two = ($popular_status == 0 ? '1' : '0'); ?>"

onclick="catpop('<?php echo $cat_id ?>','<?php  echo $var_is_greater_than_two = ($popular_status == 0 ? '1' : '0'); ?>')"

 >
<?php echo $var_is_greater_than_two = ($popular_status == 0 ? 'Normal' : 'Popular'); ?>
</span>
			
                                            </td>

                                            <td>
                                                
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    
                                                    
                                                    <a class="btn btn-xs btn-info" href="admin/category/edit/<?php echo $cat_id ?>" 
                                                       >Edit</a>

                                                    

                                                    <!-- <button class="btn btn-xs btn-danger">
                                                         <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                     </button>

                                                     <button class="btn btn-xs btn-warning">
                                                         <i class="ace-icon fa fa-flag bigger-120"></i>
                                                     </button>-->
                                                </div>

                                                <div class="hidden-md hidden-lg">
                                                    <div class="inline pos-rel">
                                                        <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                            <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                            <li>
                                                                <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                    <span class="blue">
                                                                        <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                    <span class="green">
                                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                    <span class="red">
                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div><!-- /.span -->
                    </div>
					*/?><!-- /.row -->
                    <!--custom content end-->
<div class="row">
									<div class="col-xs-12">
							

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
                                    <tr>

                                        <th>Category Name </th>
                                        <th>Image</th>
                                        <th class="hidden-480">Description</th>

                                        <th>
                                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                            Created on 
                                        </th>
                                        <th class="hidden-480">Status</th>
                                        <th class="hidden-480">Action</th>
                                        <th ></th>
                                    </tr>
												</thead>

												<tbody id='all_rows'>
											<?php 	
			foreach ($getAllcategoryForAdmin as $categoryValue) {
                                        $cat_id = $categoryValue['cat_id'];
                                        $cat_name = $categoryValue['cat_name'];
                                        $adm_id = $categoryValue['adm_id'];
                                        $cat_image = $categoryValue['cat_image'];
                                        $cat_desctiption = $categoryValue['cat_desctiption'];
                                        $catedate = $categoryValue['date'];
                                        $status = $categoryValue['status'];
										$popular_status = $categoryValue['popular_status']; //1 pop / 0 normal
                                        ?>

                                        <tr>


                                            <td><input type='hidden' id='cat_id' value='<?php echo $cat_id ?>' />
											<?php echo $cat_name ?>
                                                
                                            </td>
                                            <td><img src='<?php echo $cat_image ?>' width='75px' /></td>
                                            <td class="hidden-480">
                                                <?php echo substr($cat_desctiption, 0, 50); ?>
                                            </td>
                                            <td>
                                                <?php echo date("d-m-Y", strtotime($catedate)); ?>
                                            </td>

                                            <td >

                                               											  
<span  
class="label label-sm  cat_id_right cursor <?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? 'label-warning' : 'label-success'); ?>"
data-id="<?php echo $cat_id ?>" 
data-stts="<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>" 

onclick="catactive('<?php echo $cat_id ?>','<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>')"


>
<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? 'In-Active' : 'Active'); ?>
</span>

<span  
class="label label-sm  cat_id_popular cursor <?php  echo $var_is_greater_than_two = ($popular_status == 0 ? 'label-warning' : 'label-success'); ?>"
data-id="<?php echo $cat_id ?>" 
data-stts="<?php  echo $var_is_greater_than_two = ($popular_status == 0 ? '1' : '0'); ?>"

onclick="catpop('<?php echo $cat_id ?>','<?php  echo $var_is_greater_than_two = ($popular_status == 0 ? '1' : '0'); ?>')"

 >
<?php echo $var_is_greater_than_two = ($popular_status == 0 ? 'Normal' : 'Popular'); ?>
</span>
			
                                            </td>

                                            <td>
                                                
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    
                                                    
                                                    <a class="btn btn-xs btn-info" href="admin/category/edit/<?php echo $cat_id ?>" 
                                                       >Edit</a>

                                                    

                                                    <!-- <button class="btn btn-xs btn-danger">
                                                         <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                     </button>

                                                     <button class="btn btn-xs btn-warning">
                                                         <i class="ace-icon fa fa-flag bigger-120"></i>
                                                     </button>-->
                                                </div>

                                                <div class="hidden-md hidden-lg">
                                                    <div class="inline pos-rel">
                                                        <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                            <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                            <li>
                                                                <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                    <span class="blue">
                                                                        <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                    <span class="green">
                                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                    <span class="red">
                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
											<td></td>
                                        </tr>
																					<?php } ?>



													

												</tbody>
											</table>
										</div>
									</div>
								</div>



                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>

<script>


$(window).scroll(function(){
	if ($(window).scrollTop() == $(document).height() - $(window).height()){
		loadmoreReviews();
	}
	function loadmoreReviews()
	{
		var baseHref = document.getElementsByTagName('base')[0].href;
		var val =document.getElementById("row_no").value;
		$.ajax({
			type: 'post',
			url: baseHref+'/admin/category/getAllcategoryForAdminOnScroll',
			data: { getresult:val },
			success: 
				function (response) {
					var content = document.getElementById("all_rows");
content.innerHTML += response;
//content.innerHTML = content.innerHTML+response; 
					document.getElementById("row_no").value = Number(val)+8;
				}
			});
	}

}); 


function catactive(cat_id,stts)
{
	   ShowProgress();
		setInterval(function(){  //Interval Start
			
		var params = {cat_id: cat_id, stts: stts}; //JSON ENCODED 
        
		var baseHref = document.getElementsByTagName('base')[0].href;
        path = baseHref + 'admin/login/CategoryStatusUpdate'; //console.log(params); //json //$(this).serialize(),
        $.ajax({
            type: 'POST',
            url: path,
            data: params, //new FormData('#signup-form'),//
            success:
                    function (data) {
                        location.reload();
                        //console.log(data); 
                    }
        });
			
		}, 1000); //Interval End

}
function catpop(cat_id,stts)
{
	ShowProgress();
        // Holds the product ID of the clicked element
            //alert(productId); true case
            var params = {cat_id: cat_id, stts: stts}; //JSON ENCODED 
			var baseHref = document.getElementsByTagName('base')[0].href;
			setInterval(function(){  //Interval Start
			$.ajax({
				type: 'POST',
				url: baseHref + "admin/login/CategoryPopularUpdate", //console.log(params); //json //$(this).serialize(),
				data: params, //new FormData('#signup-form'),//
				success: function (data) {
							location.reload();
						}
			});
		}, 1000); //Interval End
}

    $(".cat_id_right").click(function () {
        // Holds the product ID of the clicked element
        var cat_id = $(this).attr('data-id');
        var stts = $(this).attr('data-stts');
       
          ShowProgress();
		setInterval(function(){  //Interval Start
			postForm(cat_id, stts);
		}, 1000); //Interval End

        
    });

	// $(".cat_id_popular").click(function () {
	// ShowProgress();
        // // Holds the product ID of the clicked element
        // var cat_id = $(this).attr('data-id');
        // var stts = $(this).attr('data-stts');
       
            // //alert(productId); true case
            // var params = {cat_id: cat_id, stts: stts}; //JSON ENCODED 
			// var baseHref = document.getElementsByTagName('base')[0].href;
			// setInterval(function(){  //Interval Start
			// $.ajax({
				// type: 'POST',
				// url: baseHref + "admin/login/CategoryPopularUpdate", //console.log(params); //json //$(this).serialize(),
				// data: params, //new FormData('#signup-form'),//
				// success: function (data) {
							// location.reload();
						// }
			// });
		// }, 1000); //Interval End
        
    // });

    function postForm(cat_id, stts)
    {
        var params = {cat_id: cat_id, stts: stts}; //JSON ENCODED 
        post("admin/login/CategoryStatusUpdate", params, 'POST');
    }
    function post(path, params, method)
    {
        var baseHref = document.getElementsByTagName('base')[0].href;
        path = baseHref + path; //console.log(params); //json //$(this).serialize(),
        $.ajax({
            type: method,
            url: path,
            data: params, //new FormData('#signup-form'),//
            success:
                    function (data) {
                        location.reload();
                        //console.log(data); 
                    }
        });
    }
</script>
<!-- page specific plugin scripts -->
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="assets/js/dataTables.tableTools.min.js"></script>
		<script src="assets/js/dataTables.colVis.min.js"></script>
<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var oTable1 = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.dataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null, null,
					  { "bSortable": false }
					],
					"aaSorting": [],
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			    } );
				//oTable1.fnAdjustColumnSizing();
			
			
				//TableTools settings
				TableTools.classes.container = "btn-group btn-overlap";
				TableTools.classes.print = {
					"body": "DTTT_Print",
					"info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
					"message": "tableTools-print-navbar"
				}
			
				//initiate TableTools extension
				var tableTools_obj = new $.fn.dataTable.TableTools( oTable1, {
					"sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",
					
					"sRowSelector": "td:not(:last-child)",
					"sRowSelect": "multi",
					"fnRowSelected": function(row) {
						//check checkbox when row is selected
						try { $(row).find('input[type=checkbox]').get(0).checked = true }
						catch(e) {}
					},
					"fnRowDeselected": function(row) {
						//uncheck checkbox
						try { $(row).find('input[type=checkbox]').get(0).checked = false }
						catch(e) {}
					},
			
					"sSelectedClass": "success",
			        "aButtons": [
						{
							"sExtends": "copy",
							"sToolTip": "Copy to clipboard",
							"sButtonClass": "btn btn-white btn-primary btn-bold",
							"sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
							"fnComplete": function() {
								this.fnInfo( '<h3 class="no-margin-top smaller">Table copied</h3>\
									<p>Copied '+(oTable1.fnSettings().fnRecordsTotal())+' row(s) to the clipboard.</p>',
									1500
								);
							}
						},
						
						{
							"sExtends": "csv",
							"sToolTip": "Export to CSV",
							"sButtonClass": "btn btn-white btn-primary  btn-bold",
							"sButtonText": "<i class='fa fa-file-excel-o bigger-110 green'></i>"
						},
						
						{
							"sExtends": "pdf",
							"sToolTip": "Export to PDF",
							"sButtonClass": "btn btn-white btn-primary  btn-bold",
							"sButtonText": "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
						},
						
						{
							"sExtends": "print",
							"sToolTip": "Print view",
							"sButtonClass": "btn btn-white btn-primary  btn-bold",
							"sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",
							
							"sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Optional Navbar &amp; Text</small></a></div></div>",
							
							"sInfo": "<h3 class='no-margin-top'>Print view</h3>\
									  <p>Please use your browser's print function to\
									  print this table.\
									  <br />Press <b>escape</b> when finished.</p>",
						}
			        ]
			    } );
				//we put a container before our table and append TableTools element to it
			    $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));
				
				//also add tooltips to table tools buttons
				//addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
				//so we add tooltips to the "DIV" child after it becomes inserted
				//flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
				setTimeout(function() {
					$(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function() {
						var div = $(this).find('> div');
						if(div.length > 0) div.tooltip({container: 'body'});
						else $(this).tooltip({container: 'body'});
					});
				}, 200);
				
				
				
				//ColVis extension
				var colvis = new $.fn.dataTable.ColVis( oTable1, {
					"buttonText": "<i class='fa fa-search'></i>",
					"aiExclude": [0, 6],
					"bShowAll": true,
					//"bRestore": true,
					"sAlign": "right",
					"fnLabel": function(i, title, th) {
						return $(th).text();//remove icons, etc
					}
					
				}); 
				
				//style it
				$(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')
				
				//and append it to our table tools btn-group, also add tooltip
				$(colvis.button())
				.prependTo('.tableTools-container .btn-group')
				.attr('title', 'Show/hide columns').tooltip({container: 'body'});
				
				//and make the list, buttons and checkboxed Ace-like
				$(colvis.dom.collection)
				.addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
				.find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
				.find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');
			
			
				
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) tableTools_obj.fnSelect(row);
						else tableTools_obj.fnDeselect(row);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(!this.checked) tableTools_obj.fnSelect(row);
					else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
				});
				
			
				
				
					$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			})
		</script>