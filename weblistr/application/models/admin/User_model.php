<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class user_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url', 'form', 'file', 'string'));
    }
	function userEditUpdateForm()
	{
		$user_id = $this->input->post('usr_id');
		$usr_name = $this->input->post('usr_name');
		$bio = $this->input->post('bio');
		$mobile = $this->input->post('mobile');
		$address = $this->input->post('address');
		$city = $this->input->post('city');
		
		$state = $this->input->post('state');
		$country = $this->input->post('country');
		
		$admin_status = $this->input->post('admin_status');
		$super_admin_status = $this->input->post('super_admin_status');

		 
		$data = array(
			'usr_name' => $usr_name,
			'bio' => $bio,
			'mobile' => $mobile,
			'address' => $address,
			'city' => $city,
			'state' => $state,
			'country' => $country,
			'admin_status' => $admin_status,
			'super_admin_status' => $super_admin_status
		);
		$this->db->where("usr_id",$user_id);
		$this->db->update("user_register",$data);
		echo "1";
		
	}
	function getState($countryID) //userRegister table select by user id
	{
		$sql = "select * from tbl_state where country_id = $countryID ";
		
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
	

    function UserStatusUpdate() { //Admin
        $user_id = $this->input->post('usr_id');
        $stts = $this->input->post('stts');
        $sql = "update `user_register` set status = '$stts' where usr_id = '$user_id'";
        $query = $this->db->query($sql);
		
		if(($stts == "0")&&($stts != "1"))
		{
			///Email code 
			$toemailusrid = $user_id;
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
				$this->email->subject('Account Blocked');
				$mailbody = $this->mailtemplate('Your account has been blocked!');
				$this->email->set_mailtype("html");
				$this->email->message($mailbody);
				$this->email->send();
			
			}
			///Email code 
		}
		
        echo $user_id; //updated
    }

	function companyUserStatusUpdate() { //Admin
        $user_id = $this->input->post('usr_id');
        $stts = $this->input->post('stts');
		if($stts == 0)
		{
        $sql = "update `user_register` set status = '$stts' where usr_id = '$user_id'";
		}
		else{
			$sql = "update `user_register` set status = '$stts',admin_status = '1' where usr_id = '$user_id'";
		}
        $query = $this->db->query($sql);
        echo $user_id; //updated
    }

    function getAllUser() {
        $sql = "SELECT * FROM `user_register` where admin_status='0' order by usr_id desc  limit 10";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
    
    function getcmpUser() {
        $sql = "SELECT * FROM `applications` order by id desc limit 10";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
	function getcmpUseronscroll() {
		$getresult = $this->input->post('getresult');
        $sql = "SELECT * FROM `applications` order by id desc  limit $getresult,10";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
	
    function getSelectedUser($id) {
        $sql = "SELECT * FROM `user_register` where usr_id = '$id' ";
		$query = $this->db->query($sql);
		return $query->row_array();       
    }

	function getAllUserOnScroll() {
		$getresult = $this->input->post('getresult');
        $sql = "SELECT * FROM `user_register` order by usr_id desc limit $getresult,10";
		$query = $this->db->query($sql);
		return $query->result_array();
    }


    function getCountryName($countryID) {
        $sql = "select * from tbl_country where country_id = $countryID ";
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }
        return $result;
    }
	public function PostAdd() {
        $user_name = $this->input->post('user_name');
        $email_address = $this->input->post('email_address');
        $password = $this->input->post('password');
        $userType = $this->input->post('userType');
        
		
		$checker = $this->check_user($email_address);
		if($checker == false){
			$data = array(
				'usr_name' => $user_name,
				'email_id' => $email_address,
				'usr_password' => md5($password.'2@41bl13c9'),
				'register_method' => 'admin',
				'admin_status' => $userType
			);
			$this->db->insert('user_register', $data);
			$query = $this->db->query('SELECT LAST_INSERT_ID()');
			$row = $query->row_array();
			$prd_id = $row['LAST_INSERT_ID()'];
			
			echo $prd_id;
		}
		else
		{
			echo "0";
		}
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

	public function getotherdetails($id)
	{
		//return "$id";

		$sql = "SELECT `t1`.*,`t2`.* FROM `applications` as `t1`,`category` as `t2` WHERE `t1`.`uid`=$id AND `t2`.`cat_id`=`t1`.`category`";
		$query=$this->db->query($sql);

		if ($this->db->affected_rows()>0) {
			$data = $query->row_array();

			return 'Comapany Name: '.$data['company_name'].'<br/>Company URL: '.$data['company_url'].'<br/>Category: '.$data['cat_name'];
		}else{
			return "N/A";
		}
	}
	function approveassign()
	{
		$user_id = $this->input->post('usr_id');
		
		$sql = "SELECT * FROM `applications` where uid = '$user_id' and status = '0' ";
		$query=$this->db->query($sql);
		$datatemp = $query->row_array();
		
		$catid = $datatemp['category'];
		$company_url = $datatemp['company_url'];
		$company_name = $datatemp['company_name'];
		$tempid = $datatemp['id'];
		$tempuid = $datatemp['uid'];
		
		$sql = "insert into product(cat_id,added_by,usr_type,prd_name,prd_link) values ('$catid','$tempuid','user','$company_name','$company_url') ";
		$this->db->query($sql);
		$query = $this->db->query('SELECT LAST_INSERT_ID()');
		$row = $query->row_array();
		$prd_id = $row['LAST_INSERT_ID()'];
		
		$sql = "update applications set status = '1' , availability = '$prd_id' where  id = '$tempid'";
		$query=$this->db->query($sql);
		 
		$data = array(
			'admin_status' => '1'
		);
		$this->db->where("usr_id",$user_id);
		$this->db->update("user_register",$data);
		echo "1";
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