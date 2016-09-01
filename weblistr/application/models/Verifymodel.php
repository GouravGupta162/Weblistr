<?php
class Verifymodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('email','session'));
		$this->load->helper(array("url","form","string"));
	}
	function index($id)
	{
		$this->checkauth($id);
		//return $id;
		
		// $events=$this->db->query("CALL get_events('1','".$this->session->userdata("user_id")."')");
		// $this->db->close();
		// $this->db->reconnect();
		// return $events->result_array();
	}
	function checkauth($id)
	{
		$bool = '0';
		$arraydata = explode('_@_',$id);
		if(sizeof($arraydata) > 0)
		{
			$email  = $arraydata[0];//Base64 //aadil@aadil.com  // YWFkaWxAYWFkaWwuY29t
			$pwd  = $arraydata[1];//MD5 //39046ff8c920475f4290566cfae3abea
			
			$this->db->where("email_id",base64_decode($email));
			$this->db->where("usr_password",$pwd);
			$query=$this->db->get("user_register");
			if($query->num_rows()>0)
			{
				$sql = "update `user_register` set status = '1' where email_id = '".base64_decode($email)."' and usr_password = '$pwd' ";
				$query = $this->db->query($sql);
				$bool = '1';	
			}
		}
		if($bool=='1')
		{
			$this->session->set_userdata('auth','1');
			//echo  "Auth";
		}
		else{
			$this->session->set_userdata('auth','0');
		}
		echo '<script>window.location.href="'.base_url().'"; </script>';
	}

	function invite_user_event()/*******************         when a user invite users to an event         ****************/       
	{
			$ids=explode(",",substr($_POST['ids'],0,-1));
			for($i=0;$i<count($ids);$i++)
			{
				$check=$this->db->query("CALL check_duplicate_user_event('".$ids[$i]."','".$_POST['tid']."')");
				$this->db->close();
				$this->db->reconnect();
				if($check->num_rows()>0) 
				{
					echo "0";
					exit;
				}
				else 
				{
				$email=$this->db->query("CALL user_data('".$ids[$i]."')");
				$this->db->close();
				$this->db->reconnect();
				$invite=$email->row_array();
				$this->email->from('info@gamer.com', 'Your Name');
				$this->email->to($invite['user_email']);
				//$this->email->cc('another@another-example.com');
				//$this->email->bcc('them@their-example.com');
				$this->email->subject('Invitation Mail');
				$this->email->message('Testing the email class.');
				$this->email->send();
				$this->db->query("CALL add_user_to_event('".$invite['user_id']."','".$_POST['tid']."','1','0','0')");
				}
			}
	}
}
?>