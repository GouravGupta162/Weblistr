<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class weblist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('category_model');
        $this->load->model(array('admin/admin_model', 'admin/admin_category_model', 'admin/user_model', 'admin/product_model','notificationmodel'));  //Open 
        $this->load->library(array('session', 'email','pagination'));  // Session on each controller
        $this->load->database(); // db 
        $this->load->helper(array('url', 'form','file')); // form action basic things
    }

    public function index() {
        $data['title'] = 'Category';
        // $this->load->view("admin/header_view", $data); //$this->load->view("registration_view.php", $data);

        // $data['getAllProduct'] = $this->product_model->getAllProduct();

        // $this->load->view("admin/weblist_manage_view", $data); //$this->load->view("registration_view.php", $data);
        // $this->load->view("admin/footer_view", $data); //$this->load->view("registration_view.php", $data);
		
		
		
		$config = array();
		$config["base_url"] = base_url() . "admin/weblist/index";
		
		$total_row = $this->db->count_all('product');	//;$this->portfolio_model->record_count();
		$config["total_rows"] = $total_row;
		$config["per_page"] = 20;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		if ($page>1) {

		   $x = $page-1;
		   $x = $x+1;
		   $i= $x.'0';

		}else{

		   $i=0;
		}

		
		
        $sql = "SELECT * FROM `product` order by prd_id desc limit ".$i.','. $config["per_page"];
		
		$query = $this->db->query($sql);
		
		$data["getAllProduct"] = $query->result_array();//$this->portfolio_model->fetch_data($config["per_page"], $i);

		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );
		$data['user_type'] = $this->session->userdata('login')['type'];
		
		$this->load->view('admin/header_view',$data);
		$this->load->view('admin/weblist_manage_view',$data);
		$this->load->view('admin/footer_view',$data);
		
		
    }
	
    public function edit($id = 0) {
        if ($id != 0) {
            $data['title'] = 'Product Edit';
            $this->load->view("admin/header_view", $data); //$this->load->view("registration_view.php", $data);
            
            $data['getSelectedProduct'] = $this->product_model->getSelectedProduct($id);
            
            $this->load->view("admin/weblist_edit_manage_view", $data); //$this->load->view("registration_view.php", $data);
            $this->load->view("admin/footer_view", $data); //$this->load->view("registration_view.php", $data);
        }
    }
	function assignpost()
	{
		$subcategory = $this->input->post('subcategory');
		$prd_id = $this->input->post('prd_id');
		$user = $this->input->post('user');
		
		$check_assigned_values=$this->db->query('select * from product where prd_id="'.$prd_id.'"');
		$result = $check_assigned_values->row_array();
		
		$usercheck=$this->db->query("select * from product where added_by= '$user' ");
		$userchecker = $usercheck->num_rows();
		if($userchecker == 0)
		{
			if($result['added_by']=='' || $result['added_by']=='0')
			{
			
				$sql = "update product set added_by = '$user', usr_type = 'user' where prd_id  = '$prd_id' ";
				
				$query = $this->db->query($sql);
				
				$sql = "update user_register set admin_status = '1'  where usr_id = '$user' ";
				$query = $this->db->query($sql);
				
				
				///Email code 
		
				$toemailusrid = $user;
				$query = $this->db->query("SELECT * from user_register where usr_id = $toemailusrid ");
				$row = $query->row_array();
				$email_id = $row['email_id']; //review table auto gen id
				if($email_id != '')
				{
					$query = $this->db->query('SELECT * FROM adminemail ');
					$adminEmail = $query->row_array();
					$fromname = $adminEmail['name'];
					$fromEmail = $adminEmail['email'];
					
					$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
					$this->email->to($email_id);
					$this->email->subject('Company Assigned');
					$mailbody = $this->mailtemplate('The Weblisters assigned you company!');
					$this->email->set_mailtype("html");
					$this->email->message($mailbody);
					$this->email->send();
				
				}
				///Email code 
				
				echo "1";
			}
			else
			{
				echo "0";
			}
		}
		else{
			echo "2";
		}
	}
	function assign()
	{
		$data['title'] = 'Website Assign';
        $this->load->view("admin/header_view", $data); //$this->load->view("registration_view.php", $data);
        $data['getAllcat'] = $this->product_model->getAllcat();
		
		$data['getAllCompanyUsers'] = $this->product_model->getAllCompanyUsers();
        
        $this->load->view("admin/website_assign_view", $data); //$this->load->view("registration_view.php", $data);
        $this->load->view("admin/footer_view", $data); //$this->load->view("registration_view.php", $data);

	}
    
    
    public function approve() {
        
        $data['title'] = 'Review Approving';
        $this->load->view("admin/header_view", $data); //$this->load->view("registration_view.php", $data);
        
        $data['RecentReview'] = $this->product_model->getAllReviews();
        //$data['getUserapproveProduct'] = $this->product_model->getAllProductStatus(1);
        
        
        $this->load->view("admin/weblist_approve_manage_view", $data); //$this->load->view("registration_view.php", $data);
        $this->load->view("admin/footer_view", $data); //$this->load->view("registration_view.php", $data);
    }
    public function add() {
        
        $data['title'] = 'Product Add';
        $this->load->view("admin/header_view", $data); //$this->load->view("registration_view.php", $data);
		$data['getAllcat'] =  $this->product_model->getAllcat();
        $this->load->view("admin/weblist_add_manage_view", $data); //$this->load->view("registration_view.php", $data);
        $this->load->view("admin/footer_view", $data); //$this->load->view("registration_view.php", $data);
        
    }
    public function ProductStatusUpdate() {
        $this->product_model->ProductStatusUpdate();
    }
	public function ReviewReject() {
        $this->product_model->ReviewReject();
    }
	public function ReviewStatusUpdate() {
        $this->product_model->ReviewStatusUpdate();
    }
	
	public function FeatureStatusUpdate() {
        $this->product_model->FeatureStatusUpdate();
    }
    public function productUpdate()
    {
        $this->product_model->productupdate();
    }
    public function tagRemove()
    {
        $this->product_model->tag_remove();
    }
	
	public function GetReviewDetail()
    {
        $this->product_model->GetReviewDetail();
    }
	
	public function getAllProductOnScroll()
    { 
		$getAllProduct = $this->product_model->getAllProductOnScroll();
		
		if (sizeof($getAllProduct) > 0) {
            foreach ($getAllProduct as $product) {
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
				<tr>


					<td>
					<input type='hidden' id='prd_id' value='<?php echo $prd_id ?>' />
						<a href="Review/detail/<?php echo $prd_id ?>" target='_blank' >

							<?php echo $prd_name ?>
						</a>
					</td>
					<td><img src='<?php 
											
						if((file_exists($prd_image)) && ($prd_image != ""))
						{
							echo $prd_image; 
						}
						else{
							echo "http://www.weblistr.com/images/product/dummy_prd12.jpg"; 
						}
						
						
						?>' width='75px' /></td>
					<!--<td class="hidden-480 col-xs-3 " >
						<?php //echo substr($prd_info, 0, 50); ?>
					</td>-->

					<td class="hidden-480">
						<a href="<?php echo $prd_link; ?>" target="_blank" >
							<?php echo $prd_link; ?></a>
					</td>
					<td class="hidden-480">
						<?php echo $prd_address; ?>
					</td>

					<td>
					
					
	<span  
	class="label label-sm prd_id_right cursor <?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? 'label-warning' : 'label-success'); ?>"
	data-id="<?php echo $prd_id ?>" 
	data-stts="<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>" 
	
	onclick="productactive('<?php echo $prd_id ?>','<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>')"
	
	>
	<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? 'In-Active' : 'Active'); ?>
	</span>

	<span  
	class="label label-sm prd_id_right_featured_status cursor <?php $var = $featured_status; echo $var_is_greater_than_two = ($var == 0 ? 'btn-success' : 'btn-danger'); ?>"
	data-id="<?php echo $prd_id ?>" 
	data-stts="<?php $var = $featured_status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>" 
	onclick="productfeature('<?php echo $prd_id ?>','<?php $var = $featured_status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>')"
	>
	<?php $var = $featured_status; echo $var_is_greater_than_two = ($var == 0 ? 'Make Featured' : 'Un-Featured'); ?>
	</span>



					</td>

					<td>
						
						<div class="hidden-sm hidden-xs btn-group">




							<a class="btn btn-xs btn-info" href="admin/weblist/edit/<?php echo $prd_id ?>" 
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
		
	}
	public function getAllReviewsOnScroll()
    {	
		$RecentReview = $this->product_model->getAllReviewsOnScroll();
		if (sizeof($RecentReview) > 0) {
			foreach ($RecentReview as $review) {
			$usr_name = $review['usr_name'];
			$cat_name = $review['cat_name'];
			$prd_name = $review['prd_name'];
			$rev_id = $review['rev_id'];
			$review_head = $review['review_head'];
			$review_body = $review['review_body'];
											
			$prd_id = $review['prd_id'];
			$cat_id = $review['cat_id'];
			$status = $review['status'];
			?>
			<tr>
				<td>
				  <input type='hidden' id='rev_id' value='<?php echo $rev_id ?>' />
						<?php echo 'Review Heading - '.substr($review_head,0,50).'<br/>Review Message - '.substr($review_body,0,50); ?>
						<a href="javascript:modalread('<?php echo $rev_id ?>')">Read Completly</a>
				</td>                                          
				<td>
					<?php echo $usr_name; ?>
				</td>
				<td>
						<?php echo $prd_name; ?>
				</td>
				<td class="hidden-480">
					<?php echo $cat_name; ?>
				</td>

				<td class="hidden-480">	


	<?php 
if($status != 2)
{
?>	
				
	<span  
	class="label label-sm  rev_id_right cursor <?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? 'label-warning' : 'label-success'); ?>"
	data-id="<?php echo $rev_id ?>" 
	data-stts="<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>"

onclick="reviewactive('<?php echo $rev_id ?>','<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>')"

	>
	<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? 'Active' : 'In-Active'); ?>
	</span>
	
	

<span  
class="label label-sm  cursor label-warning"
data-id="<?php echo $rev_id ?>" 
onclick="reviewreject('<?php echo $rev_id ?>')"
>
Reject
</span>




<?php
	
}
else{
	?>
	
	
<span  
class="label label-sm  cursor label-danger"
>
Rejected
</span>

	
	<?php
}
?>
		
	
	
				</td>

			</tr>
			<?php
			}
		}
		
    }
    
    public function PostAdd() { //add_list_your_website
        if (($this->session->userdata('usr_id') != "")) {
            $userid = $this->session->userdata('usr_id');
            $this->product_model->addwebList($userid);
        } else {
            echo "0";
        }
    }

	function mailtemplate($message)
	{
		$html =" <style type='text/css'>
			img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
			a img { border: none; }
			table { border-collapse: collapse !important;}
			#outlook a { padding:0; }
			.ReadMsgBody { width: 100%; }
			.ExternalClass { width: 100%; }
			.backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
			table td { border-collapse: collapse; }
			.ExternalClass * { line-height: 115%; }
			.container-for-gmail-android { min-width: 600px; }

			* {
				font-family: Helvetica, Arial, sans-serif;
			}

			body {
				-webkit-font-smoothing: antialiased;
				-webkit-text-size-adjust: none;
				width: 100% !important;
				margin: 0 !important;
				height: 100%;
				color: #676767;
			}

			td {
				font-family: Helvetica, Arial, sans-serif;
				font-size: 14px;
				color: #777777;
				text-align: center;
				line-height: 21px;
			}

			a {
				color: #676767;
				text-decoration: none !important;
			}

			.pull-left {
				text-align: left;
			}

			.pull-right {
				text-align: right;
			}

			.header-lg,
			.header-md,
			.header-sm {
				font-size: 32px;
				font-weight: 700;
				line-height: normal;
				padding: 35px 0 0;
				color: #4d4d4d;
			}

			.header-md {
				font-size: 24px;
			}

			.header-sm {
				padding: 5px 0;
				font-size: 18px;
				line-height: 1.3;
			}

			.content-padding {
				padding: 20px 0 30px;
			}

			.mobile-header-padding-right {
				width: 290px;
				text-align: right;
				padding-left: 10px;
			}

			.mobile-header-padding-left {
				width: 290px;
				text-align: left;
				padding-left: 10px;
			}

			.free-text {
				width: 100% !important;
				padding: 10px 60px 0px;
			}

			.block-rounded {
				border-radius: 5px;
				border: 1px solid #e5e5e5;
				vertical-align: top;
			}

			.button {
				padding: 30px 0;
			}

			.info-block {
				padding: 0 20px;
				width: 260px;
			}

			.block-rounded {
				width: 260px;
			}

			.info-img {
				width: 258px;
				border-radius: 5px 5px 0 0;
			}

			.force-width-gmail {
				min-width:600px;
				height: 0px !important;
				line-height: 1px !important;
				font-size: 1px !important;
			}

			.button-width {
				width: 228px;
			}

		</style>

		<style type='text/css' media='screen'>
			@import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
		</style>

		<style type='text/css' media='screen'>
			@media screen {
				* {
					font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
				}
			}
		</style>

		<style type='text/css' media='only screen and (max-width: 480px)'>
			@media only screen and (max-width: 480px) {
				table[class*='container-for-gmail-android'] {
					min-width: 290px !important;
					width: 100% !important;
				}

				table[class='w320'] {
					width: 320px !important;
				}

				img[class='force-width-gmail'] {
					display: none !important;
					width: 0 !important;
					height: 0 !important;
				}

				a[class='button-width'],
				a[class='button-mobile'] {
					width: 248px !important;
				}

				td[class*='mobile-header-padding-left'] {
					width: 160px !important;
					padding-left: 0 !important;
				}

				td[class*='mobile-header-padding-right'] {
					width: 160px !important;
					padding-right: 0 !important;
				}

				td[class='header-lg'] {
					font-size: 24px !important;
					padding-bottom: 5px !important;
				}

				td[class='header-md'] {
					font-size: 18px !important;
					padding-bottom: 5px !important;
				}

				td[class='content-padding'] {
					padding: 5px 0 30px !important;
				}

				td[class='button'] {
					padding: 5px !important;
				}

				td[class*='free-text'] {
					padding: 10px 18px 30px !important;
				}

				td[class='info-block'] {
					display: block !important;
					width: 280px !important;
					padding-bottom: 40px !important;
				}

				td[class='info-img'],
				img[class='info-img'] {
					width: 278px !important;
				}
			}
		</style>
		<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%' style='background-color:#f7f7f7' >
			<tr>
				<td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
					<center>
						<img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
							<table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
								<tr>
									<td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
									 
										<center>
											<table cellpadding='0' cellspacing='0' width='600' class='w320'>
												<tr>
													<td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
														<a href=''><img width='137' height='47' src='http://demo.dupleit.com/weblister_v2/images/logo.png' alt='logo'></a>
													</td>
													<td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
														<a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
														<a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
														<a href=''><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
													</td>
												</tr>
											</table>
										</center>
									 
									</td>
								</tr>
							</table>
					</center>
				</td>
			</tr>
			<tr>
				<td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
					<center>
						<table cellspacing='0' cellpadding='0' width='600' class='w320'>
							<tr>
								<td class='header-lg'>
									The Weblisters!
								</td>
							</tr>
							<tr>
								<td style='height:100px;'></td>
							</tr>
							<tr>
								<td >
									<table>
									<tr>
									<td>'$message'</td></tr>
									</table>
								</td>
							</tr>
						</table>
					</center>
				</td>
			</tr>
			
			<tr>
				<td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
					<center>
						<table cellspacing='0' cellpadding='0' width='600' class='w320'>
							<tr>
								<td style='padding: 25px 0 25px'>
									<strong>The Weblisters</strong><br />
									Kolkata <br />
									India <br /><br />
								</td>
							</tr>
						</table>
					</center>
				</td>
			</tr>
		</table>";
		return $html;
	}
}

?>