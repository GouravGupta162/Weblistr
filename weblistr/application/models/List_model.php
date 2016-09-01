<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class List_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->helper(array('url','form','file'));
    }
	
	public function check_tag($tag_name)
	{
		$where = "tag_name='$tag_name'";
		$this->db->where($where);
        $query=$this->db->get("tags");
        if($query->num_rows() > 0)
		{
			foreach($query->result() as $rows)
            {
				//var_dump($rows);
				return $rows->tag_id;
			}
		}
		return "0";
	}
	public function insert_tags($tag_name)
	{
		$date = date('Y-m-d H:i:s');
		$data = array(
					'tag_name'=>$tag_name,
					'date'=>$date,
					'status'=>'0'
					);
		$this->db->insert('tags',$data);
		
		$query = $this->db->query('SELECT LAST_INSERT_ID()');
		$row = $query->row_array();
		return $row['LAST_INSERT_ID()'];
		
		//$this->db->insert_id();//product_tags id if working 
	}
	public function insert_product_tags($prd_id,$tag_id)
	{
		$data = array(
					'prd_id'=>$prd_id,
					'tag_id'=>$tag_id,
					'status'=>'0'
					);
		$this->db->insert('product_tags',$data);
		
		$query = $this->db->query('SELECT LAST_INSERT_ID()');
		$row = $query->row_array();
		return $row['LAST_INSERT_ID()'];
	}
	
	public function tag_process($hidden_tags,$prd_id)
	{
		$arrayData = explode(",",$hidden_tags);
		foreach ($arrayData as $row => $tagname) { 
		$checker = $this->check_tag($tagname); //tag id
			if($checker == 0){
				$checker = $this->insert_tags($tagname);
				$this->insert_product_tags($prd_id,$checker);
				//echo $tagname.'</br>'; // new insert
			}
			else{
				$this->insert_product_tags($prd_id,$checker);
				//echo $tagname.' '.$checker.'  ' .' value matched</br>'; //increase counter only or allot  to project 
			}
		
		}
		//echo sizeof($arrayData).'\n';
		//echo $arrayData[0];
	}
	
	function edit_list_your_website($user)
	{
		$prd_id=$this->input->post('prd_id');
		$info=$this->input->post('webinfo');
		$deallink=$this->input->post('deallink');
		$servicesOffered=$this->input->post('servicesOffered');
		$customer_support_id=$this->input->post('custId');//customer_support_id
		$locations=$this->input->post('locations');
		$deliveryTime=$this->input->post('deliveryTime');
		
		
		$windowApp=$this->input->post('windowApp');
		$iosApp=$this->input->post('iosApp');
		$androidApp=$this->input->post('androidApp');
		
		$address=$this->input->post('webaddress');
		$num=$this->input->post('webnumber');
		$payoption='';
		if(isset($_POST['payoption'])){
			$payoption=implode(',',$_POST['payoption']);
		}
			
		
		$this->db->where("prd_id",$prd_id);
		$this->db->where("added_by",$user);
		$data=array(
				'prd_info'=>$info,
				'deal_link'=>$deallink,
				'services_offered'=>$servicesOffered,
				'customer_support_id'=>$customer_support_id,
				
				'windows_app_url'=>$windowApp,
				'ios_app_url'=>$iosApp,
				'android_app_url'=>$androidApp,
				'prd_address'=>$address,
				'prd_number'=>$num,
				'payment_option'=>$payoption,	 
				'locations'=>$locations,
				'delivery_time'=>$deliveryTime
			);
		$this->db->update('product', $data);
		$afftectedRows = $this->db->affected_rows();
		echo $afftectedRows;
				
	}
	
	public function add_list_your_website($user)
	{
		
		
		$query = $this->db->query("SELECT * from user_register where usr_id = $user");
		$row = $query->row_array();
		$toemailusrid = $row['email_id'];
		if($row['admin_status'] != 1)
		{
				$link=$this->input->post('weblink');
				$name=$link;//$this->input->post('webname');
				//$cat_id=$this->input->post('cat_hidden');
				$address=$this->input->post('webaddress');
				//$num=$this->input->post('webnumber');
				
				//new start
				// $windowApp=$this->input->post('windowApp');
				// $iosApp=$this->input->post('iosApp');
				// $androidApp=$this->input->post('androidApp');
				
				$deallink=$this->input->post('deallink');
				$servicesOffered=$this->input->post('servicesOffered');
				$customer_support_id=$this->input->post('custId');//customer_support_id
				
				if(isset($_POST['payoption'])){
					$payoption=implode(',',$_POST['payoption']);
				}
				
				$cat_id= $_POST['webcategory'];
					
				// $webcategory='';
				// if(isset($_POST['webcategory'])){
					// $cat_id=implode(',',$_POST['webcategory']);
				// }
				
				
				$locations=$this->input->post('locations');
				$deliveryTime=$this->input->post('deliveryTime');
				
				//new end
				
				$info=$this->input->post('webinfo');
				//$file=$this->input->$_FILES['file'];
				$fname = $_FILES['file']['name']; 
				$fileTmpName=$_FILES["file"]["tmp_name"]; 
				//echo $file. " - Yahoo Done";
				
				$hidden_tag=$this->input->post('hidden_tag');
				//$this->tag_process($hidden_tag,31);
				//$this->tag_process($hidden_tag,$prd_id);
				//exit;
				$random=rand(1111,9999);
				$newFileName=$random.$fname;
				
				$checked=$this->check_prd($link);
				//$checked=$this->check_prd($name,$link);
				
				if($fname!='')
				{
					$filepath = "images/product/".$newFileName; //images/product/flipkart_logo.jpg
					$resizestatus = $this->resizesave($fileTmpName,$filepath,250,250);
					
					if($checked == false)
					{	
						if($resizestatus == 1) //if(move_uploaded_file($fileTmpName,$filepath))
						{ 
							$data=array(
								 'cat_id'=>$cat_id,
								 
								 'usr_type'=>'user',
								 'prd_name'=>$name,
								 'prd_link'=>$link,
								 'prd_info'=>$info,
								 //'prd_address'=>$address,
								 //'prd_number'=>$num,
								 'prd_image'=>$filepath,

								 // 'windows_app_url'=>$windowApp,
								 // 'ios_app_url'=>$iosApp,
								 // 'android_app_url'=>$androidApp,
								 
								 //'deal_link'=>$deallink,
								 //'services_offered'=>$servicesOffered,
								 //'customer_support_id'=>$customer_support_id,
								 //'payment_option'=>$payoption,
								 //'locations'=>$locations,
								 //'delivery_time'=>$deliveryTime,
								 
								 'status'=>'0'
								 );
							$this->db->insert('product',$data);
							
							//$this->db->insert_id();//product id if working 
							
							$query = $this->db->query('SELECT LAST_INSERT_ID()');
							$row = $query->row_array();
							$prd_id = $row['LAST_INSERT_ID()'];
							
							$this->tag_process($hidden_tag,$prd_id);
							
							$this->db->query("insert into prd_usr_ids (prd_id,usr_id) values ('$prd_id','$user') ");
							
							// $query = $this->db->query("SELECT admin_status from user_register where usr_id = $user");
							// $row = $query->row_array();
							// $admin_status = $row['admin_status'];
							// if($admin_status == 0)
							// {
								// $this->db->query("update user_register set admin_status = 1 where usr_id = $user");
							// }
							
							//Notification Model Loading and calling it Start
								$notification =& get_instance(); 
								$notification->load->model("notificationmodel");
								$this->notificationmodel->CompanyListingNotification($prd_id,$user);
							//Notification Model Loading and calling it End
							
							
							///Email code 
							$email_id = $toemailusrid;
							if($email_id != '')
							{
								$query = $this->db->query('SELECT * FROM adminemail ');
								$adminEmail = $query->row_array();
								$fromname = $adminEmail['name'];
								$fromEmail = $adminEmail['email'];
								
								$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
								$this->email->to($email_id);
								$this->email->subject('Website Listed');
								$mailbody = $this->mailtemplate('website is added successfully and under review. we will notify you after approving.');
								$this->email->set_mailtype("html");
								$this->email->message($mailbody);
								$this->email->send();
								echo $prd_id;
							}
							else{
								echo $prd_id;
							}
							
							
						}
						else{
							echo "-2";
						}
					}
					else{
						echo "-3";
					}
					
				}
				else
				{
					$filepath="images/product/dummy_prd12.jpg";
					
					if($checked == false)
					{	
						
						$data=array(
							 'cat_id'=>$cat_id,
							 //'added_by'=>$user,
							 'usr_type'=>'user',
							 'prd_name'=>$name,
							 'prd_link'=>$link,
							 'prd_info'=>$info,
							 //'prd_address'=>$address,
							 //'prd_number'=>$num,
							 'prd_image'=>$filepath,

							 // 'windows_app_url'=>$windowApp,
							 // 'ios_app_url'=>$iosApp,
							 // 'android_app_url'=>$androidApp,
							 
							 //'deal_link'=>$deallink,
							 //'services_offered'=>$servicesOffered,
							 //'customer_support_id'=>$customer_support_id,
							 //'payment_option'=>$payoption,
							 //'locations'=>$locations,
							 //'delivery_time'=>$deliveryTime,
							 
							 'status'=>'0'
							 );
						$this->db->insert('product',$data);
						
						//$this->db->insert_id();//product id if working 
						
						$query = $this->db->query('SELECT LAST_INSERT_ID()');
						$row = $query->row_array();
						$prd_id = $row['LAST_INSERT_ID()'];
						
						$this->tag_process($hidden_tag,$prd_id);
						$this->db->query("insert into prd_usr_ids (prd_id,usr_id) values ('$prd_id','$user') ");
						// $query = $this->db->query("SELECT admin_status from user_register where usr_id = $user");
						// $row = $query->row_array();
						// $admin_status = $row['admin_status'];
						// if($admin_status == 0)
						// {
							// $this->db->query("update user_register set admin_status = 1 where usr_id = $user");
						// }
						
						//Notification Model Loading and calling it Start
							$notification =& get_instance(); 
							$notification->load->model("notificationmodel");
							$this->notificationmodel->CompanyListingNotification($prd_id,$user);
						//Notification Model Loading and calling it End
						
						///Email code 
						$email_id = $toemailusrid;
						if($email_id != '')
						{
							$query = $this->db->query('SELECT * FROM adminemail ');
							$adminEmail = $query->row_array();
							$fromname = $adminEmail['name'];
							$fromEmail = $adminEmail['email'];
							
							$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
							$this->email->to($email_id);
							$this->email->subject('Website Listed');
							$mailbody = $this->mailtemplate('website is added successfully and under review. we will notify you after approving.');
							$this->email->set_mailtype("html");
							$this->email->message($mailbody);
							$this->email->send();
							echo $prd_id;
						}
						else{
							echo $prd_id;
						}
						
					}
					else{
						echo "-3";
					}

					
				}
				
				
		}
		else
		{
			echo "alreadysubmitted";
		}
	}
	
	public function check_prd($link)
	{
		$where = " prd_link='$link'";
		$this->db->where($where);//$this->db->where("email_id",$email);
        $query=$this->db->get("product");
        if($query->num_rows()>0)
		{
			 return true;   
		}
		return false;
	}
	
	function getProduct_AutoComplete($q,$cat){ //Category Auto Comeplte
		// $this->db->select('*');
		// $this->db->like('prd_name', $q.'%');
		// $query = $this->db->get('product');
		if($cat == 0)
		{
			$q='%'.$q.'%';
			//$query = $this->db->query("SELECT * from product where (prd_name like '$q' or prd_link like '$q') and status='1'");
$query = $this->db->query("SELECT *,product.cat_id as newcat from product,category where (product.prd_name like '$q' or product.prd_link like '$q') and product.status='1' and FIND_IN_SET(category.cat_id,product.cat_id) group by prd_id ");


		}
		else
		{
			$q='%'.$q.'%';
			$query = $this->db->query("SELECT *,product.cat_id as newcat from product,category where (product.prd_name like '$q' or product.prd_link like '$q') and FIND_IN_SET('$cat',product.cat_id) and product.status='1' and category.cat_id = '$cat'   group by prd_id  ");
		}
			//$q=$q.'%';
			
			//$query = $this->db->query("SELECT * from product where prd_name like '$q' ");
			//$query = $query->row_array();
			
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $row){
				//$row_set[] = htmlentities(stripslashes($row['cat_name'])); //build an array
				$new_row['label']=htmlentities(stripslashes($row['prd_name'])); //Show
				$new_row['value']= $row["prd_id"].','. $row["newcat"]; //Hidden Work
				$row_set[] = $new_row; //build an array
			}
			echo json_encode($row_set); //format the array into json data
		}
		else{
			echo "0";
		}
		
	}
	function resizesave($fileTempNmae,$filepath,$compresswidth,$compressheight)
	{
		//resizing
		$bannertempname = $fileTempNmae;//file temp name
		$size = getimagesize($bannertempname);
		$type = $size['mime'];                        
		$width = $size[0];
		$height = $size[1];
		
		$newwidth = $compresswidth;
		$newheight = $compressheight;
		$tmp = imagecreatetruecolor($newwidth, $newheight);
		
		$resizefilename=$filepath;//"images/category/full/".$newFileName; path with file name and its extenstion
		$status = "0";
		if ($size[2] == IMAGETYPE_GIF) 
		{
			$src = imagecreatefromgif($bannertempname);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagegif($tmp, $resizefilename, 100);
			$status = "1";
		}
		elseif ($size[2] == IMAGETYPE_JPEG)
		{
			$src = imagecreatefromjpeg($bannertempname);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagejpeg($tmp, $resizefilename, 100);
			$status = "1";
		}
		elseif ($size[2] == IMAGETYPE_PNG)
		{
			$src = imagecreatefrompng($bannertempname);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagepng($tmp, $resizefilename, 9);
			$status = "1";
		}
		imagedestroy($src);
		imagedestroy($tmp);
		//resizing
		
		return $status;
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