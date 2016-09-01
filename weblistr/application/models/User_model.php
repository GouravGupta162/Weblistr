<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
		
    }
	function login($email,$password)
    {
		$this->db->where("email_id",$email);
		$this->db->where("admin_status",'0');
        $this->db->where("usr_password",md5($password.'2@41bl13c9'));
		
        $query=$this->db->get("user_register");
        if($query->num_rows()>0)
        {
			$rows = $query->row_array();

			if($rows['status'] == 1){         	
            
				$this->session->set_userdata('usr_id',$rows['usr_id']);
				$this->session->set_userdata('usr_name',$rows['usr_name']);
				$this->session->set_userdata('email_id',$rows['email_id']);
				$this->session->set_userdata('admin_status',$rows['admin_status']);
				$this->session->set_userdata('super_admin_status',$rows['super_admin_status']);
				$this->session->set_userdata('logged_in','TRUE');
				$this->session->set_userdata('fb_profile',$rows['social_id']);
				$this->session->set_userdata('register_method',$rows['register_method']);
				
				$login_counter = $rows['login_counter'];
				
				if($login_counter == 0){
					if($rows['admin_status'] == 0)
					{
						/************** email to user on signup email sender  **************************************/  
							$query = $this->db->query('SELECT * FROM adminemail ');
							$adminEmail = $query->row_array();
							$fromname = $adminEmail['name'];
							$fromEmail = $adminEmail['email'];
							
							$this->email->from($fromEmail, ucwords($fromname));
							$this->email->to($email);
							$this->email->subject('Welcome to the Weblistr Community!');
							
							$logolink = base_url()."images/logo.png";
							$emailmodel =& get_instance(); 
							$emailmodel->load->model("emailmodel");
							$mailbody = $this->emailmodel->userfirsttimelogin($logolink,$rows['usr_name']);
							
							$this->email->set_mailtype("html");
							$this->email->message($mailbody);
							$this->email->send();
						//email End
					}
					else if($rows['admin_status'] == 1) {
						/************** email to user on signup email sender  **************************************/  
							$query = $this->db->query('SELECT * FROM adminemail ');
							$adminEmail = $query->row_array();
							$fromname = $adminEmail['name'];
							$fromEmail = $adminEmail['email'];
							
							$this->email->from($fromEmail, ucwords($fromname));
							$this->email->to($email);
							$this->email->subject('Welcome to the Weblistr Community!');
							
							$logolink = base_url()."images/logo.png";
							$emailmodel =& get_instance(); 
							$emailmodel->load->model("emailmodel");
							$mailbody = $this->emailmodel->companyfirstlogin($logolink,$rows['usr_name']);
							
							$this->email->set_mailtype("html");
							$this->email->message($mailbody);
							$this->email->send();
						//email End
					}
				}
				$newlogcounter = $login_counter+1;
				$usrid =  $rows['usr_id'];
				$sql = " update user_register set login_counter = '$newlogcounter' where user_register.usr_id =  '$usrid' ";
				$this->db->query($sql);
				
				echo 'loggedin';
			}	
			else{
				echo 'banned';
			}
		}
		else{
			echo "notloggedin";
		}
    }
	
	function companylogin($email,$password)
    {
		$this->db->where("email_id",$email);
		$this->db->where("admin_status",'1');
        $this->db->where("usr_password",md5($password.'2@41bl13c9'));
		
        $query=$this->db->get("user_register");
        if($query->num_rows()>0)
        {
			$rows = $query->row_array();

			if($rows['status'] == 1){         	
            
				$this->session->set_userdata('usr_id',$rows['usr_id']);
				$this->session->set_userdata('usr_name',$rows['usr_name']);
				$this->session->set_userdata('email_id',$rows['email_id']);
				$this->session->set_userdata('admin_status',$rows['admin_status']);
				$this->session->set_userdata('super_admin_status',$rows['super_admin_status']);
				$this->session->set_userdata('logged_in','TRUE');
				$this->session->set_userdata('fb_profile',$rows['social_id']);
				$this->session->set_userdata('register_method',$rows['register_method']);
				
				
				$login_counter = $rows['login_counter'];
				
				if($login_counter == 0){
				/************** email to user on signup email sender  **************************************/  
					$query = $this->db->query('SELECT * FROM adminemail ');
					$adminEmail = $query->row_array();
					$fromname = $adminEmail['name'];
					$fromEmail = $adminEmail['email'];
					
					$this->email->from($fromEmail, ucwords($fromname));
					$this->email->to($email);
					$this->email->subject('Welcome to the Weblistr Community!');
					
					$logolink = base_url()."images/logo.png";
					$emailmodel =& get_instance(); 
					$emailmodel->load->model("emailmodel");
					$mailbody = $this->emailmodel->userfirsttimelogin($logolink,$rows['usr_name']);
					
					$this->email->set_mailtype("html");
					$this->email->message($mailbody);
					$this->email->send();
				//email End
				}
				$newlogcounter = $login_counter+1;
				$usrid =  $rows['usr_id'];
				$sql = " update user_register set login_counter = '$newlogcounter' where user_register.usr_id =  '$usrid' ";
				$this->db->query($sql);
				
				
				echo 'loggedin';
			}	
			else{
				echo 'banned';
			}
		}
		else{
			echo "notloggedin";
		}
    }
	
	function getUserDetails($usr_id) //userRegister table select by user id
	{
		$sql = "select user_register.*,tbl_state.state_name from user_register,tbl_state  where user_register.state = tbl_state.state_id and user_register.usr_id = $usr_id ";
		
		//$sql = "select * from user_register where usr_id = $usr_id ";
		
		$result = $this->db->query($sql)->result_array();
        return $result;
	}
	
	function getUserDetailinRow($usr_id) //userRegister table select by user id
	{
		$sql = "select user_register.* from user_register where user_register.usr_id = $usr_id ";
		
		//$sql = "select * from user_register where usr_id = $usr_id ";
		
		$result = $this->db->query($sql)->row_array();
        return $result;
	}
	function userimage($usr_id) //userRegister table select by user id
	{
		$sql = "select * from user_register  where usr_id = $usr_id ";
		
		//$sql = "select * from user_register where usr_id = $usr_id ";
		
		$result = $this->db->query($sql)->row_array();
        return $result;
	}
	
	function getUserImage($usr_id) //userRegister table select by user id
	{
		$sql = "select * from user_register  where user_register.usr_id = $usr_id ";
		
		//$sql = "select * from user_register where usr_id = $usr_id ";
		
		$result = $this->db->query($sql)->result_array();
        return $result;
	}
	function getUserName($usr_id) //userRegister table select by user id
	{
		$sql = "select usr_name,profile_image from user_register  where user_register.usr_id = $usr_id ";
		
		//$sql = "select * from user_register where usr_id = $usr_id ";
		
		$result = $this->db->query($sql)->result_array();
        return $result;
	}
	
	function getUserAddress($usr_id) //userRegister table select by user id
	{
		$sql = "select state,country from user_register  where user_register.usr_id = $usr_id ";
		
		//$sql = "select * from user_register where usr_id = $usr_id ";
		
		$result = $this->db->query($sql)->result_array();
        return $result;
	}

	function getStateName($stateID) {
        $sql = "SELECT * FROM tbl_state where state_id = $stateID ";
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }
        return $result;
    }
	
	function getCountryName($CountryID) //userRegister table select by user id
	{
		$sql = "select * from tbl_country where country_id =  $CountryID";
		
		//$sql = "select * from user_register where usr_id = $usr_id ";
		
		$result = $this->db->query($sql)->result_array();
        return $result;
	}
	
	function getState($countryID) //userRegister table select by user id
	{
		$sql = "select * from tbl_state where country_id = $countryID ";
		
		$result = $this->db->query($sql)->result_array();
        return $result;
	}
	
	function getSelectState($stateID) //userRegister table select by user id
	{
		$sql = "select * from tbl_state where state_id = $stateID ";
		
		$result = $this->db->query($sql)->result_array();
        return $result;
	}
	
	
	
	public function changePassword()
	{
		$userid = $this->session->userdata('usr_id');
		$currentPassword = $this->input->post('currentPassword');
		$newPassword = $this->input->post('newPassword');
		$confirmPassword = $this->input->post('confirmPassword');
		
		$sql = "select * from user_register where usr_id = '$userid' ";
		
		$result = $this->db->query($sql)->row_array();
        if($newPassword == $confirmPassword){
			if($result['usr_password'] == md5($currentPassword.'2@41bl13c9'))
			{
				$this->db->where("usr_id",$userid);
				$data = array(
					'usr_password' => md5($newPassword.'2@41bl13c9')
				);
				$this->db->update('user_register', $data);
				
				
				///Email code 
				$toemailusrid = $userid;
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
					$this->email->subject('Password Changed');
					$mailbody = $this->mailtemplate('Your password has been changed successfully and your new password is - '.$newPassword);
					$this->email->set_mailtype("html");
					$this->email->message($mailbody);
					$this->email->send();
				}
				
				$this->session->unset_userdata('usr_id','');
				$this->session->unset_userdata('usr_name','');
				$this->session->unset_userdata('email_id','');
				$this->session->unset_userdata('logged_in','FALSE');
						  
				//$this->session->unset_userdata($newdata );
				$this->session->sess_destroy();
				
				///Email code 
				echo $userid;
				
			}
			else{
				echo "nosamepwd";
			}
		}
		else{
			echo "newpwdmatch";
		}
		//echo $userid;
	}
	
	function userProfileUpdate($userID) //userRegister table select by user id
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$bio = $this->input->post('bio');
		$mobile = $this->input->post('mobile');
		$addr = $this->input->post('addr');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$country = $this->input->post('country');
		
		//echo $country;
		
		$this->db->where("usr_id",$userID);
        $data = array(
			'usr_name' => $name,
			'bio' => $bio,
			'mobile' => $mobile,
			'address' => $addr,
			'city' => $city,
			'state' => $state,
			'country' => $country,
			
		);
	    $this->db->update('user_register', $data);
		$this->session->set_userdata('usr_name',$name);
		echo $userID;
		//$result = $this->db->query($sql)->result_array();
        //return $result;
	}
	
	function getBookmarkedProduct($usr_id) //userRegister table select by user id
	{
		$sql = "select product.*,reviews.rev_id from product
inner join reviews on product.prd_id = reviews.prd_id 
where reviews.usr_id = $usr_id and reviews.bookmark = 1 order by reviews.rev_id desc";
		
		//$sql = "select * from product where prd_id in (SELECT prd_id FROM `reviews` where usr_id = $usr_id and bookmark = 1) ";
		
		$result = $this->db->query($sql)->result_array();
        return $result;
	}
	
	function getUserReviews($usr_id) //userRegister table select by user id
	{
		$sql = "SELECT product.prd_name,product.prd_image,category.cat_name, reviews.* FROM `reviews` 
inner join product on reviews.prd_id = product.prd_id 
inner join category on reviews.cat_id = category.cat_id 
where  reviews.usr_id = ".$usr_id. " and reviews.review_head <> '' order by reviews.rev_id desc ";
		
		$result = $this->db->query($sql)->result_array();
        return $result;
	}
	
	
	function getreviewsStar($rev_id) //userRegister table select by user id
	{
		$sql = "SELECT * from  review_details where review_details.rev_id = ".$rev_id;
		
		$result = $this->db->query($sql)->row_array();
        return $result;
	}
	
	
	
	function check_user($email)
	{
		$this->db->where("email_id",$email);
        $query=$this->db->get("user_register");
        if($query->num_rows()>0)
		{
			 return true;   
		}
		return false;
	}
	
	
	
	public function com_signup()
	{
		$email = $this->input->post('email');

		$checked=$this->check_user($email);

		$ccat=$this->input->post('cat');

		$curl=$this->input->post('url');

		$cname=$this->input->post('uname');
		
		if($checked == false)
		{
			//Checking product in product table
			$sql ="SELECT * FROM `product` WHERE `prd_name` LIKE '%".$cname."%' or `prd_link` LIKE '%".$curl."%'";
			$check=$this->db->query($sql);

			if($this->db->affected_rows()>0)
			{
				$data = $check->row_array();
				$prdid=$data['prd_id'];
				echo "someonealloted";
			}
			else
			{
				$date = date('Y-m-d H:i:s');
				$data=array(
					'usr_name'=>$this->input->post('uname'),
					'email_id'=>$this->input->post('email'),
					'usr_password'=>md5($this->input->post('pwd').'2@41bl13c9'),
					'register_method'=>'website',//$this->input->post('email_address'),
					'state'=>'36',
					//'social_id'=>$this->input->post('email_address'),
					'register_date'=>$date,//$this->input->post('email_address'),
					'status'=>'0',
					'admin_status'=>'1' //default he register as a company but not approved yet
					);
				$this->db->insert('user_register',$data);
				$query = $this->db->query('SELECT LAST_INSERT_ID()');
				$row = $query->row_array();
				$uid = $row['LAST_INSERT_ID()']; //order id
				
				$prdid=0;
				$this->db->query("INSERT into `applications` (`uid`,`company_name`,`company_url`,`category`,`status`,`availability`) values ($uid,'$cname','$curl',$ccat,0,$prdid)");
				
				/************** email to user on signup email sender  **************************************/  
				$query = $this->db->query('SELECT * FROM `adminemail` ');
				$adminEmail = $query->row_array();
				$fromname = $adminEmail['name'];
				$fromEmail = $adminEmail['email'];
				
				$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
				$this->email->to($email);
				$this->email->subject('Verify Your Account');
				$link = base_url()."verify/index/".base64_encode($email)."_@_". md5($this->input->post('pwd').'2@41bl13c9');
				//Email Template Model
					$logolink = base_url()."images/logo.png";
					$emailmodel =& get_instance(); 
					$emailmodel->load->model("emailmodel");
					//$mailbody = $this->emailmodel->RegistrationEmailConfirmation($link,$logolink);
					$mailbody = $this->emailmodel->companyemailverification($link,$logolink);
				//Email Template Model
				
				//$mailbody = $this->verifyemailhtml($link,base_url());
				$this->email->set_mailtype("html");
				$this->email->message($mailbody);
				$this->email->send();
				//email End
				
				echo "User Registered Successfully";
			}

			
		}
		else
		{
			echo "noregister";
		}
	}
	
	
	
	public function add_user()
	{
		$email = $this->input->post('email');
		$uname = $this->input->post('uname');
		$pwd = $this->input->post('pwd');
		
		$checked=$this->check_user($email);
		if($checked == false)
		{
			$date = date('Y-m-d H:i:s');
			$data=array(
				'usr_name'=>$uname,
				'email_id'=>$email,
				'usr_password'=>md5($pwd.'2@41bl13c9'),
				'register_method'=>'website',//$this->input->post('email_address'),
				'state'=>'36',
				//'social_id'=>$this->input->post('email_address'),
				'register_date'=>$date,//$this->input->post('email_address'),
				'status'=>'0'//$this->input->post('email_address'),
				);
			$this->db->insert('user_register',$data);
			
			
			/************** email to user on signup email sender  **************************************/  
			$query = $this->db->query('SELECT * FROM adminemail ');
			$adminEmail = $query->row_array();
			$fromname = $adminEmail['name'];
			$fromEmail = $adminEmail['email'];
			
			$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
			$this->email->to($email);
			$this->email->subject('Verify Your Account');
			$link = base_url()."verify/index/".base64_encode($email)."_@_". md5($this->input->post('pwd').'2@41bl13c9');
			
			//Email Template Model
				$logolink = base_url()."images/logo.png";
				$emailmodel =& get_instance(); 
				$emailmodel->load->model("emailmodel");
				$mailbody = $this->emailmodel->RegistrationEmailConfirmation($link,$logolink);
			//Email Template Model
			
			//$mailbody = $this->verifyemailhtml($link,base_url());
			$this->email->set_mailtype("html");
			$this->email->message($mailbody);
			$this->email->send();
			//email End
			
			echo "User Registered Successfully";
		}
		else
		{
			echo "noregister";
		}
	}
	
	
	/////forgot password
	function forgotemailhtml($resetlink,$baselink)
	{
		return '<style type="text/css">
					/* Take care of image borders and formatting, client hacks */
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


					/* General styling */
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

				<style type="text/css" media="screen">
					@import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
				</style>

				<style type="text/css" media="screen">
					@media screen {
						/* Thanks Outlook 2013! */
						* {
							font-family: "Oxygen", "Helvetica Neue", "Arial", "sans-serif" !important;
						}
					}
				</style>

				<style type="text/css" media="only screen and (max-width: 480px)">
					/* Mobile styles */
					@media only screen and (max-width: 480px) {

						table[class*="container-for-gmail-android"] {
							min-width: 290px !important;
							width: 100% !important;
						}

						table[class="w320"] {
							width: 320px !important;
						}

						img[class="force-width-gmail"] {
							display: none !important;
							width: 0 !important;
							height: 0 !important;
						}

						a[class="button-width"],
						a[class="button-mobile"] {
							width: 248px !important;
						}

						td[class*="mobile-header-padding-left"] {
							width: 160px !important;
							padding-left: 0 !important;
						}

						td[class*="mobile-header-padding-right"] {
							width: 160px !important;
							padding-right: 0 !important;
						}

						td[class="header-lg"] {
							font-size: 24px !important;
							padding-bottom: 5px !important;
						}

						td[class="header-md"] {
							font-size: 18px !important;
							padding-bottom: 5px !important;
						}

						td[class="content-padding"] {
							padding: 5px 0 30px !important;
						}

						td[class="button"] {
							padding: 5px !important;
						}

						td[class*="free-text"] {
							padding: 10px 18px 30px !important;
						}

						td[class="info-block"] {
							display: block !important;
							width: 280px !important;
							padding-bottom: 40px !important;
						}

						td[class="info-img"],
						img[class="info-img"] {
							width: 278px !important;
						}
					}
				</style>
					
				<table align="center" cellpadding="0" cellspacing="0" class="container-for-gmail-android" width="100%" style="background-color:#f7f7f7;">
					<tr>
						<td align="left" valign="top" width="100%" style="background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;">
							<center>
								<img src="http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png" class="force-width-gmail">
									<table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff" background="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" style="background-color:transparent">
										<tr>
											<td width="100%" height="80" valign="top" style="text-align: center; vertical-align:middle;">
												<center>
													<table cellpadding="0" cellspacing="0" width="600" class="w320">
														<tr>
															<td class="pull-left mobile-header-padding-left" style="vertical-align: middle;">
																<a href="'.$baselink.'"><img width="137" height="47" src="http://demo.dupleit.com/weblister_v2/images/logo.png" alt="logo"></a>
															</td>
															<td class="pull-right mobile-header-padding-right" style="color: #4d4d4d;">
																<a href="https://twitter.com/TheWeblistersIN"><img width="44" height="47" src="http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif" alt="twitter" /></a>
																<a href="https://www.facebook.com/theweblisters"><img width="38" height="47" src="http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif" alt="facebook" /></a>
																<a href="#"><img width="40" height="47" src="http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif" alt="rss" /></a>
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
						<td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
							<center>
								<table cellspacing="0" cellpadding="0" width="600" class="w320">
									<tr>
										<td class="button">
											<center>
											<div style="margin-top: 30px;" >
												click <a class="button-mobile" href="'.$resetlink.'" >here</a> to reset your password
											</div>
											</center>
										</td>
									</tr>
								</table>
							</center>
						</td>
					</tr>
					
					<tr>
						<td align="center" valign="top" width="100%" style="background-color: #f7f7f7; height: 100px;">
							<center>
								<table cellspacing="0" cellpadding="0" width="600" class="w320">
									<tr>
										<td style="padding: 25px 0 25px">
											<strong>The Weblisters</strong><br />
											Kolkata <br />
											India <br /><br />
										</td>
									</tr>
								</table>
							</center>
						</td>
					</tr>
				</table>';
	}
	///email template 
	function forgot($email)
	{
		
		$this->db->where("email_id",$email);
        $query=$this->db->get("user_register");
		
		if($query->num_rows()>0)
		{
			$data = $query->row_array();
		
			$pass=base64_encode($data['usr_password']."aba".$data['usr_id']);
			$link= base_url().'user/reset_pass/'.$pass;
			
			/************** email to user on signup email sender  **************************************/  
			$query = $this->db->query('SELECT * FROM adminemail ');
			$adminEmail = $query->row_array();
			$fromname = $adminEmail['name'];
			$fromEmail = $adminEmail['email'];
			
			$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
			$this->email->to($email);
			$this->email->subject('Forgot Password');
			
			//$this->email->message('Click on link to get new password '.$link);
			$mailbody = $this->forgotemailhtml($link,base_url());
			$this->email->set_mailtype("html");
			$this->email->message($mailbody);
			
			
			$this->email->send();
			//email End
			
			echo "<span class='infosuccess'>A reset link has been sent to the registered email Id.</span>";
		}
		else
		{
			echo "<span class='infodanger'>User does not Exists</span>";
		}
	}
	
	function reset_pass($param)
	{
		$var=explode("aba",base64_decode($param));
		
		$check=$this->db->query("select usr_id from user_register where usr_id=".$var[1]."");
		
		if($check->num_rows()>0)
		{
			$response=$var[1];
		}
		else
		{
			$response="proximity";
		}
		return $response;
	}
	function set_pass($teck){
		$this->db->query("update user_register set usr_password = '".md5($_POST['pass']."2@41bl13c9")."' where usr_id=".$teck."");
		echo '<span style="color:green;">Password updated successfully.</span>';
	}
	function check_fb_id($fbid)
	{
		$this->db->where("social_id",$fbid);
        $query=$this->db->get("user_register");
        if($query->num_rows()>0)
		{
			 return true;   
		}
		return false;
	}
	
	public function fb_add_user() //signup and login
	{
		$fbid = $this->input->post('fbid');
		$fbname = $this->input->post('fbname');
		$checked=$this->check_fb_id($fbid);
		if($checked == false)
		{
			$date = date('Y-m-d H:i:s');
			$data=array(
				'usr_name'=>$fbname,
				'register_method'=>'facebook',//$this->input->post('email_address'),
				'register_date'=>$date,//$this->input->post('email_address'),
				'state'=>'0',
				'status'=>'1',//$this->input->post('email_address'),
				'social_id'=>$fbid//$this->input->post('email_address'),
				);
			$this->db->insert('user_register',$data);
			
			$query = $this->db->query('SELECT LAST_INSERT_ID()');
			$row = $query->row_array();
			$userID = $row['LAST_INSERT_ID()'];
			
			$this->session->set_userdata('usr_id',$userID);
			$this->session->set_userdata('usr_name',$fbname);
			//$this->session->set_userdata('email_id',$rows->email_id);
			$this->session->set_userdata('admin_status',0);
			$this->session->set_userdata('super_admin_status',0);
			$this->session->set_userdata('logged_in','TRUE');
			$this->session->set_userdata('fb_profile',$rows->social_id);
			$this->session->set_userdata('register_method',$rows->register_method);
			
			//echo "User Registered Successfully";
			echo $userID;
		}
		else
		{
			$this->db->where("social_id",$fbid);
			$query=$this->db->get("user_register");
			if($query->num_rows()>0)
			{
				foreach($query->result() as $rows)
				{
					$this->session->set_userdata('usr_id',$rows->usr_id);
					$this->session->set_userdata('usr_name',$rows->usr_name);
					$this->session->set_userdata('email_id',$rows->email_id);
					$this->session->set_userdata('admin_status',$rows->admin_status);
					$this->session->set_userdata('super_admin_status',$rows->super_admin_status);
					$this->session->set_userdata('logged_in','TRUE');
					$this->session->set_userdata('fb_profile',$rows->social_id);
					$this->session->set_userdata('register_method',$rows->register_method);
				}
			}
			echo "0";
		}
	}
	function change_password($user_id,$password)
    {
		$this->db->where("id",$user_id);
        $data = array(
			'password' => $password
		);
	    $this->db->update('user', $data);
		return true;		
    }
	
	function updateProfileImage($userid)
	{
		$fname = $_FILES['file']['name']; 
		$fileTmpName= $_FILES["file"]["tmp_name"]; 
		
		$random=rand(1111,9999);
		$newFileName=$random.$fname;

		$filepath = "images/user/".$newFileName; //images/product/flipkart_logo.jpg
		
		$resizestatus = $this->resizesave($fileTmpName,$filepath,150,150);
		if($resizestatus == 1)//if(move_uploaded_file($fileTmpName,$filepath))
			{
			$this->db->where("usr_id",$userid);
			$data = array(
				'profile_image' => $filepath
			);
			$this->db->update('user_register',$data);
			echo $userid;
		}
		else 
		{
			echo "0";
		}
	}
	
	function add_image($user_id,$userfile)
	{
		$this->db->where("id",$user_id);
		$data = array(
			'image' => $userfile['file_name']
		);
		$this->db->update('user',$data);
		return true;
	}
	
	/*function fetchup()
	{
		//$this->db->where("id",$user_id);
		//$data = array(
			//'image' => $userfile['file_name']
		//);
		//$this->db->update('user',$data);
		//return true;
		return "fetchu up ";
	}*/
	function feedback($user)
	{
		
		$email=$this->input->post('email');
		$message=$this->input->post('message');
		
		$date = date('Y-m-d H:i:s');
		$data=array(
			'email'=>$email,
			'message'=>$message,
			'feed_date'=>$date
			);
		$this->db->insert('feedback',$data);
		
		
		/************** email to user on signup  **************************************/  
		$query = $this->db->query('SELECT * FROM adminemail ');
		$adminEmail = $query->row_array();
		$fromname = $adminEmail['name'];
		$fromEmail = $adminEmail['email'];
		
		$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
		$this->email->to($email,$fromEmail);
		$this->email->subject('Feedback');
		$mailbody = $this->feedbackemailhtml($email,$message,base_url());
		$this->email->set_mailtype("html");
		$this->email->message($mailbody);
		$this->email->send();
		//email End
		
		echo "Your feedback has been sent.";
		
	}
	
	function feedbackemailhtml($email,$message,$baselink)
	{
		return '<style type="text/css">
            /* Take care of image borders and formatting, client hacks */
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


            /* General styling */
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

        <style type="text/css" media="screen">
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type="text/css" media="screen">
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: "Oxygen", "Helvetica Neue", "Arial", "sans-serif" !important;
                }
            }
        </style>

        <style type="text/css" media="only screen and (max-width: 480px)">
            /* Mobile styles */
            @media only screen and (max-width: 480px) {

                table[class*="container-for-gmail-android"] {
                    min-width: 290px !important;
                    width: 100% !important;
                }

                table[class="w320"] {
                    width: 320px !important;
                }

                img[class="force-width-gmail"] {
                    display: none !important;
                    width: 0 !important;
                    height: 0 !important;
                }

                a[class="button-width"],
                a[class="button-mobile"] {
                    width: 248px !important;
                }

                td[class*="mobile-header-padding-left"] {
                    width: 160px !important;
                    padding-left: 0 !important;
                }

                td[class*="mobile-header-padding-right"] {
                    width: 160px !important;
                    padding-right: 0 !important;
                }

                td[class="header-lg"] {
                    font-size: 24px !important;
                    padding-bottom: 5px !important;
                }

                td[class="header-md"] {
                    font-size: 18px !important;
                    padding-bottom: 5px !important;
                }

                td[class="content-padding"] {
                    padding: 5px 0 30px !important;
                }

                td[class="button"] {
                    padding: 5px !important;
                }

                td[class*="free-text"] {
                    padding: 10px 18px 30px !important;
                }

                td[class="info-block"] {
                    display: block !important;
                    width: 280px !important;
                    padding-bottom: 40px !important;
                }

                td[class="info-img"],
                img[class="info-img"] {
                    width: 278px !important;
                }
            }
        </style>
  


        <table align="center" cellpadding="0" cellspacing="0" class="container-for-gmail-android" width="100%" style="background-color:#f7f7f7" >
            <tr>
                <td align="left" valign="top" width="100%" style="background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;">
                    <center>
                        <img src="http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png" class="force-width-gmail">
                            <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff" background="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" style="background-color:transparent">
                                <tr>
                                    <td width="100%" height="80" valign="top" style="text-align: center; vertical-align:middle;">
                                     
                                        <center>
                                            <table cellpadding="0" cellspacing="0" width="600" class="w320">
                                                <tr>
                                                    <td class="pull-left mobile-header-padding-left" style="vertical-align: middle;">
                                                        <a href=""><img width="137" height="47" src="http://demo.dupleit.com/weblister_v2/images/logo.png" alt="logo"></a>
                                                    </td>
                                                    <td class="pull-right mobile-header-padding-right" style="color: #4d4d4d;">
                                                        <a href=""><img width="44" height="47" src="http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif" alt="twitter" /></a>
                                                        <a href=""><img width="38" height="47" src="http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif" alt="facebook" /></a>
                                                        <a href=""><img width="40" height="47" src="http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif" alt="rss" /></a>
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
                <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
                    <center>
                        <table cellspacing="0" cellpadding="0" width="600" class="w320">
                            <tr>
                                <td class="header-lg">
							The Weblisters!
                                </td>
                            </tr>
                            <tr>
                                <td class="free-text">
                                    Thank you for contacting us, our team will contact you soon.
                                </td>
                            </tr>
                            <tr>
                                <td style="height:100px;"></td>
                            </tr>
                            <tr>
                                <td >
                                    <table>
									<tr>
									<tr><td>Email</td><td>'.$email.'</td></tr>
									<tr><td>Message</td><td>'.$message.'</td></tr>
									</table>
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align="center" valign="top" width="100%" style="background-color: #f7f7f7; height: 100px;">
                    <center>
                        <table cellspacing="0" cellpadding="0" width="600" class="w320">
                            <tr>
                                <td style="padding: 25px 0 25px">
                                    <strong>The Weblisters</strong><br />
                                    Kolkata <br />
                                    India <br /><br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>';
			
	}
	
	function getCompanyProfile() //userRegister table select by user id
	{
		$userid = $this->session->userdata('usr_id');
			
		$sql="SELECT * FROM `product` where usr_type ='user' and added_by = $userid limit 1";
		
		$result = $this->db->query($sql)->row_array();
        return $result;
	}
	
	

	function getCompanyReview($prdid) 
	{
			
		$sql="SELECT * FROM `reviews` where prd_id = $prdid and status = 1 ORDER BY rev_id desc limit 3";
		
		$result = $this->db->query($sql)->result_array();
        return $result;
	}
	
	//define('PAGE_PER_NO',3); // number of results per page.
	
	function getPagination($prdid){
		$sql="SELECT * FROM `reviews` where prd_id = $prdid ORDER BY rev_id desc ";
		
		$result = $this->db->query($sql)->result_array();
		$count = sizeof($result);
		
		$PAGE_PER_NO = 3;
		  $paginationCount= floor($count / $PAGE_PER_NO);
		  $paginationModCount= $count % $PAGE_PER_NO;
		  if(!empty($paginationModCount)){
				   $paginationCount++;
		  }
		  return $paginationCount;
	}
	
	
	function fetchpagingcontent($id,$prdID)
	{
		$pageLimit=3*$id;
		
		$sql="SELECT * FROM `reviews` where prd_id = $prdID ORDER BY rev_id desc limit $pageLimit,3";
		
		$getCompanyReview = $this->db->query($sql)->result_array();
		if(sizeof($getCompanyReview) > 0){
			foreach($getCompanyReview as $rev)
			{
				
				$userdetails = $this->user_model->getUserDetailinRow($rev['usr_id']);
				?>
				
				<div class="rev_details company">
				<div class="r_profile company">
				<?php 
				if(trim($userdetails['register_method']) == trim('facebook')){
					?>
					<img src="http://graph.facebook.com/<?php echo $userdetails['social_id']; ?>/picture?type=square" alt="profile-pic" />
					<?php
				}
				else{
					if($userdetails['profile_image'] != ''){
						
						
						
						if (file_exists($userdetails['profile_image'])){ 
							?>
								<img src='<?php echo $userdetails['profile_image'] ?>' alt='profile-pic' />
							<?php
						}else{
							?>
							<img src="images/about-icon-md.png" alt="profile-pic">
							<?php 
						}
					
					}
					else{
						?>
							<img src="images/about-icon-md.png" alt="profile-pic" />
						<?php
					}
				}
				?>
				</div>
				<div class="r_info comp">
				<div class="r_info_head">
				<h4><?php echo $userdetails['usr_name']; ?></h4>
				</div>

				<div class="r_details info-para">
					<h1><?php echo $rev['review_head']; ?> </h1>
					

				<?php echo substr($rev['review_body'],0,250); ?>  

				</div>
				
<?php
$revImages = $this->write_review_model->getReviewImages($rev['rev_id']);
if(sizeof($revImages)>0)
{
	?>
	<div class="r_thumbnails">
		<ul>
			<?php 
			foreach($revImages as $revimage){
			?>
				<li>
				<a class="fancybox" href="<?php echo $revimage['rev_image'] ?>" data-fancybox-group="gallery<?php echo $rev['rev_id']; ?>" title="<?php echo $rev['review_head'] ?>">
				
				<img src="<?php echo $revimage['thumbnail'] ?>" />
				</a>
				</li>
			<?php
			}
			?>
		</ul>
	</div>
	<?php
}
?>


<a class="reply_btn" role="button" data-toggle="collapse" href="#collapseExample_<?php echo $rev['rev_id'] ?>" aria-expanded="false" aria-controls="collapseExample">Reply</a>

<div class="collapse toggle" id="collapseExample_<?php echo $rev['rev_id'] ?>">
  <div class="well bg">
   <textarea class="form-control" rows="3" id='textbox_<?php echo $rev['rev_id'] ?>' placeholder="Your Message"></textarea>
   <button type="button" onclick='replyid(this.id)' id='<?php echo $rev['rev_id'] ?>' class="reply_btn snd">Send</button>
  </div>
</div>

</div>
<div class="rev_tmngs"><?php echo  date("d-m-Y", strtotime($rev['date'])); ?></div>


<div class="col-a">			
<?php

$getReviewComment = $this->write_review_model->getReviewComment($rev['rev_id']);
if(sizeof($getReviewComment) > 0) //Comments of Review
{
?>

<div class="com-rev">
<ul>
<?php
		foreach ($getReviewComment as $cmtValue)
		{
			?>
				<li>
				<div class="comment-col">
                <div class="pull-left">
                
                <div class="commt-pic">
					<?php 
					if($cmtValue['register_method'] == 'facebook')
					{
						?>
							<img src="http://graph.facebook.com/<?php echo $cmtValue['social_id']; ?>/picture?type=large" alt="profile-pic" />
					   <?php
					}
					else if($cmtValue['profile_image'] != '')
					{
						
						if (file_exists($cmtValue['profile_image'])){ 
							?>
								<img src="<?php echo $cmtValue['profile_image'] ?>" alt="profile-pic">
							<?php
						}else{
							?>
							<img src="images/about-icon-md.png" alt="profile-pic">
							<?php 
						}
					}
					else{
						?>
						<img src="images/about-icon-md.png" alt="profile-pic">
						<?php 
					}
					?>
                    
                    <span class="user-n"><a href="user/profile/<?php  echo $cmtValue['usr_id']; ?>"> <?php echo $cmtValue['usr_name']; ?></a></span>
				
				</div>
                </div>
                
                <div class="pull-right">
                <div class="comm-date-time">
					<span class="commt-date"><?php echo date("d-m-Y", strtotime($cmtValue['date']));  ?></span>
				</div>
                
                </div>
                
                <div class="commt-des">
               <p>
				<?php echo $cmtValue['cmt_text'] ?></p>
                
				</div>
          
				</div>
				</li>
		<?php } ?>
</ul>

</div>


	<div class="view-commt"><a href="javascript:commentmodalread('<?php echo $rev['rev_id'] ?>')" class="view-commt">View All</a></div>

<?php

}

?>
	</div>			
				
			<!--	<div class="collapse toggle" id="collapseExample_<?php echo $rev['rev_id'] ?>">
				  <div class="well bg">
				   <textarea class="form-control" rows="3" id='textbox_<?php echo $rev['rev_id'] ?>' placeholder="Your Message"></textarea>
				   <button type="submit" class="reply_btn snd">Send</button>
				  </div>
				</div>

				</div>
				<div class="rev_tmngs"><?php echo  date("d-m-Y", strtotime($rev['date'])); ?></div>-->
				</div>
				
				<?php
			}
		}
		else{
			echo "No More Reviews";
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