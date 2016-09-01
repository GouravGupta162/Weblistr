<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('category_model');
        $this->load->model(array('admin/admin_model', 'admin/admin_category_model', 'admin/user_model','notificationmodel'));  //Open 
        $this->load->library(array('session', 'email'));  // Session on each controller
        $this->load->database(); // db 
        $this->load->helper(array('url', 'form','file')); // form action basic things
    }

    public function index() {
        $data['title'] = 'Category';
        $this->load->view("admin/header_view", $data); //$this->load->view("registration_view.php", $data);

        $data['getAllcategoryForAdmin'] = $this->admin_category_model->getAllcategoryForAdmin();

        $this->load->view("admin/category_manage_view", $data); //$this->load->view("registration_view.php", $data);
        $this->load->view("admin/footer_view", $data); //$this->load->view("registration_view.php", $data);
    }

    function categoryupdate() { //For Admin Update Edit Category
        $this->admin_category_model->category_update();
    }


	function getAllcategoryForAdminOnScroll() { //For Admin Update Edit Category
        $getAllcategoryForAdmin = $this->admin_category_model->getAllcategoryForAdminOnScroll();
		
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
		
    }
	
	
     function categoryadd() { //For Admin Update Edit Category
        $userid = $this->session->userdata('usr_id'); //admin ID
        $this->admin_category_model->category_add($userid);
    }

    public function edit($id = 0) {
        if ($id != 0) {
            $data['title'] = 'Category Edit';
            $this->load->view("admin/header_view", $data); //$this->load->view("registration_view.php", $data);
            
            $data['getSelectedcategoryForAdmin'] = $this->admin_category_model->getSelectedcategoryForAdmin($id);
            
            $this->load->view("admin/category_edit_manage_view", $data); //$this->load->view("registration_view.php", $data);
            $this->load->view("admin/footer_view", $data); //$this->load->view("registration_view.php", $data);
        }
    }

    
    public function add() {
        
        $data['title'] = 'Category Add';
        $this->load->view("admin/header_view", $data); //$this->load->view("registration_view.php", $data);

        $this->load->view("admin/category_add_manage_view", $data); //$this->load->view("registration_view.php", $data);
        $this->load->view("admin/footer_view", $data); //$this->load->view("registration_view.php", $data);
        
    }

    
}

?>